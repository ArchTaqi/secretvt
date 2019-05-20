<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Group class
 *
 * Copyright (c) CIBoard <www.ciboard.co.kr>
 *
 * @author CIBoard (develop@ciboard.co.kr)
 */

/**
 * 게시판 그룹 메인을 담당하는 controller 입니다.
 */
class Group extends CB_Controller
{

    /**
     * 모델을 로딩합니다
     */
    protected $models = array('Board','Post', 'Post_extra_vars');

    /**
     * 헬퍼를 로딩합니다
     */
    protected $helpers = array('form', 'array');

    function __construct()
    {
        parent::__construct();

        /**
         * 라이브러리를 로딩합니다
         */
        $this->load->library(array('pagination', 'querystring', 'accesslevel', 'videoplayer', 'point', 'board_group'));
    }


    /**
     * 게시판 그룹 페이지입니다
     */
    public function index($bgr_key = '')
    {
        // 이벤트 라이브러리를 로딩합니다
        $eventname = 'event_group_index';
        $this->load->event($eventname);

        if (empty($bgr_key)) {
            show_404();
        }

        $view = array();
        $view['view'] = array();

        // 이벤트가 존재하면 실행합니다
        $view['view']['event']['before'] = Events::trigger('before', $eventname);

        $group_id = $this->board_group->item_key('bgr_id', $bgr_key);
        if (empty($group_id)) {
            show_404();
        }

        $group = $this->board_group->item_all($group_id);

        $select = 'brd_id';
        $where = array(
            'bgr_id' => element('bgr_id', $group),
            'brd_search' => 1,
        );
        $board_id = $this->Board_model->get_board_list($where);
        $board_list = array();
        if ($board_id && is_array($board_id)) {
            foreach ($board_id as $key => $val) {
                $board_list[] = $this->board->item_all(element('brd_id', $val));
            }
        }

        $view['view']['list'] = $list = $this->_get_list(element('brd_key',element(0,$board_list)),'',$bgr_key);

        $group['headercontent'] = ($this->cbconfig->get_device_view_type() === 'mobile')
            ? element('mobile_header_content', $group)
            : element('header_content', $group);
         
        $group['footercontent'] = ($this->cbconfig->get_device_view_type() === 'mobile')
            ? element('mobile_footer_content', $group)
            : element('footer_content', $group);
         
        $view['view']['group'] = $group;

        $view['view']['board_list'] = $board_list;

        $view['view']['canonical'] = group_url($bgr_key);

        // 이벤트가 존재하면 실행합니다
        $view['view']['event']['before_layout'] = Events::trigger('before_layout', $eventname);

        /**
         * 레이아웃을 정의합니다
         */
        $page_title = $this->cbconfig->item('site_meta_title_group');
        $meta_description = $this->cbconfig->item('site_meta_description_group');
        $meta_keywords = $this->cbconfig->item('site_meta_keywords_group');
        $meta_author = $this->cbconfig->item('site_meta_author_group');
        $page_name = $this->cbconfig->item('site_page_name_group');

        $searchconfig = array(
            '{그룹명}',
            '{그룹아이디}',
        );
        $replaceconfig = array(
            element('bgr_name', $group),
            $bgr_key,
        );

        $page_title = str_replace($searchconfig, $replaceconfig, $page_title);
        $meta_description = str_replace($searchconfig, $replaceconfig, $meta_description);
        $meta_keywords = str_replace($searchconfig, $replaceconfig, $meta_keywords);
        $meta_author = str_replace($searchconfig, $replaceconfig, $meta_author);
        $page_name = str_replace($searchconfig, $replaceconfig, $page_name);

        $layout_dir = element('group_layout', $group) ? element('group_layout', $group) : $this->cbconfig->item('layout_group');
        $mobile_layout_dir = element('group_mobile_layout', $group) ? element('group_mobile_layout', $group) : $this->cbconfig->item('mobile_layout_group');
        $use_sidebar = element('group_sidebar', $group) ? element('group_sidebar', $group) : $this->cbconfig->item('sidebar_group');
        $use_mobile_sidebar = element('group_mobile_sidebar', $group) ? element('group_mobile_sidebar', $group) : $this->cbconfig->item('mobile_sidebar_group');
        $skin_dir = element('group_skin', $group) ? element('group_skin', $group) : $this->cbconfig->item('skin_group');
        $mobile_skin_dir = element('group_mobile_skin', $group) ? element('group_mobile_skin', $group) : $this->cbconfig->item('mobile_skin_group');
        $layoutconfig = array(
            'path' => 'group',
            'layout' => 'layout',
            'skin' => 'group',
            'layout_dir' => $layout_dir,
            'mobile_layout_dir' => $mobile_layout_dir,
            'use_sidebar' => $use_sidebar,
            'use_mobile_sidebar' => $use_mobile_sidebar,
            'skin_dir' => $skin_dir,
            'mobile_skin_dir' => $mobile_skin_dir,
            'page_title' => $page_title,
            'meta_description' => $meta_description,
            'meta_keywords' => $meta_keywords,
            'meta_author' => $meta_author,
            'page_name' => $page_name,
            'page_url' => $this->uri->uri_string(),
        );
        $view['layout'] = $this->managelayout->front($layoutconfig, $this->cbconfig->get_device_view_type());
        $this->data = $view;
        $this->layout = element('layout_skin_file', element('layout', $view));
        $this->view = element('view_skin_file', element('layout', $view));
    }

    /**
     * 게시판 목록페이지입니다.
     */
    public function _get_list($brd_key, $from_view = '', $bgr_key = '')
    {


        // 이벤트 라이브러리를 로딩합니다
        $eventname = 'event_board_post_get_list';
        $this->load->event($eventname);

        $view = array();
        $view['view'] = array();

        // 이벤트가 존재하면 실행합니다
        $view['view']['event']['before'] = Events::trigger('list_before', $eventname);

        $return = array();
        $board = $this->_get_board($brd_key);
        $mem_id = (int) $this->member->item('mem_id');

        $alertmessage = $this->member->is_member()
            ? '회원님은 이 게시판 목록을 볼 수 있는 권한이 없습니다'
            : '비회원은 이 게시판에 접근할 권한이 없습니다.\\n\\n회원이시라면 로그인 후 이용해 보십시오';

        $check = array(
            'group_id' => element('bgr_id', $board),
            'board_id' => element('brd_id', $board),
        );
        $this->accesslevel->check(
            element('access_list', $board),
            element('access_list_level', $board),
            element('access_list_group', $board),
            $alertmessage,
            $check
        );
        $this->accesslevel->selfcertcheck('list', element('access_list_selfcert', $board));

        if (element('use_personal', $board) && $this->member->is_member() === false) {
            alert('이 게시판은 1:1 게시판입니다. 비회원은 접근할 수 없습니다');
            return false;
        }
        $skindir = ($this->cbconfig->get_device_view_type() === 'mobile')
            ? (element('board_mobile_skin', $board) ? element('board_mobile_skin', $board)
            : element('board_skin', $board)) : element('board_skin', $board);

        $skinurl = base_url( VIEW_DIR . 'board/' . $skindir);

        $view['view']['is_admin'] = $is_admin = $this->member->is_admin(
            array(
                'board_id' => element('brd_id', $board),
                'group_id' => element('bgr_id', $board)
            )
        );

        /**
         * 페이지에 숫자가 아닌 문자가 입력되거나 1보다 작은 숫자가 입력되면 에러 페이지를 보여줍니다.
         */
        $param =& $this->querystring;
        $page = (((int) $this->input->get('page')) > 0) ? ((int) $this->input->get('page')) : 1;
        $order_by_field = element('order_by_field', $board)
            ? element('order_by_field', $board)
            : 'post_num, post_reply';

        $findex = $this->input->get('findex', null, $order_by_field);
        $sfield = $sfieldchk = $this->input->get('sfield', null, '');
        if ($sfield === 'post_both') {
            $sfield = array('post_title', 'post_content');
        }
        $skeyword = $this->input->get('skeyword', null, '');
        if ($this->cbconfig->get_device_view_type() === 'mobile') {
            $per_page = element('mobile_list_count', $board)
                ? (int) element('mobile_list_count', $board) : 10;
        } else {
            $per_page = element('list_count', $board)
                ? (int) element('list_count', $board) : 20;
        }
        $offset = ($page - 1) * $per_page;

        $this->Post_model->allow_search_field = array('post_id', 'post_title', 'post_content', 'post_both', 'post_category', 'post_userid', 'post_nickname'); // 검색이 가능한 필드
        $this->Post_model->search_field_equal = array('post_id', 'post_userid', 'post_nickname'); // 검색중 like 가 아닌 = 검색을 하는 필드

        // 이벤트가 존재하면 실행합니다
        $view['view']['event']['step1'] = Events::trigger('list_step1', $eventname);

        /**
         * 상단에 공지사항 부분에 필요한 정보를 가져옵니다.
         */

        $except_all_notice= false;
        if (element('except_all_notice', $board)
            && $this->cbconfig->get_device_view_type() !== 'mobile') {
            $except_all_notice = true;
        }
        if (element('mobile_except_all_notice', $board)
            && $this->cbconfig->get_device_view_type() === 'mobile') {
            $except_all_notice = true;
        }
        $use_subject_style = ($this->cbconfig->get_device_view_type() === 'mobile')
            ? element('use_mobile_subject_style', $board)
            : element('use_subject_style', $board);
        $use_sideview = ($this->cbconfig->get_device_view_type() === 'mobile')
            ? element('use_mobile_sideview', $board)
            : element('use_sideview', $board);
        $use_sideview_icon = ($this->cbconfig->get_device_view_type() === 'mobile')
            ? element('use_mobile_sideview_icon', $board)
            : element('use_sideview_icon', $board);
        $list_date_style = ($this->cbconfig->get_device_view_type() === 'mobile')
            ? element('mobile_list_date_style', $board)
            : element('list_date_style', $board);
        $list_date_style_manual = ($this->cbconfig->get_device_view_type() === 'mobile')
            ? element('mobile_list_date_style_manual', $board)
            : element('list_date_style_manual', $board);

        if (element('use_gallery_list', $board)) {
            $this->load->model('Post_file_model');

            $board['gallery_cols'] = $gallery_cols
                = ($this->cbconfig->get_device_view_type() === 'mobile')
                ? element('mobile_gallery_cols', $board)
                : element('gallery_cols', $board);

            $board['gallery_image_width'] = $gallery_image_width
                = ($this->cbconfig->get_device_view_type() === 'mobile')
                ? element('mobile_gallery_image_width', $board)
                : element('gallery_image_width', $board);

            $board['gallery_image_height'] = $gallery_image_height
                = ($this->cbconfig->get_device_view_type() === 'mobile')
                ? element('mobile_gallery_image_height', $board)
                : element('gallery_image_height', $board);

            $board['gallery_percent'] = floor( 102 / $board['gallery_cols']) - 2;
        }

        if (element('use_category', $board)) {
            $this->load->model('Board_category_model');
            $board['category'] = $this->Board_category_model
                ->get_all_category(element('brd_id', $board));
        }

        $noticeresult = $this->Post_model
            ->get_notice_list(element('brd_id', $board), $except_all_notice, $sfield, $skeyword);
        if ($noticeresult) {
            foreach ($noticeresult as $key => $val) {

                $notice_brd_key = $this->board->item_id('brd_key', element('brd_id', $val));
                $noticeresult[$key]['post_url'] = post_url($notice_brd_key, element('post_id', $val));

                $noticeresult[$key]['meta'] = $meta
                    = $this->Post_meta_model->get_all_meta(element('post_id', $val));


                if ($this->cbconfig->get_device_view_type() === 'mobile') {
                    $noticeresult[$key]['title'] = element('mobile_subject_length', $board)
                        ? cut_str(element('post_title', $val), element('mobile_subject_length', $board))
                        : element('post_title', $val);
                } else {
                    $noticeresult[$key]['title'] = element('subject_length', $board)
                        ? cut_str(element('post_title', $val), element('subject_length', $board))
                        : element('post_title', $val);
                }
                if (element('post_del', $val)) {
                    $noticeresult[$key]['title'] = '게시물이 삭제 되었습니다';
                }

                if (element('mem_id', $val) >= 0) {
                    $noticeresult[$key]['display_name'] = display_username(
                        element('post_userid', $val),
                        element('post_nickname', $val),
                        ($use_sideview_icon ? element('mem_icon', $val) : ''),
                        ($use_sideview ? 'Y' : 'N')
                    );
                } else {
                    $noticeresult[$key]['display_name'] = '익명사용자';
                }
                $noticeresult[$key]['display_datetime'] = display_datetime(element('post_datetime', $val), $list_date_style, $list_date_style_manual);
                $noticeresult[$key]['category'] = '';
                if (element('use_category', $board) && element('post_category', $val)) {
                        $noticeresult[$key]['category']
                            = $this->Board_category_model
                            ->get_category_info(element('brd_id', $val), element('post_category', $val));
                }
                if ($param->output()) {
                    $noticeresult[$key]['post_url'] .= '?' . $param->output();
                }
                $noticeresult[$key]['title_color'] = $use_subject_style
                    ? element('post_title_color', $meta) : '';
                $noticeresult[$key]['title_font'] = $use_subject_style
                    ? element('post_title_font', $meta) : '';
                $noticeresult[$key]['title_bold'] = $use_subject_style
                    ? element('post_title_bold', $meta) : '';
                $noticeresult[$key]['is_mobile'] = (element('post_device', $val) === 'mobile') ? true : false;
            }
        }
        /**
         * 게시판 목록에 필요한 정보를 가져옵니다.
         */
        $where = array();
        $where['post_del <>'] = 2;
        if (element('except_notice', $board)
            && $this->cbconfig->get_device_view_type() !== 'mobile') {
            $where['post_notice'] = 0;
        }
        if (element('mobile_except_notice', $board)
            && $this->cbconfig->get_device_view_type() === 'mobile') {
            $where['post_notice'] = 0;
        }
        if (element('use_personal', $board) && $is_admin === false) {
            $where['post.mem_id'] = $mem_id;
        }

         $category_id = '';
        if (element('use_category', $board)) {
            
            
            if(is_null($this->input->get('category_id'))) $category_id = $this->session->userdata('category_id');
            else $category_id = $this->input->get('category_id');

            if (empty($category_id) OR $category_id < 1) {
                $category_id = '';
            }
            
            $this->session->set_userdata(
                'category_id',
                $category_id
            );
        }
        
        
        // if(!empty(get_cookie('region')) && element('bgr_id', $board)!=='8' && element('bgr_id', $board)!=='11') {
        //     $where['region_category'] = get_cookie('region');
        // }

        

        
        $this->load->model('Scrap_model');
        

        $where_in['brd_id'] = array(11,37,49,53,57,61,65);
        $result = $this->Post_model
            ->get_post_list($per_page, $offset, $where, $category_id, $findex, $sfield, $skeyword,'',$where_in);
        $list_num = $result['total_rows'] - ($page - 1) * $per_page;

        if (element('list', $result)) {
            foreach (element('list', $result) as $key => $val) {

                $brd_key_ = $this->board->item_id('brd_key', element('brd_id', $val));
                $board_ = $this->_get_board($brd_key_);
                $result['list'][$key]['board_']=$board_;
                $result['list'][$key]['post_url'] = post_url(element('brd_key', $board_), element('post_id', $val));
                
                
                $swhere = array(
                    'post_id' => element('post_id', $val),
                );
                $count = $this->Scrap_model->count_by($swhere);

                $result['list'][$key]['scrap_count'] = $count;

                if($this->member->is_member()){            
                    $scrapwhere = array(
                       'post_id' => element('post_id', $val),
                       'mem_id' => (int) $this->member->item('mem_id'),
                   );
                   $result['list'][$key]['scrap'] = $this->Scrap_model->get_one('','',$scrapwhere);
                    
                }

                $result['list'][$key]['extravars'] = $this->Post_extra_vars_model->get_all_meta(element('post_id', $val));

                if ($this->cbconfig->get_device_view_type() === 'mobile') {
                    $result['list'][$key]['title'] = element('mobile_subject_length', $board_)
                        ? cut_str(element('post_title', $val), element('mobile_subject_length', $board_))
                        : element('post_title', $val);
                } else {
                    $result['list'][$key]['title'] = element('subject_length', $board_)
                        ? cut_str(element('post_title', $val), element('subject_length', $board_))
                        : element('post_title', $val);
                }
                if (element('post_del', $val)) {
                    $result['list'][$key]['title'] = '게시물이 삭제 되었습니다';
                }
                $is_blind = (element('blame_blind_count', $board_) > 0 && element('post_blame', $val) >= element('blame_blind_count', $board_)) ? true : false;
                if ($is_blind) {
                    $result['list'][$key]['title'] = '신고가 접수된 게시글입니다.';
                }

                if (element('post_secret', $val)) {
                    $result['list'][$key]['title'] = '비밀글입니다';
                }
                if (element('mem_id', $val) >= 0) {
                    $result['list'][$key]['display_name'] = display_username(
                        element('post_userid', $val),
                        (element('post_nickname', $val) ? element('post_nickname', $val) : element('post_username', $val)), 
                        ($use_sideview_icon ? element('mem_icon', $val) : ''),
                        ($use_sideview ? 'Y' : 'N')
                    );
                } else {
                    $result['list'][$key]['display_name'] = '익명사용자';
                }

                $result['list'][$key]['display_datetime'] = display_datetime(
                    element('post_datetime', $val),
                    $list_date_style,
                    $list_date_style_manual
                );
                $result['list'][$key]['category'] = '';
                if (element('use_category', $board_) && element('post_category', $val)) {
                    $result['list'][$key]['category']
                        = $this->Board_category_model
                        ->get_category_info(element('brd_id', $val), element('post_category', $val));
                }
                if ($param->output()) {
                    $result['list'][$key]['post_url'] .= '?' . $param->output();
                }
                $result['list'][$key]['num'] = $list_num--;
                $result['list'][$key]['is_hot'] = false;

                $hot_icon_day = ($this->cbconfig->get_device_view_type() === 'mobile')
                    ? element('mobile_hot_icon_day', $board_)
                    : element('hot_icon_day', $board_);

                $hot_icon_hit = ($this->cbconfig->get_device_view_type() === 'mobile')
                    ? element('mobile_hot_icon_hit', $board_)
                    : element('hot_icon_hit', $board_);

                if ($hot_icon_day && ( ctimestamp() - strtotime(element('post_datetime', $val)) <= $hot_icon_day * 86400)) {
                    if ($hot_icon_hit && $hot_icon_hit <= element('post_hit', $val)) {
                        $result['list'][$key]['is_hot'] = true;
                    }
                }
                $result['list'][$key]['is_new'] = false;
                $new_icon_hour = ($this->cbconfig->get_device_view_type() === 'mobile')
                    ? element('mobile_new_icon_hour', $board_)
                    : element('new_icon_hour', $board_);

                if ($new_icon_hour && ( ctimestamp() - strtotime(element('post_datetime', $val)) <= $new_icon_hour * 3600)) {
                    $result['list'][$key]['is_new'] = true;
                }

                $result['list'][$key]['is_mobile'] = (element('post_device', $val) === 'mobile') ? true : false;

                $result['list'][$key]['thumb_url'] = '';
                $result['list'][$key]['origin_image_url'] = '';
                if (element('use_gallery_list', $board_)) {
                    if (element('post_image', $val)) {
                        $filewhere = array(
                            'post_id' => element('post_id', $val),
                            'pfi_is_image' => 1,
                        );
                        $file = $this->Post_file_model
                            ->get_one('', '', $filewhere, '', '', 'pfi_id', 'ASC');
                        $result['list'][$key]['thumb_url'] = thumb_url('post', element('pfi_filename', $file), $gallery_image_width, $gallery_image_height);
                        $result['list'][$key]['origin_image_url'] = thumb_url('post', element('pfi_filename', $file));
                    } else {
                        $thumb_url = get_post_image_url(element('post_content', $val), $gallery_image_width, $gallery_image_height);
                        $result['list'][$key]['thumb_url'] = $thumb_url
                            ? $thumb_url
                            : '';

                        $result['list'][$key]['origin_image_url'] = $thumb_url;
                    }
                } else {
                    $this->load->model('Post_file_model');

                    if (element('post_image', $val)) {
                        $filewhere = array(
                            'post_id' => element('post_id', $val),
                            'pfi_is_image' => 1,
                        );
                        $file = $this->Post_file_model
                            ->get_one('', '', $filewhere, '', '', 'pfi_id', 'ASC');
                        $result['list'][$key]['thumb_url'] = thumb_url('post', element('pfi_filename', $file));
                        $result['list'][$key]['origin_image_url'] = thumb_url('post', element('pfi_filename', $file));
                    } else {
                        $thumb_url = get_post_image_url(element('post_content', $val));
                        $result['list'][$key]['thumb_url'] = $thumb_url
                            ? $thumb_url
                            : thumb_url('', '');

                        $result['list'][$key]['origin_image_url'] = $thumb_url;
                    }


                }


                $result['list'][$key]['pln_url'] ='';

                if (element('post_link_count', $val)) {
                    $this->load->model('Post_link_model');
                    $linkwhere = array(
                        'post_id' => element('post_id', $val),
                    );
                    $link = $this->Post_link_model
                        ->get('', '', $linkwhere, '', '', 'pln_id', 'ASC');
                    if ($link && is_array($link)) {
                            $result['list'][$key]['pln_url'] = $link;
                    }
                }
            }
        }

        // $return['main_data'] = $main_result;
        $return['data'] = $result;
        $return['notice_list'] = $noticeresult;
        if (empty($from_view)) {
            $board['headercontent'] = ($this->cbconfig->get_device_view_type() === 'mobile')
                ? element('mobile_header_content', $board)
                : element('header_content', $board);
        }
        $board['footercontent'] = ($this->cbconfig->get_device_view_type() === 'mobile')
            ? element('mobile_footer_content', $board)
            : element('footer_content', $board);

        $board['cat_display_style'] = ($this->cbconfig->get_device_view_type() === 'mobile')
            ? element('mobile_category_display_style', $board)
            : element('category_display_style', $board);

        $return['board'] = $board;

        $return['point_info'] = '';
        if ($this->cbconfig->item('use_point')
            && element('use_point', $board)
            && element('use_point_info', $board)) {

            $point_info = '';
            if (element('point_write', $board)) {
                $point_info .= '원글작성 : ' . element('point_write', $board) . '<br />';
            }
            if (element('point_comment', $board)) {
                $point_info .= '댓글작성 : ' . element('point_comment', $board) . '<br />';
            }
            if (element('point_fileupload', $board)) {
                $point_info .= '파일업로드 : ' . element('point_fileupload', $board) . '<br />';
            }
            if (element('point_filedownload', $board)) {
                $point_info .= '파일다운로드 : ' . element('point_filedownload', $board) . '<br />';
            }
            if (element('point_filedownload_uploader', $board)) {
                $point_info .= '파일다운로드시업로더에게 : ' . element('point_filedownload_uploader', $board) . '<br />';
            }
            if (element('point_read', $board)) {
                $point_info .= '게시글조회 : ' . element('point_read', $board) . '<br />';
            }
            if (element('point_post_like', $board)) {
                $point_info .= '원글추천함 : ' . element('point_post_like', $board) . '<br />';
            }
            if (element('point_post_dislike', $board)) {
                $point_info .= '원글비추천함 : ' . element('point_post_dislike', $board) . '<br />';
            }
            if (element('point_post_liked', $board)) {
                $point_info .= '원글추천받음 : ' . element('point_post_liked', $board) . '<br />';
            }
            if (element('point_post_disliked', $board)) {
                $point_info .= '원글비추천받음 : ' . element('point_post_disliked', $board) . '<br />';
            }
            if (element('point_comment_like', $board)) {
                $point_info .= '댓글추천함 : ' . element('point_comment_like', $board) . '<br />';
            }
            if (element('point_comment_dislike', $board)) {
                $point_info .= '댓글비추천함 : ' . element('point_comment_dislike', $board) . '<br />';
            }
            if (element('point_comment_liked', $board)) {
                $point_info .= '댓글추천받음 : ' . element('point_comment_liked', $board) . '<br />';
            }
            if (element('point_comment_disliked', $board)) {
                $point_info .= '댓글비추천받음 : ' . element('point_comment_disliked', $board) . '<br />';
            }

            $return['point_info'] = $point_info;
        }

        // 이벤트가 존재하면 실행합니다
        $view['view']['event']['step2'] = Events::trigger('list_step2', $eventname);


        /**
         * primary key 정보를 저장합니다
         */
        $return['primary_key'] = $this->Post_model->primary_key;

        $highlight_keyword = '';
        if ($skeyword) {
            if ( ! $this->session->userdata('skeyword_' . $skeyword)) {
                $sfieldarray = array(
                    'post_title',
                    'post_content',
                    'post_both',
                );
                if (in_array($sfieldchk, $sfieldarray)) {
                    $this->load->model('Search_keyword_model');
                    $searchinsert = array(
                        'sek_keyword' => $skeyword,
                        'sek_datetime' => cdate('Y-m-d H:i:s'),
                        'sek_ip' => $this->input->ip_address(),
                        'mem_id' => $mem_id,
                    );
                    $this->Search_keyword_model->insert($searchinsert);
                    $this->session->set_userdata(
                        'skeyword_' . $skeyword,
                        1
                    );
                }
            }
            $key_explode = explode(' ', $skeyword);
            if ($key_explode) {
                foreach ($key_explode as $seval) {
                    if ($highlight_keyword) {
                        $highlight_keyword .= ',';
                    }
                    $highlight_keyword .= '\'' . html_escape($seval) . '\'';
                }
            }
        }
        $return['highlight_keyword'] = $highlight_keyword;

        /**
         * 페이지네이션을 생성합니다
         */
        $config['base_url'] = group_url($bgr_key) . '?' . $param->replace('page');
        $config['total_rows'] = $result['total_rows'];
        $config['per_page'] = $per_page;
        if ($this->cbconfig->get_device_view_type() === 'mobile') {
            $config['num_links'] = element('mobile_page_count', $board)
                ? element('mobile_page_count', $board) : 3;
        } else {
            $config['num_links'] = element('page_count', $board)
                ? element('page_count', $board) : 5;
        }
        $this->pagination->initialize($config);
        $return['paging'] = $this->pagination->create_links();
        $return['page'] = $page;

        /**
         * 쓰기 주소, 삭제 주소등 필요한 주소를 구합니다
         */
        $search_option = array(
            'post_title' => '제목',
            'post_content' => '내용'
        );
        $return['search_option'] = search_option($search_option, $sfield);
        if ($skeyword) {
            $return['list_url'] = board_url(element('brd_key', $board));
            $return['search_list_url'] = board_url(element('brd_key', $board) . '?' . $param->output());
        } else {
            $return['list_url'] = board_url(element('brd_key', $board) . '?' . $param->output());
            $return['search_list_url'] = '';
        }

        $check = array(
            'group_id' => element('bgr_id', $board),
            'board_id' => element('brd_id', $board),
        );
        $can_write = $this->accesslevel->is_accessable(
            element('access_write', $board),
            element('access_write_level', $board),
            element('access_write_group', $board),
            $check
        );

        $return['write_url'] = '';
        if ($can_write === true) {
            $return['write_url'] = write_url($brd_key);
        } elseif ($this->cbconfig->get_device_view_type() !== 'mobile' && element('always_show_write_button', $board)) {
            $return['write_url'] = 'javascript:alert(\'비회원은 글쓰기 권한이 없습니다.\\n\\n회원이시라면 로그인 후 이용해 보십시오.\');';
        } elseif ($this->cbconfig->get_device_view_type() === 'mobile' && element('mobile_always_show_write_button', $board)) {
            $return['write_url'] = 'javascript:alert(\'비회원은 글쓰기 권한이 없습니다.\\n\\n회원이시라면 로그인 후 이용해 보십시오.\');';
        }

        $return['list_delete_url'] = site_url('postact/listdelete/' . $brd_key . '?' . $param->output());

        return $return;
    
    }

    /**
     * board, board_meta 정보를 얻습니다
     */
    public function _get_board($brd_key)
    {
        $board_id = $this->board->item_key('brd_id', $brd_key);
        if (empty($board_id)) {
            show_404();
        }
        $board = $this->board->item_all($board_id);
        
        return $board;
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Main class
 *
 * Copyright (c) CIBoard <www.ciboard.co.kr>
 *
 * @author CIBoard (develop@ciboard.co.kr)
 */

/**
 * 메인 페이지를 담당하는 controller 입니다.
 */
class Main extends CB_Controller
{

    /**
     * 모델을 로딩합니다
     */
    protected $models = array('Post','Board','Event','Notice', 'Post_extra_vars','Board_category','Post_file');

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
        $this->load->library(array('querystring'));
    }


    /**
     * 전체 메인 페이지입니다
     */
    public function index()
    {
        // 이벤트 라이브러리를 로딩합니다
        $eventname = 'event_main_index';
        $this->load->event($eventname);

        $view = array();
        $view['view'] = array();

        // 이벤트가 존재하면 실행합니다
        $view['view']['event']['before'] = Events::trigger('before', $eventname);

        
        $view['view']['canonical'] = site_url();

        if(empty(get_cookie('region'))) $view['view']['region']=0;
        else $view['view']['region'] = 0;

        $this->load->model('Menu_model');
        $view['view']['menu'] = array();

        $this->Menu_model->allow_order_field = array('men_order');

        $result = $this->Menu_model->get_admin_list('','',array('men_mobile' => 1),'','men_order','asc');
        if(element('list',$result))
        foreach(element('list',$result) as $key => $value){

            
            $men_link_arr=explode('/',element('men_link',$value));
            $last = end($men_link_arr);
            
            
            
            
            $board = $this->board->item_all($this->board->item_key('brd_id', $last));
            $where = array(
                'brd_id' => $this->board->item_key('brd_id', $last),
            );
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

            $category_id = (int) $this->input->get('category_id');
            if (empty($category_id) OR $category_id < 1) {
                $category_id = '';
            }


            
            
            if(!empty(get_cookie('region')) && element('bgr_id', $board)!=='8' && element('bgr_id', $board)!=='11') {
                $where['region_category'] = get_cookie('region');
            }

            $category_id = (int) $this->input->get('category_id');
            if (empty($category_id) OR $category_id < 1) {
                $category_id = '';
            }

            $post_result = $this->Post_model
            ->get_post_list('5', '', $where, $category_id,'(case when post_order=0 then 999 else post_order end),post_num, post_reply','asc');

            if (element('list', $post_result)) {
                foreach (element('list', $post_result) as $key => $val) {

                   
                    $post_result['list'][$key]['post_url'] = post_url(element('brd_key', $board), element('post_id', $val));
                    
                    

                    $post_result['list'][$key]['extravars'] = $this->Post_extra_vars_model->get_all_meta(element('post_id', $val));

                    
                    $post_result['list'][$key]['title'] = element('mobile_subject_length', $board)
                        ? cut_str(element('post_title', $val), element('mobile_subject_length', $board))
                        : element('post_title', $val);

                    $post_result['list'][$key]['category'] = '';
                    if (element('use_category', $board) && element('post_category', $val)) {

                        $post_result['list'][$key]['category']
                            = $this->Board_category_model
                            ->get_category_info(element('brd_id', $val), element('post_category', $val));
                    }




                    

                    $post_result['list'][$key]['thumb_url'] = '';
                    $post_result['list'][$key]['origin_image_url'] = '';
                    if (element('use_gallery_list', $board)) {

                        $gallery_image_width=120;
                        $gallery_image_height=80;
                        if (element('post_image', $val)) {
                            $filewhere = array(
                                'post_id' => element('post_id', $val),
                                'pfi_is_image' => 1,
                            );
                            $file = $this->Post_file_model
                                ->get_one('', '', $filewhere, '', '', 'pfi_id', 'ASC');
                            $post_result['list'][$key]['thumb_url'] = thumb_url('post', element('pfi_filename', $file),$gallery_image_width,$gallery_image_height,1);
                            $post_result['list'][$key]['origin_image_url'] = thumb_url('post', element('pfi_filename', $file),$gallery_image_width,$gallery_image_height);
                        } else {
                            $thumb_url = get_post_image_url(element('post_content', $val),$gallery_image_width,$gallery_image_height);
                            $post_result['list'][$key]['thumb_url'] = $thumb_url
                                ? $thumb_url
                                : thumb_url('', '',$gallery_image_width,$gallery_image_height);

                            $post_result['list'][$key]['origin_image_url'] = $thumb_url;
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
                            $post_result['list'][$key]['thumb_url'] = thumb_url('post', element('pfi_filename', $file),$gallery_image_width,$gallery_image_height);
                            $post_result['list'][$key]['origin_image_url'] = thumb_url('post', element('pfi_filename', $file));
                        } else {
                            $thumb_url = get_post_image_url(element('post_content', $val),$gallery_image_width,$gallery_image_height);
                            $post_result['list'][$key]['thumb_url'] = $thumb_url
                                ? $thumb_url
                                : thumb_url('', '',$gallery_image_width,$gallery_image_height);

                            $post_result['list'][$key]['origin_image_url'] = $thumb_url;
                        }


                    }
                }
            }
            $view['view']['list'][element('men_id',$value)]['board'] = $board;
            $view['view']['list'][element('men_id',$value)]['men_name'] = element('men_name',$value);
            $view['view']['list'][element('men_id',$value)]['total_rows'] = $post_result['total_rows'];
            $view['view']['list'][element('men_id',$value)]['board_url'] = board_url($last);
            $view['view']['list'][element('men_id',$value)]['post_list'] = element('list',$post_result);
        }
        
        // 이벤트가 존재하면 실행합니다
        $view['view']['event']['before_layout'] = Events::trigger('before_layout', $eventname);

        $notiwhere = array(
                'noti_activated' => 1,
            );

        $notice_result = $this->Notice_model
            ->get('', '', $notiwhere, 1, 0, 'noti_id', 'desc');
        
        $view['view']['notice_result'] = $notice_result;
        

        if (( ctimestamp() - strtotime(element('noti_datetime', element(0,$notice_result))) <= 3 * 3600)) {

                    $view['view']['notice']['is_new'] = true;
                }

        $evewhere = array(
                'eve_activated' => 1,
            );

        $event_result = $this->Event_model
            ->get('', '', $evewhere, 1, 0, 'eve_id', 'desc');

        $view['view']['event_result'] = $event_result;
        
        if (( ctimestamp() - strtotime(element('eve_datetime', element(0,$event_result))) <= 3 * 3600)) {
            
                    $view['view']['event']['is_new'] = true;
                }
        /**
         * 레이아웃을 정의합니다
         */
        $page_title = $this->cbconfig->item('site_meta_title_main');
        $meta_description = $this->cbconfig->item('site_meta_description_main');
        $meta_keywords = $this->cbconfig->item('site_meta_keywords_main');
        $meta_author = $this->cbconfig->item('site_meta_author_main');
        $page_name = $this->cbconfig->item('site_page_name_main');

        $layoutconfig = array(
            'path' => 'main',
            'layout' => 'layout',
            'skin' => 'main',
            'layout_dir' => $this->cbconfig->item('layout_main'),
            'mobile_layout_dir' => $this->cbconfig->item('mobile_layout_main'),
            'use_sidebar' => $this->cbconfig->item('sidebar_main'),
            'use_mobile_sidebar' => $this->cbconfig->item('mobile_sidebar_main'),
            'skin_dir' => $this->cbconfig->item('skin_main'),
            'mobile_skin_dir' => $this->cbconfig->item('mobile_skin_main'),
            'page_title' => $page_title,
            'meta_description' => $meta_description,
            'meta_keywords' => $meta_keywords,
            'meta_author' => $meta_author,
            'page_name' => $page_name,
        );
        $view['layout'] = $this->managelayout->front($layoutconfig, $this->cbconfig->get_device_view_type());
        $this->data = $view;
        $this->layout = element('layout_skin_file', element('layout', $view));
        $this->view = element('view_skin_file', element('layout', $view));
    }
}

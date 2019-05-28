<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Notes class
 *
 * Copyright (c) CIBoard <www.ciboard.co.kr>
 *
 * @author CIBoard (develop@ciboard.co.kr)
 */

/**
 * 관리자>회원설정>팔로우현황 controller 입니다.
 */
class Notes extends CB_Controller
{

    /**
     * 관리자 페이지 상의 현재 디렉토리입니다
     * 페이지 이동시 필요한 정보입니다
     */
    public $pagedir = 'member/notes';

    /**
     * 모델을 로딩합니다
     */
    protected $models = array('Note');

    /**
     * 이 컨트롤러의 메인 모델 이름입니다
     */
    protected $modelname = 'Note_model';

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
        $this->load->library(array('pagination', 'querystring'));
    }

    /**
     * 목록을 가져오는 메소드입니다
     */
    public function index()
    {
        // 이벤트 라이브러리를 로딩합니다
        $eventname = 'event_admin_member_notes_index';
        $this->load->event($eventname);

        $view = array();
        $view['view'] = array();

        // 이벤트가 존재하면 실행합니다
        $view['view']['event']['before'] = Events::trigger('before', $eventname);

        /**
         * 페이지에 숫자가 아닌 문자가 입력되거나 1보다 작은 숫자가 입력되면 에러 페이지를 보여줍니다.
         */
        $param =& $this->querystring;
        $page = (((int) $this->input->get('page')) > 0) ? ((int) $this->input->get('page')) : 1;
        $findex = $this->input->get('findex') ? $this->input->get('findex') : $this->{$this->modelname}->primary_key;
        $forder = $this->input->get('forder', null, 'desc');
        $sfield = $this->input->get('sfield', null, '');
        $skeyword = $this->input->get('skeyword', null, '');

        $per_page = admin_listnum();
        $offset = ($page - 1) * $per_page;

        /**
         * 게시판 목록에 필요한 정보를 가져옵니다.
         */
        $this->{$this->modelname}->allow_search_field = array('nte_title','nte_content'); // 검색이 가능한 필드
        // $this->{$this->modelname}->search_field_equal = array('send_mem_id', 'recv_mem_id', 'nte_title', 'nte_content'); // 검색중 like 가 아닌 = 검색을 하는 필드
        $this->{$this->modelname}->allow_order_field = array('nte_id'); // 정렬이 가능한 필드

        $where = array(
            'nte_type' => 2,
        );

        $result = $this->{$this->modelname}
            ->get_admin_list($per_page, $offset, '', $where, $findex, $forder, $sfield, $skeyword);
        $list_num = $result['total_rows'] - ($page - 1) * $per_page;
        if (element('list', $result)) {
            foreach (element('list', $result) as $key => $val) {
                $result['list'][$key]['member'] = $dbmember = $this->Member_model->get_by_memid(element('send_mem_id', $val), 'mem_id, mem_userid, mem_nickname, mem_icon');
                $result['list'][$key]['display_name'] = display_username(
                    element('mem_userid', $dbmember),
                    element('mem_nickname', $dbmember),
                    element('mem_icon', $dbmember)
                );
                $result['list'][$key]['target_member'] = $target_member = $this->Member_model->get_by_memid(element('recv_mem_id', $val), 'mem_id, mem_userid, mem_nickname, mem_icon');
                $result['list'][$key]['target_display_name'] = display_username(
                    element('mem_userid', $target_member),
                    element('mem_nickname', $target_member),
                    element('mem_icon', $target_member)
                );

                $result['list'][$key]['delete_url'] = admin_url($this->pagedir . '/delete/'.element('nte_id', $val).'?' . $param->output());

                $result['list'][$key]['num'] = $list_num--;
            }
        }
        $view['view']['data'] = $result;

        /**
         * primary key 정보를 저장합니다
         */
        $view['view']['primary_key'] = $this->{$this->modelname}->primary_key;

        /**
         * 페이지네이션을 생성합니다
         */
        $config['base_url'] = admin_url($this->pagedir) . '?' . $param->replace('page');
        $config['total_rows'] = $result['total_rows'];
        $config['per_page'] = $per_page;
        $this->pagination->initialize($config);
        $view['view']['paging'] = $this->pagination->create_links();
        $view['view']['page'] = $page;

        /**
         * 쓰기 주소, 삭제 주소등 필요한 주소를 구합니다
         */
        
        $search_option = array(
            'nte_title' => '제목',
            'nte_content' => '내용'
        );
        $return['search_option'] = search_option($search_option, $sfield);
        
        $view['view']['skeyword'] = ($sfield && array_key_exists($sfield, $search_option)) ? $skeyword : '';
        $view['view']['search_option'] = search_option($search_option, $sfield);
        
        
        

        // 이벤트가 존재하면 실행합니다
        $view['view']['event']['before_layout'] = Events::trigger('before_layout', $eventname);

        /**
         * 어드민 레이아웃을 정의합니다
         */
        $layoutconfig = array('layout' => 'layout', 'skin' => 'index');
        $view['layout'] = $this->managelayout->admin($layoutconfig, $this->cbconfig->get_device_view_type());
        $this->data = $view;
        $this->layout = element('layout_skin_file', element('layout', $view));
        $this->view = element('view_skin_file', element('layout', $view));
    }

    /**
     * 쪽지를 삭제하는 함수입니다
     */
    public function delete($note_id = 0)
    {
        // 이벤트 라이브러리를 로딩합니다
        $eventname = 'event_note_delete';
        $this->load->event($eventname);

        /**
         * 로그인이 필요한 페이지입니다
         */
        required_user_login();

        

        // 이벤트가 존재하면 실행합니다
        Events::trigger('before', $eventname);

        

        $note_id = (int) $note_id;
        if (empty($note_id) OR $note_id < 1) {
            show_404();
        }

        $note = $this->Note_model->get_one($note_id);
        if ( ! element('nte_id', $note)) {
            show_404();
        }
        
        
        if ( ! element('related_note_id', $note)) {
            show_404();
        }
        $related_note = $this->Note_model->get_one(element('related_note_id', $note));

        if ( ! element('nte_id', $related_note)) {
            show_404();
        }

        $this->Note_model->delete($note_id);
        $this->Note_model->delete(element('nte_id', $related_note));

        // 이벤트가 존재하면 실행합니다
        Events::trigger('after', $eventname);

        /**
         * 삭제가 끝난 후 목록페이지로 이동합니다
         */
        $this->session->set_flashdata(
            'message',
            '정상적으로 삭제되었습니다'
        );
        $param =& $this->querystring;
        
        redirect(admin_url($this->pagedir . '/?'. $param->output()));
    }

     /**
     * 쪽지 상세보기 페이지입니다
     */
    public function view($note_id = 0)
    {
        // 이벤트 라이브러리를 로딩합니다
        $eventname = 'event_note_view';
        $this->load->event($eventname);

        /**
         * 로그인이 필요한 페이지입니다
         */
        required_user_login();

        $mem_id = (int) $this->member->item('mem_id');

        $view = array();
        $view['view'] = array();

        // 이벤트가 존재하면 실행합니다
        $view['view']['event']['before'] = Events::trigger('before', $eventname);

        if ( ! $this->cbconfig->item('use_note')) {
            alert_close('쪽지 기능을 사용하지 않는 사이트입니다');
            return false;
        } elseif ( ! $this->member->item('mem_use_note') && $this->member->is_admin() !== 'super') {
            alert_close('회원님은 쪽지 기능을 사용하지 않는 중이십니다');
            return false;
        }

        

        $note_id = (int) $note_id;
        if (empty($note_id) OR $note_id < 1) {
            show_404();
        }

        $where = array(
            'nte_id' => $note_id,
        );
        $result = $this->Note_model->get_admin_note($where);
        if ( ! element('nte_id', $result)) {
            alert('지워지거나 없는 쪽지입니다.');
            return false;
        }
            
        $result['member'] = $dbmember = $this->Member_model->get_by_memid(element('send_mem_id', $result), 'mem_id, mem_userid, mem_nickname, mem_icon');
        $result['display_name'] = display_username(
            element('mem_userid', $dbmember),
            element('mem_nickname', $dbmember),
            element('mem_icon', $dbmember)
        );
        $result['target_member'] = $target_member = $this->Member_model->get_by_memid(element('recv_mem_id', $result), 'mem_id, mem_userid, mem_nickname, mem_icon');
        $result['target_display_name'] = display_username(
            element('mem_userid', $target_member),
            element('mem_nickname', $target_member),
            element('mem_icon', $target_member)
        );


         
        
        if (element('nte_type', $result) === '1'
            && (empty($result['nte_read_datetime']) OR $result['nte_read_datetime'] <= '0000-00-00 00:00:00')) {
            $updatedata = array(
                'nte_read_datetime' => cdate('Y-m-d H:i:s'),
            );
            $this->Note_model->update(element('nte_id', $result), $updatedata);
            if ($result[$mem_column] > 0) {
                $updatedata = array(
                    'nte_read_datetime' => cdate('Y-m-d H:i:s'),
                );
                $where = array(
                    'related_note_id' => element('nte_id', $result),
                );
                $this->Note_model->update('', $updatedata, $where);
            }

            $where = array(
                'recv_mem_id' => $mem_id,
                'nte_type' => 1,
            );
            $this->db->where($where);
            $this->db->group_start();
            $this->db->where(array('nte_read_datetime <=' => '0000-00-00 00:00:00'));
            $this->db->or_where(array('nte_read_datetime' => null));
            $this->db->group_end();
            $cnt = $this->db->count_all_results('note');
            $updatedata = array(
                'meta_unread_note_num' => $cnt,
            );
            $this->load->model('Member_meta_model');
            $this->Member_meta_model->save($mem_id, $updatedata);
        }
        $result['content'] = display_html_content(
            element('nte_content', $result),
            element('nte_content_html_type', $result),
            $thumb_width = 500,
            $autolink = true,
            $popup = true
        );       

        $view['view']['data'] = $result;
        
        $view['view']['canonical'] = admin_url($this->pagedir .'/view/' . $note_id);

        $view['view']['delete_url'] = admin_url($this->pagedir .'/delete/' . element('nte_id', $result));

        // 이벤트가 존재하면 실행합니다
        $view['view']['event']['before_layout'] = Events::trigger('before_layout', $eventname);

        /**
         * 레이아웃을 정의합니다
         */
        $page_title = $this->cbconfig->item('site_meta_title_note_view');
        $meta_description = $this->cbconfig->item('site_meta_description_note_view');
        $meta_keywords = $this->cbconfig->item('site_meta_keywords_note_view');
        $meta_author = $this->cbconfig->item('site_meta_author_note_view');
        $page_name = $this->cbconfig->item('site_page_name_note_view');

        $searchconfig = array(
            '{쪽지제목}',
        );
        $replaceconfig = array(
            element('nte_title', $result),
        );

        $page_title = str_replace($searchconfig, $replaceconfig, $page_title);
        $meta_description = str_replace($searchconfig, $replaceconfig, $meta_description);
        $meta_keywords = str_replace($searchconfig, $replaceconfig, $meta_keywords);
        $meta_author = str_replace($searchconfig, $replaceconfig, $meta_author);
        $page_name = str_replace($searchconfig, $replaceconfig, $page_name);

        $layoutconfig = array(
            'path' => 'note',
            'layout' => 'layout',
            'skin' => 'view',
            'layout_dir' => $this->cbconfig->item('layout_note'),
            'mobile_layout_dir' => $this->cbconfig->item('mobile_layout_note'),
            'skin_dir' => $this->cbconfig->item('skin_note'),
            'mobile_skin_dir' => $this->cbconfig->item('mobile_skin_note'),
            'page_title' => $page_title,
            'meta_description' => $meta_description,
            'meta_keywords' => $meta_keywords,
            'meta_author' => $meta_author,
            'page_name' => $page_name,
        );
        $view['layout'] = $this->managelayout->admin($layoutconfig, $this->cbconfig->get_device_view_type());
        $this->data = $view;
        $this->layout = element('layout_skin_file', element('layout', $view));
        $this->view = element('view_skin_file', element('layout', $view));
    }
}

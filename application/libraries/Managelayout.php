<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Managelayout class
 *
 * Copyright (c) CIBoard <www.ciboard.co.kr>
 *
 * @author CIBoard (develop@ciboard.co.kr)
 */

/**
 * 레이아웃을 관리하는 class 입니다.
 */
class Managelayout extends CI_Controller
{

    private $css = array();
    private $js = array();

    function __construct()
    {

    }


    /**
     * 관리자페이지 레이아웃관리합니다
     */
    function admin($config = array(), $device_view_type = '')
    {
        $data = array();
        $CI = & get_instance();
        $CI->load->config('cb_admin_menu');
        $data['admin_page_menu'] = config_item('admin_page_menu');

        if (uri_string() !== config_item('uri_segment_admin')) {
            list($data['menu_dir1'], $data['menu_dir2']) = explode('/', str_replace(config_item('uri_segment_admin') . '/', '', uri_string()));
            $data['menu_title'] = element(0, element(element('menu_dir2', $data), element('menu', element(element('menu_dir1', $data), element('admin_page_menu', $data)))));
        } else {
            $data['menu_dir1'] = '';
            $data['menu_dir2'] = '';
        }

        $layout_skin_file = element('layout', $config);
        $skin_file = element('skin', $config);

        $data['layout_skin_path'] = 'admin/' . ADMIN_SKIN;
        $data['layout_skin_url'] = base_url( VIEW_DIR . element('layout_skin_path', $data));
        $data['index_url'] = admin_url($data['menu_dir1'] . '/' . $data['menu_dir2']);
        $data['layout_skin_file'] = $data['layout_skin_path'] . '/' . $layout_skin_file;
        $data['view_skin_file'] = $data['layout_skin_path'] . '/';
        if ($data['menu_dir1']) {
            $data['view_skin_file'] .= $data['menu_dir1'] . '/';
        }
        if ($data['menu_dir2']) {
            $data['view_skin_file'] .= $data['menu_dir2'] . '/';
        }
        $data['view_skin_path'] = $data['view_skin_file'];
        $data['view_skin_url'] = base_url( VIEW_DIR . $data['view_skin_path']);
        $data['view_skin_file'] .= $skin_file;

        $data['favicon'] = $CI->cbconfig->item('site_favicon') ? site_url(config_item('uploads_dir') . '/favicon/' . $CI->cbconfig->item('site_favicon')) : '';

        return $data;
    }


    /**
     * 프론트페이지 레이아웃관리합니다
     */
    function front($config = array(), $device_view_type = '')
    {
        $data = array();
        $CI = & get_instance();

        if ($CI->uri->segment(1) === config_item('uri_segment_admin') && $CI->uri->segment(2) === 'preview') {
            return $this->preview($config);
        }

        $searchconfig = array(
            '{홈페이지제목}',
            '{현재주소}',
            '{회원아이디}',
            '{회원닉네임}',
            '{회원레벨}',
            '{회원포인트}',
        );
        $replaceconfig = array(
            $CI->cbconfig->item('site_title'),
            current_full_url(),
            $CI->member->item('mem_userid'),
            $CI->member->item('mem_nickname'),
            $CI->member->item('mem_level'),
            $CI->member->item('mem_point'),
        );

        $page_title = element('page_title', $config) ? element('page_title', $config) : $CI->cbconfig->item('site_meta_title_default');
        $meta_description = element('meta_description', $config) ? element('meta_description', $config) : $CI->cbconfig->item('site_meta_description_default');
        $meta_keywords = element('meta_keywords', $config) ? element('meta_keywords', $config) : $CI->cbconfig->item('site_meta_keywords_default');
        $meta_author = element('meta_author', $config) ? element('meta_author', $config) : $CI->cbconfig->item('site_meta_author_default');
        $page_name = element('page_name', $config) ? element('page_name', $config) : $CI->cbconfig->item('site_page_name_default');
        
        $data['page_title'] = $page_title = str_replace($searchconfig, $replaceconfig, $page_title);
        $data['meta_description'] = $meta_description = str_replace($searchconfig, $replaceconfig, $meta_description);
        $data['meta_keywords'] = $meta_keywords = str_replace($searchconfig, $replaceconfig, $meta_keywords);
        $data['meta_author'] = $meta_author = str_replace($searchconfig, $replaceconfig, $meta_author);
        $data['page_name'] = $page_name = str_replace($searchconfig, $replaceconfig, $page_name);

        $layoutdirname = $device_view_type === 'mobile' ? element('mobile_layout_dir', $config) : element('layout_dir', $config);
        if (empty($layoutdirname)) {
            $layoutdirname = $device_view_type === 'mobile' ? $CI->cbconfig->item('mobile_layout_default') : $CI->cbconfig->item('layout_default');
        }
        if (empty($layoutdirname)) {
            $layoutdirname = 'basic';
        }
        $layout = '_layout/' . $layoutdirname;
        $data['layout_skin_path'] = $layout;
        $data['layout_skin_url'] = base_url( VIEW_DIR . $data['layout_skin_path']);
        $layout .= '/';
        if (element('layout', $config)) {
            $layout .= element('layout', $config);
        }
        $data['layout_skin_file'] = $layout;

        $skindir = $device_view_type === 'mobile' ? element('mobile_skin_dir', $config) : element('skin_dir', $config);
        if (empty($skindir)) {
            $skindir = $device_view_type === 'mobile' ? $CI->cbconfig->item('mobile_skin_default') : $CI->cbconfig->item('skin_default');
        }
        if (empty($skindir)) {
            $skindir = 'basic';
        }
        $skin = '';
        if (element('path', $config)) {
            $skin .= element('path', $config) . '/';
        }
        $skin .= $skindir;
        $data['view_skin_path'] = $skin;
        $data['view_skin_url'] = base_url( VIEW_DIR . $data['view_skin_path']);
        $skin .= '/';
        if (element('skin', $config)) {
            $skin .= element('skin', $config);
        }
        $data['view_skin_file'] = $skin;

        $user_sidebar = $device_view_type === 'mobile' ? element('use_mobile_sidebar', $config) : element('use_sidebar', $config);
        if ($user_sidebar === '1') {
            $data['use_sidebar'] = '1';
        } elseif ($user_sidebar === '2') {
            $data['use_sidebar'] = '';
        } else {
            $user_sidebar = $device_view_type === 'mobile' ? $CI->cbconfig->item('mobile_sidebar_default') : $CI->cbconfig->item('sidebar_default');
            if ($user_sidebar === '1') {
                $data['use_sidebar'] = '1';
            } elseif ($user_sidebar === '2') {
                $data['use_sidebar'] = '';
            } else {
                $data['use_sidebar'] = '';
            }
        }

        $data['favicon'] = $CI->cbconfig->item('site_favicon') ? site_url(config_item('uploads_dir') . '/favicon/' . $CI->cbconfig->item('site_favicon')) : '';

        $mem_id = (int) $CI->member->item('mem_id');

        if ($CI->input->is_ajax_request() === false) {

            // 현재 접속자
            $CI->load->model('Currentvisitor_model');
            $currentpage = $page_name ? $page_name : $page_title;
            $currentpage = $currentpage ? $currentpage : $CI->cbconfig->item('site_title');
            $agent_referrer = $CI->agent->referrer() ? $CI->agent->referrer() : '';
            $agent_string = $CI->agent->agent_string() ? $CI->agent->agent_string() : '';
            $CI->Currentvisitor_model->add_visitor($CI->input->ip_address(), $mem_id,
            $CI->member->item('mem_nickname'), cdate('Y-m-d H:i:s'), $currentpage, current_full_url(), $agent_referrer, $agent_string);
            if ($CI->cbconfig->item('open_currentvisitor') OR $CI->member->is_admin() === 'super') {

                $minute = (int) $CI->cbconfig->item('currentvisitor_minute');
                if ($minute < 1) {
                    $minute = 10;
                }
                $curdatetime = cdate('Y-m-d H:i:s', ctimestamp() - $minute * 60);
                $data['current_visitor_num'] = $CI->Currentvisitor_model->get_current_count($curdatetime);
            }

            // 알림
            $data['notification_num'] = 0;
            if ($CI->cbconfig->item('use_notification')) {
                if ($CI->member->is_member()) {
                    $CI->load->model('Notification_model');
                    $data['notification_num'] = $CI->Notification_model->unread_notification_num($mem_id);
                }
            }

            // 메뉴관리
            $CI->load->model('Menu_model');
            $data['menu'] = $CI->Menu_model->get_all_menu($device_view_type);

            if ($data['menu']) {
                $menu = $data['menu'];

                $menu_keys=array_keys(element(0, $menu));

                if (element(0, $menu)) {
                    foreach (element(0, $menu) as $mkey => $mval) {

                        if(str_replace("/","",element('men_link', $mval)) === str_replace("/","",element('page_url', $config))){
                            $data['menu']['active']= array(element('men_id', $mval));
                            
                        }
                         
                        if (element(element('men_id', $mval), $menu)) {
                            foreach (element(element('men_id', $mval), $menu) as $skey => $sval) {

                                if(str_replace("/","",element('men_link', $sval)) === str_replace("/","",element('page_url', $config))) 
                                    $data['menu']['active']= array(element('men_id', $mval),element('men_id', $sval));
                            }
                            

                        } else {

                            if(str_replace("/","",element('men_link', $mval)) === str_replace("/","",element('page_url', $config))) $data['menu']['active']= array(element('men_id', $mval));
                            
                        }
                    }
                }

                if(!empty($data['menu']['active'][0]) && strpos($CI->uri->uri_string(),'post') === false){

                    $m = array_search($data['menu']['active'][0], $menu_keys);
                    
                    if($m===0)
                        $prev_key = array_pop($menu_keys);
                    else 
                        $prev_key = $menu_keys[$m - 1];

                    if($m+1 === count($menu_keys))
                        $next_key = array_shift($menu_keys);
                    else 
                        $next_key = $menu_keys[$m+1];

                    $data['prev_men_link'] = element('men_link',element($prev_key,element(0, $menu)));
                    $data['next_men_link'] = element('men_link',element($next_key,element(0, $menu)));
                }
            }
            
            //팝업관리
            $CI->load->library('popuplib');
            $data['popup'] = $CI->popuplib->display_popup();

        }

        return $data;
    }


    /**
     * 프리뷰 페이지를 위한 레이아웃관리입니다
     */
    function preview($config = array())
    {

        $data = array();
        $CI = & get_instance();

        if ($CI->input->get('is_mobile')) {
            $CI->cbconfig->set_device_view_type('mobile');
        } else {
            $CI->cbconfig->set_device_view_type('pc');
        }

        $device_view_type = $CI->cbconfig->get_device_view_type();
        $layoutdirname = $CI->input->get('layout');
        if (empty($layoutdirname)) {
            $layoutdirname = $device_view_type === 'mobile' ? $CI->cbconfig->item('mobile_layout_default') : $CI->cbconfig->item('layout_default');
        }
        if (empty($layoutdirname)) {
            $layoutdirname = 'basic';
        }
        $layout = '_layout/' . $layoutdirname;
        $data['layout_skin_path'] = $layout;
        $data['layout_skin_url'] = base_url( VIEW_DIR . $data['layout_skin_path']);
        $layout .= '/';
        if (element('layout', $config)) {
            $layout .= element('layout', $config);
        }
        $data['layout_skin_file'] = $layout;

        $skindir = $CI->input->get('skin');
        if (empty($skindir)) {
            $skindir = $device_view_type === 'mobile' ? $CI->cbconfig->item('mobile_skin_default') : $CI->cbconfig->item('skin_default');
        }
        if (empty($skindir)) {
            $skindir = 'basic';
        }
        $skin = '';
        if (element('path', $config)) {
            $skin .= element('path', $config) . '/';
        }
        $skin .= $skindir;
        $data['view_skin_path'] = $skin;
        $data['view_skin_url'] = base_url( VIEW_DIR . $data['view_skin_path']);
        $skin .= '/';
        if (element('skin', $config)) {
            $skin .= element('skin', $config);
        }
        $data['view_skin_file'] = $skin;

        $user_sidebar = $CI->input->get('sidebar');
        if ($user_sidebar === '1') {
            $data['use_sidebar'] = '1';
        } elseif ($user_sidebar === '2') {
            $data['use_sidebar'] = '';
        } else {
            $user_sidebar = $device_view_type === 'mobile' ? $CI->cbconfig->item('mobile_sidebar_default') : $CI->cbconfig->item('sidebar_default');
            if ($user_sidebar === '1') {
                $data['use_sidebar'] = '1';
            } elseif ($user_sidebar === '2') {
                $data['use_sidebar'] = '';
            } else {
                $data['use_sidebar'] = '';
            }
        }

        // 메뉴관리
        $CI->load->model('Menu_model');
        $data['menu'] = $CI->Menu_model->get_all_menu($device_view_type);

        return $data;
    }


    /**
     * css를 추가합니다
     */
    function add_css($file = '')
    {
        if (empty($file)) {
            return;
        }
        array_push($this->css, $file);
    }


    /**
     * js를 추가합니다
     */
    function add_js($file = '')
    {
        if (empty($file)) {
            return;
        }
        array_push($this->js, $file);
    }


    /**
     * 추가된 css를 리턴합니다
     */
    function display_css()
    {
        $return = '';
        $_css = $this->css;
        if ($_css) {
            foreach ($_css as $val) {
                $return .= '<link rel="stylesheet" type="text/css" href="' . $val . '" />';
            }
        }
        return $return;
    }


    /**
     * 추가된 js를 리턴합니다
     */
    function display_js()
    {
        $return = '';
        $_js = $this->js;
        if ($_js) {
            foreach ($_js as $val) {
                $return .= '<script type="text/javascript" src="' . $val . '"></script>';
            }
        }
        return $return;
    }

    /**
     * footer 리턴합니다
     */
    function display_footer()
    {   

        $CI = & get_instance();
        $btn_box_html='';

        if($CI->member->is_member()){
            $btn_box_html=
                '<li class="f_btn">
                    <a href="'.site_url('login/logout?url=' . urlencode(current_full_url())).'"  title="로그아웃"><i class="fa fa-sign-out"></i> 로그아웃</a>
                </li>
                <li class="f_btn">
                    <a href="'.site_url('mypage').'"  title="마이페이지"><i class="fa fa-user"></i> 마이페이지</a>
                </li>';
        } else {
            $btn_box_html=
                '<li class="f_btn">
                    <a href="'.site_url('login?url=' . urlencode(current_full_url())).'"  title="로그인"><i class="fa fa-sign-in"></i> 로그인</a>
                </li>
                <li class="f_btn">
                    <a href="'.site_url('register').'"  title="회원가입"><i class="fa fa-user"></i> 회원가입</a>
                </li>';
        }
        $return = '
        <section class="footer_02">
            <h2 class="hidden">푸터</h2>
            <ul class="btn_box">
                '.$btn_box_html.'
                       
                       

                <li class="f_btn">
                    <a href="https://play.google.com/store/apps/details?id=com.secretvt"  title="구글앱다운로드"><i class="fa fa-download"></i> 구글 앱 다운로드
                    </a>
               </li>

                  
            </ul>
            
        </section>
        <footer>
            
            <ul>
                <li>'.mailto('boyoon8@gmail.com','고객센터').'</li>
                <li><a href="'.board_url('vtn_other').'" title="제휴문의">제휴문의</a></li>
                <li><a href="'.document_url('provision').'" title="이용약관">이용약관</a></li>
                <li><a href="'.document_url('privacy').'" title="개인정보 방침">개인정보 방침</a></li>
                

               
            </ul>

            

            <h2>Copyright ⓒ Phillippines. All Rights Reserved </h2>
        </footer>

        
        ';
        return $return;
    }
}

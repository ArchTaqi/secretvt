<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo html_escape(element('page_title', $layout)); ?></title>
<link rel="icon" href="<?php echo base_url('assets/images/temp/favi02.png?'.$this->cbconfig->item("browser_cache_version")); ?>"/> 
<meta property="og:type" content="website">
<meta property="og:title" content="시크릿베트남">
<meta property="og:description" content="베트남 소식 및 업소정보 제공! 예약 및 길찾기 지원">
<meta property="og:image" content="https://secretvt.com/assets/images/temp/link_thum.png">
<meta property="og:url" content="https://secretvt.com">
<?php if (element('meta_description', $layout)) { ?><meta name="description" content="<?php echo html_escape(element('meta_description', $layout)); ?>"><?php } ?>
<?php if (element('meta_keywords', $layout)) { ?><meta name="keywords" content="<?php echo html_escape(element('meta_keywords', $layout)); ?>"><?php } ?>
<?php if (element('meta_author', $layout)) { ?><meta name="author" content="<?php echo html_escape(element('meta_author', $layout)); ?>"><?php } ?>
<?php if (element('favicon', $layout)) { ?><link rel="shortcut icon" type="image/x-icon" href="<?php echo element('favicon', $layout); ?>" /><?php } ?>
<?php if (element('canonical', $view)) { ?><link rel="canonical" href="<?php echo element('canonical', $view); ?>" /><?php } ?>
<link rel="stylesheet" type="text/css" href="<?php echo element('layout_skin_url', $layout); ?>/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dialog.css')?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/reset.css?'.$this->cbconfig->item('browser_cache_version'))?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/global.css?23'.$this->cbconfig->item('browser_cache_version'))?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/page.css?23'.$this->cbconfig->item('browser_cache_version'))?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/page_new.css?'.$this->cbconfig->item('browser_cache_version'))?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css?'.$this->cbconfig->item('browser_cache_version'))?>" />
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nanum+Gothic" />
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/earlyaccess/jejugothic.css" />

<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/ui-lightness/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/swiper.min.css'); ?>" />
<?php echo $this->managelayout->display_css(); ?>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript">
// 자바스크립트에서 사용하는 전역변수 선언
var cb_url = "<?php echo trim(site_url(), '/'); ?>";
var cb_cookie_domain = "<?php echo config_item('cookie_domain'); ?>";
var cb_charset = "<?php echo config_item('charset'); ?>";
var cb_time_ymd = "<?php echo cdate('Y-m-d'); ?>";
var cb_time_ymdhis = "<?php echo cdate('Y-m-d H:i:s'); ?>";
var layout_skin_path = "<?php echo element('layout_skin_path', $layout); ?>";
var view_skin_path = "<?php echo element('view_skin_path', $layout); ?>";
var is_member = "<?php echo $this->member->is_member() ? '1' : ''; ?>";
var is_admin = "<?php echo $this->member->is_admin(); ?>";
var cb_admin_url = <?php echo $this->member->is_admin() === 'super' ? 'cb_url + "/' . config_item('uri_segment_admin') . '"' : '""'; ?>;
var cb_board = "<?php echo isset($view) ? element('board_key', $view) : ''; ?>";
var cb_board_url = <?php echo ( isset($view) && element('board_key', $view)) ? 'cb_url + "/' . config_item('uri_segment_board') . '/' . element('board_key', $view) . '"' : '""'; ?>;
var cb_device_type = "<?php echo $this->cbconfig->get_device_type() === 'mobile' ? 'mobile' : 'desktop' ?>";
var cb_csrf_hash = "<?php echo $this->security->get_csrf_hash(); ?>";
var cookie_prefix = "<?php echo config_item('cookie_prefix'); ?>";
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/common.js?'.$this->cbconfig->item('browser_cache_version')); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.extension.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/sideview.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.hoverIntent.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ba-outside-events.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/iscroll.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/mobile.sidemenu.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/js.cookie.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/swiper.min.js'); ?>"></script>

<?php echo $this->managelayout->display_js(); ?>
</head>
<body <?php echo isset($view) ? element('body_script', $view) : ''; ?>>

<?php


    $menuhtml = '<nav id="" class="gnb_main wrap09">
                    <ul class="gnb_list">';
    $menuhtml_sub ='';
    if (element('menu', $layout)) {
        $menu = element('menu', $layout);


        $menu_keys=array_keys(element(0, $menu));
        if (element(0, $menu)) {
            foreach (element(0, $menu) as $mkey => $mval) {
                $mlink = element('men_link', $mval) ? element('men_link', $mval) : 'javascript:;';
                $active='';
                
                if(element('men_id',$mval) === element(0,element('active',$menu))) {
                    $active='active';
                }

                if (element(element('men_id', $mval), $menu) && element(0,element('active',$menu)) === element('men_id', $mval)) {
                    $mlink = element('men_link', $mval) ? element('men_link', $mval) : 'javascript:;';
                    $menuhtml .= '<li class="gnb_li '.$active.'">
                    <a href="' . $mlink . '" ' . element('men_custom', $mval);
                    if (element('men_target', $mval)) {
                        $menuhtml .= ' target="' . element('men_target', $mval) . '"';
                    }
                    $menuhtml .= ' title="' . html_escape(element('men_name', $mval)) . '">' . html_escape(element('men_name', $mval)) . '</a>';
                    $menuhtml .= '</li>';

                    $menuhtml_sub = '<nav class="lnb01">
                                        <ul class="lnb_list">';

                    foreach (element(element('men_id', $mval), $menu) as $skey => $sval) {
                        $active='';
                        
                        if(element('men_id',$sval) === element(1,element('active',$menu))) {
                            $active='active';
                        }
                        $slink = element('men_link', $sval) ? element('men_link', $sval) : 'javascript:;';
                        $menuhtml_sub .= '<li class="lnb_li '.$active.'"><a href="' . $slink . '" ' . element('men_custom', $sval);
                        if (element('men_target', $sval)) {
                            $menuhtml_sub .= ' target="' . element('men_target', $sval) . '"';
                        }
                        $menuhtml_sub .= ' title="' . html_escape(element('men_name', $sval)) . '">' . html_escape(element('men_name', $sval)) . '</a></li>';
                    }
                    $menuhtml_sub .= '</ul></nav>';

                } else {
                    
                    $menuhtml .= '<li class="gnb_li '.$active.'" ><a href="' . $mlink . '" ' . element('men_custom', $mval);
                    if (element('men_target', $mval)) {
                        $menuhtml .= ' target="' . element('men_target', $mval) . '"';
                    }
                    $menuhtml .= ' title="' . html_escape(element('men_name', $mval)) . '">' . html_escape(element('men_name', $mval)) . '</a></li>';

                    $menuhtml .= "\n";
                }
            }
        }
    }
    $menuhtml.='</ul></nav>';

 ?>

    <header class="header">
        <h1 class="h_logo"><a href="<?php echo site_url(); ?>" title="<?php echo html_escape($this->cbconfig->item('site_title'));?>"><?php echo $this->cbconfig->item('site_logo'); ?>
                    </a></h1>
        <ul class="h_btn_box">
            <li class="pull-left" id="btn_side">
                <button><img src="<?php echo base_url('assets/images/h_icon_ham.svg'); ?>" alt="네비게이션"></button>
            </li>
            <?php if ($this->member->is_member()) { ?>
                

                <li class="pull-right"><a href="<?php echo site_url('mypage'); ?>" ><img src="<?php echo base_url('assets/images/icon_user_config.png'); ?>" alt="My Page" ></a></li>
            <?php } else { ?>
                 <li class="pull-right">
                    <a href="<?php echo site_url('login?url=' . urlencode(current_full_url())); ?>" ><img src="<?php echo base_url('assets/images/h_icon_user.svg'); ?>" alt="로그인"></a>
                </li>   
                
                
            <?php } ?>

            
            <li class="pull-right mr10">
                <a href="<?php echo site_url('search'); ?>">
                    <img src="<?php echo base_url('assets/images/h_icon_search.svg'); ?>" alt="검색">
                </a>
            </li>
        </ul>
    </header>

   
        
        
        
        <!-- 지역선택하기 영역 -->  
       
     
        

       
    
        
        <?php 

        echo $menuhtml;
        echo $menuhtml_sub;
            if(!empty(element(0,element('active',$menu)))){
                
                
                $prev_men_link = element('prev_men_link', $layout);
                $next_men_link = element('next_men_link', $layout);
            } else {

                
                $prev_men_link = element('prev_men_link', $view,'');
                $next_men_link = element('next_men_link', $view,'');
            }
            ?>
        

    <!-- nav end -->
    <!-- header end -->

    <!-- main start -->
     <div class="swiper-container swiper-container-main">
        <div class="swiper-wrapper">
            <?php if(!empty($prev_men_link)) echo '<div class="swiper-slide" data-location-url="'.$prev_men_link.'"></div>'; ?>
            <div class="swiper-slide">
                <div>
        

                <!-- 본문 시작 -->
                <?php if (isset($yield))echo $yield; ?>
                <!-- 본문 끝 -->
                </div>
            </div>
            <?php if(!empty($next_men_link)) echo '<div class="swiper-slide" data-location-url="'.$next_men_link.'"></div>'; ?>
        </div>
    </div>
        
    <!-- main end -->
    <aside class="fixed_btn_box">
        <ul class="btn_box">
            <li class="btn btn_top" style="display:none;"><img src="<?php echo base_url('/assets/images/icon_top.svg');?>" alt="맨위로"></li>
            <?php if (element('write_url', element('list', $view))) { ?>
            <li class="btn btn_write"><a href="<?php echo element('write_url', element('list', $view)) ?>" class=""><img src="<?php echo base_url('/assets/images/icon_write.svg');?>" alt="글쓰기"></a></li>
            <?php }elseif (element('write_url', $view)) { ?>
            <li class="btn btn_write"><a href="<?php echo element('write_url', $view) ?>" class=""><img src="<?php echo base_url('/assets/images/icon_write.svg');?>" alt="글쓰기"></a></li>
            <?php } ?>
        </ul>
    </aside>

    <aside class="back_top_m" style="display:none;">
        <div><img src="<?php echo base_url('/assets/images/backtop_03.png')?>" alt="맨위로"></div>
    </aside>
    <!-- footer start -->
    <?php echo $this->managelayout->display_footer(); ?>
    <!-- footer end -->

<div class="menu " id="side_menu">
    <div class="side_wr add_side_wr">
        <div id="isroll_wrap" class="side_inner_rel">
            <section class="side_inner_abs gnb_side">
                <h2 class="hidden">네비게이션</h2>
                
                <div class="top">
                    <?php if ($this->member->is_member()) { ?>
                        <h3 class="txt"><a href="<?php echo site_url('mypage'); ?>" title="마이페이지" style="color:#fff"><span class="t_bold"><?php echo $this->member->item('mem_nickname') ?></span>님 안녕하세요</a></h3>
                    <?php } else { ?>
                        <h3 class="txt"><a style="color:#fff" href="<?php echo site_url('login?url=' . urlencode(current_full_url())); ?>" title="로그인">로그인 하세요</a></h3>
                    <?php } ?>
                    <button type="button" class="btn_close" ><img src="<?php echo base_url('assets/images/icon_close.svg') ?>" alt="메뉴닫기"></button>
                </div>
                <?php if ($this->member->is_member()) { ?>
                    <div class="my_box01">
                        <ul class="list">
                        <li class="list_li"><a href="<?php echo site_url('notification'); ?>" title="나의 알림"><img src="/assets/images/menu_icon_bell.svg" alt="알림" class="icon"><br>알 림<span class="lab_notification badge notification_num"><?php echo number_format((int) element('notification_num', $layout)); ?> </span></a></li>
                        <?php if ($this->cbconfig->item('use_note') && $this->member->item('mem_use_note')) { ?>
                            <li class="list_li"><a href="javascript:;" onClick="note_list();" title="나의 쪽지"><img src="/assets/images/menu_icon_mail.svg" alt="쪽지" class="icon"><br>쪽 지<span class="lab_notification"><?php echo number_format((int) $this->member->item('meta_unread_note_num')); ?></span></a></li>
                        <?php } ?>
                        <?php if ($this->cbconfig->item('use_point')) { ?>
                            <li class="list_li"><a href="<?php echo site_url('mypage/point'); ?>" title="나의 포인트"><img src="/assets/images/menu_icon_point.svg" alt="포인트" class="icon"><br><span class="point"> <?php echo number_format((int) $this->member->item('mem_point')); ?></span> 점</a></li>
                        <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <?php
                $menuhtml = '';
                if (element('menu', $layout)) {
                    $menu = element('menu', $layout);
                    if (element(0, $menu)) {
                        foreach (element(0, $menu) as $mkey => $mval) {
                            if (element(element('men_id', $mval), $menu)) {
                                $mlink = element('men_link', $mval) ? element('men_link', $mval) : 'javascript:;';
                                $menuhtml .= '<div class="cate_box01"><h3 class="tit">
                                <a href="' . $mlink . '" ' . element('men_custom', $mval);
                                if (element('men_target', $mval)) {
                                    $menuhtml .= ' target="' . element('men_target', $mval) . '"';
                                }
                                $menuhtml .= ' title="' . html_escape(element('men_name', $mval)) . '">' . html_escape(element('men_name', $mval)) . '</a><a href="#" style="float:right;" class="subopen" data-menu-order="' . $mkey . '"><i class="fa fa-angle-down"></i></a></h3>
                                <ul class="list  drop-downorder-' . $mkey . '">';

                                foreach (element(element('men_id', $mval), $menu) as $skey => $sval) {
                                    $men_key = explode("vtn_",element('men_link', $sval));
                                    $menuhtml .= '<li class="list_li"><a href="' . element('men_link', $sval) . '" ' . element('men_custom', $sval);
                                    if (element('men_target', $sval)) {
                                        $menuhtml .= ' target="' . element('men_target', $sval) . '"';
                                    }
                                    $menuhtml .= ' title="' . html_escape(element('men_name', $sval)) . '"><img src="'.base_url("assets/images/icon_".element(1,$men_key,'')).'.svg">' . html_escape(element('men_name', $sval)) . '</a></li>';
                                }
                                $menuhtml .= '</ul></div>';

                            } else {
                                $mlink = element('men_link', $mval) ? element('men_link', $mval) : 'javascript:;';
                                $menuhtml .= '<div class="cate_box02"><h3 class="list_li"><a href="' . $mlink . '" ' . element('men_custom', $mval);
                                if (element('men_target', $mval)) {
                                    $menuhtml .= ' target="' . element('men_target', $mval) . '"';
                                }
                                $menuhtml .= ' title="' . html_escape(element('men_name', $mval)) . '">' . html_escape(element('men_name', $mval)) . '</a></h3></div>';
                            }
                        }
                    }
                }
                echo $menuhtml;
                ?>
                <div class="cate_box02">
                    <h3 class="list_li"><a href="<?php echo board_url('vtn_other') ?>">제휴문의</a></h3>
                </div>
                <ul class="login_box">
    
                    <?php if ($this->member->is_member()) { ?>
                    <li><a href="<?php echo site_url('login/logout?url=' . urlencode(current_full_url())); ?>"  title="로그아웃"><i class="fa fa-sign-out"></i> 로그아웃</a></li>
                    <?php }else{ ?>
                    <li><a href="<?php echo site_url('login?url=' . urlencode(current_full_url())); ?>"  title="로그인"><i class="fa fa-sign-in"></i> 로그인</a></li>
                    <?php } ?>
                    
                    <li><a href="<?php echo site_url('notice/lists'); ?>"  title="공지사항">공지사항</a></li>
                </ul>
            </section>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).on('click', '.viewpcversion', function(){
    Cookies.set('device_view_type', 'desktop', { expires: 1 });
});
$(document).on('click', '.viewmobileversion', function(){
    Cookies.set('device_view_type', 'mobile', { expires: 1 });
});
</script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-88829342-9', 'auto');
    ga('send', 'pageview');
    


    $(document).ready(function(){

    //     var select = $("#region");
    //     select.change(function(){
    //          //var select_name = $(this).children("option:selected").html();
    //          //$("header h1 span label").html(select_name);
    //         // $("label").css("color" , "#231b26");


    //     Cookies.set('region',$(this).children('option:selected').index(), { expires: 1 },cb_cookie_domain);
    //        // set_cookie("region", '11', 0, cb_cookie_domain);     
    // //       alert(js_mem_link[curnetIndex]);   
    //        location.href=$(this).val();
    //     });

        // $("#mainmenu ul li").click(function(){

        //     if(pageing) pageing=1;
        //     $('div.c').eq($(this).index()).click();        

        //   //  setTimeout( "reload_rg('"+js_swipe_contents[$(this).index()]+"')", 500);
        // });

        // if($("#region option:selected").text()){
        //     $("#region").siblings("label").text($("#region option:selected").text());
        //     $("#region").siblings("label").css("color" , "#231b26");
        // }

        // $(window).scroll(function() { 
        // if ($(this).scrollTop() > 500) { //250 넘으면 버튼이 보여짐니다. 
        //     $('.back_top_m').fadeIn(); } else { $('.back_top_m').fadeOut(); } 
        // });

        $('.btn_top').click(function(){

                    $('html, body').animate({
                        scrollTop: $('html, body').offset().top
                    }, 500);
        });
        
        <?php if($prev_men_link || $next_men_link) {?>
        var swiper = new Swiper('.swiper-container-main', {
          initialSlide :1,
          runCallbacksOnInit : false,
          touchAngle:20,
          threshold : 90,
          preventClicks :false,
          preventClicksPropagation:false,

        });
        

        // swiper.on('touchEnd', function () {
        //     // alert(swiper.touches.startY +"-"+ swiper.touches.currentY);
        //     if((swiper.touches.startY - swiper.touches.currentY) > 5 ) 
        //         $('#mainmenu').hide();
        //     else 
        //         $('#mainmenu').show();
                
        // });



        
        swiper.on('slideChange', function () {
            if(swiper.activeIndex < 1)
                location.href='<?php echo $prev_men_link?>';
            else if(swiper.activeIndex > 1)
                location.href='<?php echo $next_men_link?>';
                
        });
        <?php } ?>

        $(window).scroll(function() { 
            if ($(this).scrollTop() > 500) { //250 넘으면 버튼이 보여짐니다. 
                $('.btn_top').fadeIn(); } else { $('.btn_top').fadeOut(); 
            } 
        });
    });
</script> 



<!-- <script>
window.GitpleConfig = { appCode: '0DoFz2YzRfSUpTuBYVs4KF3VuI6ys2' };
!function(){function e(){function e(){var e=t.contentDocument,a=e.createElement("script");a.type="text/javascript",a.async=!0,a.src=window[n]&&window[n].url?window[n].url+"/inapp-web/gitple-loader.js":"https://app.gitple.io/inapp-web/gitple-loader.js",a.charset="UTF-8",e.head&&e.head.appendChild(a)}var t=document.getElementById(a);t||((t=document.createElement("iframe")).id=a,t.style.display="none",t.style.width="0",t.style.height="0",t.addEventListener?t.addEventListener("load",e,!1):t.attachEvent?t.attachEvent("onload",e):t.onload=e,document.body.appendChild(t))}var t=window,n="GitpleConfig",a="gitple-loader-frame";if(!window.Gitple){document;var i=function(){i.ex&&i.ex(arguments)};i.q=[],i.ex=function(e){i.processApi?i.processApi.apply(void 0,e):i.q&&i.q.push(e)},window.Gitple=i,t.attachEvent?t.attachEvent("onload",e):t.addEventListener("load",e,!1)}}();
Gitple('boot');
</script> -->

<!-- 깃플 로그인 예제 시작 { -->
<script>
<?php
/*
if ($this->member->is_member()) {
    $unique_id = $this->member->item('mem_id'); // 보안을 위해 유추할 수 없는 UUID(소문자), 숫자 등으로 변경해 주세요.
    $mb_id = $this->member->item('mem_userid');
    $name = html_escape($this->member->item('mem_nickname'));
    $nick = html_escape($this->member->item('mem_nickname'));
    $email = valid_email($this->member->item('mem_email')) ? $this->member->item('mem_email') : $this->member->item('mem_userid').'@secretvt.com';
    printf("
    Gitple('update', {
        id: '%s',
        name: '%s',
        email: '%s',
        meta: {
            '아이디': '%s',
            '별명': '%s'
        }
    });", $unique_id, $name, $email, $mb_id, $nick);
}
*/
?>


</script>

<?php echo element('popup', $layout); ?>
<?php echo $this->cbconfig->item('footer_script'); ?>

<!--
Layout Directory : <?php echo element('layout_skin_path', $layout); ?>,
Layout URL : <?php echo element('layout_skin_url', $layout); ?>,
Skin Directory : <?php echo element('view_skin_path', $layout); ?>,
Skin URL : <?php echo element('view_skin_url', $layout); ?>,
-->

</body>
</html>

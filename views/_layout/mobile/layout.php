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
<meta property="og:image" content="https://secretvt.com/assets/images/temp/logo.png">
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
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css?'.$this->cbconfig->item('browser_cache_version'))?>" />

<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/earlyaccess/nanumgothic.css" />
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
<script type="text/javascript" src="<?php echo base_url('assets/js/common.js'); ?>"></script>
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
    $menuhtml = '<nav id="mainmenu">
                    <ul>';
    
    if (element('menu', $layout)) {
        $menu = element('menu', $layout);
        $menu_keys=array_keys(element(0, $menu));
        if (element(0, $menu)) {
            foreach (element(0, $menu) as $mkey => $mval) {
                // if (element(element('men_id', $mval), $menu)) {
                //     $mlink = element('men_link', $mval) ? element('men_link', $mval) : 'javascript:;';
                //     $menuhtml .= '<li class="dropdown">
                //     <a href="' . $mlink . '" ' . element('men_custom', $mval);
                //     if (element('men_target', $mval)) {
                //         $menuhtml .= ' target="' . element('men_target', $mval) . '"';
                //     }
                //     $menuhtml .= ' title="' . html_escape(element('men_name', $mval)) . '">' . html_escape(element('men_name', $mval)) . '</a>
                //     <ul class="dropdown-menu">';

                //     foreach (element(element('men_id', $mval), $menu) as $skey => $sval) {
                //         $slink = element('men_link', $sval) ? element('men_link', $sval) : 'javascript:;';
                //         $menuhtml .= '<li><a href="' . $slink . '" ' . element('men_custom', $sval);
                //         if (element('men_target', $sval)) {
                //             $menuhtml .= ' target="' . element('men_target', $sval) . '"';
                //         }
                //         $menuhtml .= ' title="' . html_escape(element('men_name', $sval)) . '">' . html_escape(element('men_name', $sval)) . '</a></li>';
                //     }
                //     $menuhtml .= '</ul></li>';

                // } else {
                    $mlink = element('men_link', $mval) ? element('men_link', $mval) : 'javascript:;';
                    $active='';
                    
                    if(element('men_id',$mval) === element(0,element('active',$menu))) {
                        $active='active';
                    }
                    $menuhtml .= '<li class="'.$active.'" ><a href="' . $mlink . '" ' . element('men_custom', $mval);
                    if (element('men_target', $mval)) {
                        $menuhtml .= ' target="' . element('men_target', $mval) . '"';
                    }
                    $menuhtml .= ' title="' . html_escape(element('men_name', $mval)) . '">' . html_escape(element('men_name', $mval)) . '</a></li>';

                    $menuhtml .= "\n";
                // }
            }
        }
    }
    $menuhtml.='</ul></nav>';

 ?>
    <header>
        <h1>
        <!-- 로고 영역 -->
            <a href="<?php echo site_url(); ?>" title="<?php echo html_escape($this->cbconfig->item('site_title'));?>"><?php echo $this->cbconfig->item('site_logo'); ?>
            </a>
        </h1>
        <span style="visibility:hidden;">
        
         
            <label for="select">지역선택하기</label>
            <select id="region">
        <?php
        /*
        if (config_item('region_category')) {
            foreach (config_item('region_category') as $key => $value) {

                if($key == element('region', $view)) echo '<option value='.current_url().' selected>'.$value.'</option>';
                else echo '<option value='.current_url().'>'.$value.'</option>';
            }
        }
        */
        ?>
            </select>
        </span>
        <ul>
            <?php if ($this->member->is_member()) { ?>
                <li><a href="<?php echo site_url('login/logout?url=' . urlencode(current_full_url())); ?>" title="로그아웃">로그아웃</a></li>
                <li><a href="<?php echo site_url('mypage'); ?>" title="My Page">My Page</a></li>
            <?php } else { ?>
                <li><a href="<?php echo site_url('login?url=' . urlencode(current_full_url())); ?>" title="로그인">로그인</a></li>
                <li><a href="<?php echo site_url('register'); ?>" title="회원가입">회원가입</a></li>
            <?php } ?>
        </ul>
        <!-- 지역선택하기 영역 -->  
       
     
        

       
    
        
        <?php 
            if(!empty(element(0,element('active',$menu)))){
                echo $menuhtml;
                
                $prev_men_link = element('prev_men_link', $layout);
                $next_men_link = element('next_men_link', $layout);
            } else {

                
                $prev_men_link = element('prev_men_link', $view,'');
                $next_men_link = element('next_men_link', $view,'');
            }
            ?>
        
    </header>
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
    <aside class="back_top_m" style="display:none;">
        <div><img src="<?php echo base_url('/assets/images/backtop_03.png')?>" alt="맨위로"></div>
    </aside>
    <!-- footer start -->
    <?php echo $this->managelayout->display_footer(); ?>
    <!-- footer end -->




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

        var select = $("#region");
        select.change(function(){
             //var select_name = $(this).children("option:selected").html();
             //$("header h1 span label").html(select_name);
            // $("label").css("color" , "#231b26");


        Cookies.set('region',$(this).children('option:selected').index(), { expires: 1 },cb_cookie_domain);
           // set_cookie("region", '11', 0, cb_cookie_domain);     
    //       alert(js_mem_link[curnetIndex]);   
           location.href=$(this).val();
        });

        $("#mainmenu ul li").click(function(){

            if(pageing) pageing=1;
            $('div.c').eq($(this).index()).click();        

          //  setTimeout( "reload_rg('"+js_swipe_contents[$(this).index()]+"')", 500);
        });

        if($("#region option:selected").text()){
            $("#region").siblings("label").text($("#region option:selected").text());
            $("#region").siblings("label").css("color" , "#231b26");
        }

        $(window).scroll(function() { 
        if ($(this).scrollTop() > 500) { //250 넘으면 버튼이 보여짐니다. 
            $('.back_top_m').fadeIn(); } else { $('.back_top_m').fadeOut(); } 
        });

        $('.back_top_m').click(function(){

                    $('html, body').animate({
                        scrollTop: $('html, body').offset().top
                    }, 500);
        });
        
        <?php if($prev_men_link || $next_men_link) {?>
        var swiper = new Swiper('.swiper-container-main', {
          initialSlide :1,
          runCallbacksOnInit : false,
          touchAngle:35,
          threshold : 30,
          preventClicks :false,
          preventClicksPropagation:false,

        });
        

        swiper.on('touchMove', function () {

            if((swiper.touches.startY - swiper.touches.currentY) > 0 && Math.abs(swiper.touches.startY - swiper.touches.currentY) > Math.abs(swiper.touches.startX - swiper.touches.currentX)) 
                $('#mainmenu').hide();
            else 
                $('#mainmenu').show();
                
        });



        
        swiper.on('slideChange', function () {
            if(swiper.activeIndex < 1)
                location.href='<?php echo $prev_men_link?>';
            else if(swiper.activeIndex > 1)
                location.href='<?php echo $next_men_link?>';
                
        });
        <?php } ?>
    });
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

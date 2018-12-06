<?php $this->managelayout->add_js(base_url('assets/js/bxslider/jquery.bxslider.min.js')); ?>
<?php $this->managelayout->add_js(base_url('assets/js/bxslider/plugins/jquery.fitvids.js')); ?>

<script type="text/javascript">
        $(document).ready(function () {
          // alert($(window).height());
          //$('.bigbanner').css('height',$(window).height());
          $('.down').show();
          // alert(screen.height);
            var swiper_sub = new Swiper('.swiper-container-sub', {
                spaceBetween: 0,
                  effect: 'fade',
                  centeredSlides: true,
                  autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                  },
                  
            });      

            $('li.cont_cate_li').click(function(){
                $("li.cont_cate_li").removeClass('active');
                var index = $("li.cont_cate_li").index(this);
                $("li.cont_cate_li:eq(" + index + ")").addClass('active');

                $("div.cont_contents").hide();
                $("div.cont_contents:eq(" + index + ")").fadeIn();
                
            });

            $(function () {
              $('.down').bind("click", function () {
                down_scroll();
                return false;
              });
            });

            // $(window).scroll(function() {
            //   if($(this).scrollTop() >= 400)
            // });
        });

        function down_scroll() {
          var offset = $(".main_category").offset();
          $('html, body').animate({ scrollTop: offset.top-44 }, 500);
          
        }
</script>

    
        <section class="bigbanner swiper-container-sub">
            <h2 class="hidden">배너</h2>
            <ul class="bn_ul swiper-wrapper">
                <li class="bn_li bn_li01 swiper-slide"> 
                    <div class="bn_img" style="background-image:url('<?php echo base_url('assets/images/bn_02.png') ?>');"></div>
                    <div class="bn_text_box">
                        <a href="/event/post/7">
                            <p class="bn_text big_font">Jeong San</p>
                            <p class="bn_text small_font">동나이강에서 진행하는 지상최고의 라운딩<br>적당한 굴곡, 넓은 페어웨이,<br>현대적인 벙커의 조화</p>
                            
                            <span class="btn">할인패키지 내용보기 →</span>
                        </a>
                    </div>
                    <div class="black_back"></div>
                </li>

                <li class="bn_li bn_li02 swiper-slide"> 
                    <div class="bn_img" style="background-image:url('<?php echo base_url('assets/images/bn_01.png') ?>');"></div>
                    <div class="bn_text_box text-right">
                        <a href="/event/post/7">
                            <p class="bn_text small_font">인도차이나에서 가장 도전적인 골프 코스 <br>건축의 걸작이라 할 수 있는</p>
                            <p class="bn_text big_font">Dong Nai 골프</p>
                            <span class="btn">할인패키지 내용보기 →</span>
                        </a>
                    </div>
                    <div class="black_back"></div>
                </li>
               
                <li class="bn_li bn_li03 swiper-slide"> 
                    <div class="bn_img" style="background-image:url('<?php echo base_url('assets/images/bn_03.png') ?>');"></div>
                    <div class="bn_text_box">
                        <a href="/event/post/7">
                            <p class="bn_text big_font">Tan Son Nhat</p>
                            <p class="bn_text small_font">넓은 페어웨이와<br>롤링 워터 해저드 제방벙커,<br>베트남 최고의 서비스,<br>접근성, 편의시설 관리운영</p>
                            <span class="btn">할인패키지 내용보기 →</span>
                        </a>
                    </div>
                    <div class="black_back"></div>
                </li>
            </ul>
            <div class="down" style="display: none;">
            
                <div class="path path01"></div>
                <div class="path path02"></div>
                <div class="path path03"></div>
            
            </div>
        </section>

       <!--  <section class="ad" style="margin-bottom:4%;">
            <h4>
                ad01
            </h4>
            <a href="<?php echo base_url('write/vtn_discount') ?>">
                <img src="<?php echo base_url('assets/images/temp/middle_btn.png') ?>">
            </a>
        </section> -->
        <section class="main_category">
        <h2 class="hidden">메인메뉴</h2>
        <ul class="main_cate_ul">
            <?php 
            if (element('list', $view)) {
                foreach(element('list', $view) as $value){

               
             ?>
            <li class="main_cate_li" style="background-image:url('<?php echo base_url("assets/images/".element('brd_key', element('board',$value)).".png") ?>');">
                <a href="<?php echo element('board_url',$value) ?>">
                    <div class="cate_text"><?php echo element('men_name',$value) ?></div>
                    <?php 

                    if(element('brd_key', element('board',$value))==='vtn_info' || element('brd_key', element('board',$value))==='vtn_free'|| element('brd_key', element('board',$value))==='vtn_free_gallery')
                      echo'<div class="cate_count">총&#32;<span class="count">'.element('total_rows',$value).'개</span>의 게시글이 있습니다.</div>';
                    else 
                      echo'<div class="cate_count">총&#32;<span class="count">'.element('total_rows',$value).'개</span>의 업소정보가 있습니다.</div>';
                     ?>
                    
                </a>
            </li>
            <?php 
                } 
            }
            ?>
            
        </ul>
        
        
    </section>
    <section class="secret_bn">
            <a href="<?php echo base_url('write/vtn_tour') ?>">
                <h4>ad02</h4>
                <figure>
                    <img src="<?php echo base_url('assets/images/temp/main_bot/bottom_bn01.png?ver=1.0') ?>" alt="bottom_vtn_tour">
                    <figcaption style="right: 8%;">
                        <h2>시크릿 투어</h2>
                     
                        <p>
                            호텔예약,골프부킹 가이드 요청<br>
                            예약서비스 입니다.
                        </p>
                     
                         <button>
                             바 로 가 기
                         </button>
                    </figcaption>
                </figure>
            </a>
        </section>
    <section class="mainpage_cont">
        <h2 class="hidden">업소정보</h2>
        <div class="cont_category">
            <ul class="cont_cate_ul">
                <?php 
                $i=0;
                if (element('list', $view)) {
                    foreach(element('list', $view) as $key => $value){

                    if($i===0)  $active ="active";
                    else $active ="";
                 ?>


                <li class="cont_cate_li <?php echo $active ?>" id="men_<?php echo $key ?>">
                    <?php echo element('men_name',$value) ?>
                </li>
                <?php 
                    $i++;
                    } 
                }
                ?>

                
                
            </ul>
        </div>
        
        
        <?php 
        $i=0;
        if (element('list', $view)) {
            foreach(element('list', $view) as $key => $value){

                if($i===0)  $active ="active";
                else $active ="";
                
                if(element('brd_key', element('board',$value))!=='vtn_free'){
                    
                   ?>
                    <div class="cont_list cont_contents <?php echo $active ?>" >
                        <ul class="cont_list_ul">
                           <?php 
                           if(element('post_list',$value))
                           foreach(element('post_list',$value) as  $value_){
                            ?>   
                           <li class="cont_list_li">
                           <a href="<?php echo element('post_url',$value_) ?>">
                               <figure>
                                   <img src="<?php echo element('thumb_url', $value_); ?>" alt="<?php echo html_escape(element('title', $value_)); ?>" title="<?php echo html_escape(element('title', $value_)); ?>" class=" img-responsive" style="width:100%;" />
                                   <figcaption>
                                       <h3 class="cont_title"><?php if(!empty(element('bca_value',element('category', $value_)))) echo '['.html_escape(element('bca_value',element('category', $value_))).']'; ?><?php echo html_escape(element('title', $value_)); ?></h3>
                                       <p class="cont_text"><?php if(element('sub_subject',element('extravars', $value_))) echo element('sub_subject',element('extravars', $value_)); ?></p>
                                   </figcaption>
                               </figure>
                           </a>
                           </li>
                           
                           <?php 
                           }
                            ?>
                            <li class="cont_list_li cont_plus">
                               <a href="<?php echo element('board_url',$value) ?>">
                                   <figure>
                                       <img src="<?php echo base_url('assets/images/see_more_icon.png') ?> " alt="더 보 기">
                                       <figcaption>
                                           <h3 class="cont_title">더 보 기</h3>
                                           
                                       </figcaption>
                                   </figure>
                               </a>
                            </li>
                       </ul>
                   </div>
                <?php
                } else {

                ?>
                    <div class="text_list cont_contents" id="men_<?php echo $key ?>">
                       <ul class="text_list_ul">
                           <?php 
                           if(element('post_list',$value))
                           foreach(element('post_list',$value) as  $value_){
                            ?>   
                           <li class="text_list_li">
                            <a href="<?php echo element('post_url',$value_) ?>">
                               <h3 class="text_title"><strong><?php echo html_escape(element('title', $value_)); ?></strong>
                                <?php if (element('post_comment_count', $value_)) { ?><span class="comment_num">+<?php echo element('post_comment_count', $value_); ?></span><?php } ?>
                                </h3>
                               <div class="text_cont"><?php if(element('post_content',$value_)) echo element('post_content',$value_); ?></div>
                            </a>
                           </li>
                           
                           <?php 
                           }
                            ?>
                            
                       </ul>
                       <div class="text_plus">
                        <a href="<?php echo element('board_url',$value) ?>">더 보 기<img src="<?php echo base_url('assets/images/see_more_icon_small.png') ?>" alt="더 보 기"></a>
                       </div>
                   </div>
        <?php 
                }
            $i++;
            } 
        }
        ?>
        
       </section>
    
    <!-- main 하단 배너 영역 -->
        

        <!-- <section class="secret_bn">
            <a href="<?php echo base_url('write/vtn_safevisa') ?>">
                <h4>ad02</h4>
                <figure>
                    <img src="<?php echo base_url('assets/images/temp/main_bot/bottom_bn03.png') ?>" alt="bottom_vtn_safevisa">
                    <figcaption style="right: 8%; text-align: right;">
                        <h2>시크릿 안전비자</h2>
                     
                        <p>
                            관광단수 및 복수,DN 비즈니스<br>
                            거주증 및 문제비자 문의
                        </p>
                     
                         <button >
                             바 로 가 기
                         </button>
                    </figcaption>
                </figure>
            </a>
        </section>

        <section class="secret_bn" style="margin-bottom:4%;">
            <a href="<?php echo base_url('write/vtn_renta') ?>">
                    <h4>ad02</h4>
                    <figure>
                        <img src="<?php echo base_url('assets/images/temp/main_bot/bottom_bn02.png') ?>" alt="bottom_vtn_renta">
                        <figcaption style="left: 8%;">
                            <h2>시크릿 렌트카</h2>
                         
                            <p>
                                7인,16인,25인,45인 리무진 <br>
                                차량요청 서비스
                            </p>
                         
                             <button>
                                 바 로 가 기
                             </button>
                        </figcaption>
                    </figure>
            </a>
        </section> -->

    <?php 
    if(element('noti_title',element('0',element('notice_result', $view))) || element('eve_title',element('0',element('event_result', $view)))){
    ?>
    <!-- notice & event 영역 -->
        <section class="notice">
            <ul>
                <?php 
                if(element('noti_title',element('0',element('notice_result', $view)))){
                ?>
                
                <li style="border-bottom:1px solid #ededed;">
                    <a href="<?php echo base_url('/notice/lists'); ?>">
                        <h3>공지사항</h3>
                        <p>시크릿베트남에서 알려드립니다.
                        <?php 
                        if(element('is_new',element('notice', $view))){
                        ?>
                            <img src="<?php echo base_url('/assets/images/temp/new.png')?>" style="width:13px;vertical-align: middle;">
                        <?php }?>
                        </p>
                    </a>
                </li>
                <?php }?>
                <?php 
                if(element('eve_title',element('0',element('event_result', $view)))){
                ?>
                <li>
                    <a href="<?php echo base_url('/event/lists'); ?>">
                        <h3>이벤트</h3>
                        <p>시크릿베트남의 다양한 이벤트를 만나보세요.
                        <?php 
                        if(element('is_new',element('event', $view))){
                        ?>
                            <img src="<?php echo base_url('/assets/images/temp/new.png')?>" style="width:13px;vertical-align: middle;">
                        <?php }?>
                        </p>
                    </a>
                </li>
                <?php }?>
            </ul>
        </section>
    <?php }?>
    

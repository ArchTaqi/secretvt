<?php $this->managelayout->add_js(base_url('assets/js/bxslider/jquery.bxslider.min.js')); ?>
<?php $this->managelayout->add_js(base_url('assets/js/bxslider/plugins/jquery.fitvids.js')); ?>
<script type="text/javascript">
        $(document).ready(function () {
            var swiper_sub = new Swiper('.swiper-container-sub', {
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                  },
                  
            });           
        });
</script>

<div class="wrap06">
        <section class="slide" >
            <div class="swiper-container-sub">
                <div class="swiper-wrapper">
                <?php echo banner('index_bxslider','order',3,'<div class="swiper-slide per100">','</div>'); ?>
                </div>
                
            </div>
            <p>
                  A resort for you only ! You can get all the information<br>
                  you need in one trip to Vietnam  
                </p>
        </section>

       <!--  <section class="ad" style="margin-bottom:4%;">
            <h4>
                ad01
            </h4>
            <a href="<?php echo base_url('write/vtn_discount') ?>">
                <img src="<?php echo base_url('assets/images/temp/middle_btn.png') ?>">
            </a>
        </section> -->

        <section class="main_list">
            <h4>main_list</h4>
            <ul>
                <li>
                    <a href="<?php echo site_url('/board/vtn_karaoke') ?>">
                        <figure>
                            <img src="<?php echo base_url('assets/images/temp/main_menu/menu_01.png'); ?>" alt="main_01">
                            <figcaption>
                                <h2>가라오케</h2>
                                <p>맛좋은 술과 노래를 즐길 수 있는 곳</p>
                            </figcaption>
                        </figure>
                    </a>
                </li>

                <li>
                    <a href="<?php echo site_url('/board/vtn_club') ?>">
                        <figure>
                            <img src="<?php echo base_url('assets/images/temp/main_menu/menu_02.png'); ?>" alt="main_02">
                            <figcaption>
                                <h2>클 럽</h2>
                                <p>베트남 여성들과 다양하고 즐거운 만남</p>
                            </figcaption>
                        </figure>
                    </a>
                </li>

                <li>
                    <a href="<?php echo site_url('/board/vtn_msg') ?>">
                        <figure>
                            <img src="<?php echo base_url('assets/images/temp/main_menu/menu_03.png'); ?>" alt="main_03">
                            <figcaption>
                                <h2>마사지&이발소</h2>
                                <p>내 몸 관리와 함께 특별한 서비스</p>
                            </figcaption>
                        </figure>
                    </a>
                </li>

                <li>
                    <a href="<?php echo site_url('/board/vtn_hotel') ?>">
                        <figure>
                            <img src="<?php echo base_url('assets/images/temp/main_menu/menu_04.png'); ?>" alt="main_04">
                            <figcaption>
                                <h2>호 텔</h2>
                                <p>체계적인 서비스와 깜끔한 시설 관리</p>
                            </figcaption>
                        </figure>
                    </a>
                </li>

                <li>
                    <a href="<?php echo site_url('/board/vtn_golf') ?>">
                        <figure>
                            <img src="<?php echo base_url('assets/images/temp/main_menu/menu_05.png'); ?>" alt="main_05">
                            <figcaption>
                                <h2>골 프</h2>
                                <p>높은 퀄리티와 서비스,<br>넓은 페어웨이 </p>
                            </figcaption>
                        </figure>
                    </a>
                </li>

                <li>
                    <a href="<?php echo site_url('/board/vtn_food')?>">
                        <figure>
                            <img src="<?php echo base_url('assets/images/temp/main_menu/menu_06.png'); ?>" alt="main_06">
                            <figcaption>
                                <h2>맛 집</h2>
                                <p>베트남 로컬 맛집 부터<br> 퓨전 맛집까지</p>
                            </figcaption>
                        </figure>
                    </a>
                </li>

                <li>
                    <a href="<?php echo site_url('/board/vtn_travel') ?>">
                        <figure>
                            <img src="<?php echo base_url('assets/images/temp/main_menu/menu_07.png'); ?>" alt="main_07">
                            <figcaption>
                                <h2>여행정보</h2>
                                <p>여행기사부터 코스정보<br>까지 한곳에</p>
                            </figcaption>
                        </figure>
                    </a>
                </li>

                <li>
                    <a href="<?php echo site_url('/board/vtn_info')?>">
                        <figure>
                            <img src="<?php echo base_url('assets/images/temp/main_menu/menu_08.png'); ?>" alt="main_0">
                            <figcaption>
                                <h2>베남 정보</h2>
                                <p>다양한 정보를 현지에서<br> 전달</p>
                            </figcaption>
                        </figure>
                    </a>
                </li>

                <li>
                    <a href="<?php echo site_url('/board/vtn_free')?>">
                        <figure>
                            <img src="<?php echo base_url('assets/images/temp/main_menu/menu_09.png'); ?>" alt="main_0">
                            <figcaption>
                                <h2>자유 게시판</h2>
                                <p>베트남의 경험담을<br> 자유롭게 작성</p>
                            </figcaption>
                        </figure>
                    </a>
                </li>


            </ul>
        </section>

    <!-- main 하단 배너 영역 -->
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
    
</div>
<section class="main_gallery_list01">
    <div class="m_list_tit">
        <h2 class="tit"><?php echo html_escape(element('latest_title', element('config', $view))); ?></h2>
        <a href="<?php echo group_url('g-a'); ?>" class="see_more" title="<?php echo html_escape(element('latest_title', element('config', $view))); ?>">더보기 <i class="fa fa-angle-right" ></i></a>
    </div>
        <!-- Table -->
    <div class="gallery_list swiper-container">
        <ul class="list swiper-wrapper">
            <?php
            $i = 0;
            if (element('latest', $view)) {
                foreach (element('latest', $view) as $key => $value) {
            ?>
                <li class="list_li swiper-slide">
                    <a href="<?php echo element('url', $value); ?>" title="<?php echo html_escape(element('title', $value)); ?>">
                        <div class="thum">
                            <img src="<?php echo element('thumb_url', $value); ?>" alt="<?php echo html_escape(element('title', $value)); ?>">
                        </div>
                        <div class="txt_box">
                            <h3 class="tit"><?php echo html_escape(element('title', $value)); ?></h3>
                        </div>
                    </a>
                </li>
            <?php
                    $i++;
                }
            }
            ?>
            
        </ul>
        <div class="swiper-pagination"></div>
    </div>
</section>
<script type="text/javascript">
//<![CDATA[
    
    var swiper = new Swiper('.main_gallery_list01 .swiper-container', {
      slidesPerView: 2.5,
      spaceBetween: 10,
      
      freeMode: true,
      pagination: {
        el: '.main_gallery_list01 .swiper-pagination',
      
        dynamicBullets: true,
      },
    });

//]]>
</script>
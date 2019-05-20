<div class="main_flex">
    <div class="bg_lightgray">
        <!-- 추천 컨텐츠 -->
        <?php 
        $config = array(
            'skin' => 'mobile',
            'latest_title' => '시크릿베트남 추천 컨텐츠',
            'brd_key' => array('vtn_karaoke','vtn_club','vtn_msg','vtn_hotel','vtn_golf','vtn_food','vtn_famous'),
            'is_gallery' => 1,
            'image_height' => 200,
            'image_width' => 200,
            'cache_minute' => 1,
            'limit' => 5,
            'findex' => 'post_like',
            'forder' => 'desc',
          );
        echo $this->board->latest_like($config);
        ?>

        <!-- 자유게시판 -->
        <?php 
        $config = array(
            'skin' => 'mobile',
            'latest_title' => '시크릿 자유게시판',
            'latest_class' => 'main_txt_list01',
            'brd_key' => 'vtn_free',
            'cache_minute' => 1,
            'limit' => 5,
          );
        echo $this->board->latest_free($config);
        ?>
        <section class="ad mb2per">
          <a href=""><img src="http://placehold.it/500x150" alt="광고"></a>
        </section>
        <!-- NEW 새로운 컨텐츠 -->
        <?php 
        $config = array(
            'skin' => 'mobile',
            'latest_title' => '신규 컨텐츠',
            'latest_class' => 'main_gallery_list02',
            'brd_key' => array('vtn_karaoke','vtn_club','vtn_msg','vtn_hotel','vtn_golf','vtn_food','vtn_famous'),
            'is_gallery' => 1,
            'image_height' => 200,
            'image_width' => 200,
            'cache_minute' => 1,
            'limit' => 500,
            
          );
        echo $this->board->latest_new($config);
        ?>

        <!-- 자유 갤러리 -->
        <?php 
        $config = array(
            'skin' => 'mobile',
            'latest_title' => '자유갤러리',
            'latest_class' => 'main_gallery_list03',
            'brd_key' => 'vtn_free_gallery',
            'is_gallery' => 1,
            'image_height' => 200,
            'image_width' => 200,
            'cache_minute' => 1,
            'limit' => 4,
          );
        echo $this->board->latest_gallery($config);
        ?>
        <!-- 번개/동행 -->
        <?php 
        $config = array(
            'skin' => 'mobile',
            'latest_title' => '번개/동행',
            'latest_class' => 'main_txt_list02',
            'brd_key' => 'vtn_ltn',
            'cache_minute' => 1,
            'limit' => 5,
          );
        echo $this->board->latest_ltn($config);
        ?>
        <section class="ad mb2per">
          <a href=""><img src="http://placehold.it/500x240" alt="광고"></a>
        </section>

        <?php 
        $config = array(
            'skin' => 'mobile',
            'latest_title' => '최근 본 게시물',
            'latest_class' => 'main_tab01',
            'post_id' => $this->session->userdata('lately'),
            'cache_minute' => 1,
            'limit' => 5,
            'is_gallery' => 1,
          );
        echo $this->board->latest_lately($config);
        ?>
        


        <?php 
        if(element('noti_title',element('0',element('notice_result', $view))) || element('eve_title',element('0',element('event_result', $view)))){
        ?>
        <!-- notice & event 영역 -->
            <section class="news_oneline mb0">
                
                    <?php 
                    if(element('noti_title',element('0',element('notice_result', $view)))){
                    ?>
                    <div class="box">
                        <a href="<?php echo document_post_url('notice', element('noti_id', element('0',element('notice_result', $view)))) ?>">
                            <b class="lab">공지</b>
                            <?php echo element('noti_title',element('0',element('notice_result', $view))) ?>
                            <?php 
                            if(element('is_new',element('notice', $view))){
                            ?>
                                <img src="<?php echo base_url('/assets/images/temp/new.png')?>" style="width:13px;vertical-align: middle;">
                            <?php }?>
                            
                        </a>
                    </div>
                    <?php }?>
                    <?php 
                    if(element('eve_title',element('0',element('event_result', $view)))){
                    ?>
                    <div class="box">
                        <a href="<?php echo document_post_url('event', element('eve_id', element('0',element('event_result', $view)))) ?>">
                            <b class="lab">이벤트</b>
                            <?php echo element('eve_title',element('0',element('event_result', $view))) ?>
                            <?php 
                            if(element('is_new',element('event', $view))){
                            ?>
                                <img src="<?php echo base_url('/assets/images/temp/new.png')?>" style="width:13px;vertical-align: middle;">
                            <?php }?>
                            
                        </a>
                    </div>
                    <?php }?>
                </ul>
            </section>
        <?php }?>
        
  </div>
</div>
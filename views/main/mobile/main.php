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
        <section class="main_tab01">
        <h2 class="hidden">하단 탭메뉴</h2>
        <div class="tab_cate">
          <ul class="cate_list">
            <li class="list_li active"><button type="button" class="btn_tab">최근 본 게시물</button></li>
            
          </ul>
        </div>
        <div class="tab_cont">
          <div class="tab_list">
            <ul class="list">
              <li class="list_li">
                <a href="">
                  <div class="thum">
                    <img src="https://secretvt.com/uploads/post/2018/10/eda76225295da60e343e1e60ca7d0cf6.png" alt="호치민 중심에서 맛집즐기기~">
                  </div>
                  <div class="txt_box">
                    <h3 class="tit"><strong>호치민 중심에서 맛집즐기기~</strong><span class="reply">[4]</span></h3>
                    <ul class="info_list">
                      <li class="info_li nick">닉네임</li>
                      <li class="info_li">04-01</li>
                      <li class="info_li"><span class="hidden">조회수</span><i class="fa fa-eye"></i> 300</li>
                    </ul>
                  </div>
                </a>
              </li>
              <li class="list_li">
                <a href="">
                  <div class="thum">
                    <img src="https://secretvt.com/uploads/post/2018/10/eda76225295da60e343e1e60ca7d0cf6.png" alt="호치민 중심에서 맛집즐기기~">
                  </div>
                  <div class="txt_box">
                    <h3 class="tit"><strong>호치민 중심에서 맛집즐기기~호치민 중심에서 맛집즐기기~호치민 중심에서 맛집즐기기~</strong><span class="reply">[6]</span></h3>
                    <ul class="info_list">
                      <li class="info_li nick">닉네임</li>
                      <li class="info_li">04-01</li>
                      <li class="info_li"><span class="hidden">조회수</span><i class="fa fa-eye"></i> 120</li>
                    </ul>
                  </div>
                </a>
              </li>
              <li class="list_li">
                <a href="">
                  <div class="thum">
                    <img src="https://secretvt.com/uploads/post/2019/03/ea69a3528b27b1d4594941224f3cbf3e.gif" alt="핑크핑크한 우주소녀 루다">
                  </div>
                  <div class="txt_box">
                    <h3 class="tit"><strong>핑크핑크한 우주소녀 루다</strong></h3>
                    <ul class="info_list">
                      <li class="info_li nick">닉네임</li>
                      <li class="info_li">04-01</li>
                      <li class="info_li"><span class="hidden">조회수</span><i class="fa fa-eye"></i> 32</li>
                    </ul>
                  </div>
                </a>
              </li>
              <li class="list_li">
                <a href="">
                  <div class="txt_box">
                    <h3 class="tit"><strong>핑크핑크한 우주소녀 루다</strong></h3>
                    <ul class="info_list">
                      <li class="info_li nick">닉네임</li>
                      <li class="info_li">04-01</li>
                      <li class="info_li"><span class="hidden">조회수</span><i class="fa fa-eye"></i> 11</li>
                    </ul>
                  </div>
                </a>
              </li>
              <li class="list_li">
                <a href="">
                  <div class="txt_box">
                    <h3 class="tit"><strong>핑크핑크한 우주소녀 루다핑크핑크한 우주소녀 루다핑크핑크한 우주소녀 루다</strong><span class="reply">[1]</span></h3>
                    <ul class="info_list">
                      <li class="info_li nick">닉네임</li>
                      <li class="info_li">04-01</li>
                      <li class="info_li"><span class="hidden">조회수</span><i class="fa fa-eye"></i> 11</li>
                    </ul>
                  </div>
                </a>
              </li>
            </ul>
            
          </div>
          <div class="tab_empty" style="display: none;">
            <p class="txt">최근 본 게시물이 없습니다.</p>
          </div>
        </div>

      </section>


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
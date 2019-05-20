<section class="<?php echo html_escape(element('latest_class', element('config', $view))); ?>">
    <div class="tab_cate">
      <ul class="cate_list">
        <li class="list_li active"><button type="button" class="btn_tab"><?php echo html_escape(element('latest_title', element('config', $view))); ?></button></li>
        
      </ul>
    </div>
    
        <!-- Table -->
    <div class="tab_cont">
        <div class="tab_list">
            <ul class="list">
            <?php
            $i = 0;
            if (element('latest', $view)) {
                foreach (element('latest', $view) as $key => $value) {
            ?>  
                <li class="list_li ">
                    <div>
                        <?php 
                        if(element('thumb_url', $value)){
                            echo '<a href="'.element('url', $value).'" title="'.html_escape(element('title', $value)).'">
                            <div class="thum">
                              <img src="'.element('thumb_url', $value).'" alt="'.html_escape(element('title', $value)).'">
                            </div>';
                        } 
                        ?>
                    
                        <div class="txt_box">
                            <a href="<?php echo element('url', $value); ?>" title="<?php echo html_escape(element('title', $value)); ?>">
                            <h3 class="tit"><strong><?php echo html_escape(element('title', $value)); ?></strong>
                            <?php if (element('post_comment_count', $value)) { ?> <span class="reply">[<?php echo element('post_comment_count', $value); ?>]</span><?php } ?>
                            </h3>
                            </a>
                          <ul class="info_list">
                            <li class="info_li nick"><?php echo element('name', $value); ?></li>
                            <li class="info_li"><?php echo element('display_datetime', $value); ?></li>
                            <li class="info_li"><span class="hidden">조회수</span><i class="fa fa-eye"></i><?php echo number_format(element('post_hit', $value)); ?></li>
                          </ul>
                        </div>
                    </div>    
                </li>
            <?php
                    $i++;
                }
            } 
            ?>
            
        </ul>
    </div>
    <?php 
    if (!element('latest', $view)) {
        echo '<div class="tab_empty" >
              <p class="txt">최근 본 게시물이 없습니다.</p>
            </div>';
    }
     ?>
    
</section>

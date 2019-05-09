<section class="<?php echo html_escape(element('latest_class', element('config', $view))); ?>">
    <div class="m_list_tit">
        <h2 class="tit"><?php echo html_escape(element('latest_title', element('config', $view))); ?></h2>
        <a href="<?php echo board_url(element('brd_key', element('board', $view))); ?>" class="see_more" title="<?php echo html_escape(element('latest_title', element('config', $view))); ?>">더보기 <i class="fa fa-angle-right" style="font-size: 16px;vertical-align: middle;"></i></a>
    </div>
        <!-- Table -->
    <div class="">
        <ul class="list ">
            <?php
            $i = 0;
            if (element('latest', $view)) {
                foreach (element('latest', $view) as $key => $value) {
            ?>
                <li class="list_li ">
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
    </div>
</section>
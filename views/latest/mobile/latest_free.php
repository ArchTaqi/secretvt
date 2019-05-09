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
                        
                            <span class="lank"><?php echo $key+1 ?></span>
                            <strong class="tit">
                                <?php echo html_escape(element('title', $value)); ?>
                            </strong>
                            <?php if (element('post_comment_count', $value)) { ?> <span class="num_reply">[<?php echo element('post_comment_count', $value); ?>]</span><?php } ?>
                            

                        
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
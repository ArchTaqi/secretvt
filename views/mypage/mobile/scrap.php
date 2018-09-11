<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<div class="wrap05 mypage">
    <section class="title02">
        <h2>스크랩</h2>
    </section>
    
    <section class="myinfo">
        <figure class="info_area">
            <img src="<?php echo base_url('assets/images/temp/info_img/info_user.png') ?>" alt="user">
            <figcaption>
                <h2>
                    <?php echo html_escape($this->member->item('mem_userid')); ?>
                </h2>
                <p><strong>"<?php echo html_escape($this->member->item('mem_nickname')); ?>" </strong>님 안녕하세요</p>
            </figcaption>
        </figure>
    </section>
    
    <section class="info_table">
        <table>
            <tr>
                <td>
                    <a href="<?php echo site_url('mypage'); ?>">내 정보</a>
                </td>
                <td>
                    <a href="<?php echo site_url('mypage/post'); ?>">작성글</a>
                </td>
                <td class="active">
                    <a href="<?php echo site_url('mypage/scrap'); ?>" title="나의 스크랩">스크랩</a>
                </td>
            </tr>
        </table>
    </section>
    
    <section class="store_list02">
    <h3>스크랩 <small>총: <?php echo number_format(element('total_rows', element('data', $view), 0)); ?>건</small></h3>
    <?php
    echo show_alert_message(element('alert_message', $view), '<div class="alert alert-auto-close alert-dismissible alert-info"><button type="button" class="close alertclose" >&times;</button>', '</div>');
    ?>
        
            <?php
            if (element('list', element('data', $view))) {
                foreach (element('list', element('data', $view)) as $result) {
            ?>
            <ul>
                <li class="gallery-box " >
                    
                    <a href="<?php echo element('post_url', $result); ?>" title="<?php echo html_escape(element('title', $result)); ?>">
                        <div  class="per30 pull-left">
                        <img src="<?php echo element('thumb_url', $result); ?>" alt="<?php echo html_escape(element('title', $result)); ?>" title="<?php echo html_escape(element('title', $result)); ?>" class="per100 img-responsive"  />
                        </div>
                        <div class="per60 ml10 pull-left">
                        <h2 >[<?php echo html_escape(element('bca_value',element('category', $result))); ?>]<?php echo html_escape(element('title', $result)); ?><?php if (element('post_comment_count', $result)) { ?><span style="font:normal 11px 'dotum';">[+<?php echo element('post_comment_count', $result); ?>]</span><?php } ?></h2>
                        
                        
                            <p class="sub_subject"><?php if(element('sub_subject',element('extravars', $result))) echo element('sub_subject',element('extravars', $result)); ?>
                            </p>

                            <span>
                                <?php if (element('open_time',element('extravars', $result))) { 
                                   echo  element('open_time',element('extravars', $result));
                                }
                                ?>
                                
                            </span>
                        </div>
                        <div class=" pull-left ">
                            <?php 
                            echo '<a href="javascript:post_action(\'post_scrap_cancel\',\''.element('post_id',  $result).'\', \''.element('scr_id', $result).'\',\'스크랩을 취소 하시겠습니까?\');"><i class="fa fa-heart" style="font-size:20px;color:#ddd;"></i></a>';
                             
                             ?>
                            
                        </div>
                    </a>
                </li>
            </ul>
            <?php
                }
            }
            if ( ! element('list', element('data', $view))) {
            ?>
            <div class="table-answer nopost">내용이 없습니다</div>     
            <?php
            }
            ?>
        <nav><?php echo element('paging', $view); ?></nav>
    </section>
</div>

<script type="text/javascript">
//<![CDATA[
$(document).on('click', '.btn-scrap-modify', function() {
    $('.title-a-' + $(this).attr('data-scrap-id')).toggle();
    $('.title-b-' + $(this).attr('data-scrap-id')).toggle();
});
//]]>
</script>

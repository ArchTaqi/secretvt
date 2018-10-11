<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>




<?php echo element('headercontent', element('board', element('list', $view))); ?>

<div class="wrap10">

    <!-- <section class="title">
        <h4>title</h4>
        <div></div>
        <h2><?php echo html_escape(element('board_name', element('board', element('list', $view)))); ?></h2>
        <?php
            if (element('use_category', element('board', element('list', $view))) && element('cat_display_style', element('board', element('list', $view))) === 'tab') {
                $category = element('category', element('board', element('list', $view)));
                ?>
                <table class="table01">
                    <tr>
                        <td role="presentation" <?php if ( ! $this->input->get('category_id')) { ?>class="active" <?php } ?>><a href="<?php echo board_url(element('brd_key', element('board', element('list', $view)))); ?>?findex=<?php echo html_escape($this->input->get('findex')); ?>&category_id="><img src="<?php echo base_url('assets/images/temp/sub_img/sub_all.png'); ?>" alt="sub01">전체</a></td>
                        <?php
                        if (element(0, $category)) {
                            foreach (element(0, $category) as $ckey => $cval) {
                                ?>
                                <td role="presentation" <?php if ($this->input->get('category_id') === element('bca_key', $cval)) { ?>class="active" <?php } ?>><a href="<?php echo board_url(element('brd_key', element('board', element('list', $view)))); ?>?findex=<?php echo html_escape($this->input->get('findex')); ?>&category_id=<?php echo element('bca_key', $cval); ?>"><img src="<?php echo base_url('assets/images/temp/sub_img/kara_0'.($ckey+1).'.png'); ?>" alt="sub01"><?php echo html_escape(element('bca_value', $cval)); ?></a></td>
                                <?php
                            }
                        }
                        ?>
                    </tr>
                </table>
        <?php } ?>
    </section> -->



    <?php
    $attributes = array('name' => 'fboardlist', 'id' => 'fboardlist');
    echo form_open('', $attributes);
    ?>

    <?php if (element('is_admin', $view)) { ?>
        <div><label for="all_boardlist_check" class='label'><input id="all_boardlist_check" onclick="if (this.checked) all_boardlist_checked(true); else all_boardlist_checked(false);" type="checkbox" /> 전체선택</label></div>
    <?php } ?>

    
    <section class="title02" style="display:none;">
        <!-- <h2>업소정보 - <span><?php echo html_escape(element(element('region', $view),config_item('region_category')));?></span></h2>
        <p>총 <span><?php echo (element('total_rows', element('main_data', element('list', $view)))+element('total_rows', element('data', element('list', $view)))) ?>개</span>의 업소가 있습니다.</p> -->
    </section>

    <?php /* ?>
    <section class="store_list">
        <?php
            $i = 0;
            $open = false;
            $cols = 2;

            if (element('list', element('main_data', element('list', $view)))) {
                foreach (element('list', element('main_data', element('list', $view))) as $result) {

                    if ($cols && $i % $cols === 0) {
                        echo '<ul>';
                        $open = true;
                    }
                    $marginright = (($i+1)% $cols === 0) ? 0 : 2;
                    ?>
                    <li>
                        <?php if (element('is_admin', $view)) { ?><input type="checkbox" name="chk_post_id[]" value="<?php echo element('post_id', $result); ?>" /><?php } ?>
                        <a href="<?php echo element('post_url', $result); ?>" title="<?php echo html_escape(element('title', $result)); ?>">
                            <figure>
                                <img src="<?php echo element('thumb_url', $result); ?>" alt="<?php echo html_escape(element('title', $result)); ?>" title="<?php echo html_escape(element('title', $result)); ?>"/>
                                
                                <figcaption>
                                    <h2 class="info_subject">[<?php echo html_escape(element('bca_value',element('category', $result))); ?>]<?php echo html_escape(element('title', $result)); ?>
                                        <?php if (element('post_comment_count', $result)) { ?><span style="font:normal 11px 'dotum';">[+<?php echo element('post_comment_count', $result); ?>]</span><?php } ?>

                                    </h2>

                                    <p class="sub_subject"><?php if(element('sub_subject',element('extravars', $result))) echo element('sub_subject',element('extravars', $result)); ?>

                                    </p>
                                    <span>
                                        <?php if (element('open_time',element('extravars', $result))) { 
                                         echo  element('open_time',element('extravars', $result));
                                     }
                                     ?>
                                    </span>
                             </figcaption>
                         </figure>


                     </a>
                 </li>
                 <?php
                 $i++;
                 if ($cols && $i > 0 && $i % $cols === 0 && $open) {
                    echo '</ul>';
                    $open = false;
                }
            }
            } else {
                echo '<div class="table-answer nopost">내용이 없습니다</div>';
            }
            if ($open) {
                echo '</ul>';
                $open = false;
        }?>
    </section>
    <?php */ ?>
    

    <section class="store_list02">
        <?php
        $i = 0;
        $open = false;
        $cols = element('gallery_cols', element('board', element('list', $view)));
        
        if (element('list', element('data', element('list', $view)))) {
            foreach (element('list', element('data', element('list', $view))) as $result) {
                if ($cols && $i % $cols === 0) {
                    echo '<ul>';
                    $open = true;
                }
                $marginright = (($i+1)% $cols === 0) ? 0 : 2;


                if($i ===1){
                    // echo '<section class="ad">
                    //         <h4>ad</h4>
                    //         '.banner("board_rolling_banner_1").'
                    //     </section>';
                
                    echo '
                            <ins class="adsbygoogle"
                                 style="display:block"
                                 data-ad-format="fluid"
                                 data-ad-layout-key="-6t+ed+2i-1n-4w"
                                 data-ad-client="ca-pub-7419726859237673"
                                 data-ad-slot="8140858172"></ins>
                            <script>
                                 (adsbygoogle = window.adsbygoogle || []).push({});
                            </script> 
                          ';
                }

               
        ?>
            <li class="gallery-box " style="width:<?php echo element('gallery_percent', element('board', element('list', $view))); ?>%;margin-right:<?php echo $marginright;?>%;">
                <?php if (element('is_admin', $view)) { ?><input type="checkbox" name="chk_post_id[]" value="<?php echo element('post_id', $result); ?>" /><?php } ?>

                <a href="<?php echo element('post_url', $result); ?>" title="<?php echo html_escape(element('title', $result)); ?>"><img src="<?php echo element('thumb_url', $result); ?>" alt="<?php echo html_escape(element('title', $result)); ?>" title="<?php echo html_escape(element('title', $result)); ?>" class=" img-responsive" style="width:100%;" />
                
                    <h2 ><?php echo element('bca_value',element('category', $result)) ? '['.html_escape(element('bca_value',element('category', $result))).']':''; ?><?php echo html_escape(element('title', $result)); ?><?php if (element('post_comment_count', $result)) { ?><span style="font:normal 11px 'dotum';">[+<?php echo element('post_comment_count', $result); ?>]</span><?php } ?></h2>
                
                    <div class="per90 pull-left text_box">
                        <p class="sub_subject"><?php if(element('sub_subject',element('extravars', $result))) echo element('sub_subject',element('extravars', $result)); ?>
                        </p>

                        <span>
                            <?php if (element('open_time',element('extravars', $result))) { 
                               echo  element('open_time',element('extravars', $result));
                            }
                            ?>
                            
                        </span>
                    </div>
                    <div class="per10 pull-left scrap_heart">
                        <?php 
                        if(element('is_scrap',$result)) echo '<i class="fa fa-heart" style="font-size:20px;"></i>';
                        else echo '<i class="fa fa-heart-o" style="font-size:20px"></i>';
                         ?>
                        
                    </div>
                </a>
            </li>

            <?php
            $i++;
        if ($cols && $i > 0 && $i % $cols === 0 && $open) {
                echo '</ul>';
                $open = false;
            }
        }
        } else {
            echo '<div class="table-answer nopost">내용이 없습니다</div>';     
        }
        if ($open) {
            echo '</ul>';
            $open = false;
        }?>
    </section>
    
    <?php echo form_close(); ?>
    <div class="border_button">
        <div class="pull-left mr10">
            <!-- <a href="<?php echo element('list_url', element('list', $view)); ?>" class="btn btn-default btn-sm">목록</a> -->
            <?php if (element('search_list_url', element('list', $view))) { ?>
                <a href="<?php echo element('list_url', element('list', $view)); ?>" class="btn btn-success btn-sm">전체목록</a>
            <?php } ?>
        </div>
        <?php if (element('is_admin', $view)) { ?>
            <div class="pull-right mr10">
                <a onClick="post_multi_action('multi_delete', '0', '선택하신 글들을 완전삭제하시겠습니까?');" class="btn btn-silver btn-sm">선택삭제</a>

                <!-- <button type="button" class="btn btn-default btn-sm admin-manage-list"><i class="fa fa-cog big-fa"></i>관리</button>
                <div class="btn-admin-manage-layer admin-manage-layer-list">
                    <?php if (element('is_admin', $view) === 'super') { ?>
                        <div class="item" onClick="document.location.href='<?php echo admin_url('board/boards/write/' . element('brd_id', element('board', element('list', $view)))); ?>';"><i class="fa fa-cog"></i> 게시판설정</div>
                        <div class="item" onClick="post_multi_copy('copy');"><i class="fa fa-files-o"></i> 복사하기</div>
                        <div class="item" onClick="post_multi_copy('move');"><i class="fa fa-arrow-right"></i> 이동하기</div>
                        <div class="item" onClick="post_multi_change_category();"><i class="fa fa-tags"></i> 카테고리변경</div>
                    <?php } ?>
                    <div class="item" onClick="post_multi_action('multi_delete', '0', '선택하신 글들을 완전삭제하시겠습니까?');"><i class="fa fa-trash-o"></i> 선택삭제하기</div>
                    <div class="item" onClick="post_multi_action('post_multi_secret', '0', '선택하신 글들을 비밀글을 해제하시겠습니까?');"><i class="fa fa-unlock"></i> 비밀글해제</div>
                    <div class="item" onClick="post_multi_action('post_multi_secret', '1', '선택하신 글들을 비밀글로 설정하시겠습니까?');"><i class="fa fa-lock"></i> 비밀글로</div>
                    <div class="item" onClick="post_multi_action('post_multi_notice', '0', '선택하신 글들을 공지를 내리시겠습니까?');"><i class="fa fa-bullhorn"></i> 공지내림</div>
                    <div class="item" onClick="post_multi_action('post_multi_notice', '1', '선택하신 글들을 공지로 등록 하시겠습니까?');"><i class="fa fa-bullhorn"></i> 공지올림</div>
                    <div class="item" onClick="post_multi_action('post_multi_blame_blind', '0', '선택하신 글들을 블라인드 해제 하시겠습니까?');"><i class="fa fa-exclamation-circle"></i> 블라인드해제</div>
                    <div class="item" onClick="post_multi_action('post_multi_blame_blind', '1', '선택하신 글들을 블라인드 처리 하시겠습니까?');"><i class="fa fa-exclamation-circle"></i> 블라인드처리</div>
                    <div class="item" onClick="post_multi_action('post_multi_trash', '', '선택하신 글들을 휴지통으로 이동하시겠습니까?');"><i class="fa fa-trash"></i> 휴지통으로</div>
                </div> -->
            </div>
        <?php } ?>
        <?php if (element('write_url', element('list', $view))) { ?>
            <div class="pull-left ml10">
                <a href="<?php echo element('write_url', element('list', $view)); ?>" class="btn btn-success btn-sm">글쓰기</a>
            </div>
        <?php } ?>
    </div>

    <nav><?php echo element('paging', element('list', $view)); ?></nav>

    <!-- 광고 배너 영역 -->
        <section class="ad" style="margin-bottom: 0;">
            <h4>ad</h4>
            <?php echo banner("board_default_banner_1") ?>
        </section>
    <!-- ===== -->
</div>

<?php echo element('footercontent', element('board', element('list', $view))); ?>

<?php
if (element('highlight_keyword', element('list', $view))) {
    $this->managelayout->add_js(base_url('assets/js/jquery.highlight.js')); ?>
<script type="text/javascript">
//<![CDATA[
$('#fboardlist').highlight([<?php echo element('highlight_keyword', element('list', $view));?>]);
//]]>
</script>
<?php } ?>

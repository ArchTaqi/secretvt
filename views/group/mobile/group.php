<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>




<?php echo element('headercontent', element('board', element('list', $view))); ?>

<div class="main_flex">
    <section class="post_list">
        <h2 class="hidden">관광 전체</h2>
        <div class="select_area_box title03">
            <select  onchange="location.href='<?php echo group_url('/g-a'); ?>?findex=<?php echo html_escape($this->input->get('findex')); ?>&category_id=' + this.value;">
                <option value="">지역 선택</option>
                <?php
                $category = element('category', element('board', element('list', $view)));
                function ca_select($p = '', $category = '', $category_id = '')
                {
                    $return = '';
                    if ($p && is_array($p)) {
                        foreach ($p as $result) {
                            $exp = explode('.', element('bca_key', $result));
                            $len = (element(1, $exp)) ? strlen(element(1, $exp)) : '0';
                            $space = str_repeat('-', $len);
                            $return .= '<option value="' . html_escape(element('bca_key', $result)) . '"';
                            if (element('bca_key', $result) === $category_id) {
                                $return .= 'selected="selected"';
                            }
                            $return .= '>' . $space . html_escape(element('bca_value', $result)) . '</option>';
                            $parent = element('bca_key', $result);
                            $return .= ca_select(element($parent, $category), $category, $category_id);
                        }
                    }
                    return $return;
                }

                echo ca_select(element(0, $category), $category, $this->input->get('category_id'));
                ?>
            </select>

            
            <?php if (element('write_url', element('list', $view))) { ?>
             
                <a href="<?php echo element('write_url', element('list', $view)); ?>" class="btn-sm bold"><h3>글쓰기</h3></a>
            
            <?php } ?>
   
        </div>
    <?php
    $attributes = array('name' => 'fboardlist', 'id' => 'fboardlist');
    echo form_open('', $attributes);
    ?>

    <?php if (element('is_admin', $view)) { ?>
        <div><label for="all_boardlist_check" class='label'><input id="all_boardlist_check" onclick="if (this.checked) all_boardlist_checked(true); else all_boardlist_checked(false);" type="checkbox" /> 전체선택</label></div>
    <?php } ?>



    
    

    
        <?php
        $i = 0;
        $open = false;
        $cols = element('gallery_cols', element('board', element('list', $view)));
        
        if (element('list', element('data', element('list', $view)))) {
            foreach (element('list', element('data', element('list', $view))) as $result) {
                if ($cols && $i % $cols === 0) {
                    echo '<ul class="gallery_list01">';
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
            <li class="list_li" style="width:<?php echo element('gallery_percent', element('board', element('list', $view))); ?>%;margin-right:<?php echo $marginright;?>%;">
                <?php if (element('is_admin', $view)) { ?><input type="checkbox" name="chk_post_id[]" value="<?php echo element('post_id', $result); ?>" /><?php } ?>

                <a href="<?php echo element('post_url', $result); ?>" title="<?php echo html_escape(element('title', $result)); ?>">
                    <div class="thum">
                        <img src="<?php echo element('thumb_url', $result); ?>" alt="<?php echo html_escape(element('title', $result)); ?>" title="<?php echo html_escape(element('title', $result)); ?>" class=" img-responsive" style="width:100%;" />
                    </div>
                    <div class="txt_box">
                        <h3 class="tit"><?php echo element('board_name',element('board_', $result)) ? '<span class="lab_box lab">'.html_escape(element('board_name',element('board_', $result))).'</span>':''; ?><?php echo element('bca_value',element('category', $result)) ? '<span class="lab_box lab">'.html_escape(element('bca_value',element('category', $result))).'</span>':''; ?><?php echo html_escape(element('title', $result)); ?></h3>
                        <p class="sub_tit"><?php if(element('sub_subject',element('extravars', $result))) echo element('sub_subject',element('extravars', $result)); ?>
                        </p>
                        <ul class="info_list01">

                                <li class="info_li nick"><?php echo element('display_name', $result); ?></li>
                                <li class="info_li"><?php echo element('display_datetime', $result); ?></li>
                                <li class="info_li"><?php if (element('post_comment_count', $result)) { echo '댓글 : '.element('post_comment_count', $result);  } ?></li>
                        </ul>
                        <ul class="info_list02">
                            <li class="info_li">
                                <i class="fa fa-eye"></i><span class="hidden">조회수</span><?php echo element('post_hit', $result); ?>
                            </li>
                            <li class="info_li">
                                <i class="fa fa-heart-o"></i><span class="hidden">스크랩수</span><?php echo element('scrap_count', $result); ?>
                            </li>
                        </ul>
                            
                    </div>
                </a>
                <?php if ( ! element('post_del', $result) && element('use_scrap', element('board_', $result))) { 
                    if(element('scr_id',element('scrap', $result)))
                        echo '<button type="button" class="scrap_heart" onClick="javascript:post_scrap_cancel(\''.element('post_id', $result).'\', \''.element('scr_id',element('scrap', $result)).'\');" ><i class="fa fa-heart" ></i></button>';
                    else echo '<button type="button" class="scrap_heart" onClick="javascript:post_scrap(\''.element('post_id', $result).'\', \'post-scrap\');"><i class="fa fa-heart-o" ></i></button>';
                    
                 } ?>
                
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

                
            </div>
        <?php } ?>
        
    </div>

    <nav><?php echo element('paging', element('list', $view)); ?></nav>
    </section>

    <!-- 광고 배너 영역 -->
   
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
<script type="text/javascript">

</script>
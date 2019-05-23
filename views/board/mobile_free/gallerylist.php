<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<?php echo element('headercontent', element('board', element('list', $view))); ?>



<div class="main_flex">
<!-- secretvt 자유게시판란 광고 -->


<!-- secretvt 자유게시판란광고 -->
<ins class="adsbygoogle mt10"
     style="display:inline-block;width:100%;height:60px"
     data-ad-client="ca-pub-7419726859237673"
     data-ad-slot="3682862126"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
    <section class="title03 mt20">
        
        <h2 class="hidden"><?php echo element('brd_name', element('board', element('list', $view))) ?> <?php echo element('post_title', element('post_parent',$view)) ?>
        
        </h2>
        <p>총 <span><?php echo element('total_rows', element('data', element('list', $view))) ?>개</span>의 게시글이 있습니다.</p>
         <?php if (element('write_url', element('list', $view))) { ?>
        <a href="<?php echo element('write_url', element('list', $view)); ?>" class="btn-sm bold"><h3>글쓰기</h3></a>
        
    <?php } ?>
    </section>


    <section>
        


   
    <script>

        $(document).ready(function(){
        //제목/내용 선택하기
            var select = $("#sfield");
            select.change(function(){
            var select_name = $(this).children("option:selected").text();
            $(this).siblings("label").text(select_name);
             });
        // 검색영역 width 값 
             var devide_width =  $('.wrap05').width();

             var find_width = devide_width - 70 - 23 - 36
             $('.list .notice_find input').css('width', find_width);
        });

        $(document).ready(function(){
            $('.list ul li.gallery-box a p').each(function(){
                var length = 60;

                $(this).each(function(){
                    if($(this).text().length >= length){
                        $(this).text($(this).text().substr(0,length)+'...');
                    }
                });
            });
        });


        $(document).ready(function(){
            $('.find_list input[type="text"]').css('width' , $('.find_list').width() - 35)
        });
    </script>
    
    <!-- <div class="notice_find">
        <div class="choice">
            <label for="select">제목+내용</label>
            <select id="find">
                <option>제목+내용</option>
                <option>제 목</option>
                <option>내 용</option>
            </select>
        </div>
        <input type="text">

        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-search"></i></button>
    </div> -->
    <div class='text-center'>
    <form class="navbar-form navbar-right pull-right" style="display: inline-block; width: 100%;" action="<?php echo board_url(element('brd_key', element('board', element('list', $view)))); ?>" onSubmit="return postSearch(this);">
        <input type="hidden" name="findex" value="<?php echo html_escape($this->input->get('findex')); ?>" />
        <input type="hidden" name="category_id" value="<?php echo html_escape($this->input->get('category_id')); ?>" />
        <input type="hidden" name="sfield" id="sfield" value="post_title">
        
        <div class="find_list">
            <div class="form-group choice">
            </div>
            <input type="text" placeholder="Search" name="skeyword" value="<?php echo html_escape($this->input->get('skeyword')); ?>" />
             <button type="submit"><i class="fa fa-search"></i></button>
        </div>

    </form>
    </div>
    <?php
    if (element('use_category', element('board', element('list', $view))) && element('cat_display_style', element('board', element('list', $view))) === 'tab') {
        $category = element('category', element('board', element('list', $view)));
    ?>
        <ul >
            <li onClick="location.href='<?php echo board_url(element('brd_key', element('board', element('list', $view)))); ?>?findex=<?php echo html_escape($this->input->get('findex')); ?>&category_id='" role="presentation" <?php if ( ! $this->input->get('category_id')) { ?>class="active" <?php } ?>>전체</li>
            <?php
            if (element(0, $category)) {
                foreach (element(0, $category) as $ckey => $cval) {
            ?>
                <li onClick="location.href='<?php echo board_url(element('brd_key', element('board', element('list', $view)))); ?>?findex=<?php echo html_escape($this->input->get('findex')); ?>&category_id=<?php echo element('bca_key', $cval); ?>'" role="presentation" <?php if ($this->input->get('category_id') === element('bca_key', $cval)) { ?>class="active" <?php } ?>><?php echo html_escape(element('bca_value', $cval)); ?></li>
            <?php
                }
            }
            ?>
        </ul>
    <?php } ?>
    
    <?php
    $attributes = array('name' => 'fboardlist', 'id' => 'fboardlist');
    echo form_open('', $attributes);
    ?>
    
    <?php if (element('is_admin', $view)) { ?>
        <div><label for="all_boardlist_check" class='label'><input id="all_boardlist_check" onclick="if (this.checked) all_boardlist_checked(true); else all_boardlist_checked(false);" type="checkbox" /> 전체선택</label></div>
    <?php } ?>

    <div>
    <?php
    $i = 0;
    $open = false;
    $cols = element('gallery_cols', element('board', element('list', $view)));
    if (element('list', element('data', element('list', $view)))) {
        foreach (element('list', element('data', element('list', $view))) as $result) {
            
            if ($cols && $i % $cols === 0) {
                echo '<ul class="txt_list">';
                $open = true;
            }
            $marginright = (($i+1)% $cols === 0) ? 0 : 2;
            
    ?>

        <li>
            <?php if (element('is_admin', $view)) { ?><input type="checkbox" name="chk_post_id[]" value="<?php echo element('post_id', $result); ?>" /><?php } ?>
            <a href="<?php echo element('post_url', $result); ?>" title="<?php echo html_escape(element('title', $result)); ?>">
           
                <!-- <?php if (element('category', $result)) { ?><span class="label label-default">[<?php echo html_escape(element('bca_value', element('category', $result))); ?>]</span><?php } ?> -->
                <?php 
                if(element('thumb_url', $result))
                    echo '<div class="thum_box">
                    <img src="'.element('thumb_url', $result).'" alt="'.html_escape(element('title', $result)).'">
                    </div>';
                 ?>
                <h2>
                    <?php if(!empty(element('post_secret', $result))) echo '<i class="fa fa-lock"></i>'; ?><?php if (element('is_hot', $result)) { ?><b class="lab_hot">HOT</b><?php } ?><?php echo html_escape(element('title', $result));?> </h2>
                    <div class="content_txt"><p><?php if(empty(element('post_secret', $result))) echo (element('content', $result)); ?></p></div>
            </a>
                <span>
                    <?php echo element('display_name', $result); ?> <strong style="color:#dfe1ee">|</strong> <?php echo element('display_datetime', $result); ?> <strong style="color:#dfe1ee">|</strong> <i class="fa fa-eye"></i> <?php echo hit_format(element('post_hit', $result)); ?> <strong style="color:#dfe1ee">|</strong> <i class="fa fa-comments"></i> <?php echo element('post_comment_count', $result); ?>
                </span>
            
            </li>
        <?php
                $i++;
                if ($cols && $i > 0 && $i % $cols === 0 && $open) {
                    echo '</ul>';
                    $open = false;
                }
            }
        }else {

            echo '<div class="table-answer nopost text-center">내용이 없습니다</div>';     
        }
        if ($open) {
            echo '</ul>';
            $open = false;
        }
        ?>
        </div>
   
    

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
                <a onClick="post_multi_action('multi_delete', '0', '선택하신 글들을 완전삭제하시겠습니까?');" class="btn btn-danger btn-sm">선택삭제</a>

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
    
    </div>

    
    <nav><?php echo element('paging', element('list', $view)); ?></nav>
  
</div>

<?php echo element('footercontent', element('board', element('list', $view))); ?>


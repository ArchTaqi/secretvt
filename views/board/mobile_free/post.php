<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>
<?php    $this->managelayout->add_js(base_url('plugin/zeroclipboard/ZeroClipboard.js')); ?>

<?php 


if (element('syntax_highlighter', element('board', $view)) OR element('comment_syntax_highlighter', element('board', $view))) {
    $this->managelayout->add_css(base_url('assets/js/syntaxhighlighter/styles/shCore.css'));
    $this->managelayout->add_css(base_url('assets/js/syntaxhighlighter/styles/shThemeMidnight.css'));
    $this->managelayout->add_js(base_url('assets/js/syntaxhighlighter/scripts/shCore.js'));
    $this->managelayout->add_js(base_url('assets/js/syntaxhighlighter/scripts/shBrushJScript.js'));
    $this->managelayout->add_js(base_url('assets/js/syntaxhighlighter/scripts/shBrushPhp.js'));
    $this->managelayout->add_js(base_url('assets/js/syntaxhighlighter/scripts/shBrushCss.js'));
    $this->managelayout->add_js(base_url('assets/js/syntaxhighlighter/scripts/shBrushXml.js'));
?>
    <script type="text/javascript">
    SyntaxHighlighter.config.clipboardSwf = '<?php echo base_url('assets/js/syntaxhighlighter/scripts/clipboard.swf'); ?>';
    var is_SyntaxHighlighter = true;
    SyntaxHighlighter.all();
    </script>
<?php } ?>

<?php echo element('headercontent', element('board', $view)); ?>

<div class="main_flex">
    <?php echo show_alert_message($this->session->flashdata('message'), '<div class="alert alert-auto-close alert-dismissible alert-info">', '</div>'); ?>
   <!--  <h3>
        <?php if (element('category', element('post', $view))) { ?>[<?php echo html_escape(element('bca_value', element('category', element('post', $view)))); ?>] <?php } ?>
        <?php echo html_escape(element('post_title', element('post', $view))); ?>
    </h3> -->
    

    <?php 
    $tel1='';
    if (element('extra_content', $view)) {
                foreach (element('extra_content', $view) as $key => $value) { 
                        if($value['field_name'] == 'tel1') $tel1=$value['output'];
                        
                } 
              
    }
    ?>
    <div class="de_title">
        

        <div class="cont_tit">
            <div class="lab_box">
                <!-- <span class="lab"><?php echo element('board_name', element('board', $view)) ?></span> -->
                <?php if (element('category', element('post', $view))) { echo '<span class="lab">'.html_escape(element('bca_value', element('category', element('post', $view)))).'</span>';  } ?>
            </div>
            <h3 class="tit"><?php echo html_escape(element('post_title', element('post', $view))); ?></h3>
            
    
        
        <?php if ( ! element('post_del', element('post', $view)) && element('use_scrap', element('board', $view))) { 
            if(element('scr_id',element('scrap', element('post', $view))))
                echo '<button type="button" class="scrap_heart" onClick="javascript:post_scrap_cancel(\''.element('post_id', element('post', $view)).'\', \''.element('scr_id',element('scrap', element('post', $view))).'\');" ><i class="fa fa-heart" ></i><span class="num">'.element('scrap_count', element('post', $view)).'</span></button>';
            else echo '<button type="button" class="scrap_heart" onClick="javascript:post_scrap(\''.element('post_id', element('post', $view)).'\', \'post-scrap\');"><i class="fa fa-heart-o" ></i><span class="num">'.element('scrap_count', element('post', $view)).'</span></button>';
            
         } ?>
            <ul class="post_info">
                <li class="info_li">
                    <button class="btn_nick"><?php echo element('display_name', element('post', $view)) ?><!-- <img src="images/icon_mail_nick.svg" alt=""> --></button>
                    <!-- <ul class="click_nick" style="display: none;">
                        <li class=""><a href="">쪽지보내기</a></li>
                        <li class=""><a href="">친구등록</a></li>
                    </ul> -->
                </li>
                <li class="info_li"><?php echo element('display_datetime', element('post', $view)) ?></li>
                <li class="info_li">조회수: <?php echo element('post_hit', element('post', $view)) ?></li>
                <li class="info_li">댓글: <?php echo element('post_comment_count', element('post', $view));  ?></li>
            </ul>
        </div>
    </div>
    <section class="store">
        <div class="contents-view" style="margin-bottom: 0;">
            

            <!-- 본문 내용 시작 -->
            <div id="post-content"><?php echo element('content', element('post', $view)); ?></div>
            <!-- 본문 내용 끝 -->
        </div>
    </section>
    <!-- 광고 배너 영역 -->
    
    <!-- ===== -->
    <?php if ( ! element('post_del', element('post', $view)) && (element('use_post_like', element('board', $view)) OR element('use_post_dislike', element('board', $view)))) { ?>
        <div class="recommand">
            <?php if (element('use_post_like', element('board', $view))) { ?>
                <a class="good" href="javascript:;" id="btn-post-like" onClick="post_like('<?php echo element('post_id', element('post', $view)); ?>', '1', 'post-like');" title="추천하기"><span class="post-like"><?php echo number_format(element('post_like', element('post', $view))); ?></span><br /><i class="fa fa-thumbs-o-up fa-lg"></i></a>
            <?php } ?>
            <?php if (element('use_post_dislike', element('board', $view))) { ?>
                <a class="bad" href="javascript:;" id="btn-post-dislike" onClick="post_like('<?php echo element('post_id', element('post', $view)); ?>', '2', 'post-dislike');" title="비추하기"><span class="post-dislike"><?php echo number_format(element('post_dislike', element('post', $view))); ?></span><br /><i class="fa fa-thumbs-o-down fa-lg"></i></a>
            <?php } ?>
        </div>
    <?php } ?>



    <?php
    if (element('use_sns_button', $view)) {
        $this->managelayout->add_js(base_url('assets/js/sns.js'));
        if ($this->cbconfig->item('kakao_apikey')) {
            $this->managelayout->add_js('https://developers.kakao.com/sdk/js/kakao.min.js');
    ?>
        <script type="text/javascript">Kakao.init('<?php echo $this->cbconfig->item('kakao_apikey'); ?>');</script>
    <?php } ?>
        <div class="sns_button">
            <a href="javascript:;" onClick="sendSns('facebook', '<?php echo element('short_url', $view); ?>', '<?php echo html_escape(element('post_title', element('post', $view)));?>');" title="이 글을 페이스북으로 퍼가기"><img src="<?php echo element('view_skin_url', $layout); ?>/images/social_facebook.png" width="22" height="22" alt="이 글을 페이스북으로 퍼가기" title="이 글을 페이스북으로 퍼가기" /></a>
            <a href="javascript:;" onClick="sendSns('twitter', '<?php echo element('short_url', $view); ?>', '<?php echo html_escape(element('post_title', element('post', $view)));?>');" title="이 글을 트위터로 퍼가기"><img src="<?php echo element('view_skin_url', $layout); ?>/images/social_twitter.png" width="22" height="22" alt="이 글을 트위터로 퍼가기" title="이 글을 트위터로 퍼가기" /></a>
            <?php if ($this->cbconfig->item('kakao_apikey')) { ?>
                <a href="javascript:;" onClick="kakaolink_send('<?php echo html_escape(element('post_title', element('post', $view)));?>', '<?php echo element('short_url', $view); ?>');" title="이 글을 카카오톡으로 퍼가기"><img src="<?php echo element('view_skin_url', $layout); ?>/images/social_kakaotalk.png" width="22" height="22" alt="이 글을 카카오톡으로 퍼가기" title="이 글을 카카오톡으로 퍼가기" /></a>
            <?php } ?>
            <a href="javascript:;" onClick="sendSns('kakaostory', '<?php echo element('short_url', $view); ?>', '<?php echo html_escape(element('post_title', element('post', $view)));?>');" title="이 글을 카카오스토리로 퍼가기"><img src="<?php echo element('view_skin_url', $layout); ?>/images/social_kakaostory.png" width="22" height="22" alt="이 글을 카카오스토리로 퍼가기" title="이 글을 카카오스토리로 퍼가기" /></a>
            <a href="javascript:;" onClick="sendSns('band', '<?php echo element('short_url', $view); ?>', '<?php echo html_escape(element('post_title', element('post', $view)));?>');" title="이 글을 밴드로 퍼가기"><img src="<?php echo element('view_skin_url', $layout); ?>/images/social_band.png" width="22" height="22" alt="이 글을 밴드로 퍼가기" title="이 글을 밴드로 퍼가기" /></a>
        </div>
    <?php } ?>

    <div class="clearfix"></div>

   
    <section class="cont_tab">
        <div class="btn-group pull-left" role="group" aria-label="...">
            
                <a href="<?php echo element('list_url', $view); ?>" class="btn btn-info btn-sm">목 록</a>
            <?php if (element('search_list_url', $view)) { ?>
                    <a href="<?php echo element('search_list_url', $view); ?>" class="btn btn-info btn-sm">검색목록</a>
            <?php } ?>
            <?php if (element('prev_post', $view)) { ?>
                <a href="<?php echo element('url', element('prev_post', $view)); ?>" class="btn btn-success btn-sm">◀이전 글</a>
            <?php } ?>
            <?php if (element('next_post', $view)) { ?>
                <a href="<?php echo element('url', element('next_post', $view)); ?>" class="btn btn-success btn-sm">다음 글▶</a>
            <?php } ?>
        </div>
        <?php if (element('write_url', $view)) { ?>
            <div class="pull-right">
            <?php    if (element('delete_url', $view)) { ?>
                <a href="<?php echo element('delete_url', $view); ?>" class="btn btn-silver btn-sm btn-one-delete">삭제</a>
            <?php } ?>
                <?php if (element('modify_url', $view)) { ?>
                <a href="<?php echo element('modify_url', $view); ?>" class="btn btn-info btn-sm">수정</a>
            <?php } ?>
                
            </div>
        <?php } ?>
    </section>

    <?php
    

    if ( ! element('post_hide_comment', element('post', $view))) { ?>
        <section class="reply_write">
            <h2 class="reply_num">댓글 <span class="num"><?php echo element('post_comment_count', element('post', $view));  ?></span></h2>
            <?php   $this->load->view(element('view_skin_path', $layout) . '/comment_write'); ?>
            <section id="viewcomment" class="mb0" style="display:block"></section>
        </section>
        
    <?php
    }

    ?>
   
</div>

<?php echo element('footercontent', element('board', $view)); ?>

<?php if (element('target_blank', element('board', $view))) { ?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
    $("#post-content a[href^='http']").attr('target', '_blank');
});
//]]>
</script>
<?php } ?>

<script type="text/javascript">
//<![CDATA[

  
var client = new ZeroClipboard($('.copy_post_url'));
client.on('ready', function( readyEvent ) {
    client.on('aftercopy', function( event ) {
        alert('게시글 주소가 복사되었습니다. \'Ctrl+V\'를 눌러 붙여넣기 해주세요.');
    });
});
//]]>
</script>
<?php
if (element('highlight_keyword', $view)) {
    $this->managelayout->add_js(base_url('assets/js/jquery.highlight.js')); ?>
<script type="text/javascript">
//<![CDATA[
$('#post-content').highlight([<?php echo element('highlight_keyword', $view);?>]);
//]]>
</script>
<?php } ?>

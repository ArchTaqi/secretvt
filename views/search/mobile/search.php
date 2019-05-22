<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>


<div class="main_flex">
    <form action="<?php echo current_url(); ?>" onSubmit="return checkSearch(this);" class=" search_box text-center">
        
        <div class="group">
            <select class="input per100" name="sfield">
                <option value="post_both" <?php echo $this->input->get('sfield') === 'post_both' ? 'selected="selected"' : ''; ?>>제목+내용</option>
                <option value="post_title" <?php echo $this->input->get('sfield') === 'post_title' ? 'selected="selected"' : ''; ?>>제목</option>
                <option value="post_content" <?php echo $this->input->get('sfield') === 'post_content' ? 'selected="selected"' : ''; ?>>내용</option>
            </select>
        </div>
        <div class="group inp_txt_box">
            <input type="text" class="input per100" name="skeyword" placeholder="검색어" value="<?php echo html_escape($this->input->get('skeyword')); ?>" />
        </div>
        <div class="group">
            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> 검색</button>
        </div>
        
    </form>
    <?php if($this->input->get('skeyword')){?>
    <h3 class="search_result"><?php echo '검색결과 : ' . html_escape($this->input->get('skeyword')) ?></h3>
    <?php } ?>
</div>

<div class="media-box mt20 searchresult" id="searchresult">
<?php
if (element('list', element('data', $view))) {
    foreach (element('list', element('data', $view)) as $result) {
?>
    <div class="media">
<?php
        if (element('thumb_url', $result)) {
?>
        <div class="media-left">
            <a href="<?php echo element('post_url', $result); ?>" title="<?php echo html_escape(element('post_title', $result)); ?>">
                <img class="media-object" src="<?php echo element('thumb_url', $result); ?>" alt="<?php echo html_escape(element('post_title', $result)); ?>" title="<?php echo html_escape(element('post_title', $result)); ?>" style="width:100px;height:80px;" />
            </a>
        </div>
<?php
        }
?>
        <div class="media-body">
            <h4 class="media-heading"><a href="<?php echo element('post_url', $result); ?>" title="<?php echo html_escape(element('post_title', $result)); ?>"><?php echo html_escape(element('post_title', $result)); ?></a>
                <?php if (element('post_comment_count', $result)) { ?><span class="label">+<?php echo element('post_comment_count', $result); ?></span><?php } ?>
            </h4>
            <div class="media-comment">
            </div>
            <p style="line-height:1.4;"><?php echo element('content', $result); ?></p>
            <p class="media-info">
                <span><?php echo element('display_name', $result); ?></span>
                <span><i class="fa fa-clock-o"></i> <?php echo element('display_datetime', $result); ?></span>
            </p>
        </div>
    </div>
<?php
    }
}
if ( ! element('list', element('data', $view))) {
?>
    <div class="media">
        <div class="media-body nopost">
            검색 결과가 없습니다
        </div>
    </div>
<?php
}
?>
</div>
<nav><?php echo element('paging', $view); ?></nav>

<script type="text/javascript">
//<![CDATA[
function checkSearch(f) {
    var skeyword = f.skeyword.value.replace(/(^\s*)|(\s*$)/g,'');
    if (skeyword.length < 2) {
        alert('2글자 이상으로 검색해 주세요');
        f.skeyword.focus();
        return false;
    }
    return true;
}
//]]>
</script>
<?php if (element('highlight_keyword', $view)) {
    $this->managelayout->add_js(base_url('assets/js/jquery.highlight.js')); ?>
<script type="text/javascript">
//<![CDATA[
$('#searchresult').highlight([<?php echo element('highlight_keyword', $view);?>]);
//]]>
</script>
<?php } ?>

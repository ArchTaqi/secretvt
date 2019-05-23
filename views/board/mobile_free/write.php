<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>
<?php echo element('headercontent', element('board', $view)); ?>

<div class="main_flex">
    <div class="wrap09 board" style="padding-top:0px">
        <section class="write_post">
            <h2 class="title04"><b class="cate"><?php echo html_escape(element('bgr_name', element('group', $view))); ?></b> 글쓰기</h2>
    <?php
    echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
    echo show_alert_message(element('message', $view), '<div class="alert alert-auto-close alert-dismissible alert-info"><button type="button" class="close alertclose" >&times;</button>', '</div>');
    $attributes = array('class' => 'form-horizontal', 'name' => 'fwrite', 'id' => 'fwrite', 'onsubmit' => 'return submitContents(this)');
    echo form_open_multipart(current_full_url(), $attributes);
    ?>
        <input type="hidden" name="<?php echo element('primary_key', $view); ?>"    value="<?php echo element(element('primary_key', $view), element('post', $view)); ?>" />
        <div class="write_top">
        <?php if (element('is_post_name', element('post', $view))) { ?>
            <li>
                <span>이름</span>
                <input type="text" class="input per95" name="post_nickname" id="post_nickname" value="<?php echo set_value('post_nickname', element('post_nickname', element('post', $view))); ?>" />
            </li>
            <?php if ($this->member->is_member() === false) { ?>
                <li>
                    <span>비밀번호</span>
                    <input type="password" class="input per95" name="post_password" id="post_password" />
                </li>
            <?php } ?>
            <li>
                <span>이메일</span>
                <input type="text" class="input per95" name="post_email" id="post_email" value="<?php echo set_value('post_email', element('post_email', element('post', $view))); ?>" />
            </li>
            <li>
                <span>홈페이지</span>
                <input type="text" class="input per95" name="post_homepage" id="post_homepage" value="<?php echo set_value('post_homepage', element('post_homepage', element('post', $view))); ?>" />
            </li>
        <?php } ?>

            <?php if(element('board_list',$view)){ ?>
            <select name="brd_id" id="brd_id" class="select_cate">
                <?php 
                foreach(element('board_list',$view) as $key => $value){ 
                    $selected = element('brd_id', element('board', $view)) == $key ? 'selected="selected"':'';
                    echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
                
                 } 
                 ?>
            </select>
            <?php } ?>
            <?php if (element('use_category', element('board', $view))) { ?>
            <select name="post_category" class=" select_area">
                <option value="">지역을 선택해주세요</option>
                <?php
                $category = element('category', $view);
                function ca_select($p = '', $category = '', $post_category = '')
                {
                    $return = '';
                    if ($p && is_array($p)) {
                        foreach ($p as $result) {
                            $exp = explode('.', element('bca_key', $result));
                            $len = (element(1, $exp)) ? strlen(element(1, $exp)) : '0';
                            $space = str_repeat('-', $len);
                            $return .= '<option value="' . html_escape(element('bca_key', $result)) . '"';
                            if (element('bca_key', $result) === $post_category) {
                                $return .= 'selected="selected"';
                            }
                            $return .= '>' . $space . html_escape(element('bca_value', $result)) . '</option>';
                            $parent = element('bca_key', $result);
                            $return .= ca_select(element($parent, $category), $category, $post_category);
                        }
                    }
                    return $return;
                }

                echo ca_select(element(0, $category), $category, element('post_category', element('post', $view)));
                ?>
            </select>
            
            <?php } ?>
            <div class="write_tit">
                <label for="" class="hidden">제목</label>
                <input type="text" class="" name="post_title" id="post_title" value="<?php echo set_value('post_title', element('post_title', element('post', $view))); ?>" placeholder="제목을 입력하세요" />
            </div>
        </div>
        
        <?php if (element('can_post_notice', element('post', $view)) OR element('can_post_secret', element('post', $view)) OR element('can_post_receive_email', element('post', $view))) { ?>
            <div>
                <span>옵션</span>
                <?php if (element('can_post_notice', element('post', $view))) { ?>
                    <label class="checkbox-inline" for="post_notice_1">
                        <input type="checkbox" name="post_notice" id="post_notice_1" value="1" <?php echo set_checkbox('post_notice', '1', (element('post_notice', element('post', $view)) === '1' ? true : false)); ?> onChange="if (this.checked) {$('#post_notice_2').prop('disabled', true);} else {$('#post_notice_2').prop('disabled', false);}" <?php if (element('post_notice', element('post', $view)) === '2')echo "disabled='disabled'"; ?> /> 공지
                    </label>
                    <label class="checkbox-inline" for="post_notice_2">
                        <input type="checkbox" name="post_notice" id="post_notice_2" value="2" <?php echo set_checkbox('post_notice', '2', (element('post_notice', element('post', $view)) === '2' ? true : false)); ?> onChange="if (this.checked) {$('#post_notice_1').prop('disabled', true);} else {$('#post_notice_1').prop('disabled', false);}" <?php if (element('post_notice', element('post', $view)) === '1')echo "disabled='disabled'"; ?> /> 전체공지
                    </label>
                    <label class="checkbox-inline" for="post_main_4">
                        <input type="checkbox" name="post_main_4" id="post_main_4" value="1" <?php echo set_checkbox('post_main_4', '1', (element('post_main_4', element('post', $view)) ? true : false)); ?> /> 메인 4 슬롯
                    </label>
                <?php } ?>
                <?php if (element('can_post_secret', element('post', $view))) { ?>
                    <label class="checkbox-inline" for="post_secret">
                        <input type="checkbox" name="post_secret" id="post_secret" value="1" <?php echo set_checkbox('post_secret', '1', (element('post_secret', element('post', $view)) ? true : false)); ?> /> 비밀글
                    </label>
                <?php } ?>
                <?php if (element('can_post_receive_email', element('post', $view))) { ?>
                    <label class="checkbox-inline" for="post_receive_email">
                        <input type="checkbox" name="post_receive_email" id="post_receive_email" value="1" <?php echo set_checkbox('post_receive_email', '1', (element('post_receive_email', element('post', $view)) ? true : false)); ?> /> 답변메일받기
                    </label>
                <?php } ?>
            </div>
        <?php } ?>
        <!-- <li>
            <span>슬롯 정렬</span>
            <div class="group">
            <input type="number" class="input px70" name="post_order" id="post_order" value="<?php echo set_value('post_order', element('post_order', element('post', $view))+ 0); ?>" />
            </div>
        </li> -->
        
        
        <?php
        if (element('extra_content', $view)) {
            foreach (element('extra_content', $view) as $key => $value) {

        ?>
            <div>
                <span><?php echo element('display_name', $value); ?></span>
                <div class="group">
                <?php if(element('field_name', $value)=="google_map") {?>
                    <button type="button" class="btn btn-sm btn-default pull-right mr10" id="btn_google_map" onClick="open_google_map();" >지도검색</button>
                <?php } ?>
                <?php echo element('input', $value); ?>
                </div>
            </div>
        <?php
            }
        }
        ?>
       

        <?php if ( ! element('use_dhtml', element('board', $view)) AND (element('post_min_length', element('board', $view)) OR element('post_max_length', element('board', $view)))) { ?>
            <div class="well well-sm" style="margin-bottom:15px;">
                현재 <strong><span id="char_count">0</span></strong> 글자이며,
                <?php if (element('post_min_length', element('board', $view))) { ?>
                    최소 <strong><?php echo number_format(element('post_min_length', element('board', $view))); ?></strong> 글자 이상
                <?php } if (element('post_max_length', element('board', $view))) { ?>
                    최대 <strong><?php echo number_format(element('post_max_length', element('board', $view))); ?></strong> 글자 이하
                <?php } ?>
                입력하실 수 있습니다.
            </div>
        <?php } ?>
        <?php 
        $form_group_style="";
        // if($this->cbconfig->get_device_type()!=='mobile' && element('use_dhtml', element('board', $view))) $form_group_style="style='width:740px;'";
         ?>
        <div class="write_txt"> 
            <div class="form-group mb3per" <?php echo $form_group_style ?>>
                <?php if ( ! element('use_dhtml', element('board', $view))) { ?>
                    <div class="btn-group pull-right mb10">
                        <button type="button" class="btn btn-default btn-sm" onClick="resize_textarea('post_content', 'down');"><i class="fa fa-plus fa-lg"></i></button>
                        <button type="button" class="btn btn-default btn-sm" onClick="resize_textarea('post_content', 'up');"><i class="fa fa-minus fa-lg"></i></button>
                    </div>
                <?php } ?>

                <?php echo display_dhtml_editor('post_content', set_value('post_content', element('post_content', element('post', $view))), $classname = 'dhtmleditor', $is_dhtml_editor = element('use_dhtml', element('board', $view)), $editor_type = $this->cbconfig->item('post_editor_type')); ?>
            </div>
            <p class="noti">
                [이미지 업로드] 최대 <?php echo element('upload_file_count', element('board', $view)) ?>개까지 가능합니다<br>
                [이미지 SIZE] 파일당 최대 <?php echo element('upload_file_max_size', element('board', $view)) ?>MB 까지 가능합니다<br>
                통신환경에 따라 고용량 업로드는 실패할 수 있습니다.
            </p>
        </div>
        <div class="pr3per pl3per">
            <div class="filebox bs3-primary preview-image pr mb20">
        <?php
        if (element('link_count', element('board', $view)) > 0) {
            $link_count = element('link_count', element('board', $view));
            for ($i = 0; $i < $link_count; $i++) {
                $link = html_escape(element('pln_url', element($i, element('link', $view))));
                $link_column = $link ? 'post_link_update[' . element('pln_id', element($i, element('link', $view))) . ']' : 'post_link[' . $i . ']';
        ?>
                <div class="write_upload" style="margin-bottom:1.5%; display: inline-block; width: 100%;">
                    <input type="text" class="upload-name text_title" name="<?php echo $link_column; ?>" value="<?php echo set_value($link_column, $link); ?>" />
                    <label class="label_title text_title">
                        링크 <?php echo $i+1; ?>
                        <!--1-->
                    </label>
                </div>
        <?php
            }
        }
        if (element('use_upload', element('board', $view))) {
            $file_count = element('upload_file_count', element('board', $view));
            for ($i = 0; $i < $file_count; $i++) {
                $download_link = html_escape(element('download_link', element($i, element('file', $view))));
                $file_column = $download_link ? 'post_file_update[' . element('pfi_id', element($i, element('file', $view))) . ']' : 'post_file[' . $i . ']';
                $del_column = $download_link ? 'post_file_del[' . element('pfi_id', element($i, element('file', $view))) . ']' : '';
        ?>
                <div class="write_upload" style="margin-bottom:1.5%; display: inline-block; width: 100%;">
                    <input type="file" class="upload-name text_title" name="<?php echo $file_column; ?>" />
                    <label class="label_title text_title">
                        파일 <?php echo $i+1; ?>
                        <!--1-->
                    </label>
                    
                </div>
                <?php if ($download_link) { ?>
                    <div style="margin-left:10px;">
                        <a href="<?php echo $download_link; ?>"><?php echo html_escape(element('pfi_originname', element($i, element('file', $view)))); ?></a>
                        <label for="<?php echo $del_column; ?>">
                            <input type="checkbox" name="<?php echo $del_column; ?>" id="<?php echo $del_column; ?>" value="1" <?php echo set_checkbox($del_column, '1'); ?> /> 삭제
                        </label>
                    </div>
                <?php } ?>
        <?php
            }
        }
        ?>
            </div>
        <?php if ($this->member->is_member() === false) { ?>
            <div class="well text-center mt3per">
                <?php if ($this->cbconfig->item('use_recaptcha')) { ?>
                    <div class="captcha" id="recaptcha"><button type="button" id="captcha"></button></div>
                    <input type="hidden" name="recaptcha" />
                <?php } else { ?>
                    <img src="<?php echo base_url('assets/images/preload.png'); ?>" width="160" height="40" id="captcha" alt="captcha" title="captcha" />
                    <input type="text" class="input col-md-4" id="captcha_key" name="captcha_key" />
                    자동등록방지 숫자를 순서대로 입력하세요.
                <?php } ?>
            </div>
        <?php } ?>
            <div class="write_clear table-bottom">
                <button type="button" class="btn-history-back">취소</button>
                <button type="submit" class="">작성완료</button>
            </div>
        </div>
    <?php echo form_close(); ?>
    </section>

    </div>

</div>

<?php echo element('footercontent', element('board', $view)); ?>


<script type="text/javascript">
// 글자수 제한
var char_min = parseInt(<?php echo element('post_min_length', element('board', $view)) + 0; ?>); // 최소
var char_max = parseInt(<?php echo element('post_max_length', element('board', $view)) + 0; ?>); // 최대

<?php if ( ! element('use_dhtml', element('board', $view)) AND (element('post_min_length', element('board', $view)) OR element('post_max_length', element('board', $view)))) { ?>

check_byte('post_content', 'char_count');
$(function() {
    $('#post_content').on('keyup', function() {
        check_byte('post_content', 'char_count');
    });
});
<?php } ?>
function submitContents(f) {
    if ($('#char_count')) {
        if (char_min > 0 || char_max > 0) {
            var cnt = parseInt(check_byte('post_content', 'char_count'));
            if (char_min > 0 && char_min > cnt) {
                alert('내용은 ' + char_min + '글자 이상 쓰셔야 합니다.');
                $('#post_content').focus();
                return false;
            } else if (char_max > 0 && char_max < cnt) {
                alert('내용은 ' + char_max + '글자 이하로 쓰셔야 합니다.');
                $('#post_content').focus();
                return false;
            }
        }
    }
    var title = '';
    var content = '';
    $.ajax({
        url: cb_url + '/postact/filter_spam_keyword',
        type: 'POST',
        data: {
            title: f.post_title.value,
            content: f.post_content.value,
            csrf_test_name : cb_csrf_hash
        },
        dataType: 'json',
        async: false,
        cache: false,
        success: function(data) {
            title = data.title;
            content = data.content;
        }
    });
    if (title) {
        alert('제목에 금지단어(\'' + title + '\')가 포함되어있습니다');
        f.post_title.focus();
        return false;
    }
    if (content) {
        alert('내용에 금지단어(\'' + content + '\')가 포함되어있습니다');
        f.post_content.focus();
        return false;
    }
}
</script>

<?php
if (element('is_post_name', element('post', $view))) {
    if ($this->cbconfig->item('use_recaptcha')) {
        $this->managelayout->add_js(base_url('assets/js/recaptcha.js'));
    } else {
        $this->managelayout->add_js(base_url('assets/js/captcha.js'));
    }
}
?>
<script type="text/javascript">
//<![CDATA[
$(function() {
    $('#fwrite').validate({
        rules: {
            // post_title: {required :true, minlength:2, maxlength:60},
            
            post_content : {<?php echo (element('use_dhtml', element('board', $view))) ? 'valid_' . $this->cbconfig->item('post_editor_type') : 'valid'; ?> : true }
<?php if (element('is_post_name', element('post', $view))) { ?>
            , post_nickname: {required :true, minlength:2, maxlength:20}
            , post_email: {required :true, email:true}
<?php } ?>
<?php if ($this->member->is_member() === false) { ?>
            , post_password: {required :true, minlength:4, maxlength:100}
<?php if ($this->cbconfig->item('use_recaptcha')) { ?>
            , recaptcha : {recaptchaKey:true}
<?php } else { ?>
            , captcha_key : {required: true, captchaKey:true}
<?php } ?>
<?php } ?>
<?php if (element('use_category', element('board', $view))) { ?>
            // , post_category : {required: true}
<?php } ?>
        },
        messages: {
            recaptcha: '',
            captcha_key: '자동등록방지용 코드가 올바르지 않습니다.'
        }
    });
});

<?php if (element('has_tempsave', $view)) { ?>get_tempsave(cb_board); <?php } ?>
<?php if ( ! element('post_id', element('post', $view))) { ?>window.onbeforeunload = function () { auto_tempsave(cb_board); } <?php } ?>
//]]>
</script>

<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<div class="main_flex">
    <div class="">
        <section class="write_post">
            <h2 class="title04">쪽지 보내기</h2>
            <?php
            echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
            echo show_alert_message(element('message', $view), '<div class="alert alert-auto-close alert-dismissible alert-info"><button type="button" class="close alertclose" >&times;</button>', '</div>');
            $attributes = array('class' => 'mt20', 'name' => 'fnote', 'id' => 'fnote');
            echo form_open(current_full_url(), $attributes);
            ?>
            <input type="hidden" name="userid" id="userid" value="<?php echo set_value('userid', element('userid', $view)); ?>"  />
                <div class="write_top">
                    <div class="write_nick">
                        <label for="usernick">받는이</label>
                        <input type="text" name="usernick" id="usernick" value="<?php echo set_value('userid', element('userid', $view)); ?>" disabled>
                    </div>
                </div>
                <div class="write_top mt10">
                    <div class="write_nick">
                        <label for="title">제 &nbsp;&nbsp;목</label>
                        <input type="text" name="title" id="title" value="<?php echo set_value('title', element('title', $view)); ?>" >
                    </div>
                </div>

                
                <div class="write_txt">
                    <?php echo display_dhtml_editor('content', set_value('content'), $classname = 'dhtmleditor', $is_dhtml_editor = element('use_dhtml', $view), $editor_type = $this->cbconfig->item('note_editor_type')); ?>
                </div>
                <div class="pr3per pl3per mt5per">
                    
                    <div class="write_clear table-bottom">
                        <button type="button" class="btn-history-back" style="font-weight: normal;">취 소</button>
                        <button type="submit">보내기</button>
                    </div>
                </div>
                
                
            <?php echo form_close(); ?>
        </section>
    </div>
</div>

<script type="text/javascript">
//<![CDATA[
$(function() {
    $('#fnote').validate({
        rules: {
            userid: {required :true, minlength:3 },
            title: {required :true},
            content : {<?php echo (element('use_dhtml', $view)) ? 'required_' . $this->cbconfig->item('note_editor_type') : 'required'; ?> : true }
        }
    });
});
//]]>
</script>

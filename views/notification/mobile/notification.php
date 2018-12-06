<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<div class="wrap05 ">
    <section class="title02">
        <h2>알&nbsp;&nbsp;림</h2>
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
                <td >
                    <a href="<?php echo site_url('mypage/post'); ?>">작성글</a>
                </td>
                <td class="active">
                    <a href="<?php echo site_url('notification'); ?>">알&nbsp;&nbsp;림<span class="lab_notification badge notification_num"><?php echo number_format(element('notification_num', $layout) + 0); ?></span></a>
                </td> 
                <td>
                    <a href="<?php echo site_url('mypage/scrap'); ?>" title="나의 스크랩">스크랩</a>
                </td>
            </tr>
        </table>
    </section>

<div class="notification">
    <?php
    echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
    echo show_alert_message(element('alert_message', $view), '<div class="alert alert-auto-close alert-dismissible alert-info"><button type="button" class="close alertclose" >&times;</button>', '</div>');
    $attributes = array('class' => 'form-inline', 'name' => 'flist', 'id' => 'flist');
    echo form_open(current_full_url(), $attributes);
    ?>
        <ul class="table-top  pull-left">
            <li>
                <button type="button" class="btn btn-black btn-sm btn-list-delete btn-list-selected disabled" data-list-delete-url = "<?php echo element('list_delete_url', $view); ?>" >선택삭제</button>
            </li>
        </ul>
        
        <table class="table clearfix">
            <thead>
                <tr>
                    <th><input type="checkbox" name="chkall" id="chkall" /></th>
                    <th>번호</th>
                    <th>알림시간</th>
                    <th>알림내용</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if (element('list', element('data', $view))) {
                foreach (element('list', element('data', $view)) as $result) {
            ?>
                <tr>
                    <td class="text-center"><input type="checkbox" name="chk[]" class="list-chkbox" value="<?php echo element('not_id', $result); ?>" /></td>
                    <td class="text-center"><?php echo number_format(element('num', $result)); ?></td>
                    <td class="text-center"><?php echo display_datetime(element('not_datetime', $result), 'sns'); ?></td>
                    
                    <td><a href="<?php echo element('read_url', $result); ?>" <?php echo element('onClick', $result) ? 'onClick="' . element('onClick', $result) . '";' : ''; ?> class="noti_read <?php echo element('not_type', $result); ?>" data-not-id="<?php echo element('not_id', $result); ?>"><?php echo html_escape(element('not_message', $result)); ?></a></td>
                    
                </tr>
            <?php
                }
            }
            if ( ! element('list', element('data', $view))) {
            ?>
                <tr>
                    <td colspan="6" class="nopost">알림 내역이 없습니다</td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    <?php echo form_close(); ?>
    <nav><?php echo element('paging', $view); ?></nav>
</div>
<script type="text/javascript">
//<![CDATA[
$(document).on('click', '.noti_read.note', function() {
    $.ajax({
        url : cb_url + '/notification/readajax/' + $(this).attr('data-not-id'),
        type : 'get',
        dataType : 'json',
        success : function(data) {
            if (data.error) {
                alert(data.error);
                return false;
            } else if (data.success) {
                //alert(data.success);
            }

        }
    });
});
//]]>
</script>

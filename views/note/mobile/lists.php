<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>
<div class="main_flex">
    <div class="mt20 mypage">
        <section class="title02">
            <h2>쪽지함</h2>
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
                    <td>
                        <a href="<?php echo site_url('notification'); ?>">알&nbsp;&nbsp;림<span class="lab_notification badge notification_num"><?php echo number_format(element('notification_num', $layout) + 0); ?></span></a>
                    </td> 
                </tr>
                <tr>
                    <td>
                        <a href="<?php echo site_url('mypage/scrap'); ?>" title="스크랩">스크랩</a>
                    </td>
                    <td class="active">
                        <a href="<?php echo site_url('note/lists/recv'); ?>" title="쪽지함">쪽지함<span class="lab_notification"><?php echo number_format((int) $this->member->item('meta_unread_note_num')); ?></span></a>
                    </td>
                    <td>
                        <a href="<?php echo site_url('mypage/followinglist'); ?>" title="팔로우">팔로우</a>
                    </td>
                </tr>
            </table>
        </section>



    
    
    <section class="table_02">
        <?php echo show_alert_message($this->session->flashdata('message'), '<div class="alert alert-auto-close alert-dismissible alert-info">', '</div>'); ?>

        <div class="mypg_sub_cate">
            <ul class="cate_list">
                <li class="cate_li <?php echo element('type', $view) === 'recv' ? "active":""; ?>"><button type="button" class="btn" style="margin-bottom:0px" onClick="location.href='<?php echo site_url('note/lists/recv'); ?>';">받은쪽지함</button></li>
                <li class="cate_li <?php echo element('type', $view) === 'send' ? "active":""; ?>"><button type="button" style="margin-bottom:0px" onClick="location.href='<?php echo site_url('note/lists/send'); ?>';" class="btn">보낸쪽지함</button></li>
            </ul>
        </div>

      

        <table class="">
            <thead>
                <tr>
                    <th><?php echo element('type', $view) === 'recv' ? "보낸사람":"받은사람"; ?></th>
                    <th>제목</th>
                    <th>보낸시간</th>
                    <th>읽은시간</th>
                    <th>관리</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if (element('list', element('data', $view))) {
                foreach (element('list', element('data', $view)) as $result) {
            ?>
                <tr>
                    <td><?php echo element('display_name', $result); ?></td>
                    <td><a href="<?php echo site_url('note/view/' . element('type', $view) . '/' . element('nte_id', $result)); ?>"><?php echo html_escape(element('nte_title', $result)); ?></a></td>
                    <td><a href="<?php echo site_url('note/view/' . element('type', $view) . '/' . element('nte_id', $result)); ?>"><?php echo display_datetime(element('nte_datetime', $result), 'full'); ?></a></td>
                    <td><a href="<?php echo site_url('note/view/' . element('type', $view) . '/' . element('nte_id', $result)); ?>"><?php echo element('nte_read_datetime', $result) > '0000-00-00 00:00:00' ? display_datetime(element('nte_read_datetime', $result), 'full') : '<span style="color:#a94442;">아직 읽지 않음</span>'; ?></a></td>
                    <td><button class="btn-link btn-warning btn-one-delete" data-one-delete-url = "<?php echo element('delete_url', $result); ?>"><i class="fa fa-trash-o"></i></button></td>
                </tr>
            <?php
                }
            }
            if ( ! element('list', element('data', $view))) {
            ?>
                <tr>
                    <td colspan="5" class="nopost">쪽지가 없습니다</td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
            <nav><?php echo element('paging', $view); ?></nav>
        </section>
    </div>
</div>

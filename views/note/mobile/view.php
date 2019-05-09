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



    <section class="content message">
        <h2 class="hidden">쪽지</h2>
        <dl class="msg_top">
            <div class="tit_inner">
                <dt class="">받는이</dt>
                <dd class=""><?php echo element('display_name', element('data', $view)); ?></dd>
            </div>
            <div class="tit_inner">
                <dt class="">보낸시간</dt>
                <dd class=""><?php echo display_datetime(element('nte_datetime', element('data', $view)), 'full'); ?></dd>
            </div>
            <div class="tit_inner">
                <dt class="">제 목</dt>
                <dd class=""><?php echo html_escape(element('nte_title', element('data', $view))); ?></dd>
            </div>
        </dl>
        <div class="contents-view post-content">
            <?php echo element('content', element('data', $view)); ?>
        </div>
        <section class="cont_tab">
            <div class="btn-group pull-left">
                <a onClick="note_blame(<?php echo element('nte_id', element('data', $view)); ?>);" class="btn btn-info btn-sm">신고</a>
            </div>
            <div class="pull-right">
                <a href="<?php echo element('delete_url', $view); ?>" class="btn btn-silver">삭제</a>
                <button type="button" class="btn btn-success btn-sm" onClick="history.back();">이전페이지</button>
                <?php if (element('userid', element('data', $view))) { ?><a href="<?php echo site_url('note/write/' . html_escape(element('userid', element('data', $view)))); ?>" class="btn btn-danger btn-sm"><?php echo element('type', $view) === 'send' ? "쪽지쓰기":"답장"; ?></a><?php } ?>
                
            </div>
        </section>
    </section>
    
</div>

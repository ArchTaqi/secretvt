<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>
<div class="main_flex">
    <div class="mt20 mypage ">
        <section class="title02">
            <h2>Followed</h2>
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
                    <td>
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
                    <td>
                        <a href="<?php echo site_url('note/lists/recv'); ?>" title="쪽지함">쪽지함<span class="lab_notification"><?php echo number_format((int) $this->member->item('meta_unread_note_num')); ?></span></a>
                    </td>
                    <td class="active">
                        <a href="<?php echo site_url('mypage/followinglist'); ?>" title="팔로우">팔로우</a>
                    </td>
                </tr>
            </table>
        </section>
        
        <section class="table_02">
            <div class="mypg_sub_cate">
                <ul class="cate_list">
                    <li class="cate_li "><button type="button" class="btn" style="margin-bottom:0px" onClick="location.href='<?php echo site_url('mypage/followinglist'); ?>';">Following (<?php echo number_format(element('following_total_rows', $view)); ?>)</button></li>
                    <li class="cate_li active"><button type="button" style="margin-bottom:0px" onClick="location.href='<?php echo site_url('mypage/followedlist'); ?>';" class="btn">Followed (<?php echo number_format(element('followed_total_rows', $view)); ?>)</button></li>
                </ul>
            </div>   
            <table class="">
                <thead>
                    <tr>
                        <th><i class="fa fa-user"></i></th>
                        <th>회원명</th>
                        <th>Follow한날짜</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if (element('list', element('data', $view))) {
                    foreach (element('list', element('data', $view)) as $result) {
                ?>
                    <tr>
                        <td><i class="fa fa-user"></i></td>
                        <td><?php echo element('display_name', $result); ?></td>
                        <td><?php echo display_datetime(element('fol_datetime', $result), 'full'); ?></td>
                    </tr>
                <?php
                    }
                }
                if ( ! element('list', element('data', $view))) {
                ?>
                    <tr>
                        <td colspan="3" class="nopost">아직 나를 Follow 한 사람이 없습니다</td>
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



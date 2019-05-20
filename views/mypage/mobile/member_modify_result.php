<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<div class="mt20 mypage">
    <section class="title02">
        <h2>
            정보수정 완료
        </h2>
    </section>
    <section class="info_table">
        <table>
            <tr>
                <td class="active">
                    <a href="<?php echo site_url('mypage'); ?>">내 정보</a>
                </td>
                <td>
                    <a href="<?php echo site_url('mypage/post'); ?>">작성글</a>
                </td>
                <td>
                    <a href="<?php echo site_url('notification'); ?>">알&nbsp;&nbsp;림<span class="lab_notification badge notification_num"><?php echo number_format(element('notification_num', $layout) + 0); ?></span></a>
                </td> 
                <td>
                    <a href="<?php echo site_url('mypage/scrap'); ?>" title="나의 스크랩">스크랩</a>
                </td>
            </tr>
        </table>
    </section>

    <section class="info_logout">
        <figure>
            <img src="<?php echo base_url('/assets/images/temp/info_img/info_check.png')?>">
            <figcaption>
               <h2><?php echo element('result_message', $view); ?></h2>
            </figcaption>
        </figure>       
        <button>
            <a href="<?php echo site_url(); ?>" class="btn" title="<?php echo html_escape($this->cbconfig->item('site_title'));?>">홈페이지로 이동
            </a>
        </button>
    </section>

    <section class="ad" style="margin-bottom:0;">
        <h4>ad</h4>
        <?php echo banner("mypage_banner_1") ?>
    </section>
</div>

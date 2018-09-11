<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<div class="wrap05 mypage">
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
                    <a href="<?php echo site_url('mypage/scrap'); ?>" title="나의 스크랩">스크랩</a>
                </td>
            </tr>
        </table>
    </section>
    
    
    <section class="title02">
        <h2>관리자 회원</h2>
    </section>
    
     <section class="logout">
            <h2>
            <img src="<?php echo base_url('/assets/images/temp/stop.png') ?>" alt="stop">
            </h2>
            <div class="alert alert-dismissible alert-info infoalert">
        <span id="return_message">관리자회원정보는 관리자페이지에서만 수정이 가능합니다.</span>
    </div>
    </section>
    
</div>

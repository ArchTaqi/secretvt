<?php $this->managelayout->add_css(element('view_skin_url', $layout) . '/css/style.css'); ?>

<div class="wrap02">
    <?php
        echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
        echo show_alert_message(element('message', $view), '<div class="alert alert-auto-close alert-dismissible alert-info">', '</div>');
        echo show_alert_message($this->session->flashdata('message'), '<div class="alert alert-auto-close alert-dismissible alert-info">', '</div>');
        $attributes = array('class' => 'form-horizontal', 'name' => 'flogin', 'id' => 'flogin');
        echo form_open(current_full_url(), $attributes);
    ?>
    <input type="hidden" name="url" value="<?php echo html_escape($this->input->get_post('url')); ?>" />
    <section class="enter">
        <img src="<?php echo base_url('assets/images/temp/login_img/login_lock.png') ?>" alt="lock">
        <h2>
            알려드립니다.
            <span>해당기능을 이용하시려면 로그인이 필요합니다.</span> 
        </h2>

        <ul class="id_pw">
            <li>
               <h3><?php echo element('userid_label_text', $view);?></h3> 
               <input type="text" name="mem_userid" value="<?php echo set_value('mem_userid'); ?>" accesskey="L" />
            </li>

            <li>
               <h3>패스워드</h3> 
               <input type="password" name="mem_password" />
            </li>
        </ul>

        <p class="alert-dismissible alert-info autologinalert" style="display:none;">
            자동로그인 기능사용시  다음번 접속시 부터는 별도의 입력 없이 로그인 됩니다.
            단, 공공장소에서 이용 시 개인정보가 유출될 수 있으니 꼭 로그아웃을 해주세요.
        </p>

        <div class="login_re">
            <input type="checkbox" name="autologin" id="autologin" value="1" />
            <label for="autologin">
                 아이디 / 패스워드 기억하기
            </label>
        </div>

        <div class="login_btn">
            <div class="submit_btn"></div>
            <input type="submit" value="로 그 인">
        </div>
        <?php
        if ($this->cbconfig->item('use_sociallogin')) {
            $this->managelayout->add_js(base_url('assets/js/social_login.js'));
        ?>
            <div class="login_sns">
                <ul class="login_sns_ul">
                <?php if ($this->cbconfig->item('use_sociallogin_facebook')) {?>
                    <a href="javascript:;" onClick="social_connect_on('facebook');" title="페이스북 로그인"><img src="<?php echo base_url('assets/images/social_facebook.png'); ?>" width="22" height="22" alt="페이스북 로그인" title="페이스북 로그인" /></a>
                <?php } ?>
                <?php if ($this->cbconfig->item('use_sociallogin_twitter')) {?>
                    <a href="javascript:;" onClick="social_connect_on('twitter');" title="트위터 로그인"><img src="<?php echo base_url('assets/images/social_twitter.png'); ?>" width="22" height="22" alt="트위터 로그인" title="트위터 로그인" /></a>
                <?php } ?>
                
                <?php if ($this->cbconfig->item('use_sociallogin_naver')) {?>
                    <li class="btn_sns btn_login_naver">
                        <a href="javascript:;" onClick="social_connect_on('naver');" title="네이버 로그인">
                            <figure>
                                <img src="<?php echo base_url('assets/images/social_naver.png'); ?>" alt="naver" style="width:40px;">
                                <figcaption class="">
                                    네이버 로그인
                                </figcaption>
                            </figure>
                        </a>
                    </li>
                    
                <?php } ?>
                <?php if ($this->cbconfig->item('use_sociallogin_kakao')) {?>
                    <li class="btn_sns btn_login_kakao">
                         <a href="javascript:;" onClick="social_connect_on('kakao');" title="카카오 로그인">
                            <figure>
                                <img src="<?php echo base_url('assets/images/social_kakao.png'); ?>" alt="kakao" style="width:40px;">
                                <figcaption class="">
                                    카카오톡 로그인
                                </figcaption>
                            </figure>
                        </a>
                    </li>
                <?php } ?>
                <?php if ($this->cbconfig->item('use_sociallogin_google')) {?>
                    <li class="btn_sns btn_login_google">
                         <a href="javascript:;" onClick="social_connect_on('google');" title="구글 로그인">
                            <figure>
                                <img src="<?php echo base_url('assets/images/social_google.png'); ?>" alt="google" style="width:40px;">
                                <figcaption class="">
                                    Google 로그인
                                </figcaption>
                            </figure>
                        </a>
                    </li>
                <?php } ?>
                </ul>
            </div>
        <?php } ?>
        
                
          
                    
        <ul class="login_sign">
            <li>
                <a href="<?php echo site_url('register'); ?>"  title="회원가입">
                아직도 SecretPhilippines<br>회원이 아니세요 ?
                    <span>
                    회원가입
                    </span>
                </a>
            </li>

            <li style="border-right:0;">
                <a href="<?php echo site_url('findaccount'); ?>" title="아이디 패스워드 찾기">
                아이디&amp;패스워드를<br>잊어버리셨나요?
                    <span>
                    ID/PW 찾기
                    </span>
                </a>
            </li>
        </ul>
    </section>
    <section class="ad" style="margin-bottom:0;">
        <h4>ad</h4>
        <?php echo banner("login_banner_1") ?>
    </section>
</div>

<script type="text/javascript">
//<![CDATA[
$(function() {
    $('#flogin').validate({
        rules: {
            mem_userid : { required:true, minlength:3 },
            mem_password : { required:true, minlength:4 }
        }
    });
});
$(document).on('change', "input:checkbox[name='autologin']", function() {
    if (this.checked) {
        $('.autologinalert').show(300);
    } else {
        $('.autologinalert').hide(300);
    }
});
//]]>
</script>

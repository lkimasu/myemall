<?php
if (!defined("_GNUBOARD_")) {
    exit;
}
add_stylesheet('<link rel="stylesheet" href="' . BB_ASSETS_URL . '/css/skin/outlogin/outlogin-shop-side.css">', 120);

?>
<form name="foutlogin" action="<?php echo $outlogin_action_url ?>" onsubmit="return fhead_submit(this);" method="post" autocomplete="off">
    <div class="login-group bg-light p-3">
        <span class="visually-hidden">회원로그인</span>
        <input type="hidden" name="url" value="<?php echo $outlogin_url ?>">
        <div class="input-group mb-1">
            <label for="member_id" id="member_idlabel" class="visually-hidden">회원아이디<strong>필수</strong></label>
            <input type="text" id="member_id" name="mb_id" required maxlength="20" placeholder="아이디" class="form-control" aria-label="아이디 입력" aria-describedby="로그인 아이디 입력">
        </div>
        <div class="input-group">
            <label for="member_password" id="member_passwordlabel" class="visually-hidden">비밀번호<strong>필수</strong></label>
            <input type="password" name="mb_password" id="member_password" required maxlength="20" placeholder="비밀번호" class="form-control" autocomplete="off" aria-label="비밀번호 입력">
        </div>
        <div class="auto-login-wrap mt-1">
            <input class="form-check-input" name="auto_login" value="1" type="checkbox" value="" id="auto-login-side">
            <label class="form-check-label" for="auto_login" id="auto_login_label">자동로그인</label>
            <a href="<?php echo G5_BBS_URL ?>/password_lost.php"><i class="bi bi-person-fill-exclamation"></i> ID/PW 찾기</a>
        </div>
    </div>
    <div class="login-btn mt-2 text-end">
        <a href='<?php echo G5_BBS_URL ?>/register.php' class="btn btn-outline-secondary"><i class="bi bi-person-plus-fill"></i> 가입</a>
        <button type='submit' class="btn btn-outline-primary"><i class="bi bi-box-arrow-in-right"></i> 로그인</button>
    </div>
    <div class="sns-login mb-3">
        <?php
        // 소셜로그인 사용시 소셜로그인 버튼
        include get_social_skin_path() . '/social_login.skin.php';
        ?>
    </div>
</form>

<script>
    $omi = $('#ol_id');
    $omp = $('#ol_pw');
    $omi_label = $('#ol_idlabel');
    $omi_label.addClass('ol_idlabel');
    $omp_label = $('#ol_pwlabel');
    $omp_label.addClass('ol_pwlabel');

    $(function() {

        $("#auto-login-side").click(function() {
            if ($(this).is(":checked")) {
                if (!confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?"))
                    return false;
            }
        });
    });

    function fhead_submit(f) {
        return true;
    }
</script>
<!-- } 로그인 전 아웃로그인 끝 -->
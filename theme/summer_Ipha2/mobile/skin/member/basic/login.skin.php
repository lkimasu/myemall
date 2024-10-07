<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<div id="mb_login" class="mbskin">
    <h1><?php echo $g5['title'] ?></h1>
    <div class="login_inner">

	    <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
	    <input type="hidden" name="url" value="<?php echo $login_url ?>">
	
	    <div id="login_frm">
	        <label for="login_id" class="sound_only">아이디<strong class="sound_only"> 필수</strong></label>
	        <input type="text" name="mb_id" id="login_id" placeholder="아이디(필수)" required class="frm_input required" maxLength="20">
	        <label for="login_pw" class="sound_only">비밀번호<strong class="sound_only"> 필수</strong></label>
	        <input type="password" name="mb_password" id="login_pw" placeholder="비밀번호(필수)" required class="frm_input required" maxLength="20">
	        <input type="submit" value="로그인" class="btn_submit">
	        <div>
	            <input type="checkbox" name="auto_login" id="login_auto_login">
	            <label for="login_auto_login">자동로그인</label>
	        </div>
	    </div>
	
	    <section>
	        <div>
	            <a href="./register.php" class="btn01">회원 가입</a>
	        </div>
	    </section>
	
	    </form>
		<br>
	    <?php // 쇼핑몰 사용시 여기부터 ?>
	    <?php if ($default['de_level_sell'] == 1) { // 상품구입 권한 ?>
			
	        <!-- 주문하기, 신청하기 -->
	        <?php if (preg_match("/orderform.php/", $url)) { ?>
				
	    <section id="mb_login_notmb">
	
	        <textarea readonly style="width: 99%; height: 150px;">
[개인정보의 처리목적]

다음의 목적을 위하여 개인정보를 처리합니다. 
처리하고 있는 개인정보는 다음의 목적 이외의 용도로는 이용되지 않으며, 이용 목적이 변경되는 경우에는 개인정보 보호법 제18조에 따라 별도의 동의를 받는 등 필요한 조치를 이행할 예정입니다.
▶ 서비스 제공에 관한 계약 이행 및 서비스 제공에 따른 요금정산·콘텐츠 제공, 물품배송 또는 청구서 등 발송, 대금 결재, 요금추심

▶ 회원 관리

·회원제 서비스 이용에 따른 본인확인, 개인식별, 불량회원의 부정 이용 방지와 비인가 사용 방지, 가입 의사 확인, 가입 및 가입횟수 제한, 만14세 미만 아동 개인정보 수집 시 법정 대리인 동의여부 확인, 추후 법정 대리인 본인확인, 분쟁 조정을 위한 기록보존, 불만처리 등 민원처리, 고지사항 전달

▶ 마케팅 및 광고에 활용

·신규 서비스(제품) 개발 및 특화, 인구통계학적 특성에 따른 서비스 제공 및 광고 게재, 접속 빈도 파악, 회원의 서비스 이용에 대한 통계, 이벤트 등 광고성 정보 전달



[처리하는 개인정보 항목]

회사는 상품주문 및 배송 서비스 신청 등을 위해 아래와 같은 개인정보를 수집하고 있습니다.

▶ 주문하시는분 : 이름, 비밀번호, 전화번호, 핸드폰, 주소, 이메일

▶ 받으시는분 : 이름, 전화번호, 핸드폰, 주소, 이메일



또한 서비스 이용과정이나 사업 처리 과정에서 아래와 같은 정보들이 생성되어 수집될 수 있습니다.

▶ 서비스 이용기록, 접속 로그, 쿠키, 접속 IP 정보, 결제기록, 이용정지 기록



[개인정보의 처리 및 보유기간]

① 거창한무역 쇼핑몰은 법령에 따른 개인정보 보유/이용기간 또는 정보주체로부터 개인정보를 수집시에 동의받은 개인정보 보유/이용기간 내에서 개인정보를 처리/보유합니다.

② 각각의 개인정보 처리 및 보유 기간은 다음과 같습니다.



1. 홈페이지 회원 가입 및 관리 : 사업자/단체 홈페이지 탈퇴시까지

다만, 다음의 사유에 해당하는 경우에는 해당 사유 종료시까지

1) 관계 법령 위반에 따른 수사/조사 등이 진행중인 경우에는 해당 수사/조사 종료시까지

2) 홈페이지 이용에 따른 채권/채무관계 잔존시에는 해당 채권/채무관계 정산시까지

2. 재화 또는 서비스 제공 : 재화/서비스 공급완료 및 요금결제/정산 완료시까지



다만, 다음의 사유에 해당하는 경우에는 해당 기간 종료시까지



1) 「전자상거래 등에서의 소비자 보호에 관한 법률」에 따른 표시/광고, 계약내용 및 이행 등 거래에 관한 기록

- 표시/광고에 관한 기록 : 6월

- 계약 또는 청약철회, 대금결제, 재화 등의 공급기록 : 5년

- 소비자 불만 또는 분쟁처리에 관한 기록 : 3년



[개인정보 수집 동의 거부 권리]

거창한무역 쇼핑몰은 보다 원활한 서비스 제공을 위해 기본정보 이외의 추가정보(선택항목)를 수집하고 있습니다.



추가정보는 회원에게 보다 나은 서비스를 제공하기 위한 것으로, 회원이 원하지 않을 경우, 해당 정보는 수집하지 않으며, 이로 인해 이용 상의 어떤 불이익도 발행하지 않습니다.
			</textarea>
	
	        <label for="agree">개인정보수집에 대한 내용을 읽었으며 이에 동의합니다.</label>
	        <input type="checkbox" id="agree" value="1">
	
	        <div class="btn_confirm">
	            <a href="javascript:guest_submit(document.flogin);" class="btn02">비회원으로 구매하기</a>
	        </div>
	
	        <script>
	        function guest_submit(f)
	        {
	            if (document.getElementById('agree')) {
	                if (!document.getElementById('agree').checked) {
	                    alert("개인정보수집에 대한 내용을 읽고 이에 동의하셔야 합니다.");
	                    return;
	                }
	            }
	
	            f.url.value = "<?php echo $url; ?>";
	            f.action = "<?php echo $url; ?>";
	            f.submit();
	        }
	        </script>
	    </section>
	
	        <?php } else if (preg_match("/orderinquiry.php$/", $url)) { ?>
	
	    <fieldset id="mb_login_od">
	        <legend>비회원 주문조회</legend>
	
	        <form name="forderinquiry" method="post" action="<?php echo urldecode($url); ?>" autocomplete="off">
	
	        <label for="od_id" class="od_id sound_only">주문번호<strong class="sound_only"> 필수</strong></label>
	        <input type="text" name="od_id" value="<?php echo $od_id ?>" id="od_id" placeholder="주문번호" required class="frm_input required" size="20">
	        <label for="id_pwd" class="od_pwd sound_only">비밀번호<strong class="sound_only"> 필수</strong></label>
	        <input type="password" name="od_pwd" size="20" id="od_pwd" placeholder="비밀번호" required class="frm_input required">
	        <input type="submit" value="확인" class="btn_submit">
	
	        </form>
	    </fieldset>
	    <br>
	    <section id="mb_login_odinfo">
	        <h2>비회원 주문조회 안내</h2>
	        <p>메일로 발송해드린 주문서의 <strong>주문번호</strong> 및 주문 시 입력하신 <strong>비밀번호</strong>를 정확히 입력해주십시오.</p>
	    </section>
	
	        <?php } ?>
	
	    <?php } ?>
	    <?php // 쇼핑몰 사용시 여기까지 반드시 복사해 넣으세요 ?>
	
	    <div class="btn_confirm">
	        <a href="<?php echo G5_URL ?>/">메인으로 돌아가기</a>
	    </div>
	</div>
</div>

<script>
$(function(){
    $("#login_auto_login").click(function(){
        if (this.checked) {
            this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
        }
    });
});

function flogin_submit(f)
{
    return true;
}
</script>

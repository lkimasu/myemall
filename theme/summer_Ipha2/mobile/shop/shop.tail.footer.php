<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$admin = get_admin("super");

// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>

    </div><!-- container End -->

    <aside id="secondary" class="idx">
        <div class="idx-latest aside-div">
            <?php
            // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
            // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
            // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
            echo latest('theme/basic', 'notice', 5, 12);
            ?>
        </div>

        <div class="idx-shop-menu aside-div">
        	<div class="lt">
			    <h2 class="lt_title"><strong>쇼핑몰</strong></h2>
			    <ul>
			    	<li><a href="<?php echo G5_SHOP_URL; ?>/cart.php">장바구니</a></li>
			    	<li><a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php">주문내역 / 비회원 주문 조회</a></li>
			    	<li><a href="<?php echo G5_SHOP_URL; ?>/wishlist.php">위시리스트</a></li>
				</ul>
			</div>
        </div>

        <div class="idx-latest aside-div">
            <?php
            // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
            // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
            // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
            echo latest('theme/basic', 'qa', 5, 12);
            ?>
        </div>
        
        <div class="idx-escrow">
        <?php
        include_once(G5_THEME_PATH.'/mobile/shop/es.html');
        ?>
        </div>
        <?php
        if($is_admin){
        echo visit(); // 접속자집계, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정
        }
        ?>
        
 </aside>
</div><!-- wrapper End -->


<div id="ft">
    <div id="ft_wr">
        <div class="ft_st ft_container">
        <h2><i class="fa fa-info-circle" aria-hidden="true"></i> 약관 및 방침</h2>
            <ul>
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company" class="f_anchor">거창한무역소개</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision" class="f_anchor">이용약관</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy" class="f_anchor">개인정보 처리방침</a></li>
            </ul>
        </div>    

        <div class="ft_st ft_info">
            <h2><i class="fa fa-info-circle" aria-hidden="true"></i> 사이트 정보</h2>
            <ul>
                <li><b>회사명</b> <?php echo $default['de_admin_company_name']; ?><br><b>대표</b> <?php echo $default['de_admin_company_owner']; ?></li>
                <li><b>주소</b> <?php echo $default['de_admin_company_addr']; ?></li>
                <li><b>사업자 등록번호</b> <?php echo $default['de_admin_company_saupja_no']; ?></li>
                <li><b>전화</b> <?php echo $default['de_admin_company_tel']; ?> / <b>팩스</b> <?php echo $default['de_admin_company_fax']; ?></li>
                <li><b>통신판매업신고번호</b> <?php echo $default['de_admin_tongsin_no']; ?></li>
               
            </ul>
        </div>

        <div class="ft_st ft_customer">
            <h2><i class="fa fa-user" aria-hidden="true"></i> 고객센터</h2>
            <ul>
                <li class="ft_call"><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:070-8829-9906" class="f_anchor"> 070-8829-9906</a></li>
                <li class="ft_call"><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:010-2498-7316" class="f_anchor"> 010-2498-7316</a></li>
                <li>월-금 am 09:00 - pm 05:00</li>
                <li>점심시간 : am 12:00 - pm 01:00</li>
            </ul>
        </div>

        <div class="ft_st ft_customer">
            <h2><i class="fa-solid fa-building-columns"></i> 무통장 입금 계좌</h2>
            <ul>
            <h2><li><b>농협</b> 301-0329-2845-01 <br> 농업회사법인거창한무역(주)</li></h2>
            </ul>
        </div>
        
    </div>
    <div class="ft_copy">
        <span>Copyright &copy; 2023 <?php echo $default['de_admin_company_name']; ?>. All Rights Reserved.</span>
    </div>

    <a href="#" id="ft_to_top"><i class="fa-solid fa-chevron-up" aria-hidden="true"></i><span class="sound_only">상단으로</span></a>

</div>
<?php
$sec = get_microtime() - $begin_time;
$file = $_SERVER['SCRIPT_NAME'];

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<script src="<?php echo G5_JS_URL; ?>/sns.js"></script>

<?php
include_once(G5_THEME_PATH.'/tail.sub.php');
?>

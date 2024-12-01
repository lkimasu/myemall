<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// 스타일과 스크립트 추가
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);

?>

<div class="footer_list">
    <!-- 첫 번째 영역 -->
    <div class="footer_div">
        <h3 class="icon-text-group">
            <img src="/theme/strawberry/shop/img/icon-notice.png">
            <a href="/bbs/board.php?bo_table=notice">
            공지사항
            </a>
        </h3>
	    <?php echo latest('theme/shop_basic', 'notice', 3, 30); ?>
    </div>

    <!-- 두 번째 영역 -->
    <div class="footer_div">
        <h3 class="icon-text-group">
            <img src="/theme/strawberry/shop/img/icon-cscenter.png">
            고객센터
        </h3>
        <div class="inline-text-group">
            <p class="phone">070-8829-9906</p>
            <p>평일 AM 09:00 - PM 05:30</p>
            <p>점심 PM 12:00 - PM 01:00</p>
        </div>
    </div>

    <!-- 세 번째 영역 -->
    <div class="footer_div">
        <h3 class="icon-text-group">
            <img src="/theme/strawberry/shop/img/icon-bamk.png">
            계좌안내
        </h3>
        <div class="inline-text-group">
            <p class="bank">농협 301-0329-2845-01</p>
            <p class="bank">농업회사법인거창한무역(주)</p>
        </div>
        <p>※ 반드시 전화주문시에만 상단의 계좌로 입금바랍니다.</p>
        <p>※ 주문자명과 입금자명이 다른 경우 꼭 연락주세요!</p>
    </div>
</div>
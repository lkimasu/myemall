<?php
include_once('./_common.php');

define("_INDEX_", TRUE);

include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');
?>

<script src="<?php echo G5_JS_URL; ?>/swipe.js"></script>
<script src="<?php echo G5_JS_URL; ?>/shop.mobile.main.js"></script>

<!-- 메인 배너 시작 -->
<div class="main-banner">
    <?php echo display_banner('메인', 'mainbanner.10.skin.php'); ?>
</div>
<!-- 메인 배너 끝 -->

<?php if($default['de_mobile_type1_list_use']) { ?>
<div class="sct_wrap">
    <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=1">히트상품</a></h2>
    <?php
    $list = new item_list();
    $list->set_mobile(true);
    $list->set_type(1);
    $list->set_view('it_img', true); // 이미지 표시
    $list->set_view('it_name', true);
    $list->set_view('it_cust_price', true);
    $list->set_view('it_price', true);
    $list->set_view('it_icon', true);
    $list->set_view('sns', false);
    echo $list->run();
    ?>
</div>
<?php } ?>

<?php if($default['de_mobile_type2_list_use']) { ?>
<div class="sct_wrap">
    <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=2">추천상품</a></h2>
    <?php
    $list = new item_list();
    $list->set_mobile(true);
    $list->set_type(2);
    $list->set_view('it_img', true); // 이미지 표시
    $list->set_view('it_name', true);
    $list->set_view('it_cust_price', true);
    $list->set_view('it_price', true);
    $list->set_view('it_icon', true);
    $list->set_view('sns', false);
    echo $list->run();
    ?>
</div>
<?php } ?>

<?php if($default['de_mobile_type3_list_use']) { ?>


    <div class="sct_wrap">

        <h1><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=3">최신상품</a></h1>
    <?php
    $list = new item_list();
    $list->set_mobile(true);
    $list->set_type(3);
    $list->set_view('it_img', true); // 이미지 표시
    $list->set_view('it_name', true);
    $list->set_view('it_cust_price', true);
    $list->set_view('it_price', true);
    $list->set_view('it_icon', true);
    $list->set_view('sns', false);
    echo $list->run();
    ?>
</div>
<?php } ?>

<?php if($default['de_mobile_type4_list_use']) { ?>
<div class="sct_wrap">
    <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=4">인기상품</a></h2>
    <?php
    $list = new item_list();
    $list->set_mobile(true);
    $list->set_type(4);
    $list->set_view('it_img', true); // 이미지 표시
    $list->set_view('it_name', true);
    $list->set_view('it_cust_price', false);
    $list->set_view('it_price', true);
    $list->set_view('it_icon', true);
    $list->set_view('sns', false);
    echo $list->run();
    ?>
</div>
<?php } ?>

<?php if($default['de_mobile_type5_list_use']) { ?>
<div class="sct_wrap">
    <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=5">할인상품</a></h2>
    <?php
    $list = new item_list();
    $list->set_mobile(true);
    $list->set_type(5);
    $list->set_view('it_img', true); // 이미지 표시
    $list->set_view('it_name', true);
    $list->set_view('it_cust_price', false);
    $list->set_view('it_price', true);
    $list->set_view('it_icon', true);
    $list->set_view('sns', false);
    echo $list->run();
    ?>
</div>
<?php } ?>

    <div class="main_wrap">
        <h2>거창한무역 현장 스토리</h2>
        <h3>사진으로 만나는 거창한무역의 제품과 여정을 확인해보세요.</h3>
    </div>

<!-- 소셜 미디어 링크 -->
 <div class="social-icons">
    <a href="https://blog.naver.com/wpdlf943" target="_blank">
        <img src="/theme\strawberry\shop\img\sns_icons_blog.png" alt="네이버 블로그" width="80">
    </a>
    <a href="https://www.instagram.com/wpdlf943/" target="_blank">
        <img src="/theme\strawberry\shop\img\sns_icons_insta.png" alt="인스타그램" width="40">
    </a>
    <a href="https://pf.kakao.com/_zKdQxj/" target="_blank">
        <img src="/theme\strawberry\shop\img\sns_icons_kakao.png" alt="카카오채널" width="40">
    </a>
</div>

<div class="container">
    <!-- 카드 슬라이더 시작 -->
    <?php include_once(G5_MSHOP_SKIN_PATH.'/card_slider.skin.php'); ?>
    <!-- 카드 슬라이더 끝 -->
</div>

<!-- 이벤트 섹션 시작 -->
<div class="event-section">
    <?php include_once(G5_MSHOP_SKIN_PATH.'/main.event.skin.php'); ?>
</div>
<!-- 이벤트 섹션 끝 -->

<?php
include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
?>
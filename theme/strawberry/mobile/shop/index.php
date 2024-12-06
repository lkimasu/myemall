<?php
include_once('./_common.php');



include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');
?>

<script src="<?php echo G5_JS_URL; ?>/swipe.js"></script>
<script src="<?php echo G5_JS_URL; ?>/shop.mobile.main.js"></script>

<!-- 메인 배너 시작 -->
<div class="main-banner">
    <?php echo display_banner('메인', 'mainbanner.10.skin.php'); ?>
</div>
<!-- 메인 배너 끝 -->

<div class="main_wrap">
        <h1>카테고리별 추천 상품</h1>
        <h2>신선함 그대로, 믿을 수 있는 직배송</h2>
        <h3>100% 산지 직송, 신선함 그대로! - 신선 과일 직배송</h3>
</div>

<!-- 카테고리별 추천 상품 시작 -->
<?php include_once(G5_MSHOP_SKIN_PATH.'/category_recommendation.php');?>
<!-- 카테고리별 추천 상품 시작 -->

<div class="main_wrap_real">
        <h2>실시간 후기</h2>
        <h3>고객님의 생생한 리뷰를 확인하세요!</h3>
</div>

<?php include(G5_MSHOP_SKIN_PATH.'/reviews.php');?>


<?php if($default['de_mobile_type1_list_use']) { ?>
<div class="sct_wrap">
    <h1><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=1">히트상품</a></h1>
    <?php
    $list = new item_list();
    $list->set_mobile(true);
    $list->set_type(1);
    $list->set_view('it_img', true); // 이미지 표시
    $list->set_view('it_name', true);
    $list->set_view('it_cust_price', true);
    $list->set_view('it_price', true);
    $list->set_view('it_icon', true);
    echo $list->run();
    ?>
</div>
<?php } ?>

<?php if($default['de_mobile_type2_list_use']) { ?>
<div class="sct_wrap">
    <h1><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=2">추천상품</a></h1>
    <?php
    $list = new item_list();
    $list->set_mobile(true);
    $list->set_type(2);
    $list->set_view('it_img', true); // 이미지 표시
    $list->set_view('it_name', true);
    $list->set_view('it_cust_price', true);
    $list->set_view('it_price', true);
    $list->set_view('it_icon', true);
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
    echo $list->run();
    ?>
</div>

<div class="link-container">
    <a id="dynamic-link" href="<?php echo G5_MSHOP_URL; ?>/listtype.php?type=3" class="styled-link">
        전체보기 (링크)
    </a>
</div>
<?php } ?>

<?php if($default['de_mobile_type4_list_use']) { ?>
<div class="sct_wrap">
    <h1><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=4">인기상품</a></h1>
     <h2> 가장 많이 선택된 상품 </h2>
            <h3> 베스트셀러 상품, 후회 없는 선택! - 고객 인기 상품 </h3>
    <?php
    $list = new item_list();
    $list->set_mobile(true);
    $list->set_type(4);
    $list->set_view('it_img', true); // 이미지 표시
    $list->set_view('it_name', true);
    $list->set_view('it_cust_price', false);
    $list->set_view('it_price', true);
    $list->set_view('it_icon', true);
    echo $list->run();
    ?>
</div>
<?php } ?>

<?php if($default['de_mobile_type5_list_use']) { ?>
<div class="sct_wrap">
    <h1><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=5">할인상품</a></h1>
    <?php
    $list = new item_list();
    $list->set_mobile(true);
    $list->set_type(5);
    $list->set_view('it_img', true); // 이미지 표시
    $list->set_view('it_name', true);
    $list->set_view('it_cust_price', false);
    $list->set_view('it_price', true);
    $list->set_view('it_icon', true);
    echo $list->run();
    ?>
</div>
<?php } ?>

    <div class="main_wrap_story">
        <h2>거창한무역 현장 스토리</h2>
        <h3>사진으로 만나는 거창한무역의 제품과 여정을 확인해보세요.</h3>
    </div>

<div class="container">
    <!-- 카드 슬라이더 시작 -->
    <?php include_once(G5_MSHOP_SKIN_PATH.'/card_slider.skin.php'); ?>
    <!-- 카드 슬라이더 끝 -->
</div>

<div>
        <?php include_once(G5_MSHOP_SKIN_PATH. '/footer_box.php'); ?>
</div>


<!-- 이벤트 섹션 시작 -->
<div class="event-section">
    <?php include_once(G5_MSHOP_SKIN_PATH.'/main.event.skin.php'); ?>
</div>
<!-- 이벤트 섹션 끝 -->

<?php
echo 
include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
?>
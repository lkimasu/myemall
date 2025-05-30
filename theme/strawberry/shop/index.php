<?php
include_once('./_common.php');


if (G5_IS_MOBILE) {
    include_once(G5_THEME_MSHOP_PATH.'/index.php');
    return;
}

if (!defined('_INDEX_')) define('_INDEX_', true);

include_once(G5_THEME_SHOP_PATH.'/shop.head.php');
?>

<div class="container">
<!-- 메인 배너 시작 -->
<div class="main-banner">
    <?php echo display_banner('메인', 'mainbanner.10.skin.php'); ?>
</div>
<!-- 메인 배너 끝 -->

<div class="main_wrap">
        <h2>카테고리별 추천 상품</h2>
        <h3>신선함 그대로, 믿을 수 있는 직배송</h3>
</div>

<!-- 카테고리별 추천 상품 시작 -->
<?php include_once(G5_SHOP_SKIN_PATH.'/category_recommendation.php');?>
<!-- 카테고리별 추천 상품 시작 -->


<div class="main_wrap_real">
        <h2>실시간 후기</h2>
        <h3>고객님의 생생한 리뷰를 확인하세요!</h3>
</div>

<?php include(G5_SHOP_SKIN_PATH.'/reviews.php');?>

    <?php if($default['de_type3_list_use']) { ?>

    <!-- 최신상품 시작 -->
    <section class="sct_wrap">
      
        <header>
            <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=3">최신상품</a></h2>
            <h3> 가장 먼저 만나보는 최신 트렌드 상품! </h3>
        </header>
        
        <?php
        $list = new item_list();
        $list->set_type(3);
        $list->set_view('it_img', true); // 이미지 표시
        $list->set_view('it_name', true);
        $list->set_view('it_basic', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_star_score', true);
        $list->set_view('sns', true);
        echo $list->run();
        ?>
    </section>
    <!-- 최신상품 끝 -->
    <?php } ?>

    <div class="link-container">
    <a id="dynamic-link" href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=3" class="styled-link">
        전체보기(링크)
    </a>
    </div>

    <?php if($default['de_type4_list_use']) { ?>
    <!-- 인기상품 시작 -->
    <section class="sct_wrap">
        <header>
            <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=4">인기상품</a></h2>
            <h3> 베스트셀러 상품, 후회 없는 선택! - 고객 인기 상품 </h3>
        </header>
        <?php
        $list = new item_list();
        $list->set_type(4);
        $list->set_view('it_img', true); // 이미지 표시
        $list->set_view('it_name', true);
        $list->set_view('it_basic', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_star_score', true);
        $list->set_view('sns', true);
        echo $list->run();
        ?>
    </section>
    <!-- 인기상품 끝 -->
    <?php } ?>

    <div class="link-container">
    <a id="dynamic-link" href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=4" class="styled-link">
        전체보기(링크)
    </a>
    </div>

    <?php include_once(G5_SHOP_SKIN_PATH.'/boxevent.skin.php'); // 이벤트 ?>

    <?php if($default['de_type1_list_use']) { ?>
    <!-- 히트상품 시작 -->
    <section class="sct_wrap">
        <header>
            <h1><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=1">히트상품</a></h1>
        </header>
        <?php
        $list = new item_list();
        $list->set_type(1);
        $list->set_view('it_img', true);
        $list->set_view('it_name', true);
        $list->set_view('it_basic', false);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_star_score', true);
        $list->set_view('sns', true);
        echo $list->run();
        ?>
    </section>
    <!-- 히트상품 끝 -->
    <?php } ?>

    <?php if($default['de_type2_list_use']) { ?>
    <!-- 추천상품 시작 -->
    <section class="sct_wrap">
        <header>
            <h1><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=2">추천상품</a></h1>
        </header>
        <?php
        $list = new item_list();
        $list->set_type(2);
        $list->set_view('it_img', true); // 이미지 표시
        $list->set_view('it_name', true);
        $list->set_view('it_basic', false);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_star_score', true);
        $list->set_view('sns', true);
        echo $list->run();
        ?>
    </section>
    <!-- 추천상품 끝 -->
    <?php } ?>

    <?php if($default['de_type5_list_use']) { ?>
    <!-- 할인상품 시작 -->
    <section class="sct_wrap">
        <header>
            <h1><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=5">할인상품</a></h1>
        </header>
        <?php
        $list = new item_list();
        $list->set_type(5);
        $list->set_view('it_img', true); // 이미지 표시
        $list->set_view('it_name', true);
        $list->set_view('it_basic', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_star_score', true);
        $list->set_view('sns', true);
        echo $list->run();
        ?>
    </section>
    <!-- 할인상품 끝 -->
    <?php } ?>


<!-- SNS 배너 시작 -->
    <div class="main_wrap_story">
        <h2>유씨네농장의 오늘, SNS에서 확인하세요</h2>
        <h3>현장에서 촬영한 제품 여정과 비하인드 스토리를 사진으로 만날 수 있습니다.</h3>
    </div>

    <div class="container_card">
        <!-- 카드 슬라이더 시작 -->
        <?php include_once(G5_SHOP_SKIN_PATH.'/card_slider.skin.php'); ?>
        <!-- 카드 슬라이더 끝 -->
         
    </div>
    
    <div class="container_card">

    <?php echo display_banner('왼쪽'); ?>
    </div>

    <div>
        <?php include_once(G5_SHOP_SKIN_PATH. '/footer_box.php'); ?>
    </div>
</div>

<script>
    $("#container").removeClass("container").addClass("idx-container");
</script>

<?php

include_once(G5_THEME_SHOP_PATH.'/shop.tail.php');
?>

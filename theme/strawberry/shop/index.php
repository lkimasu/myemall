<?php
include_once('./_common.php');

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MSHOP_PATH.'/index.php');
    return;
}

if (!defined('_INDEX_')) define('_INDEX_', true);

include_once(G5_THEME_SHOP_PATH.'/shop.head.php');
?>

<!-- 메인 배너 시작 -->
<div class="main-banner">
    <?php echo display_banner('메인', 'mainbanner.10.skin.php'); ?>
</div>
<!-- 메인 배너 끝 -->

<div class="container">

   
    <?php if($default['de_type3_list_use']) { ?>

    <div class ="main_wrap">
        <h1> 거창한무역 상품모음 </h1>
    </div>
    
    
    <!-- 최신상품 시작 -->
    <section class="sct_wrap">
      
        <header>
            <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=3">최신상품</a></h2>
        </header>
        <?php
        $list = new item_list();
        $list->set_type(3);
        $list->set_view('it_img', true); // 이미지 표시
        $list->set_view('it_name', true);
        $list->set_view('it_basic', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
        $list->set_view('sns', true);
        echo $list->run();
        ?>
    </section>
    <!-- 최신상품 끝 -->
    <?php } ?>

    <?php if($default['de_type4_list_use']) { ?>
    <!-- 인기상품 시작 -->
    <section class="sct_wrap">
        <header>
            <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=4">인기상품</a></h2>
        </header>
        <?php
        $list = new item_list();
        $list->set_type(4);
        $list->set_view('it_img', true); // 이미지 표시
        $list->set_view('it_name', true);
        $list->set_view('it_basic', false);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
        $list->set_view('sns', true);
        echo $list->run();
        ?>
    </section>
    <!-- 인기상품 끝 -->
    <?php } ?>

    <?php include_once(G5_SHOP_SKIN_PATH.'/boxevent.skin.php'); // 이벤트 ?>

    <?php if($default['de_type1_list_use']) { ?>
    <!-- 히트상품 시작 -->
    <section class="sct_wrap">
        <header>
            <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=1">히트상품</a></h2>
        </header>
        <?php
        $list = new item_list();
        $list->set_type(1);
        $list->set_view('it_img', true);
        $list->set_view('it_name', true);
        $list->set_view('it_basic', false);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
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
            <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=2">추천상품</a></h2>
        </header>
        <?php
        $list = new item_list();
        $list->set_type(2);
        $list->set_view('it_img', true); // 이미지 표시
        $list->set_view('it_name', true);
        $list->set_view('it_basic', false);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
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
            <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=5">할인상품</a></h2>
        </header>
        <?php
        $list = new item_list();
        $list->set_type(5);
        $list->set_view('it_img', true); // 이미지 표시
        $list->set_view('it_name', true);
        $list->set_view('it_basic', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
        $list->set_view('sns', true);
        echo $list->run();
        ?>
    </section>
    <!-- 할인상품 끝 -->
    <?php } ?>
</div>

<!-- SNS 배너 시작 -->
    <div class="main_wrap">
        <h2>거창한무역 현장 스토리</h2>
        <h3>사진으로 만나는 거창한무역의 제품과 여정을 확인해보세요.</h3>
    </div>

<div class="social-icons">
<!-- 소셜 미디어 링크 -->

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
    <?php include_once(G5_SHOP_SKIN_PATH.'/card_slider.skin.php'); ?>
    <!-- 카드 슬라이더 끝 -->
</div>

<script>
    $("#container").removeClass("container").addClass("idx-container");
</script>

<?php
include_once(G5_THEME_SHOP_PATH.'/shop.tail.php');
?>

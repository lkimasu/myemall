<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
add_javascript('<script src="'.G5_JS_URL.'/jquery.bxslider.js"></script>', 10);
?>

<title>
    <?php 
    if (isset($g5['title']) && $g5['title']) { 
        echo $g5['title']; 
    } else { 
        echo "거창한무역"; 
    } 
    ?>
</title>

<header id="hd">
    <?php if ((!$bo_table || $w == 's' ) && defined('_INDEX_')) { ?><h1><?php echo $config['cf_title'] ?></h1><?php } ?>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>

<div id="tnb">
        <h3>회원메뉴</h3>
        <ul>
             <?php if ($is_member) { ?>
            <li><a href="<?php echo G5_SHOP_URL; ?>/cart.php">장바구니</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">마이페이지</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php">정보수정</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop">로그아웃</a></li>
            <?php if ($is_admin == 'super') {  ?>
            <li class="tnb_admin"><a href="<?php echo G5_ADMIN_URL; ?>/shop_admin/"><b>관리자</b></a></li>
            <?php }  ?>
            <?php } else { ?>
            <li><a href="<?php echo G5_SHOP_URL; ?>/cart.php">장바구니</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">마이페이지</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/register.php">회원가입</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo $urlencode; ?>"><b>로그인</b></a></li>
            <?php } ?>
        </ul>
    </div>

    <div id="hd_wr">
        <div id="logo"><a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?php echo G5_DATA_URL; ?>/common/mobile_logo_img" alt="<?php echo $config['cf_title']; ?> 메인"></a></div>

        <div id="hd_sch">
            <h3>쇼핑몰 검색</h3>
            <form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">

            <label for="sch_str" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
            <input type="text" name="q" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="sch_str" required>
            <button type="submit" id="sch_submit"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>

            </form>
            <script>
            function search_submit(f) {
                if (f.q.value.length < 2) {
                    alert("검색어는 두글자 이상 입력하십시오.");
                    f.q.select();
                    f.q.focus();
                    return false;
                }
                return true;
            }
            </script>
        </div>
    </div>
    <?php  include_once(G5_MSHOP_SKIN_PATH.'/boxcategory.skin.php'); // 상품분류?>
    <?php include_once(G5_THEME_MSHOP_PATH.'/category.php'); // 분류 ?>


    <script>

    $("#btn_hdcate").on("click", function() {
        $("#category").show();
    });

    $(".menu_close").on("click", function() {
        $(".menu").hide();
    });
     $(".cate_bg").on("click", function() {
        $(".menu").hide();
    });
   </script>
</header>

<div id="container">
    <?php if ((!$bo_table || $w == 's' ) && !defined('_INDEX_')) { ?><h1 id="container_title"><?php echo $g5['title'] ?></h1><?php } ?>

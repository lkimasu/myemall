<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
?>

<!-- 쇼핑몰 카테고리 시작 { -->
<nav id="gnb">
    <h2>쇼핑몰 카테고리</h2>
    <ul id="gnb_1dul">
        <li class="gnb_1dli"><button type="button" id="menu_open"><i class="fa fa-bars" aria-hidden="true"></i> <span class="sound_only">카테고리</span></button></li>
        <!--
        <li class="gnb_1dli"><a href="<?php echo G5_SHOP_URL; ?>/index.php" class="gnb_1da">홈</a></li>
        <li class="gnb_1dli">
            <a href="#" class="gnb_1da gnb_1dam">거창한무역</a>
            <ul class="gnb_2dul">
                <li class="gnb_2dli"><a href="/bbs/content.php?co_id=company" class="gnb_2da">회사소개</a></li>
                <li class="gnb_2dli"><a href="/bbs/content.php?co_id=history" class="gnb_2da">연혁</a></li>
                <li class="gnb_2dli"><a href="/bbs/content.php?co_id=maps" class="gnb_2da">오시는길</a></li>
            </ul>
        </li>
        <li class="gnb_1dli"><a href="/bbs/board.php?bo_table=gallery" class="gnb_1da">갤러리</a></li>
        <li class="gnb_1dli"><a href="https://blog.naver.com/wpdlf943" class="gnb_1da">블로그</a></li>

            -->
        <?php
        // 1단계 분류 판매 가능한 것만
        $hsql = "SELECT ca_id, ca_name FROM {$g5['g5_shop_category_table']} WHERE LENGTH(ca_id) = '2' AND ca_use = '1' ORDER BY ca_order, ca_id";
        $hresult = sql_query($hsql);
        $gnb_zindex = 999; // gnb_1dli z-index 값 설정용
        for ($i=0; $row=sql_fetch_array($hresult); $i++)
        {
            $gnb_zindex -= 1; // html 구조에서 앞선 gnb_1dli 에 더 높은 z-index 값 부여
            // 2단계 분류 판매 가능한 것만
            $sql2 = "SELECT ca_id, ca_name FROM {$g5['g5_shop_category_table']} WHERE LENGTH(ca_id) = '4' AND SUBSTRING(ca_id, 1, 2) = '{$row['ca_id']}' AND ca_use = '1' ORDER BY ca_order, ca_id";
            $result2 = sql_query($sql2);
            $count = sql_num_rows($result2);
        ?>
        <li class="gnb_1dli" style="z-index:<?php echo $gnb_zindex; ?>">
            <a href="<?php echo G5_SHOP_URL.'/list.php?ca_id='.$row['ca_id']; ?>" class="gnb_1da<?php if ($count) echo ' gnb_1dam'; ?>" title="<?php echo $row['ca_name']; ?>"><?php echo $row['ca_name']; ?></a>
            <?php
            if ($count > 0) {
                echo '<ul class="gnb_2dul" style="z-index:'.$gnb_zindex.'">';
                for ($j=0; $row2=sql_fetch_array($result2); $j++) {
            ?>
                <li class="gnb_2dli">
                    <a href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=<?php echo $row2['ca_id']; ?>" class="gnb_2da" title="<?php echo $row2['ca_name']; ?>"><?php echo $row2['ca_name']; ?></a>
                </li>
            <?php 
                }
                echo '</ul>';
            }
            ?>
        </li>
        <?php } ?>
    </ul>
</nav>
<!-- } 쇼핑몰 카테고리 끝 -->

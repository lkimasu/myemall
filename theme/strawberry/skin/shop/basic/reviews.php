<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
?>




<div class="link-container">
    <a id="dynamic-link" href="<?php echo G5_SHOP_URL; ?>/itemuselist.php" class="styled-link">
        후기 더보기
    </a>
</div>
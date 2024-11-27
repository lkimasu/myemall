<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<?php

$sql = "SELECT * 
        FROM {$g5['g5_shop_item_use_table']} 
        WHERE is_confirm = 1 
        ORDER BY is_time DESC 
        LIMIT 10";
$result = sql_query($sql);

if (sql_num_rows($result) == 0) {
    echo "<p class='no-review'>등록된 후기가 없습니다.</p>";
} else {
?>
    <div class="review-list">
        <?php
        $thumbnail_width = 100; // 썸네일 크기 설정
        for ($i = 0; $row = sql_fetch_array($result); $i++) {
            $it_href = G5_SHOP_URL . "/item.php?it_id={$row['it_id']}";
            $star = get_star($row['is_score']); // 별점
            $thumbnail = get_itemuselist_thumbnail($row['it_id'], $row['is_content'], $thumbnail_width, $thumbnail_width);

            if (!$thumbnail) {
                $thumbnail = "<img src='/path/to/default-image.jpg' alt='기본 이미지'>";
            }
        ?>
            <div class="review-item">
                <a href="<?php echo $it_href; ?>">
                    <div class="review-thumbnail">
                        <?php echo $thumbnail; ?>
                    </div>
                    <div class="review-details">
                        <p class="review-title"><?php echo get_text($row['is_subject']); ?></p>
                        <p class="review-score"><img src="<?php echo G5_URL; ?>/shop/img/s_star<?php echo $star; ?>.png" alt="별<?php echo $star; ?>개" width="80"></p>
                        <p class="review-author"><?php echo $row['is_name']; ?> (<?php echo substr($row['is_time'], 0, 10); ?>)</p>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
<?php } ?>

<div class="link-container">
    <a id="dynamic-link" href="<?php echo G5_SHOP_URL; ?>/itemuselist.php" class="styled-link">
        후기 더보기
    </a>
</div>


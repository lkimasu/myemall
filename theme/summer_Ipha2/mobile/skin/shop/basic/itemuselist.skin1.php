<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 전체 상품 사용후기 목록 시작 { -->

<div id="sps">

    <!-- <p><?php echo $config['cf_title']; ?> 전체 사용후기 목록입니다.</p> -->

    <?php
    $thumbnail_width = 500;

    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
        $num = $total_count - ($page - 1) * $rows - $i;
        $star = get_star($row['is_score']);

        $is_content = get_view_thumbnail(conv_content($row['is_content'], 1), $thumbnail_width);

        $row2 = sql_fetch(" select it_name from {$g5['g5_shop_item_table']} where it_id = '{$row['it_id']}' ");
        $it_href = G5_SHOP_URL."/item.php?it_id={$row['it_id']}";

        if ($i == 0) echo '<ol>';
    ?>
    <li>

        <div class="sps_img">
            <a href="<?php echo $it_href; ?>">
                <?php echo get_itemuselist_thumbnail($row['it_id'], $row['is_content'], 70, 70); ?>
                <span><?php echo $row2['it_name']; ?></span>
            </a>
        </div>

        <section class="sps_section">
            <h2><?php echo get_text($row['is_subject']); ?></h2>

            <dl class="sps_dl">
                <dt>작성자</dt>
                <dd><?php echo get_text($row['is_name']); ?></dd>
                <dt>작성일</dt>
                <dd><?php echo substr($row['is_time'],0,10); ?></dd>
                <dt>평가점수</dt>
                <dd><img src="<?php echo G5_SHOP_URL; ?>/img/s_star<?php echo $star; ?>.png" alt="별<?php echo $star; ?>개"></dd>
            </dl>

            <div id="sps_con_<?php echo $i; ?>" style="display:none;">
                <?php echo $is_content; // 사용후기 내용 ?>
            </div>

            <div class="sps_con_btn"><button class="sps_con_<?php echo $i; ?>">보기</button></div>
        </section>

    </li>
    <?php }
    if ($i > 0) echo '</ol>';
    if ($i == 0) echo '<p id="sps_empty">자료가 없습니다.</p>';
    ?>
</div>


<script>
$(function(){
    // 사용후기 더보기
    $(".sps_con_btn button").click(function(){
        var $con = $(this).parent().prev();
        if($con.is(":visible")) {
            $con.slideUp();
            $(this).text("보기");
        } else {
            $(".sps_con_btn button").text("보기");
            $("div[id^=sps_con]:visible").hide();
            $con.slideDown(
                function() {
                    // 이미지 리사이즈
                    $con.viewimageresize2();
                }
            );
            $(this).text("닫기");
        }
    });
});
</script>
<!-- } 전체 상품 사용후기 목록 끝 -->
<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
add_javascript('<script src="'.G5_THEME_JS_URL.'/jquery.shop.list.js"></script>', 10);
add_stylesheet('<link rel="stylesheet" href="'.G5_JS_URL.'/swiper/swiper.min.css">', 0);
add_javascript('<script src="'.G5_JS_URL.'/swiper/swiper.min.js"></script>', 10);


$cards = [];
$sql = "SELECT story_id, story_alt, story_url FROM {$g5['g5_shop_story_table']} ORDER BY story_id DESC";
$result = sql_query($sql);
while ($row = sql_fetch_array($result)) {
    $image_path = G5_DATA_URL . "/story/" . $row['story_id'];  // 이미지 경로 설정
    $cards[] = [
        "image" => $image_path,
        "title" => $row['story_alt'],
        "link"  => $row['story_url']
    ];
}

?>

<div class="swiper-container sw2">
    <div class="swiper-wrapper">
    <?php
        // DB에서 가져온 카드 데이터 출력
        foreach ($cards as $card) {
            echo '<div class="swiper-slide card">';
            echo '<a href="' . $card["link"] . '" target="_blank">';
            echo '<img src="' . $card["image"] . '" alt="' . $card["title"] . '">';
            echo '<div class="card-title">' . $card["title"] . '</div>';
            echo '</a>';
            echo '</div>';
        }
        ?>
    </div>
</div>

<script>
jQuery(function($) {
    var swiper = new Swiper('.sw2', {
        slidesPerView: 1,
        spaceBetween: 10, // 카드 간의 간격
        loop: true,
        autoplay: {
            delay: 5000, // 5초마다 슬라이드
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
});
</script>

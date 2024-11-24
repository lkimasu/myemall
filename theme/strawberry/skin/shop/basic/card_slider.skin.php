<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// 스타일과 스크립트 추가
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.G5_JS_URL.'/swiper/swiper.min.css">', 0);
add_javascript('<script src="'.G5_JS_URL.'/swiper/swiper.min.js"></script>', 10);

// 카드 데이터를 데이터베이스에서 조회하여 배열로 저장
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
    <!-- 추가 요소들 (예: 페이지네이션 등) 필요에 따라 추가 -->
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var swiper = new Swiper('.sw2', {
        slidesPerView: 3,
        spaceBetween: 10,
        loop: false,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 10000, // 10초 (10000ms) 간격
            disableOnInteraction: false, // 사용자 인터랙션 후에도 autoplay가 계속 진행되도록 설정
        },
    });
});
</script>

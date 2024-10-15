<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.G5_JS_URL.'/swiper/swiper.min.css">', 0);
add_javascript('<script src="'.G5_JS_URL.'/swiper/swiper.min.js"></script>', 10);
?>


<div class="swiper-container sw2">
    <div class="swiper-wrapper">
        <?php
        // 카드 데이터 배열
        $cards = [
            [
                "image" => "/theme/strawberry/shop/img/apple.jpg",
                "title" => "추석용 홍로 작업 중 입니다.",
                "link"  => "https://www.instagram.com/p/C_zueY_zlnQ/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA=="
            ],
            [
                "image" => "/theme/strawberry/shop/img/sweet_potato.jpg",
                "title" => "고구마 수확하고 있습니다.",
                "link"  => "https://blog.naver.com/wpdlf943/223596927254"
            ],
            [
                "image" => "/theme/strawberry/shop/img/onion.jpg",
                "title" => "국내산 양파 판매 중입니다.",
                "link"  => "https://www.instagram.com/p/DAUg73ozzry/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA=="
            ]
        ];

        // 카드 출력
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
    
  document.addEventListener('DOMContentLoaded', function () {
    var swiper = new Swiper('.sw2', {
        slidesPerView: 3,
        spaceBetween: 10,
        loop: true,
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
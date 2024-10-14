<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// Swiper 슬라이더 시작
add_stylesheet('<link rel="stylesheet" href="'.G5_JS_URL.'/swiper/swiper.min.css">', 0);
add_javascript('<script src="'.G5_JS_URL.'/swiper/swiper.min.js"></script>', 10);

// 상품 목록 초기화
$list = new item_list();
$list->set_mobile(true); // 모바일용 설정
$list->set_type(3); // 최신상품 (3번 타입)
$list->set_view('it_img', true); // 이미지 표시
$list->set_view('it_name', true); // 상품명 표시
$list->set_view('it_cust_price', true); // 소비자가격 표시
$list->set_view('it_price', true); // 판매가 표시
$list->set_view('it_icon', true); // 아이콘 표시
$list->set_view('sns', false); // SNS 공유 버튼 비활성화

// 상품 목록을 배열로 가져오기
$items = $list->run();

?>

<div class="swiper-container">
    <div class="swiper-wrapper">
        <?php
        // 상품이 존재하는 경우 슬라이드를 출력
        if (is_array($items) && count($items) > 0) {
            // 상품을 반복하여 출력
            foreach ($items as $row) {
                echo '<div class="swiper-slide card">';
                echo '<a href="'.G5_SHOP_URL.'/item.php?it_id='.$row['it_id'].'">';
                echo '<img src="'.get_it_image($row['it_id'], 300, 300).'" alt="'.get_text($row['it_name']).'">';
                echo '<div class="card-title">'.get_text($row['it_name']).'</div>';
                echo '<div class="card-price">'.display_price(get_price($row)).'</div>';
                echo '</a>';
                echo '</div>';
            }
        } else {
            // 상품이 없을 때만 출력
            echo '<p class="no-items">상품이 없습니다.</p>';
        }
        ?>
    </div>
</div>

<script>
jQuery(function($) {
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 4,  // 한 줄에 2개의 상품을 보여줌
        spaceBetween: 10,  // 카드 간의 간격
        loop: true,
        autoplay: {
            delay: 5000, // 5초마다 슬라이드
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 30
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 40
            },
        }
    });
});
</script>

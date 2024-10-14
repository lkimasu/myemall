<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
add_javascript('<script src="'.G5_THEME_JS_URL.'/jquery.shop.list.js"></script>', 10);
add_stylesheet('<link rel="stylesheet" href="'.G5_JS_URL.'/swiper/swiper.min.css">', 0);
add_javascript('<script src="'.G5_JS_URL.'/swiper/swiper.min.js"></script>', 10);
?>

<div class="swiper-container sct_10">
    <div class="swiper-wrapper">

<!-- 상품진열 10 시작 { -->
<?php
for ($i=1; $row=sql_fetch_array($result); $i++) {
    if ($this->list_mod >= 2) {
        if ($i % $this->list_mod == 0) $sct_last = 'sct_last';
        else if ($i % $this->list_mod == 1) $sct_last = 'sct_clear';
        else $sct_last = '';
    } else {
        $sct_last = 'sct_clear';
    }

    echo "<div class=\"swiper-slide sct_li {$sct_last}\" >\n";

    echo "<div class=\"sct_img\">\n";

    if ($this->href) {
        echo "<a href=\"{$this->href}{$row['it_id']}\" title=\"".htmlspecialchars(stripslashes($row['it_name']))."\">\n";
    }

    if ($this->view_it_img) {
        echo "<img src=\"". get_it_imageurl($row['it_id']) ."\" width=\"". $this->img_width ."\" height=\"". $this->img_height ."\" alt=\"". htmlspecialchars(stripslashes($row['it_name'])) ."\">";
    }

    if ($this->href) {
        echo "</a>\n";
    }

    if ($this->view_it_icon) {
        echo item_icon2($row);
    }

    // 버튼 및 SNS 공유 관련 코드 유지
    echo "<div class=\"sct_btn\"><div class=\"sct_btn_wr\"><button type=\"button\" class=\"btn_cart\" data-it_id=\"{$row['it_id']}\"><span class=\"sound_only\">장바구니</span><i class=\"fa fa-shopping-cart\"></i></button><button type=\"button\" class=\"btn_wish\" data-it_id=\"{$row['it_id']}\"><span class=\"sound_only\">위시리스트</span><i class=\"fa fa-heart-o\" aria-hidden=\"true\"></i></button><button type=\"button\" class=\"btn_share\"><i class=\"fa fa-share-alt\" aria-hidden=\"true\"></i><span class=\"sound_only\">sns공유</span></button>\n";
    echo "</div>\n";

    if ($this->view_sns) {
        $sns_top = $this->img_height + 10;
        $sns_url  = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'];
        $sns_title = get_text($row['it_name']).' | '.get_text($config['cf_title']);
        echo "<div class=\"sct_sns\"><div class=\"sct_sns_wr\"><h3>SNS 공유</h3><div>";
        echo get_sns_share_link('facebook', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/facebook.png');
        echo get_sns_share_link('twitter', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/twitter.png');
        echo get_sns_share_link('googleplus', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/gplus.png');
        echo get_sns_share_link('kakaotalk', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/sns_kakao.png');
        echo "</div><button type=\"button\" class=\"btn_close\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></button></div><div class=\"bg\"></div></div>\n";
    }
    echo "</div>\n"; // .sct_img 끝

    // 기타 정보 출력
    echo "<div class=\"sct_cartop\"></div>\n";

    if ($this->view_it_id) {
        echo "<div class=\"sct_id\">&lt;".stripslashes($row['it_id'])."&gt;</div>\n";
    }

    echo "</div>\n"; // .sct_li 끝

    if ($this->href) {
        echo "<div class=\"sct_txt\">\n";
    }

    if ($this->href) {
        echo "<a href=\"{$this->href}{$row['it_id']}\" class=\"sct_tit\" title=\"".htmlspecialchars(stripslashes($row['it_name']))."\">\n";
    }

    if ($this->view_it_name) {
        echo stripslashes($row['it_name'])."\n";
    }

    if ($this->href) {
        echo "</a>\n";
    }
    echo "</div>\n";

    if ($this->view_it_basic) {
        echo "<div class=\"sct_basic\">".stripslashes($row['it_basic'])."</div>\n";
    }

    if ($this->view_it_cust_price || $this->view_it_price) {
        echo "<div class=\"sct_cost\">\n";

        if ($this->view_it_price) {
            echo display_price(get_price($row), $row['it_tel_inq'])."\n";
        }

        if ($this->view_it_cust_price && $row['it_cust_price']) {
            echo "<span class=\"sct_discount\">".display_price($row['it_cust_price'])."</span>\n";
        }
        echo "</div>\n";
    }

    if ($this->view_it_icon) {
        echo item_icon3($row);
    }

    $s_core  =  (int)$row['it_use_avg']; 
    if ($s_core > 0 ) { 
        echo "<span class=\"sct_star\"><img src=".G5_SHOP_URL."/img/s_star".$s_core.".png></span>"; 
    }

    echo "</div>\n"; // .sct_li 끝
}

if ($i > 1) echo "</div>\n"; // swiper-wrapper 닫기
if($i == 1) echo "<p class=\"sct_noitem\">등록된 상품이 없습니다.</p>\n";
?>

    </div> <!-- swiper-wrapper 끝 -->
</div> <!-- swiper-container 끝 -->

<script>
$('.btn_share').click(function(){
    $(this).parent().next('.sct_sns').show();
});

$('.sct_sns_wr .btn_close').click(function(){
    $('.sct_sns').hide();
});

$('.sct_sns .bg').click(function(){
    $('.sct_sns').hide();
});

var swiper = new Swiper('.swiper-container', {
    slidesPerView: 4, // 한 번에 보여줄 카드 수
    spaceBetween: 10,  // 카드 간의 간격
    loop: true,        // 무한 루프 설정
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
});
</script>
<!-- } 상품진열 10 끝 -->

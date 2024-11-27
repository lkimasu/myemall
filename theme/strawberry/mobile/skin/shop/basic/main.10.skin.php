<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.G5_JS_URL.'/swiper/swiper.min.css">', 1); // 순서 변경
add_javascript('<script src="'.G5_THEME_JS_URL.'/jquery.shop.list.js"></script>', 10);
add_javascript('<script src="'.G5_JS_URL.'/swiper/swiper.min.js"></script>', 11); // 순서 변경
?>

<div class="swiper-container sw1 sct_10"> <!-- sct_10 클래스 추가 -->
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

    // 버튼 및 SNS 공유 관련 코드 유지
    if ($this->view_it_icon) {
        echo item_icon2($row);
    }

    if ($this->view_sns) {
        $sns_top = $this->img_height + 10;
        $sns_url  = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'];
        $sns_title = get_text($row['it_name']).' | '.get_text($config['cf_title']);
        echo "<div class=\"sct_sns\"><div class=\"sct_sns_wr\"><h3>SNS 공유</h3><div>";
     
        echo "</div><button type=\"button\" class=\"btn_close\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></button></div><div class=\"bg\"></div></div>\n";
    }
    echo "</div>\n"; // .sct_img 끝

    // 기타 정보 출력
    echo "<div class=\"sct_cartop\"></div>\n";

    if ($this->view_it_id) {
        echo "<div class=\"sct_id\">&lt;".stripslashes($row['it_id'])."&gt;</div>\n";
    }


    if ($this->href) {
        echo "<div class=\"sct_txt\"><h2>\n"; // 상품명에 h2 추가
    }

    if ($this->href) {
        echo "<a href=\"{$this->href}{$row['it_id']}\" class=\"sct_tit\" title=\"".htmlspecialchars(stripslashes($row['it_name']))."\">\n";
    }

    if ($this->view_it_name) {
        echo stripslashes($row['it_name'])."\n";
    }

    if ($this->href) {
        echo "</a></h2>\n"; // 상품명에 h2 닫기
    }
    echo "</div>\n";

    if ($this->view_it_basic) {
        echo "<div class=\"sct_basic\"><h3>".stripslashes($row['it_basic'])."</h3></div>\n"; // h3 태그 제대로 닫음
    }

    if ($this->view_it_cust_price || $this->view_it_price) {
        echo "<div class=\"sct_cost\"><h3>\n";

        if ($this->view_it_price) {
            echo display_price(get_price($row), $row['it_tel_inq'])."\n";
        }

        if ($this->view_it_cust_price && $row['it_cust_price']) {
            echo "<span class=\"sct_discount\">".display_price($row['it_cust_price'])."</span>\n";
        }
        echo "</h3></div>\n"; // h3 태그 제대로 닫음
    }

    if ($this->view_it_icon) {
        echo item_icon3($row);
    }

   /* $s_core  =  (int)$row['it_use_avg']; 
    if ($s_core > 0 ) { 
        echo "<span class=\"sct_star\"><img src=".G5_SHOP_URL."/img/s_star".$s_core.".png></span>"; 
    } */

    echo "</div>\n"; // .sct_li 끝
}

if ($i > 1) echo "</div>\n"; // swiper-wrapper 닫기
if($i == 1) echo "<p class=\"sct_noitem\">등록된 상품이 없습니다.</p>\n";
?>
<br>
<div class="swiper-pagination"></div>

</div> <!-- swiper-wrapper 끝 -->
</div> <!-- swiper-container 끝 -->


<?php if($config['cf_kakao_js_apikey']) { ?>
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
<script src="<?php echo G5_JS_URL; ?>/kakaolink.js"></script>
<script>
    // 사용할 앱의 Javascript 키를 설정해 주세요.
    Kakao.init("<?php echo $config['cf_kakao_js_apikey']; ?>");
</script>
<?php } ?>

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

document.addEventListener('DOMContentLoaded', function () {
    var swiper = new Swiper('.sw1', {
        slidesPerView: 2,
        spaceBetween: 5,
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
<!-- } 상품진열 10 끝 -->

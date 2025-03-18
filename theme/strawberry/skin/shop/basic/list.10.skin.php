<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
add_javascript('<script src="'.G5_THEME_JS_URL.'/jquery.shop.list.js"></script>', 10);

$type = isset($_REQUEST['type']) ? (int) preg_replace("/[^0-9]/", "", $_REQUEST['type']) : 1;

?>

<div class="list_title"> 
    <h2>
        <?php
        // $type 값에 따라 제목을 다르게 설정
        switch ($type) {
            case 6: // 국산과일
                echo "국산 과일";
                break;
            case 7: // 수입과일
                echo "수입 과일";
                break;
            case 8: // 과일 선물
                echo "과일 선물 세트";
                break;
            case 9: // 과일 주스
                echo "과일 주스";
                break;
            case 10: // 대용량 과일
                echo "대용량 과일";
                break;
            case 11: // 제철 과일
                echo "제철 과일";
                break;
        }
        ?>
    </h2>
    <p>
        <?php
        // $type 값에 따라 문구를 다르게 설정
        switch ($type) {
            case 6: // 국산과일
                echo "국내의 신선하고 품질 좋은 과일을 만나보세요. 자연의 풍미를 담았습니다!";
                break;
            case 7: // 수입과일
                echo "전 세계에서 엄선된 고품질의 수입 과일! 다양한 맛을 경험하세요.";
                break;
            case 8: // 과일 선물
                echo "소중한 사람을 위한 특별한 과일 선물 세트를 준비했습니다.";
                break;
            case 9: // 과일 주스
                echo "신선한 과일로 만든 건강하고 맛있는 주스를 만나보세요!";
                break;
            case 10: // 대용량 과일
                echo "대가족이나 행사에 적합한 대용량 과일을 준비했습니다.";
                break;
            case 11: // 제철 과일
                echo "지금 가장 맛있는 제철 과일을 만나보세요. 자연 그대로의 풍미!";
                break;
        }
        ?>
    </p>
</div>

<div class="con_right">

    <!-- 상품진열 10 시작 { -->
    <?php
    for ($i=1; $row=sql_fetch_array($result); $i++) {
        if ($this->list_mod >= 2) { // 1줄 이미지 : 2개 이상
            if ($i%$this->list_mod == 0) $sct_last = 'sct_last'; // 줄 마지막
            else if ($i%$this->list_mod == 1) $sct_last = 'sct_clear'; // 줄 첫번째
            else $sct_last = '';
        } else { // 1줄 이미지 : 1개
            $sct_last = 'sct_clear';
        }

        if ($i == 1) {
            if ($this->css) {
                echo "<ul class=\"{$this->css}\">\n";
            } else {
                echo "<ul class=\"sct sct_10 list_10\">\n";
            }
        }

        echo "<li class=\"sct_li {$sct_last}\" style=\"width:{$this->img_width}px\">\n";

        // 상품 이미지 출력
        echo "<div class=\"sct_img\">\n";
        if ($this->href) {
            echo "<a href=\"{$this->href}{$row['it_id']}\">\n";
        }
        if ($this->view_it_img) {
            echo get_it_image($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name']))."\n";
        }
        if ($this->href) {
            echo "</a>\n";
        }

        if ($this->view_it_icon) {
            echo item_icon2($row);
        }
        echo "</div>\n"; // sct_img 닫기

        // 상품명 출력 영역 (sct_txt)
        if ($this->href) {
            echo "<div class=\"sct_txt\">\n";
            echo "<a href=\"{$this->href}{$row['it_id']}\" class=\"sct_tit\">\n";
            if ($this->view_it_name) {
                echo stripslashes($row['it_name'])."\n";
            }
            echo "</a>\n";
            echo "</div>\n"; // sct_txt 닫기
        }

        // 상품 설명 출력 영역 (sct_basic)
        if ($this->view_it_basic && $row['it_basic']) {
            echo "<div class=\"sct_basic\">".stripslashes($row['it_basic'])."</div>\n";
        }

        // 가격 출력 영역 (sct_cost)
        if ($this->view_it_cust_price || $this->view_it_price) {
            echo "<div class=\"sct_cost\">\n";
            if ($this->view_it_price) {
                echo display_price(get_price($row), $row['it_tel_inq'])."\n";
            }
            if ($this->view_it_cust_price && $row['it_cust_price']) {
                echo "<span class=\"sct_discount\">".display_price($row['it_cust_price'])."</span>\n";
            }
            echo "</div>\n"; // sct_cost 닫기
        }

        // 평점 출력 (sct_star)
        $s_core = (int)$row['it_use_avg'];
        if ($s_core > 0) {
            echo "<span class=\"sct_star\"><img src=\"".G5_SHOP_URL."/img/s_star".$s_core.".png\"></span>\n";
        }

        // 버튼 출력 (장바구니, 위시리스트, SNS 공유)
        echo "<div class=\"sct_btn\">\n";
        echo "<div class=\"sct_btn_wr\">\n";
        echo "<button type=\"button\" class=\"btn_cart\" data-it_id=\"{$row['it_id']}\"><span class=\"sound_only\">장바구니</span><i class=\"fa fa-shopping-cart\"></i></button>\n";
        echo "<button type=\"button\" class=\"btn_wish\" data-it_id=\"{$row['it_id']}\"><span class=\"sound_only\">위시리스트</span><i class=\"fa fa-heart-o\" aria-hidden=\"true\"></i></button>\n";
        echo "<button type=\"button\" class=\"btn_share\"><i class=\"fa fa-share-alt\" aria-hidden=\"true\"></i><span class=\"sound_only\">sns공유</span></button>\n";
        echo "</div>\n"; // sct_btn_wr 닫기

        // SNS 공유 영역
        if ($this->view_sns) {
            $sns_top = $this->img_height + 10;
            $sns_url  = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'];
            $sns_title = get_text($row['it_name']).' | '.get_text($config['cf_title']);
            echo "<div class=\"sct_sns\">\n";
            echo "<div class=\"sct_sns_wr\">\n";
            echo "<h3>SNS 공유</h3><div>\n";
            echo get_sns_share_link('facebook', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/facebook.png');
            echo get_sns_share_link('twitter', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/twitter.png');
            echo get_sns_share_link('googleplus', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/gplus.png');
            echo get_sns_share_link('kakaotalk', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/sns_kakao.png');
            echo "</div>\n";
            echo "<button type=\"button\" class=\"btn_close\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></button>\n";
            echo "</div><div class=\"bg\"></div>\n";
            echo "</div>\n"; // sct_sns 닫기
        }
        echo "</div>\n"; // sct_btn 닫기

        echo "</li>\n"; // sct_li 닫기
    }

    if ($i > 1) echo "</ul>\n";
    if ($i == 1) echo "<p class=\"sct_noitem\">등록된 상품이 없습니다.</p>\n";
    ?>
</div>

<script>
$('.btn_share').click(function() {
    $(this).parent().next('.sct_sns').show();
});

$('.sct_sns_wr .btn_close').click(function() {
    $('.sct_sns').hide();
});

$('.sct_sns .bg').click(function() {
    $('.sct_sns').hide();
});
</script>
<!-- } 상품진열 10 끝 -->

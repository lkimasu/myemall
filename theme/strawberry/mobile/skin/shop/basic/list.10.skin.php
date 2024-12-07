<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
$type = isset($_REQUEST['type']) ? (int) preg_replace("/[^0-9]/", "", $_REQUEST['type']) : 1;
?>

<?php if(!defined('G5_IS_SHOP_AJAX_LIST') && $config['cf_kakao_js_apikey']) { ?>
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
<script src="<?php echo G5_JS_URL; ?>/kakaolink.js"></script>
<script>
    // 사용할 앱의 Javascript 키를 설정해 주세요.
    Kakao.init("<?php echo $config['cf_kakao_js_apikey']; ?>");
</script>
<?php } ?>

<div class="list_title"> 
    <h1>
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
            default:
                echo "다양한 과일과 농산물";
        }
        ?>
    </h1>
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
            default:
                echo "신선함이 가득한 다양한 과일과 농산물을 확인해보세요.";
        }
        ?>
    </p>
</div>


<!-- 메인상품진열 10 시작 { -->
<?php
$is_gallery_list = ($this->ca_id && isset($_COOKIE['ck_itemlist'.$this->ca_id.'_type'])) ? $_COOKIE['ck_itemlist'.$this->ca_id.'_type'] : '';
if(!$is_gallery_list){
    $is_gallery_list = 'gallery';
}
$li_width = ($is_gallery_list === 'gallery') ? intval(100 / $this->list_mod) : 100;
$li_width_style = ' style="width:'.$li_width.'%;"';
$ul_sct_class = ($is_gallery_list === 'gallery') ? 'sct_10' : 'sct_20';

for ($i=0; $row=sql_fetch_array($result); $i++) {
    if ($i == 0) {
        if ($this->css) {
            echo "<ul id=\"sct_wrap\" class=\"{$this->css}\">\n";
        } else {
            echo "<ul id=\"sct_wrap\" class=\"sct ".$ul_sct_class."\">\n";
        }
    }

    if($i % $this->list_mod == 0)
        $li_clear = ' sct_clear';
    else
        $li_clear = '';

    echo "<li class=\"sct_li{$li_clear}\"$li_width_style><div class=\"li_wr is_view_type_list\">\n";

    if ($this->href) {
        echo "<div class=\"sct_img\"><a href=\"{$this->href}{$row['it_id']}\">\n";
    }

    if ($this->view_it_img) {
        echo get_it_image($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name']))."\n";
    }

    if ($this->href) {
        echo "</a></div>\n";
    }


    if ($this->view_it_id) {
        echo "<div class=\"sct_id\">&lt;".stripslashes($row['it_id'])."&gt;</div>\n";
    }

    if ($this->href) {
        echo "<div class=\"sct_txt\"><a href=\"{$this->href}{$row['it_id']}\" class=\"sct_a\" title=\"".htmlspecialchars(stripslashes($row['it_name']))."\">\n";
    }

    if ($this->view_it_name) {
        echo stripslashes($row['it_name'])."\n";
    }

    if ($this->href) {
        echo "</a></div>\n";
    }

    if ($this->view_it_price) {
        echo "<div class=\"sct_cost\">\n";
        echo display_price(get_price($row), $row['it_tel_inq'])."\n";
        echo "</div>\n";
    }

    if ($this->view_sns) {
        $sns_top = $this->img_height + 10;
        $sns_url  = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'];
        $sns_title = get_text($row['it_name']).' | '.get_text($config['cf_title']);
        echo "<div class=\"sct_sns\" style=\"top:{$sns_top}px\">";
        echo get_sns_share_link('facebook', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/facebook.png');
        echo get_sns_share_link('twitter', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/twitter.png');
        echo get_sns_share_link('googleplus', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/gplus.png');
        echo get_sns_share_link('kakaotalk', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/sns_kakao.png');
        echo "</div>\n";
    }

    echo "</div></li>\n";
}

if ($i > 0) echo "</ul>\n";

if($i == 0) echo "<p class=\"sct_noitem\">등록된 상품이 없습니다.</p>\n";
?>
<!-- } 상품진열 10 끝 -->

<?php if( !defined('G5_IS_SHOP_AJAX_LIST') ) { ?>
<script>
jQuery(function($){
    var li_width = "<?php echo intval(100 / $this->list_mod); ?>",
        img_width = "<?php echo $this->img_width; ?>",
        img_height = "<?php echo $this->img_height; ?>",
        list_ca_id = "<?php echo $this->ca_id; ?>";

    function shop_list_type_fn(type){
        var $ul_sct = $("ul.sct");

        if(type == "gallery") {
            $ul_sct.removeClass("sct_20").addClass("sct_10")
            .find(".sct_li").attr({"style":"width:"+li_width+"%"});
        } else {
            $ul_sct.removeClass("sct_10").addClass("sct_20")
            .find(".sct_li").removeAttr("style");
        }
        
        if (typeof g5_cookie_domain != 'undefined') {
            set_cookie("ck_itemlist"+list_ca_id+"_type", type, 1, g5_cookie_domain);
        }
    }

    $("button.sct_lst_view").on("click", function() {
        var $ul_sct = $("ul.sct");

        if($(this).hasClass("sct_lst_gallery")) {
            shop_list_type_fn("gallery");
        } else {
            shop_list_type_fn("list");
        }
    });
});
</script>
<?php } ?>

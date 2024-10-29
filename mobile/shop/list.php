<?php
include_once('./_common.php');

// 상품 리스트에서 다른 필드로 정렬을 하려면 아래의 배열 코드에서 해당 필드를 추가하세요.
if( isset($sort) && ! in_array($sort, array('it_name', 'it_sum_qty', 'it_price', 'it_use_avg', 'it_use_cnt', 'it_update_time')) ){
    $sort='';
}

$sql = " select *
           from {$g5['g5_shop_category_table']}
          where ca_id = '$ca_id'
            and ca_use = '1'  ";
$ca = sql_fetch($sql);
if (!$ca['ca_id'])
    alert('등록된 분류가 없습니다.', G5_SHOP_URL);

// 테마미리보기 스킨 등의 변수 재설정
if(defined('_THEME_PREVIEW_') && _THEME_PREVIEW_ === true) {
    $ca['ca_mobile_skin']       = (isset($tconfig['ca_mobile_skin']) && $tconfig['ca_mobile_skin']) ? $tconfig['ca_mobile_skin'] : $ca['ca_mobile_skin'];
    $ca['ca_mobile_img_width']  = (isset($tconfig['ca_mobile_img_width']) && $tconfig['ca_mobile_img_width']) ? $tconfig['ca_mobile_img_width'] : $ca['ca_mobile_img_width'];
    $ca['ca_mobile_img_height'] = (isset($tconfig['ca_mobile_img_height']) && $tconfig['ca_mobile_img_height']) ? $tconfig['ca_mobile_img_height'] : $ca['ca_mobile_img_height'];
    $ca['ca_mobile_list_mod']   = (isset($tconfig['ca_mobile_list_mod']) && $tconfig['ca_mobile_list_mod']) ? $tconfig['ca_mobile_list_mod'] : $ca['ca_mobile_list_mod'];
    $ca['ca_mobile_list_row']   = (isset($tconfig['ca_mobile_list_row']) && $tconfig['ca_mobile_list_row']) ? $tconfig['ca_mobile_list_row'] : $ca['ca_mobile_list_row'];
}

switch ($ca_id) {

    case '10': // 사과
        $meta_description = "신선하고 달콤한 사과, 산지 직송과 무료배송으로 만나보세요.";
        $meta_keywords = "사과, 시나노골드,홍로,부사,아오리,홍로사과,시나노사과,사과10KG,사과5KG,거창사과,꿀사과,선물세트";
        break;
    case '20': // 사과주스
        $meta_description = "싱싱한 사과로 만든 사과주스 무료배송";
        $meta_keywords = "사과주스, 과일주스, 건강 음료, 신선한 주스,사과즙,HACCP 사과주스";
        break;
    case '30': // 포도
        $meta_description = "맛있는 포도, 다양한 종류의 포도를 구입하세요.";
        $meta_keywords = "포도, 신선한 포도, 과일, 샤인머스켓,선물세트,과일선물세트,수출용,샤인머스켓2KG,샤인머스켓4KG";
        break;
    case '40': // 수입과일
        $meta_description = "신선하고 다양한 수입과일을 만나보세요.";
        $meta_keywords = "수입과일, 해외 과일, 다양한 과일, 과일 시장,용과";
        break;
    case '50': // 양파
        $meta_description = "양파, 신선한 양파를 저렴하게 제공합니다.";
        $meta_keywords = "양파, 국내산 양파, 신선한 양파, 채소,소 사이즈 양파,대 사이즈 양파,장아찌 사이즈 양파,수입산 양파";
        break;
    case '60': // 기타 상품
        $meta_description = "다양한 기타 농산물을 한눈에 확인하세요.";
        $meta_keywords = "농산물, 신선 식품, 다양한 농산물, 직거래 상품,고구마";
        break;
    default: // 기본값
        $meta_description = "다양한 상품을 만나보세요.";
        $meta_keywords = "농산물, 신선 식품, 과일, 채소, 쇼핑몰";
        break;
}


// 본인인증, 성인인증체크
if(!$is_admin) {
    $msg = shop_member_cert_check($ca_id, 'list');
    if($msg)
        alert($msg, G5_SHOP_URL);
}

$g5['title'] = $ca['ca_name'].' - 거창한무역';


include_once(G5_MSHOP_PATH.'/_head.php');

// 스킨경로
$skin_dir = G5_MSHOP_SKIN_PATH;

if($ca['ca_mobile_skin_dir']) {
    if(preg_match('#^theme/(.+)$#', $ca['ca_mobile_skin_dir'], $match))
        $skin_dir = G5_THEME_MOBILE_PATH.'/'.G5_SKIN_DIR.'/shop/'.$match[1];
    else
        $skin_dir = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/shop/'.$ca['ca_mobile_skin_dir'];

    if(is_dir($skin_dir)) {
        $skin_file = $skin_dir.'/'.$ca['ca_mobile_skin'];

        if(!is_file($skin_file))
            $skin_dir = G5_MSHOP_SKIN_PATH;
    } else {
        $skin_dir = G5_MSHOP_SKIN_PATH;
    }
}

define('G5_SHOP_CSS_URL', str_replace(G5_PATH, G5_URL, $skin_dir));
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php echo $description; ?>">


<script>
var g5_shop_url = "<?php echo G5_SHOP_URL; ?>";
</script>
<script src="<?php echo G5_JS_URL; ?>/shop.mobile.list.js"></script>

<div id="sct">

    <?php
    // 상단 HTML
    echo '<div id="sct_hhtml">'.conv_content($ca['ca_mobile_head_html'], 1).'</div>';

    $cate_skin = $skin_dir.'/listcategory.skin.php';
    if(!is_file($cate_skin))
        $cate_skin = G5_MSHOP_SKIN_PATH.'/listcategory.skin.php';
    include $cate_skin;

    // 테마미리보기 베스트상품 재설정
    if(defined('_THEME_PREVIEW_') && _THEME_PREVIEW_ === true) {
        if(isset($theme_config['ca_mobile_list_best_mod']))
            $theme_config['ca_mobile_list_best_mod'] = (isset($tconfig['ca_mobile_list_best_mod']) && $tconfig['ca_mobile_list_best_mod']) ? $tconfig['ca_mobile_list_best_mod'] : 0;
        if(isset($theme_config['ca_mobile_list_best_row']))
            $theme_config['ca_mobile_list_best_row'] = (isset($tconfig['ca_mobile_list_best_row']) && $tconfig['ca_mobile_list_best_row']) ? $tconfig['ca_mobile_list_best_row'] : 0;
    }

    // 분류 Best Item
    $list_mod = (isset($theme_config['ca_mobile_list_best_mod']) && $theme_config['ca_mobile_list_best_mod']) ? (int)$theme_config['ca_mobile_list_best_mod'] : $ca['ca_mobile_list_mod'];
    $list_row = (isset($theme_config['ca_mobile_list_best_row']) && $theme_config['ca_mobile_list_best_row']) ? (int)$theme_config['ca_mobile_list_best_row'] : $ca['ca_mobile_list_row'];
    $limit = $list_mod * $list_row;
    $best_skin = G5_MSHOP_SKIN_PATH.'/list.best.10.skin.php';

    $sql = " select *
                from {$g5['g5_shop_item_table']}
                where ( ca_id like '$ca_id%' or ca_id2 like '$ca_id%' or ca_id3 like '$ca_id%' )
                  and it_use = '1'
                  and it_type4 = '1'
                order by it_order, it_id desc
                limit 0, $limit ";

    $list = new item_list($best_skin, $list_mod, $list_row, $ca['ca_mobile_img_width'], $ca['ca_mobile_img_height']);
    $list->set_query($sql);
    $list->set_mobile(true);
    $list->set_view('it_img', true);
    $list->set_view('it_id', false);
    $list->set_view('it_name', true);
    $list->set_view('it_price', true);
    echo $list->run();

    // 상품 출력순서가 있다면
    if ($sort != "")
        $order_by = $sort.' '.$sortodr.' , it_order, it_id desc';
    else
        $order_by = 'it_order, it_id desc';

    $error = '<p class="sct_noitem">등록된 상품이 없습니다.</p>';

    // 리스트 스킨
    $skin_file = is_include_path_check($skin_dir.'/'.$ca['ca_mobile_skin']) ? $skin_dir.'/'.$ca['ca_mobile_skin'] : $skin_dir.'/list.10.skin.php';

    if (file_exists($skin_file)) {

        echo '<div id="sct_sortlst">';

        $sort_skin = $skin_dir.'/list.sort.skin.php';
        if(!is_file($sort_skin))
            $sort_skin = G5_MSHOP_SKIN_PATH.'/list.sort.skin.php';
        include $sort_skin;
    
            // 상품 보기 타입 변경 버튼
        $sub_skin = $skin_dir.'/list.sub.skin.php';
        if(!is_file($sub_skin))
            $sub_skin = G5_MSHOP_SKIN_PATH.'/list.sub.skin.php';

        if(is_file($sub_skin)){
            include $sub_skin;
        }

        echo '</div>';

        // 총몇개
        $items = $ca['ca_mobile_list_mod'] * $ca['ca_mobile_list_row'];
        // 페이지가 없으면 첫 페이지 (1 페이지)
        if ($page < 1) $page = 1;
        // 시작 레코드 구함
        $from_record = ($page - 1) * $items;

        $list = new item_list($skin_file, $ca['ca_mobile_list_mod'], $ca['ca_mobile_list_row'], $ca['ca_mobile_img_width'], $ca['ca_mobile_img_height']);
        $list->set_category($ca['ca_id'], 1);
        $list->set_category($ca['ca_id'], 2);
        $list->set_category($ca['ca_id'], 3);
        $list->set_is_page(true);
        $list->set_mobile(true);
        $list->set_order_by($order_by);
        $list->set_from_record($from_record);
        $list->set_view('it_img', true);
        $list->set_view('it_id', false);
        $list->set_view('it_name', true);
        $list->set_view('it_price', true);
        $list->set_view('sns', true);
        $list->set_view('it_icon', true);
        echo $list->run();

        // where 된 전체 상품수
        $total_count = $list->total_count;
    }
    else
    {
        echo '<div class="sct_nofile">'.str_replace(G5_PATH.'/', '', $skin_file).' 파일을 찾을 수 없습니다.<br>관리자에게 알려주시면 감사하겠습니다.</div>';
    }
    ?>

    <?php
    $qstr1 = '';
    if($i > 0 && $total_count > $items) {
        $qstr1 .= 'ca_id='.$ca_id;
        $qstr1 .='&sort='.$sort.'&sortodr='.$sortodr;
        $ajax_url = G5_SHOP_URL.'/ajax.list.php?'.$qstr1.'&use_sns=1';
    ?>
    <div class="li_more">
        <p id="item_load_msg"><img src="<?php echo G5_SHOP_CSS_URL; ?>/img/loading.gif" alt="로딩이미지" ><br>잠시만 기다려주세요.</p>
        <div class="li_more_btn">
            <button type="button" id="btn_more_item" data-url="<?php echo $ajax_url; ?>" data-page="<?php echo $page; ?>">더보기 +</button>
        </div>
    </div>
    <?php } ?>

    <?php
    // 하단 HTML
    echo '<div id="sct_thtml">'.conv_content($ca['ca_mobile_tail_html'], 1).'</div>';
    ?>
</div>

<?php
include_once(G5_MSHOP_PATH.'/_tail.php');

echo "\n<!-- {$ca['ca_mobile_skin']} -->\n";
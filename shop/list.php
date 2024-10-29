<?php
include_once('./_common.php');

$ca_id = isset($_REQUEST['ca_id']) ? safe_replace_regex($_REQUEST['ca_id'], 'ca_id') : '';
$skin = isset($_REQUEST['skin']) ? safe_replace_regex($_REQUEST['skin'], 'skin') : '';


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



// 상품 리스트에서 다른 필드로 정렬을 하려면 아래의 배열 코드에서 해당 필드를 추가하세요.
if( isset($sort) && ! in_array($sort, array('it_name', 'it_sum_qty', 'it_price', 'it_use_avg', 'it_use_cnt', 'it_update_time')) ){
    $sort='';
}

if (G5_IS_MOBILE) {
    include_once(G5_MSHOP_PATH.'/list.php');
    return;
}

$sql = " select * from {$g5['g5_shop_category_table']} where ca_id = '$ca_id' and ca_use = '1'  ";
$ca = sql_fetch($sql);
if (! (isset($ca['ca_id']) && $ca['ca_id']))
    alert('등록된 분류가 없습니다.');

// 테마미리보기 스킨 등의 변수 재설정
if(defined('_THEME_PREVIEW_') && _THEME_PREVIEW_ === true) {
    $ca['ca_skin']       = (isset($tconfig['ca_skin']) && $tconfig['ca_skin']) ? $tconfig['ca_skin'] : $ca['ca_skin'];
    $ca['ca_img_width']  = (isset($tconfig['ca_img_width']) && $tconfig['ca_img_width']) ? $tconfig['ca_img_width'] : $ca['ca_img_width'];
    $ca['ca_img_height'] = (isset($tconfig['ca_img_height']) && $tconfig['ca_img_height']) ? $tconfig['ca_img_height'] : $ca['ca_img_height'];
    $ca['ca_list_mod']   = (isset($tconfig['ca_list_mod']) && $tconfig['ca_list_mod']) ? $tconfig['ca_list_mod'] : $ca['ca_list_mod'];
    $ca['ca_list_row']   = (isset($tconfig['ca_list_row']) && $tconfig['ca_list_row']) ? $tconfig['ca_list_row'] : $ca['ca_list_row'];
}

// 본인인증, 성인인증체크
if(!$is_admin && $config['cf_cert_use']) {
    $msg = shop_member_cert_check($ca_id, 'list');
    if($msg)
        alert($msg, G5_SHOP_URL);
}

$g5['title'] = $ca['ca_name'].' - 거창한무역';


if ($ca['ca_include_head'] && is_include_path_check($ca['ca_include_head']))
    @include_once($ca['ca_include_head']);
else
    include_once(G5_SHOP_PATH.'/_head.php');


// 스킨경로
$skin_dir = G5_SHOP_SKIN_PATH;

if($ca['ca_skin_dir']) {
    if(preg_match('#^theme/(.+)$#', $ca['ca_skin_dir'], $match))
        $skin_dir = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/shop/'.$match[1];
    else
        $skin_dir = G5_PATH.'/'.G5_SKIN_DIR.'/shop/'.$ca['ca_skin_dir'];

    if(is_dir($skin_dir)) {
        $skin_file = $skin_dir.'/'.$ca['ca_skin'];

        if(!is_file($skin_file))
            $skin_dir = G5_SHOP_SKIN_PATH;
    } else {
        $skin_dir = G5_SHOP_SKIN_PATH;
    }
}

define('G5_SHOP_CSS_URL', str_replace(G5_PATH, G5_URL, $skin_dir));

if ($is_admin)
    echo '<div class="sct_admin"><a href="'.G5_ADMIN_URL.'/shop_admin/categoryform.php?w=u&amp;ca_id='.$ca_id.'" class="btn_admin btn"><span class="sound_only">분류 관리</span><i class="fa fa-cog fa-spin fa-fw"></i></a></div>';
?>

<script>
var itemlist_ca_id = "<?php echo $ca_id; ?>";
</script>
<script src="<?php echo G5_JS_URL; ?>/shop.list.js"></script>

<!-- 상품 목록 시작 { -->
<div id="sct">

    <?php
    $nav_skin = $skin_dir.'/navigation.skin.php';
    if(!is_file($nav_skin))
        $nav_skin = G5_SHOP_SKIN_PATH.'/navigation.skin.php';
    include $nav_skin;

    // 상단 HTML
    echo '<div id="sct_hhtml">'.conv_content($ca['ca_head_html'], 1).'</div>';

    $cate_skin = $skin_dir.'/listcategory.skin.php';
    if(!is_file($cate_skin))
        $cate_skin = G5_SHOP_SKIN_PATH.'/listcategory.skin.php';
    include $cate_skin;

    // 상품 출력순서가 있다면
    if ($sort != "")
        $order_by = $sort.' '.$sortodr.' , it_order, it_id desc';
    else
        $order_by = 'it_order, it_id desc';

    $error = '<p class="sct_noitem">등록된 상품이 없습니다.</p>';

    // 리스트 스킨
    $skin_file = is_include_path_check($skin_dir.'/'.$ca['ca_skin']) ? $skin_dir.'/'.$ca['ca_skin'] : $skin_dir.'/list.10.skin.php';

    if (file_exists($skin_file)) {

		echo '<div id="sct_sortlst">';
        $sort_skin = $skin_dir.'/list.sort.skin.php';
        if(!is_file($sort_skin))
            $sort_skin = G5_SHOP_SKIN_PATH.'/list.sort.skin.php';
        include $sort_skin;

        // 상품 보기 타입 변경 버튼
        $sub_skin = $skin_dir.'/list.sub.skin.php';
        if(!is_file($sub_skin))
            $sub_skin = G5_SHOP_SKIN_PATH.'/list.sub.skin.php';
        include $sub_skin;
        echo '</div>';

        // 총몇개 = 한줄에 몇개 * 몇줄
        $items = $ca['ca_list_mod'] * $ca['ca_list_row'];
        // 페이지가 없으면 첫 페이지 (1 페이지)
        if ($page < 1) $page = 1;
        // 시작 레코드 구함
        $from_record = ($page - 1) * $items;

        $list = new item_list($skin_file, $ca['ca_list_mod'], $ca['ca_list_row'], $ca['ca_img_width'], $ca['ca_img_height']);
        $list->set_category($ca['ca_id'], 1);
        $list->set_category($ca['ca_id'], 2);
        $list->set_category($ca['ca_id'], 3);
        $list->set_is_page(true);
        $list->set_order_by($order_by);
        $list->set_from_record($from_record);
        $list->set_view('it_img', true);
        $list->set_view('it_id', false);
        $list->set_view('it_name', true);
        $list->set_view('it_basic', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
        $list->set_view('sns', true);
        echo $list->run();

        // where 된 전체 상품수
        $total_count = $list->total_count;
        // 전체 페이지 계산
        $total_page  = ceil($total_count / $items);
    }
    else
    {
        echo '<div class="sct_nofile">'.str_replace(G5_PATH.'/', '', $skin_file).' 파일을 찾을 수 없습니다.<br>관리자에게 알려주시면 감사하겠습니다.</div>';
    }

    $qstr1 = 'ca_id='.$ca_id;
    $qstr1 .='&amp;sort='.$sort.'&amp;sortodr='.$sortodr;
    echo get_paging($config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr1.'&amp;page=');

    // 하단 HTML
    echo '<div id="sct_thtml">'.conv_content($ca['ca_tail_html'], 1).'</div>';

?>
</div>
<!-- } 상품 목록 끝 -->

<?php
if ($ca['ca_include_tail'] && is_include_path_check($ca['ca_include_tail']))
    @include_once($ca['ca_include_tail']);
else
    include_once(G5_SHOP_PATH.'/_tail.php');

echo "\n<!-- {$ca['ca_skin']} -->\n";
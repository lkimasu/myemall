<?php
include_once('./_common.php');

include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');
?>

<script src="<?php echo G5_JS_URL; ?>/swipe.js"></script>
<script src="<?php echo G5_JS_URL; ?>/shop.mobile.main.js"></script>

<div id="primary">
    
<?php echo display_banner('메인', 'mainbanner.10.skin.php'); ?>

<?php if($default['de_mobile_type4_list_use']) { ?>

   
    <div class="sct_wrap">

    <header>
            <h2 class="list"><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=4"><center>거창한무역<font color="#61ab01"> 전체상품</center></font></a></h2>
    </header>

        <?php
        $list = new item_list();
        $list->set_mobile(true);
        $list->set_type(4);
        $list->set_view('it_id', false);
        $list->set_view('it_name', true);
        $list->set_view('it_basic',true);
        $list->set_view('it_cust_price', false);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', false);
        $list->set_view('sns', false);
        echo $list->run();
        ?>
    
    <?php } ?>

    <header>
            <h2><a href="<?php echo G5_SHOP_URL; ?>/itemuselist.php" text-decoration-line: none><center>거창한무역<font color="#61ab01"> 상품후기</center></font></a></h2>
    </header>

    <?php
    include_once('./_common.php');

    $g5['title'] = '상품후기';
    include_once(G5_MSHOP_PATH.'/_head.php');

    $sql_common = " from `{$g5['g5_shop_item_use_table']}` a join `{$g5['g5_shop_item_table']}` b on (a.it_id=b.it_id) ";
    $sql_search = " where a.is_confirm = '1' ";

    if(!$sfl)
        $sfl = 'b.it_name';

    if ($stx) {
        $sql_search .= " and ( ";
        switch ($sfl) {
            case "a.it_id" :
                $sql_search .= " ($sfl like '$stx%') ";
                break;
            case "a.is_name" :
            case "a.mb_id" :
                $sql_search .= " ($sfl = '$stx') ";
                break;
            default :
                $sql_search .= " ($sfl like '%$stx%') ";
                break;
        }
        $sql_search .= " ) ";
    }

    if (!$sst) {
        $sst  = "a.is_id";
        $sod = "desc";
    }
    $sql_order = " order by $sst $sod";

    $sql = " select count(*) as cnt
            $sql_common
            $sql_search
            $sql_order ";
    $row = sql_fetch($sql);
    $total_count = $row['cnt'];

    $rows = $config['cf_mobile_page_rows'];
    $total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
    if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
    $from_record = ($page - 1) * $rows; // 시작 열을 구함

    $sql = " select *
            $sql_common
            $sql_search
            $sql_order
            limit 0, 5";
    $result = sql_query($sql);

    $itemuselist_skin = G5_MSHOP_SKIN_PATH.'/itemuselist.skin1.php';

    if(!file_exists($itemuselist_skin)) {
        echo str_replace(G5_PATH.'/', '', $itemuselist_skin).' 스킨 파일이 존재하지 않습니다.';
    } else {
        include_once($itemuselist_skin);
    }
    ?>
    </div>   

</div><!-- primary End -->

<?php
include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
?>
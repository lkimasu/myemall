<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

function get_mshop_category($ca_id, $len)
{
    global $g5;

    $sql = " select ca_id, ca_name from {$g5['g5_shop_category_table']}
                where ca_use = '1' ";
    if($ca_id)
        $sql .= " and ca_id like '$ca_id%' ";
    $sql .= " and length(ca_id) = '$len' order by ca_order, ca_id ";

    return $sql;
}
?>
<div id="category">
    <div class="ct_wr">
    <button type="button" class="close_btn1"><span class="center_text">카테고리</span><span class="sound_only">닫기</span>
    <i class="fa fa-times" aria-hidden="true"></i>
    </button>

        <div class="main_product_menu">
            <!-- 첫 번째 열: 홈, 거창한무역, 갤러리, 블로그 -->
            <ul class="cate main_menu">
                <li><a href="<?php echo G5_SHOP_URL; ?>/index.php" class="gnb_1da_cat">홈</a></li>
                <li>
                    <a href="#" class="gnb_1da_cat gnb_1dam" id="toggle_menu">거창한무역</a>
                    <ul class="sub_cate" id="mshop_submenu" style="display: none;">
                        <li><a href="/bbs/content.php?co_id=company" class="gnb_2da">회사소개</a></li>
                        <li><a href="/bbs/content.php?co_id=history" class="gnb_2da">연혁</a></li>
                        <li><a href="/bbs/content.php?co_id=maps" class="gnb_2da">오시는길</a></li>
                    </ul>
                </li>
                <li><a href="/bbs/board.php?bo_table=gallery" class="gnb_1da_cat">갤러리</a></li>
                <li><a href="https://blog.naver.com/wpdlf943" class="gnb_1da_cat">블로그</a></li>
            </ul>

            <!-- 두 번째 열: 제품 카테고리 -->
            <ul class="cate product_menu">
                <?php
                $mshop_ca_href = G5_SHOP_URL.'/list.php?ca_id=';
                $mshop_ca_res1 = sql_query(get_mshop_category('', 2));
                while($mshop_ca_row1 = sql_fetch_array($mshop_ca_res1)) {
                    echo '<li><a href="'.$mshop_ca_href.$mshop_ca_row1['ca_id'].'" class="cate_li_1_a">'.get_text($mshop_ca_row1['ca_name']).'</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<script>
$(function (){
    var $category = $("#category");

    $("#menu_open").on("click", function() {
        $category.css("display","block");
    });

    $("#category .close_btn1").on("click", function(){
        $category.css("display","none");
    });

    // 거창한무역 클릭 시 하위 메뉴 토글
    $("#toggle_menu").on("click", function(e) {
        e.preventDefault();  // 링크 기본 동작 방지
        $("#mshop_submenu").slideToggle();  // 하위 메뉴 토글
    });
});

$(document).mouseup(function (e){
    var container = $("#category");
    if(container.has(e.target).length === 0) container.hide();
});
</script>

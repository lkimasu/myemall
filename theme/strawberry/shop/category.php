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
    
    <h2>카테고리</h2><button type="button" class="close_btn"><i class="fa fa-times" aria-hidden="true"></i><span class="sound_only"> 카테고리닫기</span></button>

    <div class="ct_wr">

    <ul class="cate">
            <li class="cate_li_1">
                <a href="/index.php" class="cate_li_1_a">거창한무역</a>
                <button type="button" class="ct_sb_btn"><i class="fa fa-angle-down" aria-hidden="true"></i></button>
                <ul class="sub_cate sub_cate1">
                    <li class="cate_li_2"><a href="/bbs/content.php?co_id=company">회사소개</a></li>
                    <li class="cate_li_2"><a href="/bbs/content.php?co_id=history">연혁</a></li>
                    <li class="cate_li_2"><a href="/bbs/content.php?co_id=maps">오시는길</a></li>
                    <li class="cate_li_2"><a href="/bbs/board.php?bo_table=gallery">갤러리</a></li>
                    <li class="cate_li_2"><a href="/bbs/board.php?bo_table=story">스토리</a></li>
                </ul>
            </li>
    </ul>

        <?php
        $mshop_ca_href = G5_SHOP_URL.'/list.php?ca_id=';
        $mshop_ca_res1 = sql_query(get_mshop_category('', 2));
        for($i=0; $mshop_ca_row1=sql_fetch_array($mshop_ca_res1); $i++) {
            if($i == 0)
                echo '<ul class="cate">'.PHP_EOL;
        ?>
            <li class="cate_li_1">
                <a href="<?php echo $mshop_ca_href.$mshop_ca_row1['ca_id']; ?>" class="cate_li_1_a"><?php echo get_text($mshop_ca_row1['ca_name']); ?></a>
                <?php
                $mshop_ca_res2 = sql_query(get_mshop_category($mshop_ca_row1['ca_id'], 4));

                for($j=0; $mshop_ca_row2=sql_fetch_array($mshop_ca_res2); $j++) {
                    if($j == 0)
                        echo '<button type="button" class="ct_sb_btn"><i class="fa fa-angle-down" aria-hidden="true"></i></button><ul class="sub_cate sub_cate1">'.PHP_EOL;
                ?>
                    <li class="cate_li_2">
                        <a href="<?php echo $mshop_ca_href.$mshop_ca_row2['ca_id']; ?>"><?php echo get_text($mshop_ca_row2['ca_name']); ?></a>
                    </li>
                <?php
                }

                if($j > 0)
                    echo '</ul>'.PHP_EOL;
                ?>
            </li>
        <?php
        }

        if($i > 0)
            echo '</ul>'.PHP_EOL;
        else
            echo '<p class="no-cate">등록된 분류가 없습니다.</p>'.PHP_EOL;
        ?>
    </div>
</div>

<script>
$(function () {
    var $category = $("#category");

    // 페이지 로드 시 카테고리를 기본적으로 숨김
    $category.hide();

    // 메뉴 열기 버튼 클릭 시 카테고리 표시
    $("#menu_open").on("click", function() {
        $category.fadeIn(200); // 페이드인 효과로 카테고리를 보이게 함
    });

    // 카테고리 닫기 버튼 클릭 시 카테고리 숨기기
    $("#category .close_btn").on("click", function(){
        $category.fadeOut(200); // 페이드아웃 효과로 카테고리를 숨김
    });

    // 서브 카테고리 토글 버튼 클릭 시 서브 카테고리 보이기/숨기기
    $("#category .ct_sb_btn").on("click", function(){
        $(this).next(".sub_cate").slideToggle(200); // 서브 카테고리 페이드 토글
    });
});

// 문서 밖을 클릭하면 카테고리 숨기기
$(document).mouseup(function (e){
    var container = $("#category");
    if(container.has(e.target).length === 0)
        container.hide();
});
</script>
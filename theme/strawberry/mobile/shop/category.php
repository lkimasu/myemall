<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


function get_mshop_category($ca_id, $len)
{
    global $g5;

    $sql = "SELECT ca_id, ca_name FROM {$g5['g5_shop_category_table']}
            WHERE ca_use = '1' ";
    if ($ca_id)
        $sql .= " AND ca_id LIKE '$ca_id%' ";
    $sql .= " AND LENGTH(ca_id) = '$len' ORDER BY ca_order, ca_id ";

    return $sql;
}
?>

<div id="category" class="menu">
    <div class="cate_bg"></div>
    <div class="menu_wr">
        <button type="button" class="menu_close">
            <i class="fa fa-times" aria-hidden="true"></i>
            <span class="sound_only">카테고리닫기</span>
        </button>
        <?php echo outlogin('theme/shop_basic'); // 외부 로그인 ?>
        <div class="con">

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
            if (sql_num_rows($mshop_ca_res1)) {
                echo '<ul class="cate">'.PHP_EOL;
                while ($mshop_ca_row1 = sql_fetch_array($mshop_ca_res1)) {
                    ?>
                    <li>
                        <a href="<?php echo $mshop_ca_href.$mshop_ca_row1['ca_id']; ?>" title="<?php echo get_text($mshop_ca_row1['ca_name']); ?>"><?php echo get_text($mshop_ca_row1['ca_name']); ?></a>
                        <?php
                        $mshop_ca_res2 = sql_query(get_mshop_category($mshop_ca_row1['ca_id'], 4));
                        if (sql_num_rows($mshop_ca_res2)) {
                            echo '<button class="sub_ct_toggle ct_op">'.get_text($mshop_ca_row1['ca_name']).' 하위분류 열기</button>'.PHP_EOL;
                            echo '<ul class="sub_cate sub_cate1">'.PHP_EOL;
                            while ($mshop_ca_row2 = sql_fetch_array($mshop_ca_res2)) {
                                ?>
                                <li>
                                    <a href="<?php echo $mshop_ca_href.$mshop_ca_row2['ca_id']; ?>" title="<?php echo get_text($mshop_ca_row2['ca_name']); ?>"><?php echo get_text($mshop_ca_row2['ca_name']); ?></a>
                                    <?php
                                    $mshop_ca_res3 = sql_query(get_mshop_category($mshop_ca_row2['ca_id'], 6));
                                    if (sql_num_rows($mshop_ca_res3)) {
                                        echo '<button type="button" class="sub_ct_toggle ct_op">'.get_text($mshop_ca_row2['ca_name']).' 하위분류 열기</button>'.PHP_EOL;
                                        echo '<ul class="sub_cate sub_cate2">'.PHP_EOL;
                                        while ($mshop_ca_row3 = sql_fetch_array($mshop_ca_res3)) {
                                            ?>
                                            <li>
                                                <a href="<?php echo $mshop_ca_href.$mshop_ca_row3['ca_id']; ?>" title="<?php echo get_text($mshop_ca_row3['ca_name']); ?>"><?php echo get_text($mshop_ca_row3['ca_name']); ?></a>
                                                <?php
                                                $mshop_ca_res4 = sql_query(get_mshop_category($mshop_ca_row3['ca_id'], 8));
                                                if (sql_num_rows($mshop_ca_res4)) {
                                                    echo '<button type="button" class="sub_ct_toggle ct_op">'.get_text($mshop_ca_row3['ca_name']).' 하위분류 열기</button>'.PHP_EOL;
                                                    echo '<ul class="sub_cate sub_cate3">'.PHP_EOL;
                                                    while ($mshop_ca_row4 = sql_fetch_array($mshop_ca_res4)) {
                                                        ?>
                                                        <li>
                                                            <a href="<?php echo $mshop_ca_href.$mshop_ca_row4['ca_id']; ?>" title="<?php echo get_text($mshop_ca_row4['ca_name']); ?>"><?php echo get_text($mshop_ca_row4['ca_name']); ?></a>
                                                            <?php
                                                            $mshop_ca_res5 = sql_query(get_mshop_category($mshop_ca_row4['ca_id'], 10));
                                                            if (sql_num_rows($mshop_ca_res5)) {
                                                                echo '<button type="button" class="sub_ct_toggle ct_op">'.get_text($mshop_ca_row4['ca_name']).' 하위분류 열기</button>'.PHP_EOL;
                                                                echo '<ul class="sub_cate sub_cate4">'.PHP_EOL;
                                                                while ($mshop_ca_row5 = sql_fetch_array($mshop_ca_res5)) {
                                                                    ?>
                                                                    <li>
                                                                        <a href="<?php echo $mshop_ca_href.$mshop_ca_row5['ca_id']; ?>" title="<?php echo get_text($mshop_ca_row5['ca_name']); ?>"><?php echo get_text($mshop_ca_row5['ca_name']); ?></a>
                                                                    </li>
                                                                    <?php
                                                                }
                                                                echo '</ul>'.PHP_EOL;
                                                            }
                                                            ?>
                                                        </li>
                                                        <?php
                                                    }
                                                    echo '</ul>'.PHP_EOL;
                                                }
                                                ?>
                                            </li>
                                            <?php
                                        }
                                        echo '</ul>'.PHP_EOL;
                                    }
                                    ?>
                                </li>
                                <?php
                            }
                            echo '</ul>'.PHP_EOL;
                        }
                        ?>
                    </li>
                    <?php
                }
                echo '</ul>'.PHP_EOL;
            } else {
                echo '<p>등록된 분류가 없습니다.</p>'.PHP_EOL;
            }
            ?>
        </div>
        <div class="con">
            <ul id="hd_tnb" class="cate">
                <li class="bd"><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">마이페이지</a></li>
                <li class="bd"><a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php">주문내역</a></li>
                <li class="bd"><a href="<?php echo G5_SHOP_URL; ?>/couponzone.php">쿠폰존</a></li>
                <li class="bd"><a href="<?php echo G5_BBS_URL; ?>/faq.php">FAQ</a></li>
                <li class="bd"><a href="<?php echo G5_SHOP_URL; ?>/personalpay.php">개인결제</a></li>
                <li class="bd"><a href="<?php echo G5_SHOP_URL; ?>/itemuselist.php">사용후기</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/qalist.php">1:1문의</a></li>
            </ul> 
        </div>
    </div>
</div>

<script>
$(function () {
    var $category = $("#category");

    // 버튼 클릭 시 서브 카테고리 보이기/숨기기
    $("button.sub_ct_toggle").on("click", function() {
        var $this = $(this);
        var $sub_ul = $this.closest("li").children("ul.sub_cate");

        if ($sub_ul.length > 0) {
            var txt = $this.text();
            if ($sub_ul.is(":visible")) {
                txt = txt.replace(/닫기$/, "열기");
                $this.removeClass("ct_cl").text(txt);
            } else {
                txt = txt.replace(/열기$/, "닫기");
                $this.addClass("ct_cl").text(txt);
            }
            $sub_ul.toggle();
        }
    });

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
        $(this).next(".sub_cate").slideToggle(200);
    });

    // 문서 밖을 클릭하면 카테고리 숨기기
    $(document).mouseup(function (e) {
        if ($category.has(e.target).length === 0) {
            $category.hide();
        }
    });
});

</script>

<?php
$sub_menu = '500600';
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, "r");

$where = ' where ';
$sql_search = '';

$g5['title'] = '스토리관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');

$sql_common = " from {$g5['g5_shop_story_table']} ";
$sql_common .= $sql_search;

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함
?>

<div class="btn_fixed_top">
    <a href="./storyform.php" class="btn_01 btn">스토리추가</a>
</div>

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col" id="th_id">ID</th>
        <th scope="col" id="th_dvc">제목</th>
        <th scope="col" id="th_loc">링크</th>
        <th scope="col" id="th_img">이미지</th>
        <th scope="col" id="th_mng">관리</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $sql = " select * from {$g5['g5_shop_story_table']}" ;
       
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $bimg = G5_DATA_PATH.'/story/'.$row['story_id'];
        $bn_img = '';
        if(file_exists($bimg)) {
            $size = @getimagesize($bimg);
            $width = ($size[0] && $size[0] > 800) ? 800 : $size[0];
            $bn_img .= '<img src="'.G5_DATA_URL.'/story/'.$row['story_id'].'?" width="'.$width.'" alt="'.get_text($row['story_alt']).'">';
        }

        $bg = 'bg'.($i%2);
    ?>

    <tr class="<?php echo $bg; ?>">
        <td class="td_num"><?php echo $row['story_id']; ?></td>
        <td><?php echo get_text($row['story_alt']); ?></td>
        <td><?php echo get_text($row['story_url']); ?></td>
        <td class="td_img_view sbn_img"><?php echo $bn_img; ?></td>
        <td class="td_mng">
            <a href="./storyform.php?w=u&story_id=<?php echo $row['story_id']; ?>" class="btn btn_03">수정</a>
            <a href="./storyformupdate.php?w=d&story_id=<?php echo $row['story_id']; ?>" onclick="return delete_confirm(this);" class="btn btn_02">삭제</a>
        </td>
    </tr>

    <?php
    }
    if ($i == 0) {
        echo '<tr><td colspan="5" class="empty_table">자료가 없습니다.</td></tr>';
    }
    ?>
    </tbody>
    </table>
</div>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<script>
jQuery(function($) {
    $(".sbn_img_view").on("click", function() {
        $(this).closest(".td_img_view").find(".sbn_image").slideToggle();
    });
});
</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>

<?php
$sub_menu = '500600';
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, "w");


$story_id = isset($_REQUEST['story_id']) ? preg_replace('/[^0-9]/', '', $_REQUEST['story_id']) : 0;
$story = array(
'story_id'=>0,
'story_alt'=>'',
'story_url' => "http://"
);


if ($w=="u")
{
    $html_title .= ' 수정';
    $sql = " select * from {$g5['g5_shop_story_table']} where story_id = '$story_id' ";
    $story = sql_fetch($sql);
}
else
{
    $html_title .= ' 입력';
    $story['story_url']        = "http://";
}

$g5['title'] = '스토리관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');

?>

<form name="fbanner" action="./storyformupdate.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w; ?>">
<input type="hidden" name="story_id" value="<?php echo $story_id; ?>">

<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th scope="row">이미지</th>
        <td>
            <input type="file" name="story_bimg">
            <?php
                $bimg = G5_DATA_PATH . "/story/" . (isset($story['story_id']) ? $story['story_id'] : '');
                if (!empty($story['story_id']) && file_exists($bimg)) {
                    $size = @getimagesize($bimg);
                    if($size[0] && $size[0] > 750)
                        $width = 750;
                    else
                        $width = $size[0];

                    echo '<input type="checkbox" name="story_bimg_del" value="1" id="story_bimg_del"> <label for="story_bimg_del">삭제</label>';
                    $bimg_str = '<img src="'.G5_DATA_URL.'/story/'. $story['story_id'] .'" width="'. $width .'">';
                }
                if (!empty($bimg_str)) {
                    echo '<div class="banner_or_img">';
                    echo $bimg_str;
                    echo '</div>';
                }
            ?>
        </td>
    </tr>
    <tr>
    <th scope="row"><label for="story_alt">제목</label></th>
    <td>
        <?php echo help("해당 이미지의 제목을 입력하는 곳 입니다."); ?>
        <input type="text" name="story_alt" value="<?php echo isset($story['story_alt']) ? get_text($story['story_alt']) : ''; ?>" id="story_alt" class="frm_input" size="80">
    </td>
</tr>
    <tr>
    <th scope="row"><label for="story_url">링크</label></th>
    <td>
        <?php echo help("클릭시 이동하는 주소 입니다."); ?>
        <input type="text" name="story_url" size="80" value="<?php echo isset($story['story_url']) ? get_sanitize_input($story['story_url']) : ''; ?>" id="story_url" class="frm_input">
    </td>
</tr>

    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <a href="./storylist.php" class="btn_02 btn">목록</a>
    <input type="submit" value="확인" class="btn_submit btn" accesskey="s">
</div>

</form>


<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>

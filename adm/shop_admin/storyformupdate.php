<?php
$sub_menu = '500600';
include_once('./_common.php');

check_demo();

$w = isset($_REQUEST['w']) ? $_REQUEST['w'] : '';

if ($w == 'd')
    auth_check_menu($auth, $sub_menu, "d");
else
    auth_check_menu($auth, $sub_menu, "w");

check_admin_token();

@mkdir(G5_DATA_PATH."/story", G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH."/story", G5_DIR_PERMISSION);

$story_bimg      = isset($_FILES['story_bimg']['tmp_name']) ? $_FILES['story_bimg']['tmp_name'] : '';
$story_bimg_name = isset($_FILES['story_bimg']['name']) ? $_FILES['story_bimg']['name'] : '';
$story_id        = isset($_REQUEST['story_id']) ? preg_replace('/[^0-9]/', '', $_REQUEST['story_id']) : 0;
$story_bimg_del  = isset($_POST['story_bimg_del']) ? preg_replace('/[^0-9]/', '', $_POST['story_bimg_del']) : 0;
$story_url       = isset($_POST['story_url']) ? strip_tags(clean_xss_attributes($_POST['story_url'])) : '';
$story_alt       = isset($_POST['story_alt']) ? strip_tags(clean_xss_attributes($_POST['story_alt'])) : '';

// 이미지 삭제
if ($story_bimg_del && $story_id) {
    @unlink(G5_DATA_PATH."/story/$story_id");
}

// 파일이 이미지인지 체크합니다.
if ($story_bimg || $story_bimg_name) {
    if (!preg_match('/\.(gif|jpe?g|bmp|png)$/i', $story_bimg_name)) {
        alert("이미지 파일만 업로드 할 수 있습니다.");
    }
    $timg = @getimagesize($story_bimg);
    if ($timg[2] < 1 || $timg[2] > 16) {
        alert("이미지 파일만 업로드 할 수 있습니다.");
    }
}

if ($w == "") {
    if (!$story_bimg_name) alert('배너 이미지를 업로드 하세요.');

    sql_query("ALTER TABLE {$g5['g5_shop_story_table']} AUTO_INCREMENT=1");

    $sql = "INSERT INTO {$g5['g5_shop_story_table']}
                SET story_alt = '$story_alt',
                    story_url = '$story_url'";
    sql_query($sql);

    $story_id = sql_insert_id();
} elseif ($w == "u") {
    $sql = "UPDATE {$g5['g5_shop_story_table']}
                SET story_alt = '$story_alt',
                    story_url = '$story_url'
              WHERE story_id = '$story_id'";
    sql_query($sql);

} elseif ($w == "d") {
    
    @unlink(G5_DATA_PATH."/story/$story_id");

    $sql = "DELETE FROM {$g5['g5_shop_story_table']} WHERE story_id = $story_id";
    $result = sql_query($sql);
}

// 파일 업로드 처리
if (($w == "" || $w == "u") && $_FILES['story_bimg']['name']) {
    upload_file($_FILES['story_bimg']['tmp_name'], $story_id, G5_DATA_PATH."/story");
}

// 이동 경로 설정
if ($w == "" || $w == "u") {
    goto_url("./storyform.php?w=u&story_id=$story_id");
} else {
    goto_url("./storylist.php");
}
?>

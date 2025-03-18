<?php
include_once('./_common.php');

// 특수문자 변환 함수
function specialchars_replace($str, $len=0) {
    if ($len) {
        $str = substr($str, 0, $len);
    }
    $str = str_replace(array("&", "<", ">"), array("&amp;", "&lt;", "&gt;"), $str);
    return $str;
}

// 처리할 bo_table 배열 정의
$bo_tables = ['gallery', 'story'];

header('Content-type: text/xml');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');

echo '<?xml version="1.0" encoding="utf-8" ?>'."\n";
echo '<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">'."\n";
echo '<channel>'."\n";

// 게시판 데이터 처리
foreach ($bo_tables as $bo_table) {
    // 게시판 설정 조회
    $sql = " select gr_id, bo_subject, bo_page_rows, bo_read_level, bo_use_rss_view 
             from {$g5['board_table']} where bo_table = '$bo_table' ";
    $row = sql_fetch($sql);

    // 특수문자 변환 및 기본 설정
    $subj2 = specialchars_replace($row['bo_subject'], 255);
    $lines = $row['bo_page_rows'];

    // 비회원 읽기 및 RSS 사용 여부 확인
    if ($row['bo_read_level'] >= 2 || !$row['bo_use_rss_view']) {
        continue; // 조건에 맞지 않으면 건너뜀
    }

    // 그룹 제목 조회
    $sql = " select gr_subject from {$g5['group_table']} where gr_id = '{$row['gr_id']}' ";
    $gr_row = sql_fetch($sql);
    $subj1 = specialchars_replace($gr_row['gr_subject'], 255);

    // RSS 헤더 정보 출력
    echo '<title>'.specialchars_replace($config['cf_title'].' &gt; '.$subj1.' &gt; '.$subj2).'</title>'."\n";
    echo '<link>'.specialchars_replace(get_pretty_url($bo_table)).'</link>'."\n";
    echo '<language>ko</language>'."\n";

    // 게시글 조회 및 RSS 항목 생성
    $sql = " select wr_id, wr_subject, wr_content, wr_name, wr_datetime, wr_option
             from {$g5['write_prefix']}$bo_table
             where wr_is_comment = 0
             and wr_option not like '%secret%'
             order by wr_num, wr_reply limit 0, $lines ";
    $result = sql_query($sql);

    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $file = '';
        $html = strstr($row['wr_option'], 'html') ? 1 : 0;

        if ($i === 0) {
            echo '<description>'.specialchars_replace($subj2).' ('.$row['wr_datetime'].')</description>'."\n";
        }

        $date = substr($row['wr_datetime'], 0, 10)."T".substr($row['wr_datetime'], 11, 8)."+09:00";

        echo '<item>'."\n";
        echo '<title>'.specialchars_replace($row['wr_subject']).'</title>'."\n";
        echo '<link>'.specialchars_replace(get_pretty_url($bo_table, $row['wr_id'])).'</link>'."\n";
        echo '<description><![CDATA['.$file.conv_content($row['wr_content'], $html).']]></description>'."\n";
        echo '<dc:creator>'.specialchars_replace($row['wr_name']).'</dc:creator>'."\n";
        echo '<dc:date>'.$date.'</dc:date>'."\n";
        echo '</item>'."\n";
    }
}

// 상품 데이터 처리
echo '<!-- 상품 데이터 -->'."\n";
$sql = " SELECT it_id, it_name, it_time, it_price
            FROM {$g5['g5_shop_item_table']}
            WHERE it_use = 1
            ORDER BY it_time DESC
            LIMIT 20 ";
$result = sql_query($sql);

while ($row = sql_fetch_array($result)) {
    $link = get_pretty_url('item', $row['it_id']);
    $date = substr($row['it_datetime'], 0, 10)."T".substr($row['it_datetime'], 11, 8)."+09:00";

    echo '<item>'."\n";
    echo '<title>'.specialchars_replace($row['it_name']).'</title>'."\n";
    echo '<link>'.specialchars_replace($link).'</link>'."\n";
    echo '<description><![CDATA[가격: '.number_format($row['it_price']).'원]]></description>'."\n";
    echo '<dc:date>'.$date.'</dc:date>'."\n";
    echo '</item>'."\n";
}

echo '</channel>'."\n";
echo '</rss>'."\n";

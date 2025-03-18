 
<?php
include_once('./common.php'); // 영카트5 공통 파일 포함
 
header('Content-Type: application/rss+xml; charset=UTF-8');
 
// RSS 헤더 작성
echo "<?xml version='1.0' encoding='UTF-8' ?>\n";
?>
<rss version="2.0">
  <channel>
    <title>최신 콘텐츠 - <?php echo $config['cf_title']; ?></title>
    <link><?php echo G5_URL; ?></link>
    <description><?php echo $config['cf_title']; ?>의 최신 등록 콘텐츠</description>
    <language>ko</language>
    <pubDate><?php echo date('r'); ?></pubDate>
 
    <?php
    // 1. 상품 데이터 가져오기
    $sql = "SELECT it_id, it_name, it_time, it_price
            FROM {$g5['g5_shop_item_table']}
            WHERE it_use = 1
            ORDER BY it_time DESC
            LIMIT 20";
    $result = sql_query($sql);
 
    while ($row = sql_fetch_array($result)) {
        $link = G5_SHOP_URL . '/item.php?it_id=' . $row['it_id']; // 상품 링크
        $pubDate = date('r', strtotime($row['it_time'])); // 등록/수정 시간
        ?>
        <item>
          <title><?php echo htmlspecialchars($row['it_name']); ?> - ₩<?php echo number_format($row['it_price']); ?></title>
          <link><?php echo $link; ?></link>
          <description>₩<?php echo number_format($row['it_price']); ?></description>
          <pubDate><?php echo $pubDate; ?></pubDate>
        </item>
        <?php
    }
 
    // 2. 게시판 데이터 가져오기
    $bo_table = 'gallery'; // 대상 게시판 테이블
    $sql = "SELECT wr_id, wr_subject, wr_datetime, SUBSTR(wr_content, 1, 255) AS wr_content
            FROM {$g5['write_prefix']}{$bo_table}
            WHERE wr_is_comment = 0
            ORDER BY wr_datetime DESC
            LIMIT 20";
    $result = sql_query($sql);
 
    while ($row = sql_fetch_array($result)) {
        $link = G5_BBS_URL . '/board.php?bo_table=' . $bo_table . '&wr_id=' . $row['wr_id']; // 게시글 링크
        $pubDate = date('r', strtotime($row['wr_datetime'])); // 등록 시간
        ?>
        <item>
          <title><?php echo htmlspecialchars($row['wr_subject']); ?></title>
          <link><?php echo $link; ?></link>
          <description><![CDATA[<?php echo $row['wr_content']; ?>]]></description>
          <pubDate><?php echo $pubDate; ?></pubDate>
        </item>
        <?php
    }

 
    $bo_table = 'story'; // 대상 게시판 테이블
    $sql = "SELECT wr_id, wr_subject, wr_datetime, SUBSTR(wr_content, 1, 255) AS wr_content
            FROM {$g5['write_prefix']}{$bo_table}
            WHERE wr_is_comment = 0
            ORDER BY wr_datetime DESC
            LIMIT 20";
    $result = sql_query($sql);
 
    while ($row = sql_fetch_array($result)) {
        $link = G5_BBS_URL . '/board.php?bo_table=' . $bo_table . '&wr_id=' . $row['wr_id']; // 게시글 링크
        $pubDate = date('r', strtotime($row['wr_datetime'])); // 등록 시간
        ?>
        <item>
          <title><?php echo htmlspecialchars($row['wr_subject']); ?></title>
          <link><?php echo $link; ?></link>
          <description><![CDATA[<?php echo $row['wr_content']; ?>]]></description>
          <pubDate><?php echo $pubDate; ?></pubDate>
        </item>
        <?php
    }
 
    ?>
  </channel>
</rss>
 

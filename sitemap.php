<?php
// 데이터베이스 연결 파일 포함 (영카트5의 common.php를 포함)
include_once("./common.php");  // common.php 경로에 맞게 조정

// 데이터베이스 연결
$g5_path = $_SERVER['DOCUMENT_ROOT'];  // 서버의 문서 루트 경로 설정

// 사이트 맵의 헤더 부분
$xml_content = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
$xml_content .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

// 기본 사이트 URL
$base_url = "https://myemall.co.kr";  // 실제 도메인으로 변경

// 홈 페이지 추가
$xml_content .= "<url>\n";
$xml_content .= "<loc>$base_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>1.0</priority>\n";
$xml_content .= "</url>\n";

// 상품 목록 가져오기
$sql = "SELECT it_id FROM g5_shop_item WHERE it_use = 1"; // 활성화된 상품만 가져옴
$result = sql_query($sql);
while ($row = sql_fetch_array($result)) {
    $product_url = $base_url . "/shop/item.php?it_id=" . $row['it_id'];;
    $xml_content .= "<url>\n";
    $xml_content .= "<loc>$product_url</loc>\n";
    $xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
    $xml_content .= "<priority>0.8</priority>\n";
    $xml_content .= "</url>\n";
}

// 카테고리 목록 가져오기
$sql = "SELECT ca_id FROM g5_shop_category";
$result = sql_query($sql);
while ($row = sql_fetch_array($result)) {
    $category_url = $base_url . "/shop/list.php?ca_id=" . $row['ca_id'];
    $xml_content .= "<url>\n";
    $xml_content .= "<loc>$category_url</loc>\n";
    $xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
    $xml_content .= "<priority>0.7</priority>\n";
    $xml_content .= "</url>\n";
}

// 회사소개
$page_url = $base_url . "/bbs/content.php?co_id=company";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";

// 서비스 이용약관
$page_url = $base_url . "/bbs/content.php?co_id=provision";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";

// 개인정보 처리 방침
$page_url = $base_url . "/bbs/content.php?co_id=privacy";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";

//회사 연혁
$page_url = $base_url . "/bbs/content.php?co_id=history";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";

//오시는 길
$page_url = $base_url . "/bbs/content.php?co_id=maps";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";

//갤러리
$page_url = $base_url . "/bbs/board.php?bo_table=gallery";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";

//스토리
$page_url = $base_url . "/bbs/board.php?bo_table=story";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";

//공지사항
$page_url = $base_url . "/bbs/board.php?bo_table=notice";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";

$tables = ['notice', 'story', 'gallery']; // 포함할 게시판

foreach ($tables as $bo_table) {

$result = sql_query("SELECT wr_id FROM {$g5['write_prefix']}{$bo_table}"); // 게시판별로 wr_id 가져오기
    while ($row = sql_fetch_array($result)) {
        $page_url = $base_url . "/bbs/board.php?bo_table={$bo_table}&wr_id=" . $row['wr_id']; // 개별 게시물 URL
        $xml_content .= "<url>\n";
        $xml_content .= "<loc>$page_url</loc>\n"; // 개별 게시물 URL
        $xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n"; // 수정 날짜
        $xml_content .= "<priority>0.6</priority>\n"; // 게시물에 우선 순위 설정
        $xml_content .= "</url>\n";
    }
}

//상품 유형부분 추가
$page_url = $base_url . "/shop/list.php?ca_id=10";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.8</priority>\n";
$xml_content .= "</url>\n";

$page_url = $base_url . "/shop/list.php?ca_id=20";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.8</priority>\n";
$xml_content .= "</url>\n";


$page_url = $base_url . "/shop/list.php?ca_id=30";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.8</priority>\n";
$xml_content .= "</url>\n";


$page_url = $base_url . "/shop/list.php?ca_id=40";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.8</priority>\n";
$xml_content .= "</url>\n";


$page_url = $base_url . "/shop/list.php?ca_id=50";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.8</priority>\n";
$xml_content .= "</url>\n";

$page_url = $base_url . "/shop/list.php?ca_id=60";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.8</priority>\n";
$xml_content .= "</url>\n";

$page_url = $base_url . "/shop/list.php?ca_id=6010";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.8</priority>\n";
$xml_content .= "</url>\n";



//FAQ

$page_url = $base_url . "/bbs/faq.php";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";


//1:1 문의

$page_url = $base_url . "/bbs/qalist.php";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";


//개인결제

$page_url = $base_url . "/shop/personalpay.php";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";


//사용후기

$page_url = $base_url . "/shop/itemuselist.php";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";


//쿠폰존

$page_url = $base_url . "/shop/couponzone.php";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";


$page_url = $base_url . "/shop/cart.php";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";

$page_url = $base_url . "/register.php";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";


$page_url = $base_url . "/bbs/password_lost.php";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";


$page_url = $base_url . "/bbs/login.php";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";

$page_url = $base_url . "/bbs/content.php";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";


$page_url = $base_url . "/bbs/board.php";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";


$page_url = $base_url . "/shop/itemqalist.php";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";

$page_url = $base_url . "/shop/listtype.php?type=1";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";

$page_url = $base_url . "/shop/listtype.php?type=2";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";

$page_url = $base_url . "/shop/listtype.php?type=3";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";

$page_url = $base_url . "/shop/listtype.php?type=3";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";


$page_url = $base_url . "/shop/listtype.php?type=4";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";


$page_url = $base_url . "/shop/listtype.php?type=5";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";

$page_url = $base_url . "/shop/listtype.php?type=6";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";

$page_url = $base_url . "/shop/listtype.php?type=6";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";

$page_url = $base_url . "/shop/listtype.php?type=7";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";

$page_url = $base_url . "/shop/listtype.php?type=8";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";


$page_url = $base_url . "/shop/listtype.php?type=9";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";


$page_url = $base_url . "/shop/listtype.php?type=10";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";


$page_url = $base_url . "/shop/listtype.php?type=11";
$xml_content .= "<url>\n";
$xml_content .= "<loc>$page_url</loc>\n";
$xml_content .= "<lastmod>" . date('Y-m-d') . "</lastmod>\n";
$xml_content .= "<priority>0.5</priority>\n";
$xml_content .= "</url>\n";


// 사이트 맵 XML 끝
$xml_content .= "</urlset>\n";

// 파일로 저장
file_put_contents("sitemap.xml", $xml_content);

// 성공 메시지 (파일 저장 확인)
echo "사이트 맵이 'sitemap.xml' 파일로 저장되었습니다.";
?>

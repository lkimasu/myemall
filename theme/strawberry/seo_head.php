<?php
//////////////////////////////////////////////////////////////////////
////////////////////////////// SEO 시작 //////////////////////////////
//////////////////////////////////////////////////////////////////////

// 공통 설정
$seo_Author = "유씨네 농장"; // 제작자/운영사 이름
$seo_Publisher = "유씨네 농장"; // 발행자 이름
$seo_theme_color = "#0a81a8"; // 브라우저 테마 색상 (브랜드 색상)
$seo_language = "kr"; // 사이트 언어
$seo_locale = "ko_KR"; // 로케일 (국가+언어)
$seo_domain_addr = "https://myemall.co.kr"; // 대표 도메인

// 기본 이미지 경로
$seo_image = $seo_domain_addr . "/logo.png"; // 기본 대표 이미지
$seo_image_width = "800"; // 기본 이미지 너비
$seo_image_height = "800"; // 기본 이미지 높이

// 기본 정보 (메인 페이지)
$seo_head_title = "유씨네 농장 - 신선 과일·농산물 전문몰"; // 기본 제목
$seo_descriptionS = "유씨네 농장은 신선한 과일, 농산물, 가공식품(사과즙·양파즙)을 판매하는 전문몰입니다."; // 80자 이내
$seo_descriptionL = "유씨네 농장은 신선한 과일, 농산물, 가공식품(사과즙·양파즙)을 판매하는 전문몰입니다."; // 200자 이내
$seo_keywords = "사과, 샤인머스켓, 고구마, 양파, 사과즙, 양파즙, 샤인머스켓즙, 과일, 농산물, 산지직송, 특가상품, 과일선물세트, 흠사과, 가정용 사과, 10kg 과일, 신선채소, 수입과일, 농산물 쇼핑몰, 즙 선물세트, 5kg 과일"; // 키워드 목록


// Canonical URL 설정
$canonical_url = $seo_domain_addr; // 기본 도메인
if (isset($it_id)) {
    $canonical_url .= '/shop/item.php?it_id=' . $it_id; // 상품 상세 페이지 URL
} elseif (isset($ca_id)) {
    $canonical_url .= '/shop/list.php?ca_id=' . $ca_id; // 카테고리 페이지 URL
} else {
    $canonical_url .= strtok($_SERVER['REQUEST_URI'], '?'); // 기본 페이지 URL
}

// 페이지별 SEO 처리
if (isset($it_id)) { // 상품 상세 페이지
    $seo_qry = sql_query("SELECT * FROM {$g5['g5_shop_item_table']} WHERE it_id='{$it_id}'");
    $seo_row = sql_fetch_array($seo_qry);

    if ($seo_row) {
        $seo_head_title = $seo_row['it_name'] . " - 유씨네 농장"; // 상품명
        $seo_descriptionS = cut_str(strip_tags($seo_row['it_basic']), 80) . " | 유씨네 농장에서 가격, 배송, 후기 등 상품 관련 다양한 정보를 확인해보세요!"; // 상품 설명 (짧게)
        $seo_descriptionL = cut_str(strip_tags($seo_row['it_basic']), 200) . " | 유씨네 농장에서 가격, 배송, 후기 등 상품 관련 다양한 정보를 확인해보세요!"; // 상품 설명 (자세히)
        $seo_keywords = "{$seo_row['it_name']}, {$seo_row['it_maker']}, {$seo_row['it_brand']}"; // 키워드
        $seo_image = "{$seo_domain_addr}/data/item/{$seo_row['it_id']}_m"; // 상품 썸네일 이미지
    }
} elseif (isset($ca_id)) { // 카테고리 페이지

    // 기본값 설정
    $seo_head_title = "유씨네 농장 - 다양한 상품 쇼핑몰";
    $seo_descriptionS = "유씨네 농장에서 다양한 상품을 만나보세요.";
    $seo_descriptionL = "유씨네 농장에서는 다양한 상품을 제공하며, 신선하고 품질 좋은 상품을 구매할 수 있습니다.";
    $seo_keywords = "유씨네 농장, 쇼핑몰, 다양한 상품";

    // 카테고리 정보 가져오기
    $category_qry = sql_query("SELECT * FROM {$g5['g5_shop_category_table']} WHERE ca_id='{$ca_id}'");
    $category_row = sql_fetch_array($category_qry);

    if ($category_row) {
        $seo_head_title = $category_row['ca_name']; // 카테고리 이름
        $seo_descriptionS = "다양한 {$category_row['ca_name']} 상품을 유씨네 농장에서 만나보세요.";
        $seo_keywords = "{$category_row['ca_name']}, 상품, 쇼핑몰";

        // 정렬 기준 추가
        if (isset($_GET['sort']) && isset($_GET['sortodr'])) {
            $sort = $_GET['sort'];
            $sortodr = $_GET['sortodr'];

            if ($sort === 'it_sum_qty' && $sortodr === 'desc') {
                $seo_descriptionS .= " 판매량이 많은 순으로 정렬된 상품들을 확인하세요.";
            } elseif ($sort === 'it_price' && $sortodr === 'asc') {
                $seo_descriptionS .= " 가격이 낮은 순으로 정렬된 상품들을 확인하세요.";
            } elseif ($sort === 'it_price' && $sortodr === 'desc') {
                $seo_descriptionS .= " 가격이 높은 순으로 정렬된 상품들을 확인하세요.";
            } elseif ($sort === 'it_use_avg' && $sortodr === 'desc'){
                $seo_descriptionS .= " 평점이 높은 순으로 정렬된 상품들을 확인하세요.";
            } elseif ($sort === 'it_use_cnt' && $sortodr === 'desc'){
                $seo_descriptionS .= " 후기가 많은 순으로 정렬된 상품들을 확인하세요.";
            } elseif ($sort === 'it_update_time' && $sortodr === 'desc') {
                $seo_descriptionS .= " 최근 등록된 상품들을 확인하세요.";
            }
        }
    }
}

// 회사 소개 페이지
if (strpos($_SERVER['REQUEST_URI'], 'content.php?co_id=company') !== false) {
    $seo_head_title = "회사 소개 - 유씨네 농장";
    $seo_descriptionS = "유씨네 농장은 경남 거창에서 신선한 과일과 채소를 산지 직송으로 제공하는 신뢰받는 쇼핑몰입니다. 회사 연혁과 비전을 확인하세요.";
    $seo_descriptionL = "유씨네 농장은 경남 거창에서 신선한 과일과 채소를 산지 직송으로 제공하는 신뢰받는 쇼핑몰입니다. 우리의 연혁과 목표는 고객에게 최상의 품질과 서비스를 제공하는 데 중점을 둡니다.";
    $seo_keywords = "유씨네 농장, 회사 소개, 연혁, 비전, 경남 거창, 신선식품, 산지 직송";
}

// 연혁 페이지
if (strpos($_SERVER['REQUEST_URI'], 'content.php?co_id=history') !== false) {
    $seo_head_title = "회사 연혁 - 유씨네 농장";
    $seo_descriptionS = "유씨네 농장의 주요 연혁을 소개합니다. 신뢰받는 신선식품 브랜드로의 성장 과정을 확인하세요.";
    $seo_descriptionL = "유씨네 농장은 고객 신뢰를 바탕으로 지속 성장해온 신선식품 유통 전문 기업입니다. 주요 연혁과 성과를 확인하세요.";
    $seo_keywords = "유씨네 농장, 회사 연혁, 성장 스토리, 신선식품, 브랜드 역사";
}

// 오시는 길 페이지
if (strpos($_SERVER['REQUEST_URI'], 'content.php?co_id=maps') !== false) {
    $seo_head_title = "오시는 길 - 유씨네 농장";
    $seo_descriptionS = "유씨네 농장 본사와 매장 위치를 안내합니다. 정확한 주소와 연락처 정보를 확인하세요.";
    $seo_descriptionL = "유씨네 농장의 본사 및 매장 방문을 위한 교통 정보를 제공합니다. 위치와 연락처 정보를 통해 손쉽게 찾아오실 수 있습니다.";
    $seo_keywords = "유씨네 농장, 오시는 길, 매장 위치, 본사 주소, 경남 거창";
}

// 공지사항
if (strpos($_SERVER['REQUEST_URI'], 'board.php?bo_table=notice') !== false) {
    $seo_head_title = "공지사항 - 유씨네 농장";
    $seo_descriptionS = "유씨네 농장의 최신 소식과 공지를 확인하세요. 새로운 소식과 중요한 안내를 전달드립니다.";
    $seo_keywords = "유씨네 농장, 공지사항, 최신 소식, 안내";
}

// 스토리
if (strpos($_SERVER['REQUEST_URI'], 'board.php?bo_table=story') !== false) {
    $seo_head_title = "스토리 - 유씨네 농장";
    $seo_descriptionS = "유씨네 농장의 이야기를 소개합니다. 상품 이야기와 회사의 철학을 함께 나누세요.";
    $seo_keywords = "유씨네 농장, 스토리, 상품 이야기, 회사 철학, 농산물 이야기";
}

// 갤러리
if (strpos($_SERVER['REQUEST_URI'], 'board.php?bo_table=gallery') !== false) {
    $seo_head_title = "갤러리 - 유씨네 농장";
    $seo_descriptionS = "유씨네 농장의 다양한 상품과 활동 사진을 확인하세요. 생생한 현장의 모습을 담았습니다.";
    $seo_keywords = "유씨네 농장, 갤러리, 상품 사진, 활동 사진, 현장 스케치";
}

if ($wr_id) {
    // 데이터베이스에서 wr_subject를 가져옴
    $seo_qry = sql_query("SELECT wr_subject FROM {$g5['write_prefix']}{$bo_table} WHERE wr_id='{$wr_id}'");
    $seo_row = sql_fetch_array($seo_qry);

    // wr_subject가 존재할 경우 SEO 정보 설정
    if (!empty($seo_row['wr_subject'])) {
        $seo_head_title = $seo_row['wr_subject'] . " | 유씨네 농장"; // 페이지 제목
        $seo_descriptionS = $seo_row['wr_subject'] . "에 대한 자세한 정보를 확인하세요. 유씨네 농장에서 제공하는 상품."; // 설명
        $seo_keywords = "유씨네 농장, " . $seo_row['wr_subject'] . ", 상품 정보, 갤러리,스토리"; // 키워드
    } else {
        // wr_subject가 없을 경우 기본값 설정
        $seo_head_title = "기본 제목 | 유씨네 농장";
        $seo_descriptionS = "기본 설명입니다. 유씨네 농장에서 다양한 상품 정보를 확인하세요.";
        $seo_keywords = "유씨네 농장, 기본, 상품 정보, 갤러리,스토리";
    }
}

// 오늘 날짜
$seo_datetime = date("Y-m-d");

// 메타 태그 출력
echo "<meta http-equiv=\"content-language\" content=\"{$seo_language}\">\r\n";
echo "<link rel=\"canonical\" href=\"{$canonical_url}\">\r\n";

echo "<meta name=\"Author\" content=\"{$seo_Author}\">\r\n";
echo "<meta name=\"Publisher\" content=\"{$seo_Publisher}\">\r\n";
echo "<meta name=\"copyright\" content=\"{$seo_Publisher}\">\r\n";
echo "<meta name=\"title\" content=\"{$seo_head_title}\">\r\n";
echo "<meta name=\"description\" content=\"{$seo_descriptionS}\">\r\n";
echo "<meta name=\"keywords\" content=\"{$seo_keywords}\">\r\n";

echo "<meta name=\"theme-color\" content=\"{$seo_theme_color}\">\r\n";

echo "<meta property=\"og:locale\" content=\"{$seo_locale}\">\r\n";
echo "<meta property=\"og:type\" content=\"website\">\r\n";
echo "<meta property=\"og:site_name\" content=\"{$seo_head_title}\">\r\n";
echo "<meta property=\"og:title\" content=\"{$seo_head_title}\">\r\n";
echo "<meta property=\"og:description\" content=\"{$seo_descriptionS}\">\r\n";
echo "<meta property=\"og:url\" content=\"{$seo_domain_addr}{$_SERVER['REQUEST_URI']}\">\r\n";
if ($seo_image) {
    echo "<meta property=\"og:image\" content=\"{$seo_image}\">\r\n";
    echo "<meta property=\"og:image:width\" content=\"{$seo_image_width}\">\r\n";
    echo "<meta property=\"og:image:height\" content=\"{$seo_image_height}\">\r\n";
}

echo "<meta name=\"twitter:card\" content=\"summary_large_image\">\r\n";
echo "<meta name=\"twitter:title\" content=\"{$seo_head_title}\">\r\n";
echo "<meta name=\"twitter:description\" content=\"{$seo_descriptionS}\">\r\n";
if ($seo_image) {
    echo "<meta name=\"twitter:image\" content=\"{$seo_image}\">\r\n";
}

echo "<meta name=\"robots\" content=\"index, follow\">\r\n";

////////////////////////////// SEO 끝 //////////////////////////////
////////////////////////////////////////////////////////////////////


if (isset($it_id)) {
    $page_type = 'product'; // 상품 상세 페이지
} elseif (isset($ca_id)) {
    $page_type = 'category'; // 카테고리 페이지
} else {
    $page_type = 'main'; // 메인 페이지
}


if ($page_type === 'main') {
    echo '<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "유씨네 농장",
      "url": "https://myemall.co.kr/",
      "logo": "https://myemall.co.kr/data/common/logo_img",
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+82-70-8829-9906",
        "contactType": "general inquiry",
        "availableLanguage": ["Korean", "English"]
      },
      "sameAs": [
        "https://www.instagram.com/wpdlf943",
        "https://blog.naver.com/wpdlf943",
        "https://pf.kakao.com/_zKdQxj"
      ]
    }
    </script>';
}

if ($page_type == 'product') {
    $it_url = shop_item_url($it['it_id']); // 상품 URL 생성
    $it_img = $it['it_img1']; // 대표 이미지 URL
    $it_description = strip_tags(conv_content($it['it_basic'], 1)); // HTML 제거
    $it_price = $it['it_price']; // 상품 가격
    $it_name = $it['it_name']; // 상품 이름
    $it_sku = $it['it_id']; // 상품 SKU

    echo '<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Product",
      "name": "' . $it_name . '",
      "image": "' . $it_img . '",
      "description": "' . $it_description . '",
      "sku": "' . $it_sku . '",
      "offers": {
        "@type": "Offer",
        "url": "' . $it_url . '",
        "priceCurrency": "KRW",
        "price": "' . $it_price . '",
        "itemCondition": "https://schema.org/NewCondition",
        "availability": "https://schema.org/InStock",
        "seller": {
          "@type": "Organization",
          "name": "유씨네 농장"
        }
      }
    }
    </script>';
}


if ($page_type === 'category') {
  $category_name = $category_row['ca_name']; // 카테고리 이름
  $category_url = $seo_domain_addr . '/shop/list.php?ca_id=' . $ca_id; // 카테고리 URL
  $items = []; // 상품 데이터를 담을 배열

  // 상품 리스트 가져오기
  $item_qry = sql_query("SELECT * FROM {$g5['g5_shop_item_table']} WHERE ca_id = '{$ca_id}' LIMIT 10");
  while ($item_row = sql_fetch_array($item_qry)) {
      $items[] = [
          '@type' => 'ListItem',
          'position' => count($items) + 1,
          'url' => shop_item_url($item_row['it_id']),
          'name' => $item_row['it_name'],
          'image' => $item_row['it_img1'],
          'price' => $item_row['it_price'],
          'priceCurrency' => 'KRW',
          'availability' => 'https://schema.org/InStock'
      ];
  }

  // JSON-LD 생성
  $json_ld = [
      '@context' => 'https://schema.org',
      '@type' => 'ItemList',
      'name' => $category_name,
      'url' => $category_url,
      'itemListElement' => $items
  ];

  // JSON-LD 출력
  echo '<script type="application/ld+json">' . json_encode($json_ld, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>';
}


?>

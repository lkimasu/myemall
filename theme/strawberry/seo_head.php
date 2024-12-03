<?php
//////////////////////////////////////////////////////////////////////
////////////////////////////// SEO 시작 //////////////////////////////
//////////////////////////////////////////////////////////////////////

// 공통 설정
$seo_Author = "거창한무역"; // 제작자/운영사 이름
$seo_Publisher = "거창한무역"; // 발행자 이름
$seo_theme_color = "#0a81a8"; // 브라우저 테마 색상 (브랜드 색상)
$seo_language = "kr"; // 사이트 언어
$seo_locale = "ko_KR"; // 로케일 (국가+언어)
$seo_domain_addr = "https://myemall.co.kr/"; // 대표 도메인

// 기본 이미지 경로
$seo_image = $seo_domain_addr . "/img/default_image.png"; // 기본 대표 이미지
$seo_image_width = "800"; // 기본 이미지 너비
$seo_image_height = "800"; // 기본 이미지 높이

// 기본 정보 (메인 페이지)
$seo_head_title = "거창한무역"; // 기본 제목
$seo_descriptionS = "신선한 농수산물을 제공하는 거창한무역 쇼핑몰"; // 80자 이내
$seo_descriptionL = "거창한무역 쇼핑몰은 지역 농가와 직접 협력하여 신선하고 믿을 수 있는 농산물을 제공합니다. 사과, 양파,샤인머스켓,사과주스 등 계절 과일부터 곡물, 채소까지 다양한 제품을 합리적인 가격으로 만나보세요."; // 200자 이내
$seo_keywords = "산지직송,아오리,홍로,부사,시나노골드,프리미엄,선물세트,샤인머스켓,수출용,가정용,사과주스,착즙,햇양파,만생양파,함양양파,경남양파,양파 소,양파 대,양파 장아찌"; // 키워드 목록

// 페이지별 SEO 처리
if (isset($it_id)) { // 상품 상세 페이지
    $seo_qry = sql_query("SELECT * FROM {$g5['g5_shop_item_table']} WHERE it_id='{$it_id}'");
    $seo_row = sql_fetch_array($seo_qry);

    if ($seo_row) {
        $seo_head_title = $seo_row['it_name']; // 상품명
        $seo_descriptionS = cut_str(strip_tags($seo_row['it_basic']), 80); // 상품 설명 (짧게)
        $seo_descriptionL = cut_str(strip_tags($seo_row['it_basic']), 200); // 상품 설명 (자세히)
        $seo_keywords = "{$seo_row['it_name']}, {$seo_row['it_maker']}, {$seo_row['it_brand']}"; // 키워드
        $seo_image = "{$seo_domain_addr}/data/item/{$seo_row['it_id']}_m"; // 상품 썸네일 이미지
    }
} elseif (isset($ca_id)) { // 카테고리 페이지
    $category_qry = sql_query("SELECT * FROM {$g5['g5_shop_category_table']} WHERE ca_id='{$ca_id}'");
    $category_row = sql_fetch_array($category_qry);

    if ($category_row) {
        $seo_head_title = $category_row['ca_name']; // 카테고리 이름
        $seo_descriptionS = "다양한 {$category_row['ca_name']} 상품을 만나보세요."; // 간략 설명
        $seo_descriptionL = "다양한 {$category_row['ca_name']} 상품을 쇼핑몰에서 확인해보세요."; // 자세한 설명
        $seo_keywords = "{$category_row['ca_name']}, 상품, 쇼핑몰"; // 키워드
    }
}

// 오늘 날짜
$seo_datetime = date("Y-m-d");

// 메타 태그 출력
echo "<meta http-equiv=\"content-language\" content=\"{$seo_language}\">\r\n";
echo "<link rel=\"canonical\" href=\"{$seo_domain_addr}{$_SERVER['REQUEST_URI']}\">\r\n";

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
      "name": "거창한무역",
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
    $it_description = strip_tags(conv_content($it['it_explan'], 1)); // HTML 제거
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
          "name": "거창한무역"
        }
      }
    }
    </script>';
}

?>

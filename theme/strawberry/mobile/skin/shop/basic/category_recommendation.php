<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>카테고리별 추천 상품</title>
    <style>
        /* 기본 스타일 */
        .category-menu {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        .category-menu button {
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            cursor: pointer;
        }

        .category-menu button:hover {
            background-color: #ddd;
        }

        .category-content {
            padding: 10px;
            display: none;
        }

        .category-content.active {
            display: block;
        }

        .styled-link{
            display: block;
            width: 670px;
            height: 46px;
            margin: 20px auto 0px;
            background: #fff;
            border: 1px solid #eee;
            color: var(--font-black-color01);
            font-size: 15px;
            font-weight: 500;
            line-height: 44px;
            text-align: center;
        }


    </style>
    <script>
        // 카테고리 이름과 타입 숫자 매핑
        const categoryMap = {
            '국산과일': 6,
            '수입과일': 7,
            '과일선물': 8,
            '과일주스': 9,
            '대용량과일': 10,
            '제철과일': 11
        };

        let currentCategory = '국산과일'; // 기본값

        // 클릭 시 내용 표시
        function showCategoryContent(category) {
            // 모든 내용을 숨김
            document.querySelectorAll('.category-content').forEach(content => {
                content.style.display = 'none';
                content.classList.remove('active');
            });

            // 선택된 카테고리 내용만 표시
            const selectedContent = document.getElementById(category);
            selectedContent.style.display = 'block';
            selectedContent.classList.add('active');

            // 현재 선택된 카테고리 업데이트
            currentCategory = category;

            // 링크 업데이트
            updateLink();
        }

        // 링크 업데이트
        function updateLink() {
            const link = document.getElementById('dynamic-link');
            const type = categoryMap[currentCategory]; // 현재 카테고리에 해당하는 숫자 가져오기
            link.href = `<?php echo G5_SHOP_URL; ?>/listtype.php?type=${type}`;
        }

        // 페이지 로드 시 기본값 설정
        window.onload = function() {
            showCategoryContent('국산과일'); // 기본값으로 "국산과일" 표시
        };
    </script>
</head>
<body>

<div class="category-menu">
    <button onclick="showCategoryContent('국산과일')">국산과일</button>
    <button onclick="showCategoryContent('수입과일')">수입과일</button>
    <button onclick="showCategoryContent('과일선물')">과일 선물</button>
    <button onclick="showCategoryContent('과일주스')">과일 주스</button>
    <button onclick="showCategoryContent('대용량과일')">대용량 과일</button>
    <button onclick="showCategoryContent('제철과일')">제철 과일</button>
</div>

<!-- 각 카테고리 콘텐츠 -->
<div id="국산과일" class="category-content">
<?php
        $list = new item_list();
        $list->set_type(6);
        $list->set_view('it_img', true);
        $list->set_view('it_name', true);
        $list->set_view('it_basic', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
        $list->set_view('sns', true);
        echo $list->run();
?>
</div>
<div id="수입과일" class="category-content">
<?php
        $list = new item_list();
        $list->set_type(7);
        $list->set_view('it_img', true);
        $list->set_view('it_name', true);
        $list->set_view('it_basic', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
        $list->set_view('sns', true);
        echo $list->run();
?>
</div>
<div id="과일선물" class="category-content">
<?php
        $list = new item_list();
        $list->set_type(8);
        $list->set_view('it_img', true);
        $list->set_view('it_name', true);
        $list->set_view('it_basic', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
        $list->set_view('sns', true);
        echo $list->run();
?>
</div>
<div id="과일주스" class="category-content">
<?php
        $list = new item_list();
        $list->set_type(9);
        $list->set_view('it_img', true);
        $list->set_view('it_name', true);
        $list->set_view('it_basic', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
        $list->set_view('sns', true);
        echo $list->run();
?>
</div>
<div id="대용량과일" class="category-content">
<?php
        $list = new item_list();
        $list->set_type(10);
        $list->set_view('it_img', true);
        $list->set_view('it_name', true);
        $list->set_view('it_basic', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
        $list->set_view('sns', true);
        echo $list->run();
?>
</div>
<div id="제철과일" class="category-content">
<?php
        $list = new item_list();
        $list->set_type(11);
        $list->set_view('it_img', true);
        $list->set_view('it_name', true);
        $list->set_view('it_basic', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', true);
        $list->set_view('sns', true);
        echo $list->run();
?>
</div>

<!-- 전체 보기 링크 -->
<div class="link-container">
    <a id="dynamic-link" href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=6" class="styled-link">
        과일 전체보기(링크)
    </a>
</div>


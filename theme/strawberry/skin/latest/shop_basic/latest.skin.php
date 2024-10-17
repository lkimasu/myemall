<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>

<div class="lat">
    <div class="lat_title">
        <h2>
            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>">
                <?php echo $bo_subject ?>
            </a>
        </h2>
    </div>
    
    <ul>
    <?php for ($i=0; $i<count($list); $i++) {  ?>
        <li>
            <div class="lat_title">
                <h3> 
                    <a href="<?php echo $list[$i]['href']; ?>" title="<?php echo htmlspecialchars($list[$i]['subject']); ?>">
                        <?php 
                        if ($list[$i]['is_notice']) 
                            echo "<strong>".$list[$i]['subject']."</strong>";
                        else 
                            echo $list[$i]['subject']; 
                        
                        if ($list[$i]['comment_cnt']) 
                            echo $list[$i]['comment_cnt']; 
                        ?>
                    </a>
                </h3>
                <?php if (isset($list[$i]['icon_new']) && $list[$i]['icon_new']) echo " <span class=\"new_icon\" aria-label=\"New post\">NEW</span>"; ?>
            </div>
        </li>
    <?php } ?>
    <?php if (count($list) == 0) { // 게시물이 없을 때 ?>
    <li>게시물이 없습니다.</li>
    <?php } ?>
    </ul>
    
    <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>" class="lat_more">+ 더보기</a>
</div>

<script>
$(document).ready(function(){
    $('.lat ul').show().bxSlider({
        speed: 800,
        pager: false, 
        controls: false,
        auto: true,
        mode: 'fade'
    });
});
</script>

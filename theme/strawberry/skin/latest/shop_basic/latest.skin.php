<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>

<div class="lat">
    <ul>
    <?php for ($i=0; $i<count($list); $i++) {  ?>
        <li>
            <div class="lat_title">
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
                        
                        <div class="wr_date">
                        <?php if($list[$i]['wr_datetime']) echo date('Y-m-d', strtotime($list[$i]['wr_datetime'])); ?>
                        </div>
                
            </div>
        </li>
    <?php } ?>
    <?php if (count($list) == 0) { // 게시물이 없을 때 ?>
    <li>게시물이 없습니다.</li>
    <?php } ?>
    </ul>
    
</div>


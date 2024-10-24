<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<div id="bo_v_table"><?php echo ($board['bo_mobile_subject'] ? $board['bo_mobile_subject'] : $board['bo_subject']); ?></div>

<article id="bo_v" style="width:<?php echo $width; ?>">
    <header>
        <h1 id="bo_v_title">
            <?php
            if ($category_name) echo ($category_name ? $view['ca_name'].' | ' : ''); // 분류 출력 끝
            echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력
            ?>
        </h1>
    </header>

    <?php
    if ($view['file']['count']) {
        $cnt = 0;
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
                $cnt++;
        }
    }
     ?>
	
	<div class="view-inner">
		<section id="bo_v_info">
	        <h2>페이지 정보</h2>
	        <p class="view_nick"><i class="fa fa-user" aria-hidden="true"></i><strong><?php echo $view['name'] ?><?php if ($is_ip_view) { echo "&nbsp;($ip)"; } ?></strong></p>
	        <i class="fa fa-clock-o" aria-hidden="true"></i><span class="sound_only">작성일</span><strong><?php echo date("y-m-d H:i", strtotime($view['wr_datetime'])) ?></strong>
	        <i class="fa fa-eye" aria-hidden="true"></i><span class="sound_only">조회</span><strong><?php echo number_format($view['wr_hit']) ?>회</strong>
	        <i class="fa fa-comments-o" aria-hidden="true"></i><span class="sound_only">댓글</span><strong><?php echo number_format($view['wr_comment']) ?>건</strong>
	    </section>
	    
	    <section id="bo_v_atc">
	        <h2 id="bo_v_atc_title">본문</h2>
	
	        <?php
        // 파일 출력
        $v_img_count = count($view['file']);
        if($v_img_count) {
            echo "<div id=\"bo_v_img\">\n";

            foreach($view['file'] as $view_file) {
                echo get_file_thumbnail($view_file);
            }

            echo "</div>\n";
        }
         ?>
	
	        <div id="bo_v_con"><?php echo get_view_thumbnail($view['content']); ?></div>
	        <?php//echo $view['rich_content']; // {이미지:0} 과 같은 코드를 사용할 경우 ?>
	
	        <?php if ($is_signature) { ?><p><?php echo $signature ?></p><?php } ?>
	
	        <?php if ($scrap_href || $good_href || $nogood_href) { ?>
	        <div id="bo_v_act">
	            
	            <?php if ($good_href) { ?>
	            <span class="bo_v_act_gng">
	                <a href="<?php echo $good_href.'&amp;'.$qstr ?>" id="good_button" class="btn_b01"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><strong><?php echo number_format($view['wr_good']) ?></strong></a>
	                <b id="bo_v_act_good"></b>
	            </span>
	            <?php } ?>
	            <?php if ($nogood_href) { ?>
	            <span class="bo_v_act_gng">
	                <a href="<?php echo $nogood_href.'&amp;'.$qstr ?>" id="nogood_button" class="btn_b01"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i><strong><?php echo number_format($view['wr_nogood']) ?></strong></a>
	                <b id="bo_v_act_nogood"></b>
	            </span>
	            <?php } ?>
	        </div>
	        <?php } else {
	            if($board['bo_use_good'] || $board['bo_use_nogood']) {
	        ?>
	        <div id="bo_v_act">
	            <span class="bo_v_act_gng bo_v_act_good">
	            <?php if($board['bo_use_good']) { ?><span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><strong><?php echo number_format($view['wr_good']) ?></strong></span><?php } ?>
	            </span>
	            <span class="bo_v_act_gng bo_v_act_nogood">
	            <?php if($board['bo_use_nogood']) { ?><span><i class="fa fa-thumbs-o-down" aria-hidden="true"></i><strong><?php echo number_format($view['wr_nogood']) ?></strong></span><?php } ?>
	            </span>
	        </div>
	        <?php
	            }
	        }
	        ?>
	        <?php
	        include(G5_SNS_PATH."/view.sns.skin.php");
	        ?>
	    </section>
	    <?php
	    if ($view['link']) {
	     ?>
	    <section id="bo_v_link">
	        <h2>관련링크</h2>
	        <ul>
	        <?php
	        // 링크
	        $cnt = 0;
	        for ($i=1; $i<=count($view['link']); $i++) {
	            if ($view['link'][$i]) {
	                $cnt++;
	                $link = cut_str($view['link'][$i], 70);
	         ?>
	            <li>
	                <a href="<?php echo $view['link_href'][$i] ?>" target="_blank">
	                    링크 <i class="fa fa-link" aria-hidden="true"></i>
	                    <strong><?php echo $link ?></strong>
	                </a>
	                <span class="bo_v_link_cnt"><?php echo $view['link_hit'][$i] ?>회</span>
	            </li>
	        <?php
	            }
	        }
	         ?>
	        </ul>
	    </section>
	    <?php } ?>
	    <?php if($cnt) { ?>
	    <section id="bo_v_file">
	        <h2>첨부파일</h2>
	        <ul>
	        <?php
	        // 가변 파일
	        for ($i=0; $i<count($view['file']); $i++) {
	            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
	         ?>
	            <li>
	                <a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
	                    파일 <i class="fa fa-floppy-o" aria-hidden="true"></i>
	                    <strong> <?php echo $view['file'][$i]['source'] ?></strong>
	                    <?php echo $view['file'][$i]['content'] ?> (<?php echo $view['file'][$i]['size'] ?>)
	                </a>
	                <span class="bo_v_file_cnt"><?php echo $view['file'][$i]['download'] ?>회</span>
	                <span class="bo_v_file_data"><?php echo $view['file'][$i]['datetime'] ?></span>
	            </li>
	        <?php
	            }
	        }
	         ?>
	        </ul>
	    </section>
	    <?php } ?>
	</div>
	
    <?php
    // 코멘트 입출력
    include_once(G5_BBS_PATH.'/view_comment.php');
     ?>

    <div id="bo_v_bot">
        <?php
        ob_start();
         ?>
        <?php if ($prev_href || $next_href) { ?>
        <ul class="bo_v_nb">
            <?php if ($prev_href) { ?><li><a href="<?php echo $prev_href ?>" class="btn_b01"><i class="fa fa-chevron-left" aria-hidden="true"></i> 이전글</a></li><?php } ?>
            <?php if ($next_href) { ?><li><a href="<?php echo $next_href ?>" class="btn_b01">다음글 <i class="fa fa-chevron-right" aria-hidden="true"></i></i></a></li><?php } ?>
        </ul>
        <?php } ?>

        <ul class="bo_v_com">
            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01"><i class="fa fa-wrench" aria-hidden="true"></i> 수정</a></li><?php } ?>
            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01" onclick="del(this.href); return false;"><i class="fa fa-trash" aria-hidden="true"></i> 삭제</a></li><?php } ?>
            <?php if ($copy_href) { ?><li><a href="<?php echo $copy_href ?>" class="btn_admin" onclick="board_move(this.href); return false;"><i class="fa fa-files-o" aria-hidden="true"></i> 복사</a></li><?php } ?>
            <?php if ($move_href) { ?><li><a href="<?php echo $move_href ?>" class="btn_admin" onclick="board_move(this.href); return false;"><i class="fa fa-repeat" aria-hidden="true"></i> 이동</a></li><?php } ?>
            <?php if ($search_href) { ?><li><a href="<?php echo $search_href ?>" class="btn_b01">검색</a></li><?php } ?>
            <li><a href="<?php echo $list_href ?>" class="btn_b01"><i class="fa fa-list-ul" aria-hidden="true"></i> 목록</a></li>
            <?php if ($reply_href) { ?><li><a href="<?php echo $reply_href ?>" class="btn_b01"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 답변</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02"><i class="fa fa-pencil" aria-hidden="true"></i> 글쓰기</a></li><?php } ?>
        </ul>
        <?php
        $link_buttons = ob_get_contents();
        ob_end_flush();
         ?>
    </div>

</article>

<script>
<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    $("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }
    });
});
<?php } ?>

function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
</script>

<!-- 게시글 보기 끝 -->

<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 추천, 비추천
    $("#good_button, #nogood_button").click(function() {
        var $tx;
        if(this.id == "good_button")
            $tx = $("#bo_v_act_good");
        else
            $tx = $("#bo_v_act_nogood");

        excute_good(this.href, $(this), $tx);
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
});

function excute_good(href, $el, $tx)
{
    $.post(
        href,
        { js: "on" },
        function(data) {
            if(data.error) {
                alert(data.error);
                return false;
            }

            if(data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if($tx.attr("id").search("nogood") > -1) {
                    $tx.text("이 글을 비추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                } else {
                    $tx.text("이 글을 추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                }
            }
        }, "json"
    );
}
</script>
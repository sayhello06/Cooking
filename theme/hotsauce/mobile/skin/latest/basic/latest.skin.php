<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>
<div class="idx_notice">
    <h2><a href="<?php echo get_pretty_url($bo_table); ?>" class="lt_title"><strong><?php echo $bo_subject; ?></strong></a></h2>
    <ul>
    <?php for ($i=0; $i<count($list); $i++) { ?>
        <li>
            <?php
            //echo $list[$i]['icon_reply']." ";
            echo "<a href=\"".$list[$i]['href']."\" class=\"lt_tit\">";
            if ($list[$i]['is_notice'])
                echo "<strong>".$list[$i]['subject']."</strong>";
            else
                echo $list[$i]['subject'];

            if ($list[$i]['comment_cnt'])
                echo " <span class=\"cnt_cmt\">".$list[$i]['comment_cnt']."</span>";
				
			if (isset($list[$i]['icon_new']))    echo " " . $list[$i]['icon_new'];

            echo "</a>";
            ?>
           
            <span class="li_date"><span class="sound_only">작성일</span><?php echo $list[$i]['datetime2'] ?></span>
        </li>
        <?php }     //end for ?>
        <?php if (count($list) == 0) { //게시물이 없을 때 ?>
	    <li class="empty_lt">게시물이 없습니다.</li>
	    <?php } ?>
    </ul>
</div>
 
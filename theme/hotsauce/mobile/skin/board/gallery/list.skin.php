<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
include_once(G5_THEME_LIB_PATH.'/thumbnail2.lib.php');
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/jquery.fancylist.js"></script>

<h2 id="container_title"><span><?php echo ($board['bo_mobile_subject'] ? $board['bo_mobile_subject'] : $board['bo_subject']) ?><span class="sound_only"> 목록</span></span></h2>

<form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="spt" value="<?php echo $spt ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="sw" value="">

<!-- 게시판 목록 시작 -->
<div id="bo_gall">
	<h2>이미지 목록</h2>
    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo ($board['bo_mobile_subject'] ? $board['bo_mobile_subject'] : $board['bo_subject']) ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>

    <?php if ($is_checkbox) { ?>
    <div id="gall_allchk" class="all_chk chk_box">
        <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);" class="selec_chk">
    	<label for="chkall">
        	<span></span>
        	<b class="sound_only">현재 페이지 게시물 </b> 전체선택
        </label>
    </div>
    <?php } ?>

    <ul id="gall_ul">
        <?php
        for ($i=0; $i<count($list); $i++) {
            $file = get_file($bo_table, $list[$i]['wr_id']);
        ?>
        <li class="gall_li <?php if ($wr_id == $list[$i]['wr_id']) { ?>gall_now<?php } ?>">
        	<div class="gall_li_wr">
            	<?php if ($is_checkbox) { ?>
                <span class="gall_li_chk chk_box">
                    <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>" class="selec_chk">
                	<label for="chk_wr_id_<?php echo $i ?>">
                		<span></span>
                		<b class="sound_only"><?php echo $list[$i]['subject'] ?></b>
                	</label>
                </span>
                <?php } ?>
                
	            <span class="sound_only">
	                <?php
	                if ($wr_id == $list[$i]['wr_id'])
	                    echo "<span class=\"bo_current\">열람중</span>";
	                else
	                    echo $list[$i]['num'];
	                ?>
	            </span>

                <a href="<?php echo $list[$i]['href'] ?>" class="gall_img">
                <?php
                if ($list[$i]['is_notice']) { // 공지사항 ?>
                	<strong style="width:<?php echo $board['bo_mobile_gallery_width'] ?>px;height:<?php echo $board['bo_mobile_gallery_height'] ?>px"  class="gall_notice">공지</strong>
             	<?php
                } else {
                    $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_mobile_gallery_width'], $board['bo_mobile_gallery_height']);

                    if($thumb['src']) {
                        $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$board['bo_mobile_gallery_width'].'" height="'.$board['bo_mobile_gallery_height'].'" class="bd_img">';
                    } else {
                        $noimg = $board_skin_path.'/img/no_img.gif';
                        $img_content = '<span class="no_img"><i class="fa fa-picture-o" aria-hidden="true"></i></span>';
                    }

                    echo $img_content;
                }
                ?>
                </a>

				<div class="gall_text_href">
					<?php if ($is_category && $list[$i]['ca_name']) { ?>
                    <a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link"><?php echo $list[$i]['ca_name'] ?></a>
                    <?php } ?>
                    <a href="<?php echo $list[$i]['href'] ?>" class="gall_li_tit">
                    	<?php if (isset($list[$i]['icon_secret'])) echo $list[$i]['icon_secret']; ?>
                        <?php echo $list[$i]['subject'] ?>
                        <?php if ($list[$i]['comment_cnt']) { ?>
                    	<span class="bo_cmt">
							<span class="sound_only">댓글</span>
							<?php echo $list[$i]['comment_cnt']; ?>
							<span class="sound_only">개</span>
	                    </span>
	                    <?php } ?>
						<?php
	                    // if ($list[$i]['file']['count']) { echo '<'.$list[$i]['file']['count'].'>'; }	
	                    if ($list[$i]['icon_new']) echo "<span class=\"new_icon\">N<span class=\"sound_only\">새글</span></span>";
	                    if (isset($list[$i]['icon_hot'])) echo $list[$i]['icon_hot'];
	                    //if (isset($list[$i]['icon_file'])) echo $list[$i]['icon_file'];
	                    //if (isset($list[$i]['icon_link'])) echo $list[$i]['icon_link'];
	                    ?>
					</a>
					<div class="gall_info">
                    	<span class="sound_only">작성자 </span><?php echo $list[$i]['name'] ?>
                        <span class="sound_only">작성일 </span><span class="date"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $list[$i]['datetime2'] ?></span>
                        <span class="sound_only">조회 </span><strong><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $list[$i]['wr_hit'] ?></strong>
                        <?php if ($is_good) { ?><span class="sound_only">추천</span><strong><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <?php echo $list[$i]['wr_good'] ?></strong><?php } ?>
                        <?php if ($is_nogood) { ?><span class="sound_only">비추천</span><strong><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> <?php echo $list[$i]['wr_nogood'] ?></strong><?php } ?>
                    </div>
            	</div>
            </div>
        </li>
        <?php } ?>
        <?php if (count($list) == 0) { echo "<li class=\"empty_list\">게시물이 없습니다.</li>"; } ?>
    </ul>
</div>
<?php if ($list_href || $is_checkbox || $write_href) { ?>
<div class="bo_fx">
    <ul class="btn_bo_adm">

        <?php if ($is_checkbox) { ?>
        <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
        <li><input type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"></li>
        <li><input type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"></li>
        <?php } ?>
    </ul>

    <?php if ($rss_href || $write_href) { ?>
    <ul class="btn_bo_user">
        <?php if ($list_href) { ?>
        <li><a href="<?php echo $list_href ?>" class="btn_b01"> 목록</a></li>
        <?php } ?>
        <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01">RSS</a></li><?php } ?>
        <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">관리자</a></li><?php } ?>
        <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
    </ul>
    <?php } ?>
</div>
<?php } ?>
</form>

<script>
$(window).on("load", function() {
    $("#gall_ul").fancyList(".gall_li", "gall_clear");
});
</script>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages; ?>

<fieldset id="bo_sch">
    <legend>게시물 검색</legend>
    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <?php echo get_board_sfl_select_options($sfl); ?>
    </select>
    <input name="stx" value="<?php echo stripslashes($stx) ?>" placeholder="검색어를 입력하세요" required id="stx" class="sch_input" size="15" maxlength="20">
    <button type="submit" value="검색" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i> <span class="sound_only">검색</span></button>
    </form>
</fieldset>

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == 'copy')
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>
<!-- 게시판 목록 끝 -->

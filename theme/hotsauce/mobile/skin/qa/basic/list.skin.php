<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$qa_skin_url.'/style.css">', 0);
?>

<div id="bo_list">

    <form name="fqalist" id="fqalist" action="./qadelete.php" onsubmit="return fqalist_submit(this);" method="post">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
	
	<div id="bo_li">
		<?php if ($category_option) { ?>
	    <!-- 카테고리 시작 { -->
	    <nav id="bo_cate">
	        <h2><?php echo $qaconfig['qa_title'] ?> 카테고리</h2>
	        <ul id="bo_cate_ul">
	            <?php echo $category_option ?>
	        </ul>
	    </nav>
	    <!-- } 카테고리 끝 -->
	    <?php } ?>
	    
		<div id="bo_top_option">
			<div id="bo_list_total">
			    <span>전체 <?php echo number_format($total_count) ?>건</span>
			    <?php echo $page ?> 페이지
			</div>
	
		</div>
	    
	    <?php if ($is_checkbox) { ?>
	    <div class="all_chk chk_box">
	        <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);" class="selec_chk">
	    	<label for="chkall">
	        	<span></span>
	        	<b class="sound_only">현재 페이지 게시물 </b> 전체선택
	        </label>
	    </div>
	    <?php } ?>
	
	    <div class="list">
	        <ul>
	            <?php
	            for ($i=0; $i<count($list); $i++) {
	            ?>
	            <li class="bo_li<?php if ($is_checkbox) echo ' bo_adm'; ?>">
	                <?php if ($is_checkbox) { ?>
	                <div class="bo_chk chk_box">
	                    <input type="checkbox" name="chk_qa_id[]" value="<?php echo $list[$i]['qa_id'] ?>" id="chk_qa_id_<?php echo $i ?>" class="selec_chk">
	                	<label for="chk_qa_id_<?php echo $i ?>">
	                    	<span></span>
	                    	<b class="sound_only"><?php echo $list[$i]['subject'] ?></b>
	                    </label>
	                </div>
	                <?php } ?>
	                <div class="bo_cnt">
	                	<div>
	                		<strong class="bo_cate_link"><?php echo $list[$i]['category']; ?></strong>	
	                	</div>
	                    <a href="<?php echo $list[$i]['view_href']; ?>" class="bo_subject">
	                        <?php echo $list[$i]['subject']; ?>
	                        <?php if ($list[$i]['icon_file']) echo " <i class=\"fa fa-download\" aria-hidden=\"true\"></i>" ; ?>
	                    </a>
	                </div>
	                <div class="li_info">
	                    <span class="sound_only">작성자</span><span><?php echo $list[$i]['name']; ?></span>
	                    <span class="bo_date"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $list[$i]['date']; ?></span>
	                    <div class="li_stat <?php echo ($list[$i]['qa_status'] ? 'txt_done' : 'txt_rdy'); ?>"><?php echo ($list[$i]['qa_status'] ? '답변완료' : '답변대기'); ?></div>
	                </div>
	            </li>
	            <?php
	            }
	            ?>
	            <?php if ($i == 0) { echo '<li class="empty_list">게시물이 없습니다.</li>'; } ?>
	        </ul>
	    </div>
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
	
	    <?php if ($write_href) { ?>
	    <ul class="btn_bo_user">
	        <?php if ($list_href) { ?>
	        <li><a href="<?php echo $list_href ?>" class="btn_b01"> 목록</a></li>
	        <?php } ?>
	        <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">관리자</a></li><?php } ?>
	        <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
	    </ul>
	    <?php } ?>
	</div>
	<?php } ?>
		
    </form>
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $list_pages;  ?>

<!-- 게시판 검색 시작 { -->
<fieldset id="bo_sch">
    <legend>게시물 검색</legend>
    <form name="fsearch" method="get">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required placeholder="검색어를 입력하세요" id="stx" class="sch_input" size="15" maxlength="15">
    <button type="submit" value="검색" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i> <span class="sound_only">검색</span></button>
    </form>
</fieldset>
<!-- } 게시판 검색 끝 -->

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fqalist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_qa_id[]")
            f.elements[i].checked = sw;
    }
}

function fqalist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_qa_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다"))
            return false;
    }

    return true;
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
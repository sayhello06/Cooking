<?php
if(isset($_POST['theme']) && $_POST['theme']) {
    define('_THEME_PREVIEW_', true);
}

include_once('./_common.php');

$skin_dir = "theme/basic";

ob_start();
?>
<legend>사이트 내 전체검색</legend>
<form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">
	<label for="sch_str" class="sound_only">상품명<strong class="sound_only"> 필수</strong></label>
	<input type="text" name="q" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="sch_str" required class="frm_input" placeholder="검색어">
	<button type="submit" value="검색" id="sch_submit"><i class="fa fa-search" aria-hidden="true"></i></button>
</form>

<?php if($_POST['place'] == 'head') { ?>
<button class="sch_more_close">닫기</button>
<?php }

$content = ob_get_contents();
ob_end_clean();

echo $content;
?>

<?php
include_once('./_common.php');

define("_INDEX_", TRUE);

include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');
?>

<script src="<?php echo G5_JS_URL; ?>/swipe.js"></script>
<script src="<?php echo G5_JS_URL; ?>/shop.mobile.main.js"></script>


<!-- 메인 최신글 시작 -->
<div id="index_content">
 	<?php echo display_banner('메인', 'mainbanner.10.skin.php'); ?>
	<?php echo display_banner('왼쪽', 'boxbanner.skin.php'); ?>

	<div class="gal_tab tabs" style="float:left;width:65%;">
		<div class="pic_tab_heading" role="tablist" aria-label="Entertainment">
			<button role="tab" aria-selected="true" aria-controls="p1-tab"><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=1">히트상품</a></button>
			<button role="tab" aria-selected="false" aria-controls="p2-tab" tabindex="-1"><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=4">인기상품</a></button>
			<button role="tab" aria-selected="false" aria-controls="p3-tab" tabindex="-2"><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=5">할인상품</a></button>
		</div>
		
		<div tabindex="0" role="tabpanel" id="p1-tab" aria-labelledby="p1-tab">
			<?php if($default['de_mobile_type1_list_use']) { ?>
		        <?php
		        $list = new item_list();
		        $list->set_mobile(true);
		        $list->set_type(1);
		        $list->set_view('it_id', false);
		        $list->set_view('it_name', true);
		        $list->set_view('it_cust_price', true);
		        $list->set_view('it_price', true);
		        $list->set_view('it_icon', true);
		        $list->set_view('sns', false);
		        echo $list->run();
		        ?>
		    <?php } ?>
		</div>
		
		<div tabindex="0" role="tabpanel" id="p2-tab" aria-labelledby="p2-tab" hidden="">
		    <?php if($default['de_mobile_type4_list_use']) { ?>
		        <?php
		        $list = new item_list();
		        $list->set_mobile(true);
		        $list->set_type(4);
		        $list->set_view('it_id', false);
		        $list->set_view('it_name', true);
		        $list->set_view('it_cust_price', true);
		        $list->set_view('it_price', true);
		        $list->set_view('it_icon', true);
		        $list->set_view('sns', false);
		        echo $list->run();
		        ?>
		    <?php } ?>
	    </div>
	    
	    <div tabindex="0" role="tabpanel" id="p3-tab" aria-labelledby="p3-tab" hidden="">
			<?php if($default['de_mobile_type5_list_use']) { ?>
	        <?php
	        $list = new item_list();
	        $list->set_mobile(true);
	        $list->set_type(5);
	        $list->set_view('it_id', false);
	        $list->set_view('it_name', true);
	        $list->set_view('it_cust_price', true);
	        $list->set_view('it_price', true);
	        $list->set_view('it_icon', true);
	        $list->set_view('sns', false);
	        echo $list->run();
	        ?>
	        <?php } ?>
	    </div>
    </div>
    
    <div class="lt" style="float:left;width:35%;">
    	<div class="lt_slider">
    		<!-- 베이직 슬라이더1 { -->
			<?php if($default['de_mobile_type2_list_use']) { ?>
		    <div class="lt_slider_li">
		        <strong><a href="<?php echo shop_type_url('2'); ?>">추천상품</a></strong>
		        <?php
		        $list = new item_list();
		        $list->set_mobile(true);
		        $list->set_type(2);
		        $list->set_view('it_id', false);
		        $list->set_view('it_name', true);
		        $list->set_view('it_cust_price', true);
		        $list->set_view('it_price', true);
		        $list->set_view('it_icon', true);
		        $list->set_view('sns', false);
		        echo $list->run();
		        ?>
		    </div>
		    <?php } ?>
		    <!-- } 베이직 슬라이더1 끝 -->
			<!-- 베이직 슬라이더2 { -->
			<?php if($default['de_mobile_type3_list_use']) { ?>
		    <div class="lt_slider_li">
		        <strong><a href="<?php echo shop_type_url('3'); ?>">최신상품</a></strong>
		        <?php
		        $list = new item_list();
		        $list->set_mobile(true);
		        $list->set_type(3);
		        $list->set_view('it_id', false);
		        $list->set_view('it_name', true);
		        $list->set_view('it_cust_price', true);
		        $list->set_view('it_price', true);
		        $list->set_view('it_icon', true);
		        $list->set_view('sns', false);
		        echo $list->run();
		        ?>
		    </div>
		    <?php } ?>    
		    <!-- } 베이직 슬라이더2 끝 -->
		</div>
	</div>
	<script>
	// 각 pic_tabs 스킨에 bxSlider를 적용한다.
	$('.pic_tab_ul').each(function(idx) {
	    $('.pic_tab_heading').eq(idx).attr('id', 'pic_tab_heading_' + idx);
	
	    if($(this).find('ul').length > 1) {
	        $(this).bxSlider({
	            hideControlOnEnd: true,
	            pagerCustom: '#pic_tab_heading_' + idx
	        });
	    }
	});
	</script>
	
	<?php include_once(G5_MSHOP_SKIN_PATH.'/main.event.skin.php'); // 이벤트 ?>
	<?php include(G5_MSHOP_SKIN_PATH.'/boxtodayview.skin.php'); // 오늘 본 상품 ?>

    <!-- 커뮤니티 최신글 시작 { -->
    <section id="sidx_lat">
        <?php echo latest('theme/notice', 'notice', 4, 23); ?>
    </section>
</div>
<!-- 메인 최신글 끝 -->

<!-- 최신글 탭 스타일 -->
<script src="<?php echo G5_THEME_JS_URL ?>/latest_tab.js"></script>
<!-- 게시판 슬라이더 -->
<script>
$('.lt_slider').each(function(){
	$(this).bxSlider({
		pager:true,
		hideControlOnEnd: true,
		nextText: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
		prevText: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
	});
});
</script>

<?php
include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
?>
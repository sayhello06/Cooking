<?php
include_once('./_common.php');

define("_INDEX_", TRUE);

include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');
?>

<script src="<?php echo G5_JS_URL; ?>/swipe.js"></script>
<script src="<?php echo G5_JS_URL; ?>/shop.mobile.main.js"></script>

<?php echo display_banner('메인', 'mainbanner.10.skin.php'); ?>

<div class="idx_visual">
	<?php include_once(G5_MSHOP_SKIN_PATH.'/main.event.skin.php'); // 이벤트 ?>
	<!-- 일반게시판이벤트 { -->
    <?php
    // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
    // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수, 캐시타임, option);
    // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
    $options = array(
        'thumb_width'    => 315, // 썸네일 width
        'thumb_height'   => 315,  // 썸네일 height
    );
    echo latest('theme/event', 'event', 3, 55, 1, $options);
    ?>
    <!-- } 일반게시판이벤트 -->
</div>

<?php if($default['de_mobile_type4_list_use']) { ?>
<div class="sct_wrap">
	<h2><a href="<?php echo shop_type_url('4'); ?>">인기상품</a></h2>
    <div class="sct_slider">
    <?php
    $list = new item_list();
    $list->set_mobile(true);
    $list->set_type(4);
    $list->set_view('it_id', false);
    $list->set_view('it_name', true);
    $list->set_view('it_cust_price', false);
    $list->set_view('it_price', true);
    $list->set_view('it_icon', false);
    $list->set_view('sns', false);
    echo $list->run();
    ?>
    </div>
</div>
<?php } ?>

<?php if($default['de_mobile_type2_list_use']) { ?>
<div class="sct_wrap">
    <h2><a href="<?php echo shop_type_url('2'); ?>">추천상품</a></h2>
    <?php
    $list = new item_list();
    $list->set_mobile(true);
    $list->set_type(2);
    $list->set_view('it_id', false);
    $list->set_view('it_name', true);
    $list->set_view('it_cust_price', true);
    $list->set_view('it_price', true);
    $list->set_view('it_icon', true);
    $list->set_view('sns', true);
    echo $list->run();
    ?>
</div>
<?php } ?>

<?php if($default['de_mobile_type1_list_use']) { ?>
<div class="sct_wrap">
    <h2><a href="<?php echo shop_type_url('1'); ?>">히트상품</a></h2>
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
</div>
<?php } ?>

<?php echo display_banner('왼쪽', 'boxbanner.skin.php'); ?>

<?php if($default['de_mobile_type5_list_use']) { ?>
<div class="sct_wrap sct_bt">
    <h2><a href="<?php echo shop_type_url('5'); ?>">할인상품</a></h2>
    <?php
    $list = new item_list();
    $list->set_mobile(true);
    $list->set_type(5);
    $list->set_view('it_id', false);
    $list->set_view('it_name', true);
    $list->set_view('it_cust_price', false);
    $list->set_view('it_price', true);
    $list->set_view('it_icon', false);
    $list->set_view('sns', false);
    echo $list->run();
    ?>
</div>
<?php } ?>

<!-- 리뷰 { -->
<?php
// 상품리뷰
$sql = " select a.is_id, a.is_subject, a.is_content, a.it_id, b.it_name
            from `{$g5['g5_shop_item_use_table']}` a join `{$g5['g5_shop_item_table']}` b on (a.it_id=b.it_id)
            where a.is_confirm = '1'
            order by a.is_id desc
            limit 0, 4 ";
$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++) {
    if($i == 0) {
        echo '<div id="idx_review" class="sct_wrap sct_bt">'.PHP_EOL;
        echo '<h2><a href="'.G5_SHOP_URL.'/itemuselist.php">리뷰</a></h2>'.PHP_EOL;
        echo '<ul>'.PHP_EOL;
    }

    $review_href = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'];
?>
    <li>
		<div class="rv_cnt">	
			<a href="<?php echo $review_href; ?>" class="rv_tit"><?php echo get_text(cut_str($row['it_name'], 60)); ?></a>
			<span class="rv_rvw"><span class="rv_ico">리뷰</span><?php echo get_text(cut_str($row['is_subject'], 100)); ?></span>  
			<p><?php echo get_text(cut_str(strip_tags($row['is_content']), 90), 1); ?></p>
        </div>
        <a href="<?php echo $review_href; ?>" class="rv_img"><?php echo get_itemuselist_thumbnail($row['it_id'], $row['is_content'], 90, 65); ?></a>
    </li>
<?php
}

if($i > 0) {
    echo '</ul>'.PHP_EOL;
    echo '</div>'.PHP_EOL;
}
?>
<!-- } 리뷰 끝 -->

<?php include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php'); ?>
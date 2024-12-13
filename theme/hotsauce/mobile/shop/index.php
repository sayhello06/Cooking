<?php
include_once('./_common.php');

define("_INDEX_", TRUE);

include_once(G5_THEME_MSHOP_PATH.'/shop.head.index.php');
?>

<section id="idx_wp_section" class="idx_section">
	<div class="idx_section_inner">
		<?php echo display_banner('메인', 'mainbanner.10.skin.php'); ?>
		
		<div id="idx_bn_right" class="shop-main">
			<div id="idx_coupon">
	            <h2><a href="<?php echo G5_SHOP_URL; ?>/couponzone.php">쿠폰존</a></h2>
	            <a href="<?php echo G5_SHOP_URL; ?>/couponzone.php">
	                <img src="<?php echo G5_THEME_IMG_URL; ?>/1.jpg" alt="쿠폰존">
	            </a>
	        </div>
		</div>
		<div id="idx_bn_right" class="shop-main">
			<div id="idx_coupon"><!-- idx_event_bn -->
	            <h2><a href="<?php echo G5_SHOP_URL; ?>/couponzone.php">이벤트</a></h2>
	            <a href="<?php echo G5_SHOP_URL; ?>/couponzone.php">
	                <img src="<?php echo G5_THEME_IMG_URL; ?>/2.jpg" alt="이벤트">
	            </a>
	        </div>
		</div>
	</div>
</section>

<section id="idx_content" class="idx_section">
	<div class="idx_new idx_new_left">
		<?php include_once(G5_MSHOP_SKIN_PATH.'/main.event.skin.php'); // 이벤트 ?> 	
	    <!-- 최신글 -->
	    <?php
	    // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
	    // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
	    // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
	    echo latest('theme/basic', 'notice', 7, 18);
	    ?>
	    <!-- 최신글 -->
	</div>
	
	<div id="sbn_side_sec" class="content_box">
        <?php echo display_banner('왼쪽', 'boxbanner.skin.php'); ?>
    </div>

    <div class="idx_new idx_new_right">
	    <h2 class="con_tit"><span>NEW</span></h2>
	    <?php if($default['de_mobile_type3_list_use']) { ?>
	    <?php
	    $list = new item_list();
	    $list->set_mobile(true);
	    $list->set_type(3);
	    $list->set_view('it_id', false);
	    $list->set_view('it_name', true);
	    $list->set_view('it_cust_price', false);
	    $list->set_view('it_price', true);
	    $list->set_view('it_icon', true);
	    $list->set_view('sns', false);
	    echo $list->run();
	    ?>
	    <?php } ?>
	</div>
</section>

<section id="idx_review_sec" class="idx_section">
	<!-- 메인리뷰-->
    <?php
    // 상품리뷰
    $sql = " select a.is_id, a.is_subject, a.is_content, a.it_id, b.it_name
                from `{$g5['g5_shop_item_use_table']}` a join `{$g5['g5_shop_item_table']}` b on (a.it_id=b.it_id)
                where a.is_confirm = '1'
                order by a.is_id desc
                limit 0, 6 ";
    $result = sql_query($sql);

    for($i=0; $row=sql_fetch_array($result); $i++) {
        if($i == 0) {
            echo '<div id="idx_review">'.PHP_EOL;
            echo '<h2 class="con_tit"><a href="'.G5_SHOP_URL.'/itemuselist.php">사용후기</a></h2>'.PHP_EOL;
            echo '<ul>'.PHP_EOL;
        }

        $review_href = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'];
    ?>
        <li class="rv_<?php echo $i;?>">
            <div class="rv_wr">
                <a href="<?php echo $review_href; ?>" class="rv_img"><?php echo get_itemuselist_thumbnail($row['it_id'], $row['is_content'], 300, 300); ?></a>
                <div class="rv_txt">
                    <span class="rv_tit"><?php echo get_text(cut_str($row['is_subject'], 10)); ?></span>
                    <a href="<?php echo $review_href; ?>" class="rv_prd"><?php echo get_text(cut_str($row['it_name'], 20)); ?></a>
                    <p><?php echo get_text(cut_str(strip_tags($row['is_content']), 60), 1); ?></p>
                    <a href="<?php echo $review_href; ?>" class="prd_view">상품보기 +</a>
                </div>
            </div>
        </li>
    <?php
    }

    if($i > 0) {
        echo '</ul>'.PHP_EOL;
        echo '</div>'.PHP_EOL;
    }
    ?>
    <!-- 메인리뷰-->
</section>

<section id="idx_hot" class="idx_section">
	<?php if($default['de_mobile_type4_list_use']) { ?>
	<div class="idx_best">
	    <h2 class="con_tit"><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=4">인기상품</a></h2>
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
	<?php } ?>
</section>  
  
<section id="idx_shop">
    <h2 class="con_tit"><span>SHOP</span></h2>
    <div id="sidx" class="tab-wr">
        <ul class="tabsTit">
            <li class="tabsTab tabsHover tab-first">히트상품</li>
            <li class="tabsTab">추천상품</li>
            <li class="tabsTab tab-last">할인상품</li>
        </ul>
        <ul class="tabsCon">
            <li class="tabsList" readonly="true">
                <?php if($default['de_mobile_type1_list_use']) { ?>
                <?php
                $list = new item_list();
                $list->set_mobile(true);
                $list->set_type(1);
                $list->set_view('it_id', false);
                $list->set_view('it_name', true);
                $list->set_view('it_cust_price', false);
                $list->set_view('it_price', true);
                $list->set_view('it_icon', true);
                $list->set_view('sns', false);
                echo $list->run();
                ?>
                <?php } ?>
            </li>
            <li class="tabsList">
                <?php if($default['de_mobile_type2_list_use']) { ?>
                <?php
                $list = new item_list();
                $list->set_mobile(true);
                $list->set_type(2);
                $list->set_view('it_id', false);
                $list->set_view('it_name', true);
                $list->set_view('it_cust_price', false);
                $list->set_view('it_price', true);
                $list->set_view('it_icon', true);
                $list->set_view('sns', false);
                echo $list->run();
                ?>
                <?php } ?>
            </li>
            <li class="tabsList">
                <?php if($default['de_mobile_type5_list_use']) { ?>
                <?php
                $list = new item_list();
                $list->set_mobile(true);
                $list->set_type(5);
                $list->set_view('it_id', false);
                $list->set_view('it_name', true);
                $list->set_view('it_cust_price', false);
                $list->set_view('it_price', true);
                $list->set_view('it_icon', true);
                $list->set_view('sns', false);
                echo $list->run();
                ?>
                <?php } ?>
            </li>
		</ul>
    </div>
    <script>
    $("#sidx").UblueTabs({
        eventType:"click" 
    });
    </script>
</section>

<?php
include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
?>
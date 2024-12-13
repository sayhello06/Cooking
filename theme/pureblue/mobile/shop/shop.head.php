<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_THEME_PATH.'/js/shop_head_js.php');

?>

<header id="hd">
    <?php if ((!$bo_table || $w == 's' ) && defined('_INDEX_')) { ?><h1 id="hd_h1"><?php echo $config['cf_title'] ?></h1><?php } ?>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>
	<div id="mobile-indicator"></div>
	
    <?php if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>

    <div id="hd_wrapper">
    	<div class="m_side_gnb">
			<button class="gnb_side"><i class="fa fa-bars"></i><span class="sound_only">전체메뉴</span></button>
	    	<div id="m_sch">
	        	<button class="sch_more">
		        	<i class="fa fa-search"></i>
		        </button>
		        <fieldset id="m_hd_sch"></fieldset>
	        </div>
		</div>
		
        <div id="logo">
			<div class="logo_inner">
				<a href="<?php echo G5_SHOP_URL; ?>/">
					<span class="sound_only"><?php echo $config['cf_title']; ?></span>
					<img src="<?php echo G5_THEME_IMG_URL; ?>/mobile_logo_img.png" alt="<?php echo $config['cf_title']; ?> 메인">
				</a>
			</div>
		</div>
		
		<div class="header_ct">
			<div class="header_inner">
				<div class="hd_sch_wr">
					<fieldset id="hd_sch">
			        </fieldset>
				</div>
				<div id="tnb">
					<?php echo outlogin('theme/shop_basic'); // 외부 로그인 ?>
					<a href="<?php echo G5_SHOP_URL; ?>/cart.php" class="hd_cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="sound_only">장바구니</span><span class="cart-count"><?php echo get_boxcart_datas_count(); ?></span></a>
				</div>
    		</div>
        </div>
	</div>
</header>
<!-- } header 끝 -->
        
<div id="wrapper">
	<aside id="con_left">
		<div class="con_left_inner">
			<div id="gnb">
				<div class="gnb_side">
                	<!-- 쇼핑몰 카테고리 시작 { -->
                	<?php
					function get_mshop_category($ca_id, $len)
					{
					    global $g5;
					    $sql = " select ca_id, ca_name from {$g5['g5_shop_category_table']}
					                where ca_use = '1' ";
					    if($ca_id)
					        $sql .= " and ca_id like '$ca_id%' ";
					    $sql .= " and length(ca_id) = '$len' order by ca_order, ca_id ";	
					    return $sql;
					}

					$mshop_ca_href = G5_SHOP_URL.'/list.php?ca_id=';
					$mshop_ca_res1 = sql_query(get_mshop_category('', 2));
					for($i=0; $mshop_ca_row1=sql_fetch_array($mshop_ca_res1); $i++) {
					    if($i == 0)
					        echo '<ul class="cate">'.PHP_EOL;
					?>
				    <li>
				        <a href="<?php echo $mshop_ca_href.$mshop_ca_row1['ca_id']; ?>"><?php echo get_text($mshop_ca_row1['ca_name']); ?></a>
				        <?php
				        $mshop_ca_res2 = sql_query(get_mshop_category($mshop_ca_row1['ca_id'], 4));
				        if(sql_num_rows($mshop_ca_res2))
				            echo '<button class="sub_ct_toggle ct_op">'.get_text($mshop_ca_row1['ca_name']).' 하위분류 열기</button>'.PHP_EOL;
				
				        for($j=0; $mshop_ca_row2=sql_fetch_array($mshop_ca_res2); $j++) {
				            if($j == 0)
				                echo '<ul class="sub_cate sub_cate1">'.PHP_EOL;
				        ?>
				            <li>
				                <a href="<?php echo $mshop_ca_href.$mshop_ca_row2['ca_id']; ?>"><?php echo get_text($mshop_ca_row2['ca_name']); ?></a>
				                <?php
				                $mshop_ca_res3 = sql_query(get_mshop_category($mshop_ca_row2['ca_id'], 6));
				                if(sql_num_rows($mshop_ca_res3))
				                    echo '<button type="button" class="sub_ct_toggle ct_op">'.get_text($mshop_ca_row2['ca_name']).' 하위분류 열기</button>'.PHP_EOL;
				
				                for($k=0; $mshop_ca_row3=sql_fetch_array($mshop_ca_res3); $k++) {
				                    if($k == 0)
				                        echo '<ul class="sub_cate sub_cate2">'.PHP_EOL;
				                ?>
				                    <li>
				                        <a href="<?php echo $mshop_ca_href.$mshop_ca_row3['ca_id']; ?>"><?php echo get_text($mshop_ca_row3['ca_name']); ?></a>
				                        <?php
				                        $mshop_ca_res4 = sql_query(get_mshop_category($mshop_ca_row3['ca_id'], 8));
				                        if(sql_num_rows($mshop_ca_res4))
				                            echo '<button type="button" class="sub_ct_toggle ct_op">'.get_text($mshop_ca_row3['ca_name']).' 하위분류 열기</button>'.PHP_EOL;
				
				                        for($m=0; $mshop_ca_row4=sql_fetch_array($mshop_ca_res4); $m++) {
				                            if($m == 0)
				                                echo '<ul class="sub_cate sub_cate3">'.PHP_EOL;
				                        ?>
				                            <li>
				                                <a href="<?php echo $mshop_ca_href.$mshop_ca_row4['ca_id']; ?>"><?php echo get_text($mshop_ca_row4['ca_name']); ?></a>
				                                <?php
				                                $mshop_ca_res5 = sql_query(get_mshop_category($mshop_ca_row4['ca_id'], 10));
				                                if(sql_num_rows($mshop_ca_res5))
				                                    echo '<button type="button" class="sub_ct_toggle ct_op">'.get_text($mshop_ca_row4['ca_name']).' 하위분류 열기</button>'.PHP_EOL;
				
				                                for($n=0; $mshop_ca_row5=sql_fetch_array($mshop_ca_res5); $n++) {
				                                    if($n == 0)
				                                        echo '<ul class="sub_cate sub_cate4">'.PHP_EOL;
				                                ?>
				                                    <li>
				                                        <a href="<?php echo $mshop_ca_href.$mshop_ca_row5['ca_id']; ?>"><?php echo get_text($mshop_ca_row5['ca_name']); ?></a>
				                                    </li>
				                                <?php
				                                }
				
				                                if($n > 0)
				                                    echo '</ul>'.PHP_EOL;
				                                ?>
				                            </li>
				                        <?php
				                        }
				
				                        if($m > 0)
				                                echo '</ul>'.PHP_EOL;
				                            ?>
				                        </li>
				                    <?php
				                    }
				
				                    if($k > 0)
				                        echo '</ul>'.PHP_EOL;
				                    ?>
				                </li>
				            <?php
				            }
				
				            if($j > 0)
				                echo '</ul>'.PHP_EOL;
				            ?>
				        </li>
					    <?php
					    }
					
					if($i > 0)
					    echo '</ul>'.PHP_EOL;
					else
					    echo '<p>등록된 분류가 없습니다.</p>'.PHP_EOL;
					?>

					<script>
					$(function(){
					    $(".gnb_menu_btn").click(function(){
					        $("#m_gnb_all").show();
					    });
					});
					
					$(function (){
					
					    $("button.sub_ct_toggle").on("click", function() {
					        var $this = $(this);
					        $sub_ul = $(this).closest("li").children("ul.sub_cate");
					
					        if($sub_ul.size() > 0) {
					            var txt = $this.text();
					
					            if($sub_ul.is(":visible")) {
					                txt = txt.replace(/닫기$/, "열기");
					                $this
					                    .removeClass("ct_cl")
					                    .text(txt);
					            } else {
					                txt = txt.replace(/열기$/, "닫기");
					                $this
					                    .addClass("ct_cl")
					                    .text(txt);
					            }
					
					            $sub_ul.toggle();
					        }
					    });
					
					
					    $(".content li.con").hide();
					    $(".content li.con:first").show();   
					    $(".cate_tab li a").click(function(){
					        $(".cate_tab li a").removeClass("selected");
					        $(this).addClass("selected");
					        $(".content li.con").hide();
					        //$($(this).attr("href")).show();
					        $($(this).attr("href")).fadeIn();
					    });
					     
					});
					</script>					
            	</div>
			</div>
			<ul class="shortcut">
		    	<li><a href="<?php echo G5_BBS_URL; ?>/faq.php"><i class="fa fa-question-circle"></i> FAQ</a></li>
		        <li><a href="<?php echo G5_BBS_URL; ?>/qalist.php"><i class="fa fa-comments"></i> 1:1문의</a></li>
		        <li><a href="<?php echo G5_SHOP_URL; ?>/personalpay.php"><i class="fa fa-user-plus" aria-hidden="true"></i> 개인결제</a></li>
		        <li><a href="<?php echo G5_SHOP_URL; ?>/itemuselist.php"><i class="fa fa-pencil" aria-hidden="true"></i> 사용후기</a></li>
		        <li><a href="<?php echo G5_SHOP_URL; ?>/couponzone.php"><i class="fa fa-ticket" aria-hidden="true"></i> 쿠폰존</a></li>
		        <li><a href="<?php echo G5_URL ?>"><i class="fa fa-home" aria-hidden="true"></i> 커뮤니티</a></li>
		    </ul>
		    </div>
		<div id="bg"></div>
	</aside>
	
	<!-- con_right 시작 { -->
	<div id="con_right">
		<div id="container">
    	<?php if ((!$bo_table || $w == 's' ) && !defined('_INDEX_')) { ?><h1 id="container_title"><?php echo $g5['title'] ?></h1><?php } ?>
<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if(G5_IS_MOBILE) {
    include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');
    return;
}

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/latest.lib.php');

add_javascript('<script src="'.G5_JS_URL.'/owlcarousel/owl.carousel.min.js"></script>', 10);
add_stylesheet('<link rel="stylesheet" href="'.G5_JS_URL.'/owlcarousel/owl.carousel.css">', 0);
?>

<!-- 상단 시작 { -->
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>
    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
	} ?>
    
    <?php if ($is_admin) {  ?>
    <div id="hd_admin">
		<span class="hello_adm"><b>관리자</b>로 접속하셨습니다.</span>
    	<a href="<?php echo G5_ADMIN_URL ?>" class="admin_btn">관리자모드</a>
    </div>
    <?php }  ?>
    
    <div id="hd_menu">
        <ul>
        	<li class="hd_sc_link link_shop"><a href="<?php echo G5_SHOP_URL; ?>/">쇼핑몰</a></li>
        	<li class="hd_sc_link link_comu"><a href="<?php echo G5_URL; ?>/">커뮤니티</a></li>
            <li class="hd_menu_right link_no_mg"><a href="<?php echo shop_type_url(1); ?>">히트상품</a></li>
            <li class="hd_menu_right"><a href="<?php echo shop_type_url(2); ?>">추천상품</a></li>
            <li class="hd_menu_right"><a href="<?php echo shop_type_url(3); ?>">최신상품</a></li>
            <li class="hd_menu_right"><a href="<?php echo shop_type_url(4); ?>">인기상품</a></li>
            <li class="hd_menu_right"><a href="<?php echo shop_type_url(5); ?>">할인상품</a></li> 
        </ul>
    </div>
    <div id="hd_wrapper">
    	<div id="hd_wr">
    		<div id="logo"><a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?php echo G5_THEME_IMG_URL ?>/logo.png" alt="<?php echo $config['cf_title']; ?>"></a></div>
			<ul id="hd_qnb">
				<li>
	        		<button class="sch_btn"><i class="fa fa-search"></i><span class="sound_only">검색</span></button>
	        	</li>
	        	<li>
	        		<button class="login_btn"><i class="fa fa-user-o" aria-hidden="true"></i><span class="sound_only">로그인</span></button>
	        		<div id="member_menu">
						<div class="member_div">
							<?php echo outlogin('theme/basic'); // 외부 로그인, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>  
						</div>
					</div>
					<script>
				    $(function(){
				        $(".login_btn").click(function(){
				            $("#member_menu").toggle();
				        });
				        $(".login_cls_btn").click(function(){
				            $("#member_menu").hide();
				        });
				    });
					</script>
	        	</li>
	        	<li><a href="<?php echo G5_SHOP_URL; ?>/cart.php" class="cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="sound_only">장바구니</span><strong class="cart-num"><?php echo get_boxcart_datas_count(); ?></strong></a></li>
	        </ul> 
		</div>
		
		<div class="hd_sch_wr">
	        <fieldset id="hd_sch">
	            <legend>쇼핑몰 전체검색</legend>
	            <form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">
	            <label for="sch_str" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
	            	<div class="sch_ipt">
	            		<label for="sch_str" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
	            		<input type="text" name="q" class="sch_stx" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="sch_str" required placeholder="검색어를 입력해주세요">
	            		<button type="submit" id="sch_submit"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
	            	</div>
	            </form>
	            <button class="sch_close_btn"><span class="sound_only">닫기</span><i class="fa fa-times"></i></button>
 			</fieldset>
            <script>
            function search_submit(f) {
                if (f.q.value.length < 2) {
                    alert("검색어는 두글자 이상 입력하십시오.");
                    f.q.select();
                    f.q.focus();
                    return false;
                }
                return true;
            }
            </script>
		</div>
		<script>
	    $(function(){
	        $(".sch_btn").click(function(){
	            $(".hd_sch_wr").show();
	        });
	        $(".sch_close_btn").click(function(){
	            $(".hd_sch_wr").hide();
	        });
	    });
		</script>
	</div>
	<nav id="gnb">
		<button type="button" id="menu_open"><i class="fa fa-bars" aria-hidden="true"></i><span class="sound_only">카테고리</span></button>
		<?php include_once(G5_SHOP_SKIN_PATH.'/boxcategory.skin.php'); // 상품분류 ?>
    	<ul class="tnb_right">
            <li><a href="<?php echo G5_BBS_URL ?>/faq.php">FAQ</a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/qalist.php">1:1문의</a></li>
            <li><a href="<?php echo G5_SHOP_URL ?>/personalpay.php">개인결제</a></li>
            <li><a href="<?php echo G5_SHOP_URL ?>/itemuselist.php">사용후기</a></li> 
            <li><a href="<?php echo G5_SHOP_URL ?>/itemqalist.php">상품문의</a></li>
        </ul>
		<?php include_once(G5_THEME_SHOP_PATH.'/category.php'); // 분류 ?>
   	</nav>
</div>

<div id="wrapper">
    <!-- 콘텐츠 시작 { -->
    <div id="container">
        <?php if ((!$bo_table || $w == 's' ) && !defined('_INDEX_')) { ?><div id="wrapper_title"><span class="wt"><?php echo $g5['title'] ?></span></div><?php } ?>
        <!-- 글자크기 조정 display:none 되어 있음 시작 { -->
        <div id="text_size">
            <button class="no_text_resize" onclick="font_resize('container', 'decrease');">작게</button>
            <button class="no_text_resize" onclick="font_default('container');">기본</button>
            <button class="no_text_resize" onclick="font_resize('container', 'increase');">크게</button>
        </div>
        <!-- } 글자크기 조정 display:none 되어 있음 끝 -->
		<div id="container_inner" class="container">
			<?php include(G5_SHOP_SKIN_PATH.'/boxtodayview.skin.php'); // 오늘 본 상품 ?>
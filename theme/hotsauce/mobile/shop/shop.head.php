<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');

add_javascript('<script src="'.G5_THEME_JS_URL.'/owl.carousel.min.js"></script>', 10);
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_JS_URL.'/owl.carousel.css">', 10);

add_javascript('<script src="'.G5_THEME_JS_URL.'/jquery.flexslider.js"></script>', 10);
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_JS_URL.'/flexslider.css">', 0);

set_cart_id(0);
$tmp_cart_id = get_session('ss_cart_id');
$q = isset($_GET['q']) ? clean_xss_tags($_GET['q'], 1, 1) : '';
?>

<header id="hd">
    <?php if ((!$bo_table || $w == 's' ) && defined('_INDEX_')) { ?><h1><?php echo $config['cf_title'] ?></h1><?php } ?>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>

	<div id="hd-tnb">
		<ul class="hd-tnb-inner">
	    	<li class="bookmark"><a href="#" onclick="try{window.external.AddFavorite('<?php echo G5_SHOP_URL; ?>','<?php echo $default['de_admin_company_name']; ?>')}catch(e){alert('이 브라우저에서는 즐겨찾기 기능을 사용할 수 없습니다.\n크롬에서는 Ctrl 키와 D 키를 동시에 눌러서 즐겨찾기에 추가할 수 있습니다.')}; return false;"><i class="fa fa-bookmark" aria-hidden="true"></i>  즐겨찾기</a></li>
	        <?php if ($is_member) { ?>
	        <?php if ($is_admin) {  ?>
	        <li><a href="<?php echo G5_ADMIN_URL ?>/shop_admin"><b>관리자</b></a></li>
	        <?php } else { ?>
	        <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php">정보수정</a></li>
	        <?php } ?>
	        <li><a href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop">로그아웃</a></li>
	        <?php } else { ?>
	        <li><a href="<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo $urlencode; ?>">로그인</a></li>
	        <li><a href="<?php echo G5_BBS_URL ?>/register.php" id="snb_join">회원가입</a></li>
	        <?php } ?>
	        <li><a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php">주문/배송</a></li>
	        <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">마이페이지</a></li>
	        <li><a href="<?php echo G5_SHOP_URL; ?>/couponzone.php">쿠폰존</a></li>
	    </ul>
    </div>
    
    <div class="nav">
    	<div class="nav-inner">
    		<div id="logo"><a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?php echo G5_THEME_IMG_URL; ?>/logo.png" alt="<?php echo $config['cf_title']; ?> 메인"></a></div>
	        <div id="hd_sch">
	            <h3>쇼핑몰 검색</h3>
			    <form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">
	            <label for="sch_str" class="sound_only">상품명<strong class="sound_only"> 필수</strong></label>
	            <input type="text" name="q" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="sch_str" required class="frm_input" placeholder="검색어를 입력해주세요">
				<button type="submit" id="sch_submit"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
	            </form>
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
			<ul id="hd_icon">
	            <li><a href="<?php echo G5_SHOP_URL; ?>/cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="sound_only">장바구니</span><span class="cart-count"><?php echo get_cart_count($tmp_cart_id); ?></span></a></li>
	            <li><button type="button" id="meneu_open"><i class="fa fa-bars" aria-hidden="true"></i><span class="sound_only">전체메뉴</span></button></li>
	        </ul>
	        
	        <?php
		    $save_file = G5_DATA_PATH.'/cache/theme/hotsauce54/keyword.php';
		    if(is_file($save_file))
		        include($save_file);
		
		    if(!empty($keyword)) {
		    ?>    
		    <div id="ppl_word">
		        <h3>인기검색어</h3>
		        <ol class="slides">
		        <?php
		        $seq = 1;
		        foreach($keyword as $word) {
		        ?>
		            <li><span class="word-rank"><?php echo $seq; ?></span><a href="<?php echo G5_SHOP_URL; ?>/search.php?q=<?php echo urlencode($word); ?>"><?php echo get_text($word); ?></a></li>
		        <?php
		            $seq++;
		        }
		        ?>
		        </ol>
		        <?php if($seq > 2) { ?>
		        <div class="custom1-navigation verical-btn">
		            <a href="#" class="flex-prev">Prev</a>
		            <a href="#" class="flex-next">Next</a>
		        </div>
		        <?php } ?>
		    </div>
		    <script>
		    $(window).load(function() {
		        $('#ppl_word').flexslider({
		            animation: "slide",
		            controlNav:false,
		            slideshowSpeed:5000,
		            animationSpeed:800,
		            direction: "vertical",
		            controlsContainer: $(".custom1-controls-container"),
		            customDirectionNav: $(".custom1-navigation a")
		        });
		    });
		    </script>
		    <?php
		    }
		    ?>
        </div>
    </div>
    <?php include_once(G5_THEME_MSHOP_PATH.'/category.php'); // 분류 ?>
	<script>
    $(window).scroll(function(){
      var sticky = $('.nav'),
          scroll = $(window).scrollTop();

      if (scroll >= 10) sticky.addClass('fixed');
      else sticky.removeClass('fixed');
    });
    $("#meneu_open").on("click", function() {
        $("#category").toggle();
    });
    </script>
    </div>
</header>

<div id="container">
    <div id="container_s">

    <?php
    if(basename($_SERVER['SCRIPT_NAME']) == 'faq.php')
        $g5['title'] = '고객센터';
    ?>
	<?php if ((!$bo_table || $w == 's' ) && !defined('_INDEX_')) { ?><h1 id="container_title"><?php echo $g5['title'] ?></h1><?php } ?>
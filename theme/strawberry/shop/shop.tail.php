<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
    return;
}

$admin = get_admin("super");

// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>

    </div>
    <!-- } 콘텐츠 끝 -->

<!-- 하단 시작 { -->
</div>
<!-- } 쇼핑몰 배너 끝 -->

<div id="quick"  class="tab-wr">
    <ul class="tabs qk_btn">
        <li rel="tab1">
            <i class="fa fa-shopping-cart"></i><span class="qk_tit">장바구니</span>
        </li>
        <li rel="tab2">
            <i class="fa fa-user"></i><span class="qk_tit">나의정보</span>
        </li>
        <li rel="tab3">
            <i class="fa fa-heart"></i><span class="qk_tit">위시리스트</span>
        </li>
        <li rel="tab4">
           <i class="fa fa-clock-o"></i><span class="qk_tit">오늘본상품</span>
        </li>
       
    </ul>


    <div class="qk_con" id="tab1">
        <h3><a href="<?php echo G5_SHOP_URL; ?>/cart.php">장바구니</a></h3>
        <?php include_once(G5_SHOP_SKIN_PATH.'/boxcart.skin.php'); // 장바구니 ?>
        <button type="button" class="btn_close"><span class="sound_only">닫기</span><i class="fa fa-times"></i></button>
    </div>

    <div class="qk_con" id="tab2">
        <h3><a href="<?php echo G5_SHOP_URL; ?>/cart.php">나의정보</a></h3>
        <?php echo outlogin('theme/shop_basic'); // 아웃로그인 ?>
        <ul class="qk_mymenu">
            <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">마이페이지</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/faq.php">FAQ</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/qalist.php">1:1문의</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/personalpay.php">개인결제</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/itemuselist.php">사용후기</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/couponzone.php">쿠폰존</a></li>
        </ul>
        <button type="button" class="btn_close"><span class="sound_only">닫기</span><i class="fa fa-times"></i></button>
    </div>

    <div class="qk_con tabsList" id="tab3">
        <div class="qk_con_wr">
        <h3><a href="<?php echo G5_SHOP_URL; ?>/wishlist.php">위시리스트</a></h3>
        <?php include_once(G5_SHOP_SKIN_PATH.'/boxwish.skin.php'); // 위시리스트 ?>
        
         <button type="button" class="btn_close"><span class="sound_only">닫기</span><i class="fa fa-times"></i></button> 
         </div>
   </div>


    <div class="qk_con tabsList" id="tab4">
        <h3><a href="<?php echo G5_SHOP_URL; ?>/wishlist.php">오늘본상품</a></h3>
        
        <?php include(G5_SHOP_SKIN_PATH.'/boxtodayview.skin.php'); // 오늘 본 상품 ?>

        <button type="button" class="btn_close"><span class="sound_only">닫기</span><i class="fa fa-times"></i></button>
   </div>
</div>




<script>
$(function () {

    $(".qk_con").hide();

    $("ul.tabs li").click(function () {
        $("ul.tabs li").removeClass("active");
        $(this).addClass("active");
        $(".qk_con").hide()
        var activeTab = $(this).attr("rel");
        $("#" + activeTab).show()
    });

    $(".qk_con .btn_close").click(function () {
        $(".qk_con").hide() ;
        $(".tabs li").removeClass("active");

    });

});
</script>
<div id="ft">  
    <?php echo latest('theme/shop_basic', 'notice', 5, 30); ?>
    <div class="ft_wr">
        <div class="ft_c">
            <ul class="ft_ul">
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보처리방침</a></li>
                <li><a href="<?php echo get_device_change_url(); ?>">모바일버전</a></li>
            </ul>
            
            <div class="ft_info">
                <span><b>회사명</b> <?php echo $default['de_admin_company_name']; ?></span>
                <span><b>주소</b> <?php echo $default['de_admin_company_addr']; ?></span><br>
                <span><b>사업자 등록번호</b> <?php echo $default['de_admin_company_saupja_no']; ?></span>
                <span><b>대표</b> <?php echo $default['de_admin_company_owner']; ?></span>
                <span><b>전화</b> <?php echo $default['de_admin_company_tel']; ?></span>
                <span><b>팩스</b> <?php echo $default['de_admin_company_fax']; ?></span><br>
                <!-- <span><b>운영자</b> <?php echo $admin['mb_name']; ?></span><br> -->
                <span><b>통신판매업신고번호</b> <?php echo $default['de_admin_tongsin_no']; ?></span>
                <span><b>개인정보 보호책임자</b> <?php echo $default['de_admin_info_name']; ?></span>

                <?php if ($default['de_admin_buga_no']) echo '<span><b>부가통신사업신고번호</b> '.$default['de_admin_buga_no'].'</span>'; ?><br>
                Copyright &copy; 2001-2013 <?php echo $default['de_admin_company_name']; ?>. All Rights Reserved.
            </div>

            <button type="button" id="top_btn"><i class="fa fa-arrow-up" aria-hidden="true"></i><span class="sound_only">상단으로</span></button>
            <script>
            
            $(function() {
                $("#top_btn").on("click", function() {
                    $("html, body").animate({scrollTop:0}, '500');
                    return false;
                });
            });
            </script>
        </div>
    </div>

</div>

<?php
$sec = get_microtime() - $begin_time;
$file = $_SERVER['SCRIPT_NAME'];

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<script src="<?php echo G5_JS_URL; ?>/sns.js"></script>
<!-- } 하단 끝 -->

<?php
include_once(G5_THEME_PATH.'/tail.sub.php');
?>

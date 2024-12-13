<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$admin = get_admin("super");
$q = isset($_GET['q']) ? clean_xss_tags($_GET['q'], 1, 1) : '';
// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>
</div><!-- container End -->
<div id="nav">
    <ul>
        <li class="nav_li"><button type="button" class="cate_btn"><i class="fa fa-bars"></i><span class="txt">카테고리</span></button></li>
        <li class="nav_li" class="nav_li"><a href="<?php echo G5_SHOP_URL; ?>/mypage.php"><i class="fa fa-user-o"></i><span class="txt">마이페이지</span></a></li>
        <li class="nav_li"><a href="<?php echo G5_SHOP_URL; ?>/wishlist.php"><i class="fa fa-heart-o"></i><span class="txt">위시리스트</span></a></li>
        <li class="nav_li">
            <button type="button" type="button" class="sch_btn"><i class="fa fa-search"></i><span class="txt">검색</span></button>
        </li>
        <li class="nav_li">
            <button type="button" type="button" class="stv_btn"><i class="fa fa-clock-o"></i><span class="txt">오늘본상품</span></button>
        </li>
    </ul>
    <aside id="hd_sch">
    <form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">
        <div class="sch_inner">
            <h2>상품 검색</h2>
            <label for="sch_str" class="sound_only">상품명<strong class="sound_only"> 필수</strong></label>
            <input type="text" name="q" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="sch_str" required class="frm_input" placeholder="검색어를 입력해주세요">
            <button type="submit" value="검색" class="sch_submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
    </form>

    <button type="button" class="btn_close"><span class="sound_only">닫기</span><i class="fa fa-times"></i></button>
    </aside>

    
    <?php include(G5_MSHOP_SKIN_PATH.'/boxtodayview.skin.php'); // 오늘 본 상품 ?>

</div>

<script>
/* When the user scrolls down, hide the navbar. When the user scrolls up, show the navbar */
var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
  var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("nav").style.bottom = "0";
  } else {
    document.getElementById("nav").style.bottom = "-55px";
  }
  prevScrollpos = currentScrollPos;
}
</script>

<!-- 커뮤니티 최신글 시작 { -->
<section id="sidx_lat">
	<?php echo latest('theme/shop_basic', 'notice', 3, 30); ?>
</section>
<div id="ft">
    <h2><?php echo $config['cf_title']; ?> 정보</h2>
    <div id="ft_company">
        <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a>
        <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보</a>
        <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">이용약관</a>
        <?php
        if(G5_DEVICE_BUTTON_DISPLAY && G5_IS_MOBILE) { ?>
        <a href="<?php echo get_device_change_url(); ?>" id="device_change">PC 버전</a>
        <?php } ?>
    </div>
    <p>
        <span><b>회사명</b> <?php echo $default['de_admin_company_name']; ?></span>
        <span><b>주소</b> <?php echo $default['de_admin_company_addr']; ?></span><br>
        <span><b>사업자 등록번호</b> <?php echo $default['de_admin_company_saupja_no']; ?></span><br>
        <span><b>대표</b> <?php echo $default['de_admin_company_owner']; ?></span>
        <span><b>전화</b> <?php echo $default['de_admin_company_tel']; ?></span>
        <span><b>팩스</b> <?php echo $default['de_admin_company_fax']; ?></span><br>
        <!-- <span><b>운영자</b> <?php echo $admin['mb_name']; ?></span><br> -->
        <span><b>통신판매업신고번호</b> <?php echo $default['de_admin_tongsin_no']; ?></span><br>
        <span><b>개인정보 보호책임자</b> <?php echo $default['de_admin_info_name']; ?></span>

        <?php if ($default['de_admin_buga_no']) echo '<span><b>부가통신사업신고번호</b> '.$default['de_admin_buga_no'].'</span>'; ?><br>
        Copyright &copy; 2001-2013 <?php echo $default['de_admin_company_name']; ?>. All Rights Reserved.
    </p>

</div>

<?php
$sec = get_microtime() - $begin_time;
$file = $_SERVER['SCRIPT_NAME'];

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<script src="<?php echo G5_JS_URL; ?>/sns.js"></script>
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

	$(".cate_btn").on("click", function() {
        $("#category").show();
    });

    $(".menu_close").on("click", function() {
        $(".menu").hide();
    });
     $(".cate_bg").on("click", function() {
        $(".menu").hide();
    });

    $(".menu_close").on("click", function() {
        $(".menu").hide();
    });

    $(".stv_btn").on("click", function() {
        $("#stv").show();
    });

    $("#stv .btn_close").on("click", function() {
        $("#stv").hide();
    });


    $(".sch_btn").on("click", function() {
        $("#hd_sch").show();
    });

    $("#hd_sch .btn_close").on("click", function() {
        $("#hd_sch").hide();
    });

    </script>
    
<?php
include_once(G5_THEME_PATH.'/tail.sub.php');
?>

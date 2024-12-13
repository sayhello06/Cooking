<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

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
?>

<div id="category">
    <div class="cate_bg"></div>
    <div class="ct_wr">
    	<div id="hd_tnb">
            <?php if ($is_member) { ?>
            <a href="<?php echo G5_SHOP_URL; ?>/mypage.php" class="tnb_my">마이페이지</a>
            <a href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop" class="tnb_logout">로그아웃</a>
            
            <?php } else { ?>
            <a href="<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo $urlencode; ?>" class="tnb_login">로그인</a>
            <?php } ?>
            
            
        </div>
        
        <ul id="hd_mb">
            <li><a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php">주문조회</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/personalpay.php">개인결제</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/itemuselist.php">리뷰</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/itemqalist.php">QA</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/faq.php">고객센터</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/qalist.php">1:1문의</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=5">세일상품</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=gallery">갤러리</a></li>
        </ul>

        <ul class="tabsTit">
            <li class="tabsTab tabsHover">shop</li>
            <li class="tabsTab">board</li>
        </ul>
        <div class="tabsCon">
            <div class="tabsList" readonly="true">
                <h2 class="con_tit"><span>쇼핑몰분류</span></h2>
                <?php
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
                                                        <a href="<?php echo $mshop_ca_href.$mshop_ca_row5['ca_id']; ?>"> <?php echo get_text($mshop_ca_row5['ca_name']); ?></a>
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
            </div>
            <div class="tabsList">
                <h2>게시판</h2>
                <ul id="gnb_1dul" class="cate tabsList">
                    <?php
                    $sql = " select *
                                from {$g5['menu_table']}
                                where me_use = '1'
                                  and length(me_code) = '2'
                                order by me_order, me_id ";
                    $result = sql_query($sql, false);
                    $gnb_zindex = 999; // gnb_1dli z-index 값 설정용

                    for ($i=0; $row=sql_fetch_array($result); $i++) {
                    ?>
                    <li class="gnb_1dli" style="z-index:<?php echo $gnb_zindex--; ?>">
                        <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?></a>
                        <?php
                        $sql2 = " select *
                                    from {$g5['menu_table']}
                                    where me_use = '1'
                                      and length(me_code) = '4'
                                      and substring(me_code, 1, 2) = '{$row['me_code']}'
                                    order by me_order, me_id ";
                        $result2 = sql_query($sql2);

                        for ($k=0; $row2=sql_fetch_array($result2); $k++) {
                            if($k == 0)
                                echo '<button type="button" class="sub_ct_toggle ct_op">'.get_text($mshop_ca_row3['ca_name']).' 하위분류 열기</button><ul class="sub_cate sub_cate1">'.PHP_EOL;
                        ?>

                            <li class="gnb_2dli"><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><?php echo $row2['me_name'] ?></a></li>
                        <?php
                        }

                        if($k > 0)
                            echo '</ul>'.PHP_EOL;
                        ?>
                    </li>
                    <?php
                    }

                    if ($i == 0) {  ?>
                        <li id="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
	<button type="button" class="category_close"><span class="sound_only">카테고리 닫기</span></button>
</div>       
        
<script>
$(function (){

    $("#category").UblueTabs({
        eventType:"click" 
    });

    var $category = $("#category");

    $("#hd_ct").on("click", function() {
        $category.css("display","block");
    });

    $("#category .category_close").on("click", function(){
        $category.css("display","none");
    });

     $(".cate_bg").on("click", function() {
        $category.css("display","none");
    });

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
});
   
</script>
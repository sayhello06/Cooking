<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<?php if(!defined('G5_IS_SHOP_AJAX_LIST') && $config['cf_kakao_js_apikey']) { ?>
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
<script src="<?php echo G5_JS_URL; ?>/kakaolink.js"></script>
<script>
    // 사용할 앱의 Javascript 키를 설정해 주세요.
    Kakao.init("<?php echo $config['cf_kakao_js_apikey']; ?>");
</script>
<?php } ?>

<!-- 메인상품진열 10 시작 { -->
<?php
$is_gallery_list = ($this->ca_id && isset($_COOKIE['ck_itemlist'.$this->ca_id.'_type'])) ? $_COOKIE['ck_itemlist'.$this->ca_id.'_type'] : '';
if(!$is_gallery_list){
    $is_gallery_list = 'gallery';
}
$li_width = ($is_gallery_list === 'gallery') ? intval(100 / $this->list_mod) : 100;
$li_width_style = ' style="width:'.$li_width.'%;"';
$ul_sct_class = ($is_gallery_list === 'gallery') ? 'sct_10' : 'sct_10_list';

for ($i=0; $row=sql_fetch_array($result); $i++) {
    $item_link_href = shop_item_url($row['it_id']);     // 상품링크
    $icon = '<span class="sit_icon">';

    if ($row['it_type1'])
        $icon .= '<span class="shop_icon shop_icon_1">히트</span>';

    if ($row['it_type2'])
        $icon .= '<span class="shop_icon shop_icon_2">추천</span>';

    if ($row['it_type3'])
        $icon .= '<span class="shop_icon shop_icon_3">최신</span>';

    if ($row['it_type4'])
        $icon .= '<span class="shop_icon shop_icon_4">인기</span>';

    if ($row['it_type5'])
        $icon .= '<span class="shop_icon shop_icon_5">할인</span>';

    // 품절
    if (is_soldout($row['it_id']))
        $icon .= '<span class="shop_icon_soldout">품절</span>';

    $icon .= '</span>';

    if ($i == 0) {
        if ($this->css) {
            echo "<ul id=\"lct_wrap\" class=\"{$this->css}\">\n";
        } else {
            echo "<ul id=\"lct_wrap\" class=\"lct lct_10\">\n";
        }
    }

    if($i % $this->list_mod == 0)
        $li_clear = ' sct_clear';
    else
        $li_clear = '';

    echo "<li class=\"lct_li{$li_clear}\"$li_width_style>\n";
    echo "<div class=\"li_wr is_view_type_list\">\n";

    if ($this->href) {
        echo "<div class=\"lct_img\"><a href=\"{$item_link_href}\">\n";
    }

    if ($this->view_it_img) {
        echo get_it_image($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name']))."\n";
    }

    if ($this->href) {
        echo "</a></div>\n";
    }
    
    if ($this->view_it_id) {
        echo "<div class=\"sct_id\">&lt;".stripslashes($row['it_id'])."&gt;</div>\n";
    }
    
    if ($this->href) {
        echo "<div class=\"sct_txt\"><a href=\"{$item_link_href}{$row['it_id']}\" class=\"sct_a\">\n";
    }
    
    if ($this->view_it_name) {
        echo stripslashes($row['it_name'])."\n";
    }
    
    if ($this->href) {
        echo "</a></div>\n";
    }

    echo "<div class=\"sct_icon\">".$icon."</div>\n";

    if ($this->view_it_cust_price || $this->view_it_price) {
        echo "<div class=\"lct_cost\">\n";
    
        if ($this->view_it_cust_price && $row['it_cust_price']) {
            echo "<span class=\"sct_discount\">".display_price($row['it_cust_price'])."</span>\n";
        }

        if ($this->view_it_price) {
            echo display_price(get_price($row), $row['it_tel_inq'])."\n";
        }
        echo "</div>\n";
    }

    echo "<div class=\"sct_icon_btn\">\n";

    if ($this->view_sns) {
        $sns_top = $this->img_height + 10;
        $sns_url  = $item_link_href;
        $sns_title = get_text($row['it_name']).' | '.get_text($config['cf_title']);
        echo "<button typd=\"button\" class=\"btn_share\"><i class=\"fa fa-share-alt\" aria-hidden=\"true\"></i><span class=\"sound_only\">sns공유</span></button>\n";
        echo "<div class=\"sct_sns\"><div class=\"sct_sns_wr\"><h3>SNS 공유</h3><div>";
        echo get_sns_share_link('facebook', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/facebook.png');
        echo get_sns_share_link('twitter', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/twitter.png');
        echo get_sns_share_link('googleplus', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/gplus.png');
        echo "</div><button type=\"button\" class=\"btn_close\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></button></div><div class=\"bg\"></div></div>\n";
    }

    echo "</div>\n";

    echo "</div>\n";

    echo "</li>\n";
}

if ($i > 0) echo "</ul>\n";

if($i == 0) echo "<p class=\"sct_noitem\">등록된 상품이 없습니다.</p>\n";
?>
<!-- } 상품진열 10 끝 -->

<?php if( !defined('G5_IS_SHOP_AJAX_LIST') ) { ?>
<script>
jQuery(function($){
    var li_width = "<?php echo intval(100 / $this->list_mod); ?>",
        img_width = "<?php echo $this->img_width; ?>",
        img_height = "<?php echo $this->img_height; ?>",
        list_ca_id = "<?php echo $this->ca_id; ?>";

    function shop_list_type_fn(type){
        var $ul_lct = $("ul.lct");

        if(type == "gallery") {
            $ul_lct.removeClass("lct_20").addClass("lct_10")
            .find(".lct_li").attr({"style":"width:"+li_width+"%"});
        } else {
            $ul_lct.removeClass("lct_10").addClass("lct_20")
            .find(".lct_li").removeAttr("style");
        }
        
        if (typeof g5_cookie_domain != 'undefined') {
            set_cookie("ck_itemlist"+list_ca_id+"_type", type, 1, g5_cookie_domain);
        }
    }

    $("button.sct_lst_view").on("click", function() {
        var $ul_lct = $("ul.lct");

        if($(this).hasClass("sct_lst_gallery")) {
            shop_list_type_fn("gallery");
        } else {
            shop_list_type_fn("list");
        }
    }).click();
});

$('.btn_share').click(function(){
    $(this).next('.sct_sns').show();
});

$('.sct_sns_wr .btn_close').click(function(){
    $('.sct_sns').hide();
});

$('.sct_sns .bg').click(function(){
    $('.sct_sns').hide();
});
</script>
<?php } ?>
<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>

<?php if($config['cf_kakao_js_apikey']) { ?>
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
<script src="<?php echo G5_JS_URL; ?>/kakaolink.js"></script>
<script>
    // 사용할 앱의 Javascript 키를 설정해 주세요.
    Kakao.init("<?php echo $config['cf_kakao_js_apikey']; ?>");
</script>
<?php } ?>

<div class="pic_tab">
	<h2 class="lat_title"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><?php echo $bo_subject ?></a></h2>
	
	<div class="pic_tab_wrap">
		<div class="pic_tab_ul">
		<!-- 메인상품진열 30 시작 { -->
		<?php
		$li_width = intval(100 / $this->list_mod);
		$li_width_style = ' style="width:'.$li_width.'%;"';
		
		for ($i=0; $row=sql_fetch_array($result); $i++) {
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
		            echo "<ul class=\"{$this->css}\">\n";
		        } else {
		            echo "<ul class=\"sct sct_30\">\n";
		        }
		    }

		    if($i % $this->list_mod == 0)
		        $li_clear = ' sct_clear';
		    else
		        $li_clear = '';

		    echo "<li class=\"sct_li{$li_clear}\">\n";
		    echo "<div class=\"li_wr\">\n";

		    if ($this->href) {
		        echo "<div class=\"sct_img\"><a href=\"{$item_link_href}{$row['it_id']}\">\n";
		    }
		
		    if ($this->view_it_img) {
		        echo get_it_image($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name']))."\n";
		    }
		
		    if ($this->href) {
		        echo "</a></div>\n";
		    }

    		echo "<div class=\"sct_txt_wr\">\n";

		    if ($this->view_it_id) {
		        echo "<div class=\"sct_id\">&lt;".stripslashes($row['it_id'])."&gt;</div>\n";
		    }
		
		    if ($this->href) {
		        echo "<div class=\"sct_txt\"><a href=\"{$this->href}{$row['it_id']}\" class=\"sct_a\">\n";
		    }
		
		    if ($this->view_it_name) {
		        echo stripslashes($row['it_name'])."\n";
		    }
		
		    if ($this->href) {
		        echo "</a></div>\n";
		    }

			if ($this->view_it_cust_price || $this->view_it_price) {
		    	
		        echo "<div class=\"sct_cost\">\n";
				
				if ($this->view_it_price) {
		            echo display_price(get_price($row), $row['it_tel_inq'])."\n";
		        }
		        
				if ($this->view_it_cust_price && $row['it_cust_price']) {
		            echo "<span class=\"sct_discount\">".display_price($row['it_cust_price'])."</span>\n";
		        }
				
	        	echo "</div>\n";
		    }
			
			if ($this->view_it_icon) {
		        echo "<div class=\"sct_icon\">".$icon."</div>\n";
		    }

		    if ($this->view_sns) {
		        $sns_top = $this->img_height + 10;
		        $sns_url  = $item_link_href;
		        $sns_title = get_text($row['it_name']).' | '.get_text($config['cf_title']);
		        echo "<div class=\"sct_sns\" style=\"top:{$sns_top}px\">";
		        echo get_sns_share_link('facebook', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/facebook.png');
		        echo get_sns_share_link('twitter', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/twitter.png');
		        echo get_sns_share_link('googleplus', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/gplus.png');
		        echo get_sns_share_link('kakaotalk', $sns_url, $sns_title, G5_MSHOP_SKIN_URL.'/img/sns_kakao.png');
		        echo "</div>\n";
		    }
			
		    echo "</div>\n";
		
		    echo "</div>\n";
		
		    echo "</li>\n";
		}

		if ($i > 0) echo "</ul>\n";
		
		if($i == 0) echo "<p class=\"sct_noitem\">등록된 상품이 없습니다.</p>\n";
		?>
		<!-- } 상품진열 30 끝 -->
		</div>
	</div>
</div>
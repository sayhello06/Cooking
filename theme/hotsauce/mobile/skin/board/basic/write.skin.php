<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<h2 id="container_title"><span><?php echo $g5['title'] ?></span></h2>

<section id="bo_w">
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="wr_1" value="<?php echo $write['wr_1']; ?>">
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) { 
        $option = '';
        if ($is_notice) {
            $option .= PHP_EOL.'<li class="chk_box"><input type="checkbox" id="notice" name="notice"  class="selec_chk" value="1" '.$notice_checked.'>'.PHP_EOL.'<label for="notice"><span></span>공지</label></li>';
        }
        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= PHP_EOL.'<li class="chk_box"><input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" class="selec_chk" value="'.$html_value.'" '.$html_checked.'>'.PHP_EOL.'<label for="html"><span></span>html</label></li>';
            }
        }
        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= PHP_EOL.'<li class="chk_box"><input type="checkbox" id="secret" name="secret"  class="selec_chk" value="secret" '.$secret_checked.'>'.PHP_EOL.'<label for="secret"><span></span>비밀글</label></li>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }
        if ($is_mail) {
            $option .= PHP_EOL.'<li class="chk_box"><input type="checkbox" id="mail" name="mail"  class="selec_chk" value="mail" '.$recv_email_checked.'>'.PHP_EOL.'<label for="mail"><span></span>답변메일받기</label></li>';
        }
    }
    echo $option_hidden;
    ?>
    
    <div class="form_01 write_div">
        <h2 class="sound_only"><?php echo $g5['title'] ?></h2>

        <?php if ($is_category) { ?>
        <div class="bo_w_select write_div">
            <label for="ca_name" class="sound_only">분류<strong>필수</strong></label>
            <select id="ca_name" name="ca_name" required>
                <option value="">선택하세요</option>
                <?php echo $category_option ?>
            </select>
        </div>
        <?php } ?> 
        
        <?php if ($is_name) { ?>
        <div class="write_div">
            <label for="wr_name" class="sound_only">이름<strong>필수</strong></label>
            <input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input full_input required" maxlength="20" placeholder="이름">
        </div>
        <?php } ?>

        <?php if ($is_password) { ?>
        <div class="write_div">
            <label for="wr_password" class="sound_only">비밀번호<strong>필수</strong></label>
            <input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input full_input <?php echo $password_required ?>" maxlength="20" placeholder="비밀번호">
        </div>
        <?php } ?>

        <?php if ($is_email) { ?>
        <div class="write_div">
            <label for="wr_email" class="sound_only">이메일</label>
            <input type="email" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="frm_input full_input"  email" maxlength="100" placeholder="이메일">
        </div>
        <?php } ?>

        <?php if ($is_homepage) { ?>
        <div class="write_div">
            <label for="wr_homepage" class="sound_only">홈페이지</label>
            <input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="frm_input full_input" placeholder="홈페이지">
        </div>
        <?php } ?>

        <?php if ($option) { ?>
        <div class="write_div">
            <span class="sound_only">옵션</span>
            <ul class="bo_v_option">
            <?php echo $option ?>
            </ul>
        </div>
        <?php } ?>

        <div class="bo_w_tit write_div">
            <label for="wr_subject" class="sound_only">제목<strong>필수</strong></label>
            <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input full_input required" placeholder="제목">
        </div>

        <div class="write_div">
            <label for="wr_content" class="sound_only">내용<strong>필수</strong></label>
            <?php if($write_min || $write_max) { ?>
            <!-- 최소/최대 글자 수 사용 시 -->
            <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
            <?php } ?>
            <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
            <?php if($write_min || $write_max) { ?>
            <!-- 최소/최대 글자 수 사용 시 -->
            <div id="char_count_wrap"><span id="char_count"></span>글자</div>
            <?php } ?>
        </div>

        <?php for ($i=1; $is_link && $i<=G5_LINK_COUNT; $i++) { ?>
        <div class="bo_w_link write_div">
            <label for="wr_link<?php echo $i ?>"><i class="fa fa-link" aria-hidden="true"></i> <span class="sound_only">링크 #<?php echo $i ?></span></label>
            <input type="text" name="wr_link<?php echo $i ?>" value="<?php if($w=="u"){echo $write['wr_link'.$i];} ?>" id="wr_link<?php echo $i ?>" class="frm_input wr_link" placeholder="링크를 입력하세요">
        </div>
        <?php } ?>

        <?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
        <div class="bo_w_flie write_div">
            <div class="file_wr write_div filebox">
            	<input type="text" class="fileName" readonly="readonly" placeholder="파일을 첨부하세요">
                <label for="bf_file_<?php echo $i+1 ?>"><i class="fa fa-download lb_icon" aria-hidden="true"></i><span class="sound_only">파일 #<?php echo $i+1 ?></span><span class="btn_file">파일첨부</span></label>
                <input type="file" name="bf_file[]" id="bf_file_<?php echo $i+1 ?>" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file uploadBtn">
            </div>
            <?php if ($is_file_content) { ?>
            <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="full_input frm_input" size="50" placeholder="파일 설명을 입력해주세요.">
            <?php } ?>

            <?php if($w == 'u' && $file[$i]['file']) { ?>
            <span class="file_del">
                <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
            </span>
            <?php } ?>
        </div>
        <?php } ?>
        

	        <div class="bo_w_prdlist">
	            <h4>상품리스트</h4>
	            <label for="sch_ca_id" class="sound_only">분류선택</label>
	            <select name="sch_ca_id" id="sch_ca_id">
	                <option value="">분류선택</option>
	                <?php
	                $sql = " select * from {$g5['g5_shop_category_table']} order by ca_order, ca_id ";
	                $result = sql_query($sql);
	                for ($i=0; $row=sql_fetch_array($result); $i++)
	                {
	                    $len = strlen($row['ca_id']) / 2 - 1;
	
	                    $nbsp = "";
	                    for ($i=0; $i<$len; $i++)
	                        $nbsp .= "&nbsp;&nbsp;&nbsp;";
	
	                    echo "<option value=\"{$row['ca_id']}\">$nbsp{$row['ca_name']}</option>\n";
	                }
	                ?>
	            </select>
	            <ul id="sch_item">
	                <li class="no_item">상품을 검색해 주십시오.</li>
	            </ul>
	        </div>
	        
	        <div class="bo_w_addlist">
	            <h4>선택된 상품</h4>
	            <?php
	            $sel_li = '';
	            $nl = '';
	
	            if($w == 'u') {
	                $sql = " select it_id, it_name from {$g5['g5_shop_item_table']} where it_id in ( '".str_replace(',', "', '", $write['wr_1'])."' ) order by it_order, it_id desc ";
	                $result = sql_query($sql);
	
	                for($i=0; $row=sql_fetch_array($result); $i++) {
	                    $name = get_text($row['it_name']);
	                    $img  = get_it_image($row['it_id'], 50, 50, false, '', $name);
	
	                    if($i == 0)
	                        $prd_1 = ' class="prd_1"';
	                    else
	                        $prd_1 = '';
	
	                    $sel_li .= $nl.'<li'.$prd_1.'>'.PHP_EOL;
	                    $sel_li .= '<input type="hidden" name="it_id[]" value="'.$row['it_id'].'">'.PHP_EOL;
	                    $sel_li .= '<span class="prd_img">'.$img.'</span>'.PHP_EOL;
	                    $sel_li .= '<span class="prd_name">'.$name.'</span>'.PHP_EOL;
	                    $sel_li .= '<button type="button" class="del_item">삭제</button>'.PHP_EOL;
	                    $sel_li .= '</li>';
	
	                    $nl = PHP_EOL;
	                }
	            }
	
	            if(!$sel_li)
	                $sel_li = '<li class="no_item">선택된 상품이 없습니다.</li>';
	            ?>
	            <ul id="sel_item"><?php echo $sel_li; ?></ul>
	        </div>


        <?php if ($is_use_captcha) { //자동등록방지 ?>
        <div class="write_div">
            <span class="sound_only">자동등록방지</span>
            <?php echo $captcha_html ?>
        </div>
        <?php } ?>
    </div>

    <script>
    $(function() {
        $("#sch_ca_id").on("change", function() {
            var ca_id = $(this).val();

            if(ca_id == "")
                return false;

            $("#sch_item").load(
                "<?php echo $board_skin_url; ?>/write.item_search.php",
                { ca_id: ca_id }
            );
        });

        $(document).on("click", "#sch_item .add_item", function() {
            // 이미 등록된 상품인지 체크
            var $li = $(this).closest("li");
            var it_id = $li.find("input:hidden").val();
            var it_id2;
            var dup = false;
            $("#sel_item li input[name='it_id[]']").each(function() {
                it_id2 = $(this).val();
                if(it_id == it_id2) {
                    dup = true;
                    return false;
                }
            });

            if(dup) {
                alert("이미 선택된 상품입니다.");
                return false;
            }

            var cont = "<li>"+$li.html().replace("add_item", "del_item").replace("추가", "삭제")+"</li>";
            var count = $("#sel_item li").not(".no_item").size();

            if(count > 0) {
                $("#sel_item li:last").after(cont);
            } else {
                $("#sel_item").html(cont);
                $("#sel_item li:first").addClass("prd_1");
            }

            $li.remove();
        });

        $(document).on("click", "#sel_item .del_item", function() {
            if(!confirm("상품을 삭제하시겠습니까?"))
                return false;

            $(this).closest("li").remove();

            var count = $("#sel_item li").size();
            if(count < 1)
                $("#sel_item").html("<li class=\"no_item\">선택된 상품이 없습니다.</li>");
        });
    });
    </script>

    <div class="btn_confirm">
        <a href="<?php echo get_pretty_url($bo_table); ?>" class="btn_cancel">취소</a>
        <button type="submit" id="btn_submit" class="btn_submit" accesskey="s">작성완료</button>
    </div>
    </form>
</section>

<script>
<?php if($write_min || $write_max) { ?>
// 글자수 제한
var char_min = parseInt(<?php echo $write_min; ?>); // 최소
var char_max = parseInt(<?php echo $write_max; ?>); // 최대
check_byte("wr_content", "char_count");

$(function() {
    $("#wr_content").on("keyup", function() {
        check_byte("wr_content", "char_count");
    });
});

<?php } ?>
function html_auto_br(obj)
{
    if (obj.checked) {
        result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
        if (result)
            obj.value = "html2";
        else
            obj.value = "html1";
    }
    else
        obj.value = "";
}

function fwrite_submit(f)
{
    <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

    var subject = "";
    var content = "";
    $.ajax({
        url: g5_bbs_url+"/ajax.filter.php",
        type: "POST",
        data: {
            "subject": f.wr_subject.value,
            "content": f.wr_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            subject = data.subject;
            content = data.content;
        }
    });

    if (subject) {
        alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
        f.wr_subject.focus();
        return false;
    }

    if (content) {
        alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
        if (typeof(ed_wr_content) != "undefined")
            ed_wr_content.returnFalse();
        else
            f.wr_content.focus();
        return false;
    }

    if (document.getElementById("char_count")) {
        if (char_min > 0 || char_max > 0) {
            var cnt = parseInt(check_byte("wr_content", "char_count"));
            if (char_min > 0 && char_min > cnt) {
                alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                return false;
            }
            else if (char_max > 0 && char_max < cnt) {
                alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                return false;
            }
        }
    }

    <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>
	
	document.getElementById("btn_submit").disabled = "disabled";

    return true;
}

    // 선택된상품
    var wr_1 = [];
    var it_id = '';
    $("#sel_item li input[name='it_id[]']").each(function() {
        it_id = $(this).val();

        if(wr_1.indexOf(it_id) == -1)
            wr_1.push(it_id);
    });

    f.wr_1.value = wr_1.join();

    document.getElementById("btn_submit").disabled = "disabled";

    return true;
}
</script>

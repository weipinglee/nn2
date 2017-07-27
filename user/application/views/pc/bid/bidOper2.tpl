
			<!--start中间内容-->
            <style type="text/css">

            </style>
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>我的投标</a>><a>购买标书</a></p>
					</div>
                                                        <div class="project_detail">
                                                            <h1>{$detail['pro_name']}</h1>
                                                            <p>招标方：{$detail['true_name']}</p>
                                                            <p>招标方式：{$detail['mode_text']}</p>
                                                            <p>评标类型：{$detail['pack_type_text']}</p>
                                                            <p>项目地点：{$detail['pro_address']}</p>
                                                            <p>投标时间：{$detail['begin_time']}——{$detail['end_time']}</p>
                                                            <p>开标地点：[{$detail['open_way_text']}]</p>
                                                        </div>
					<div class="center_tabl">
                                                            <ul class="step_list">
                                                                <li class="bid_step">
                                                                    <span class="val_on on">1</span>
                                                                    <p class="step_name">
                                                                        <span class="on">资格预审</span>
                                                                    </p>
                                                                </li>
                                                                <li class="bid_step">
                                                                    <span class="val_on on">2</span>
                                                                    <p class="step_name">
                                                                        <span class="on">购买下载标书</span>
                                                                    </p>
                                                                </li>
                                                                <li class="bid_step">
                                                                    <span class="val_on ">3</span>
                                                                    <p class="step_name">
                                                                        <span class="">投标</span>
                                                                    </p>
                                                                </li>
                                                                <li class="bid_step">
                                                                    <span class="val_on ">4</span>
                                                                    <p class="step_name">
                                                                        <span class="">开标</span>
                                                                    </p>
                                                                </li>
                                                                <li class="bid_step">
                                                                    <span class="val_on ">5</span>
                                                                    <p class="step_name">
                                                                        <span class="">中标结果</span>
                                                                    </p>
                                                                </li>
                                                            </ul>


                                                            <div class="invite" id="invite" style="padding-top:47px;">
                                                                <div class="invite_title">
                                                                    <span>购买标书</span>
                                                                </div>
                                                                <div class="bid_zige" style="padding-left:317px;">
                                                                    <p class="zigefile"><span>招标编号：</span>{$detail['no']}</p>
                                                                    <p class="zigefile"><span>项目名称：</span>{$detail['pro_name']}</p>
                                                                    <p class="zigefile"><span>标书费用：</span><i>{$detail['doc_price']}</i> 元</p>

                                                                </div>
                                                            </div>

                                                            <div class="clear"></div>
                                                            <form method="post" action="{url:/bid/replyPayDoc}" pay_secret="1" auto_submit="1">
                                                                <input type="hidden" name="reply_id" value="{$reply_id}" />
                                                                <div class="button">
                                                                    <button >支付</button>
                                                                </div>
                                                            </form>

                                                        </div>
				</div>
			</div>
<script type="text/javascript">
//图片预览，兼容各个浏览器
function previewImage(file) {
   var porImg  = $(file),
       viewImg = $('#viewImg');
   var image = porImg.val();
   if (!/^\S*\.(?:png|jpe?g|bmp|gif)$/i.test(image)) {
       layer.msg('请选择图片~', {shift: 6});
       porImg.val("");
       return false;
   }
   if (file["files"] && file["files"][0]) {
       var reader = new FileReader();
       reader.onload = function(evt){
           viewImg.attr({src : evt.target.result});
       }
       reader.readAsDataURL(file.files[0]);
   } else {
       var ieImageDom = document.createElement("div");
       var proIeImageDom = document.createElement("div");
       $(ieImageDom).css({
           float: 'left',
           position: 'relative',
           overflow: 'hidden',
           width: '100px',
           height: '100px'
       }).attr({"id":"view"});
       $(proIeImageDom).attr({"id": porImg.attr("id")});
       porImg.parent().prepend(proIeImageDom);
       porImg.remove();
       file.select();
       path = document.selection.createRange().text;
       $(ieImageDom).css({"filter": "progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled='true',sizingMethod='scale',src=\"" + path + "\")"});
   }
}

    //图片上传预览
    $('#user-pic').change(function(e){
        previewImage(this);
    });
</script>
			<!--end中间内容-->

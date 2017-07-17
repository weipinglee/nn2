<script type="text/javascript">
    {if:isset($_GET['error'])}
    alert($_GET['error');
    {/if}

</script>
			<!--start中间内容-->	
            <style type="text/css">
                
            </style>
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>我的招标</a>><a>发布招标</a></p>
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
                                                                    <span class="val_on ">2</span>
                                                                    <p class="step_name">
                                                                        <span class="">购买下载标书</span>
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
                        <form method="post" action="{url:/bid/uploadCerts}" enctype="multipart/form-data">

                            <input type="hidden" name="id" value="{$detail['id']}" />
                            <div class="invite" id="invite" style="padding-top:47px;">
                                <div class="invite_title">
                                    <span>资格预审</span>
                                </div>
                                <div class="bid_zige" style="padding-left:317px;">

                                    <p class="zigefile"><span>证书名称</span><input type="text" name="name"><i>*</i></p>
                                    <p class="zigefile"><span>证书分类</span><input type="text" name="type"></p>
                                    <p class="zigefile"><span>证书描述</span><input type="text" name="des"></p>
                                    <p class="zigefile"><span>附&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;件</span><input type="file" name="pic" class="doc" id="user-pic"><i>*</i></p>
                                    <p class="zigefile"><span>附件图片</span><img id="viewImg"></p>

                                </div>
                            </div>

                            <div class="clear"></div>

                            <div class="button">
                                <button style="float: left;margin-right:20px;" onclick="javascript:window.location.href='bid_opr.html'">提交</button><button style="margin:0;">重置</button>
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

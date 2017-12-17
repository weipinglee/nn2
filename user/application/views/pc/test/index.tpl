<script type="text/javascript" src="{root:js/jquery/jquery-1.7.2.min.js}"></script>
<script type="text/javascript" src="{root:/js/webuploader/webuploader.js}"></script>
<script type="text/javascript" src="{root:/js/webuploader/upload.js}"></script>
<link href="{root:/js/webuploader/webuploader.css}" rel="stylesheet" type="text/css" />
<link href="{root:/js/webuploader/demo.css}" rel="stylesheet" type="text/css" />


<div id="uploader" class="wu-example">
    <input type="hidden" name="uploadUrl" value="{url:/ucenter/upload}" />
    <input type="hidden" name="swfUrl" value="{root:/js/webuploader/Uploader.swf}" />
    <!--用来存放文件信息-->
    <ul id="filelist" class="filelist">

                <li   class="file-item thumbnail">
                    <p>
                        <img width="110" src="" />

                    </p>
                    <input type="hidden" name="imgData[]" value="" />
                </li>

    </ul>
    <div class="btns">

        <div id="picker" style="line-height:15px;">选择文件</div><span></span>
        <div class="totalprogress" style="display:none;">
            <span class="text">0%</span>
            <span class="percentage"></span>
        </div>
        <div class="info"></div>
    </div>
</div>
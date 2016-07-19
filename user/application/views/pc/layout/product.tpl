<table border="0"  id='productAdd'>
    {foreach: items=$attrs item=$attr}

        <tr class="attr">
            <td nowrap="nowrap"><span></span>{$attr['name']}：</td>
            <td colspan="2">
                <input class="text" type="text" name="attribute[{$attr['id']}]" >
            </td>
        </tr>


    {/foreach}
    <tr>
        <th colspan="3">基本挂牌信息</th>
    </tr>
    <tr>
        <td nowrap="nowrap"><span></span>商品标题：</td>
        <td colspan="2">
            <span><input class="text" type="text" datatype="s1-30" errormsg="填写商品标题" name="warename"></span>
            <span></span>
        </td>

    </tr>
    <tr>
        <td nowrap="nowrap"><span></span>商品单价:</td>
        <td>
            <span> <input class="text" type="text" datatype="money" errormsg="请正确填写单价" name="price"></span>
            <span></span>
        </td>
        <!--                                 <td>
            请选择付款方式：
            <input type ="radio" name ="safe" checked="checked" style="width:auto;height:auto;"> 线上
            <input type ="radio" name ="safe" style="width:auto;height:auto;"> 线下
        </td> -->
    </tr>
    <tr>
        <td nowrap="nowrap"><span></span>数量:</td>
        <td>
            <span><input class="text" type="text" datatype="/^\d{1,10}(\.\d{0,5})?$/" errormsg="请正确填写数量" name="quantity"></span>
            <span></span>
        </td>
        <span></span>
        <!--  <td>
            请选择支付保证金比例：
            <input type="button" id="jian" value="-"><input type="text" id="num" value="1"><input type="button" id="add" value="+">

        </td> -->
    </tr>
    <tr>
        <td nowrap="nowrap"><span></span>单位:</td>
        <td>
            <span class="unit">{$unit}</span><input type="hidden" name="unit" value="{$unit}"/>
        </td>
        <!--  <td>
            请选择支付保证金比例：
            <input type="button" id="jian" value="-"><input type="text" id="num" value="1"><input type="button" id="add" value="+">

        </td> -->
    </tr>
    <tr>
        <td>产地:</td>
        <td colspan="2">
            <span id="areabox">{area:data=getAreaData()}</span>
            <span></span>
        </td>

    </tr>


    <tr>
        <td>上传图片：</td>
        <td>

            <script type="text/javascript" src="{root:/js/webuploader/webuploader.js}"></script>
            <script type="text/javascript" src="{root:/js/webuploader/upload.js}"></script>
            <link href="{root:/js/webuploader/webuploader.css}" rel="stylesheet" type="text/css" />
            <link href="{root:/js/webuploader/demo.css}" rel="stylesheet" type="text/css" />


            <div id="uploader" class="wu-example">
                <input type="hidden" name="uploadUrl" value="{url:/ucenter/upload}" />
                <input type="hidden" name="swfUrl" value="{root:/js/webuploader/Uploader.swf}" />
                <!--用来存放文件信息-->
                <ul id="filelist" class="filelist">
                </ul>
                <div class="btns">

                    <div id="picker" style="line-height:15px;">选择文件</div>
                    <div class="totalprogress" style="display:none;">
                        <span class="text">0%</span>
                        <span class="percentage"></span>
                    </div>
                    <div class="info"></div>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <th colspan="3"><b>详细信息</b></th>
    </tr>

    </tr>
    <tr>
        <td><span>*</span>是否可拆分：</td>
        <td>
            <select name="divide" id="divide">
                <option value="1" selected >是</option>
                <option value="0" selected >否</option>
            </select>
        </td>
    </tr>
    <tr id='nowrap' style="display: none">
        <td nowrap="nowrap" ><span>*</span>最小起订量：</td>
        <td>
            <input name="minimum" id="" type="text" class="text"  />
        </td>
       <!-- <td>
            <span>*</span>
            最小起订量即为最小起增量，最小设为1，不填写规则为不可拆分
        </td>-->
    </tr>
    <tr>
        <td>交收地点：</td>
        <td colspan="2">
            <span><input type="text" class='text' datatype="s1-30" errormsg="填写商品标题" name="accept_area"></span>
            <span></span>
        </td>
    </tr>
    <td>交收时间：</td>
    <td colspan="2">
        <span>T+<input type="text" class='text' datatype="/[1-9]\d{0,5}/" name="accept_day" style="width:50px;">天</span>
        <span></span>
    </td>
    </tr>

    <tr>
        <!--  <td>是否投保：</td>
         <td colspan="2">
<input type ="radio" name ="safe" checked="checked" style="width:auto;height:auto;">投保
<input type ="radio" name ="safe" style="width:auto;height:auto;"> 不投保
         </td>
     </tr>  -->
    <tr>
        <td>产品描述：</td>
        <td colspan="2">
            <textarea name="note"></textarea>
        </td>
    </tr>

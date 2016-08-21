<table border="0" >

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
        <td nowrap="nowrap"><span></span>商品单价：</td>
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
        <td nowrap="nowrap"><span></span>数量：</td>
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
        <td nowrap="nowrap"><span></span>单位：</td>
        <td>
            <span class="unit">{$unit}</span><input type="hidden" name="unit" value="{$unit}"/>
        </td>
        <!--  <td>
            请选择支付保证金比例：
            <input type="button" id="jian" value="-"><input type="text" id="num" value="1"><input type="button" id="add" value="+">

        </td> -->
    </tr>
        {foreach: items=$attrs item=$attr}

        <tr class="attr">
            <td nowrap="nowrap"><span></span>{$attr['name']}：</td>
            <td colspan="2">
                 {if: $attr['type'] == 1}
                                            <input class="text" type="text" name="attribute[{$attr['id']}]" >
                                            {elseif: $attr['type'] == 2}
                                            <input type="radio" name="attribute[{$attr['id']}]" value="{$attr['value']}" />
                                            {/if}
            </td>
        </tr>


    {/foreach}
    <tr style="display:none" id='productAdd'>
                            <td ></td>
                            <td ></td>
                            </tr>
                            
    <!-- <tr>
        <td nowrap="nowrap"><span></span>是否投保：</td>
        <td>
            <span> <input type="radio" name="insurance" value="1"  checked="true">是 <input type="radio" name="insurance" value="0" >否</span>
        </td>
    </tr>

    <tr id="riskdata" >
        <td ><span></span>保险：</td>
        <td>
            <span> 
            {if: !empty($risk_data)}
                {foreach: items=$risk_data}
                    <input type="checkbox" name="risk[]" value="{$item['risk_id']}">{$item['name']}{if: $item['mode'] == 1}比例： {$item['fee']}(‰) {else:}定额： {$item['fee']} {/if}
                {/foreach}
            {else:}
                该分类没有设置保险
            {/if}
            </span>
        </td>
    </tr> -->
    <input type="hidden" name="cate_id" id="cid">
    <input type="hidden" name="ajax_url" id="ajax_url" value="{url: Trade/Insurance/ajaxGetCate}">

    <tr>
        <td>产地：</td>
        <td colspan="2">
            <span id="areabox">{area:}</span>
            <span></span>
        </td>

    </tr>

    <tr>
        <td>有效期：</td>
        <td colspan="2">
             <span><input class="Wdate text" datatype="*" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',minDate:'%y-%M-#{%d+1}'})"
                           name="expire_time" value="">
                 </span>
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
                {set:$filesize = \Library\tool::getConfig(array('application','uploadsize'))}
                    {if:!$filesize}
                        {set:$filesize = 2048;}
                    {/if}
                    {set:$filesize = $filesize / 1024;}
                    <div id="picker" style="line-height:15px;">选择文件</div><span>每张图片大小不能超过{$filesize}M,双击图片可以删除</span>
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
    <tr class='nowrap' style="display: none">
        <td nowrap="nowrap" ><span>*</span>最小起订量：</td>
        <td>
            <span><input name="minimum" id="" type="text" class="text"  /></span>
            <span></span>
        </td>
       <!-- <td>
            <span>*</span>
            最小起订量即为最小起增量，最小设为1，不填写规则为不可拆分
        </td>-->
    </tr>
    <tr class='nowrap' style="display: none">
        <td nowrap="nowrap" ><span>*</span>最小递增量：</td>
        <td>
            <span><input name="minstep" id="" type="text" class="text"  /></span>
            <span></span>
        </td>
        <!-- <td>
             <span>*</span>
             最小起订量即为最小起增量，最小设为1，不填写规则为不可拆分
         </td>-->
    </tr>
    <tr>
        <td>交收地点：</td>
        <td colspan="2">
            <span><input type="text" class='text' datatype="s2-100" errormsg="请填写有效地址"  name="accept_area"></span>
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

    <tr>
        <td>补充条款：</td>
        <td colspan="2">
            <textarea name="other"></textarea>
        </td>
    </tr>

<script type="text/javascript" src="{root:js/area/AreaData_min.js}" ></script>
<script type="text/javascript" src="{root:js/area/Area.js}" ></script>

<div class="class_jy" id="cate_box" style="display:none;">
    <span class="jy_title"></span>
    <ul>
        <!-- <li value=""   class="a_choose" ><a></a></li>
-->
    </ul>

    <ul class="infoslider" style="display: none;">
        <li value=""   class="a_choose"  ><a></a></li>

    </ul>
    <!--<div class="sl_ext">
        <a href="javascript:;" class="sl_e_more info-show" style="visibility: visible;">展开</a>
    </div>-->

</div>

       <input type="hidden" name="attr_url" value="{url:/ManagerDeal/ajaxGetCategory}"  />
<script type="text/javascript" src="{views:js/product/attr.js}" ></script>
            <!--start中间内容-->    
            <div class="user_c">
                <div class="user_zhxi pro_classify">
                    <div class="zhxi_tit">
                        <p><a>产品管理</a>><a>竞价报盘</a></p>
                    </div>
                    <div class="center_tabl">
                    <div class="lx_gg">
                        <b>商品类型</b>
                    </div>

                    {if: !empty($categorys)}

                        {foreach: items=$categorys item=$category key=$level}
                            <div class="class_jy" id="level{$level}">
                                <span class="jy_title">
                                    {if: isset($childName)}
                                        {$childName}：
                                    {else:}
                                        市场类型：
                                    {/if}
                                </span>
                                <ul>
                                    {foreach: items=$category['show'] item=$cate}
                                    <li value="{$cate['id']}"  {if: $key==0} class="a_choose" {/if} ><a>{$cate['name']}</a></li>
                                    {if: $key == 0}
                                    {set: $childName = $cate['childname']}
                                    {/if}
                                    {/foreach}
                                </ul>


                            </div>
                        {/foreach}
                        {/if}


                    <form action="{url:/ManagerDeal/doDepositOffer}" method="POST" auto_submit redirect_url="{url:/managerdeal/indexoffer}">

                        <table border="0" >

                            <tr>
                                <th colspan="3">基本挂牌信息</th>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>商品标题：</td>
                                <td colspan="2">
                                    <span><input class="text" type="text" datatype="s1-30" value="{$product['product_name']}" errormsg="填写商品标题" name="warename"></span>
                                    <span></span>
                                </td>

                            </tr>



                            <tr style="display:none" id='productAdd'>
                                <td ></td>
                                <td ></td>
                            </tr>
                            <tr>
                                <td><span>*</span>交收地点：</td>
                                <td colspan="2">

                                    <span><input type="text" class='text' datatype="s1-30" value="{$offer['accept_area']}" errormsg="请填写有效地址" nullmsg="请填写交收地点" name="accept_area"></span>

                                    <span></span>
                                </td>
                            </tr>
                            <tr>
                                <td><span>*</span>交收时间：</td>
                                <td colspan="2">
                                    <input type="text" class='text' datatype="/[1-9]\d{0,5}/" value="{$offer['accept_day']}" name="accept_day" style="width:50px;">天

                                </td>
                            </tr>

                            <tr>
                                <td>记重方式：</td>
                                <td colspan="2">
        <span>
            <select name="weight_type">
                <option value="理论值" {if:$offer['weight_type']=="理论值"}selected="true"{/if}>理论值</option>
                <option value="过磅" {if:$offer['weight_type']=="过磅"}selected="true"{/if} >过磅</option>
                <option value="轨道衡" {if:$offer['weight_type']=="轨道衡"}selected="true"{/if} >轨道衡</option>
                <option value="吃水" {if:$offer['weight_type']=="吃水"}selected="true"{/if} >吃水</option>
            </select>
        </span>
                                    <span></span>
                                </td>
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

                                    </span>
                                </td>
                            </tr> -->
                            <input type="hidden" name="cate_id" id="cid">
                            <input type="hidden" name="ajax_url" id="ajax_url" value="{url: Trade/Insurance/ajaxGetCate}">

                            <tr>
                                <td>产地：</td>
                                <td colspan="2">
                                    <span id="areabox">{area:data=$product['produce_area']}</span>
                                    <span></span>
                                </td>

                            </tr>


                            <tr>
                                <td>产品描述：</td>
                                <td colspan="2">
                                    <textarea name="note" datatype="*" errormsg="请填写产品描述">{$product['note']}</textarea>
                                </td>
                            </tr>

                            <tr>
                                <td>补充条款：</td>
                                <td colspan="2">
                                    <textarea name="other">{$offer['other']}</textarea>
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align:top;">上传图片：</td>
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
                                            {if:isset($product['imgData'])}
                                                {foreach:items=$product['imgData']}
                                                    <li   class="file-item thumbnail">
                                                        <p>
                                                            <img width="110" src="{echo:\Library\thumb::get($item,110,110)}" />

                                                        </p>
                                                        <input type="hidden" name="imgData[]" value="{$item}" />
                                                    </li>
                                                {/foreach}
                                            {/if}
                                        </ul>
                                        <script type="text/javascript">
                                            $('#filelist img').dblclick(function(){
                                                $(this).parents('li').remove();
                                            });
                                        </script>
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
                                <th colspan="3"><b>竞价信息</b></th>
                            </tr>




                            <tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>数量：</td>
                                <td>
                                    <span><input class="text" value="{$product['quantity']}" type="text" datatype="/^\d{1,10}(\.\d{0,5})?$/" errormsg="请正确填写数量" name="quantity"></span>
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
                                    <input class="text" type="text" name="unit" value="{$product['unit']}"/>
                                </td>
                                <!--  <td>
                                    请选择支付保证金比例：
                                    <input type="button" id="jian" value="-"><input type="text" id="num" value="1"><input type="button" id="add" value="+">

                                </td> -->
                            </tr>



                        <tr>
                            <td></td>
                            <td colspan="2" class="btn">
                            <input type="hidden" name='cate_id' id="cate_id" value="{$cate_id}">
                                <input type="hidden" name="token" value="{$token}" />
                                <input  type="submit"  value="提交审核" />

                            </td>
                        </tr>
                         
                 </table>
                </form>
        <script type="text/javascript">
            $(function(){
                getCategory({$cate_id});
            })
        </script>
                    </div>
                </div>
            </div>





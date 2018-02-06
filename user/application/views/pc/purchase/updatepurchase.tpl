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
            <p><a>产品管理</a>><a>修改报盘</a></p>
        </div>
        <div class="center_tabl">
            <div class="lx_gg">
                <b>商品类型</b>
            </div>

            {if: !empty($categorys)}
                {foreach: items=$categorys item=$category key=$level}
                    <div class="class_jy" id="level{$level}">
                        <span class="jy_title">{$category['childname']}：</span>
                        {set:unset($categorys[$level]['childname'])}
                        <ul>

                            {foreach: items=$category item=$cate}
                                <li value="{$cate['id']}"  {if: $cate['id']==$cate_sel[$level]} class="a_choose"{/if}  ><a>{$cate['name']}</a></li>
                            {/foreach}
                        </ul>


                    </div>
                {/foreach}
            {/if}

            <form action="{url:/purchase/doUpdatepurchase}" method="POST" auto_submit redirect_url="{url:/Purchase/lists}">
                <table border="0"  >

                    <tr>
                        <th colspan="3">基本挂牌信息</th>
                    </tr>
                    <tr>
                        <td nowrap="nowrap"><span></span>商品名称：</td>
                        <td colspan="2">
                            <span><input class="text" type="text" datatype="s1-30" errormsg="填写商品标题" name="warename" value="{$product['product_name']}"></span>
                            <span></span>
                        </td>

                    </tr>
                    <tr>
                        <td nowrap="nowrap"><span></span>商品价格区间：</td>
                        <td>
            <span>
                <input class="text" style="width:90px;" type="text" errormsg="填写正确填写单价" value="{$offer['price_l']}" name="price"> -
                <input class="text" style="width:90px;" type="text" errormsg="填写正确填写单价" value="{$offer['price_r']}" name="price_r">
                (元)
            </span>

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
                            <span><input class="text" type="text" datatype="float" errormsg="填写正确填写数量" value="{$product['quantity']}" name="quantity"></span>
                            <span></span>
                        </td>
                        <span></span>
                        <!--  <td>
                            请选择支付保证金比例：
                            <input type="button" id="jian" value="-"><input type="text" id="num" value="1"><input type="button" id="add" value="+">

                        </td> -->

                    <tr>
                    <tr>
                        <td nowrap="nowrap"><span></span>单位：</td>
                        <td>
                            <span  ><input class="text" type="text" name="unit" value="{$product['unit']}"/></span>
                        </td>

                        <!--  <td>
                            请选择支付保证金比例：
                            <input type="button" id="jian" value="-"><input type="text" id="num" value="1"><input type="button" id="add" value="+">

                        </td> -->

                    <tr>
                        {foreach: items=$attrs item=$attr}
                    <tr class="attr">
                        <td nowrap="nowrap"><span></span>{$attr['name']}：</td>
                        <td colspan="2">
                            <input class="text" type="text" name="attribute[{$attr['id']}]" >
                        </td>
                    </tr>
                    {/foreach}
                    <tr style="display:none" id='productAdd'>
                        <td ></td>
                        <td ></td>
                    </tr>

                    <tr>
                        <td>产地：</td>
                        <td colspan="2">
                            <span>{area:data=$product['produce_area']}</span>
                            <span></span>
                        </td>

                    </tr>


                    <tr>
                        <td>有效期：</td>
                        <td colspan="2">
                            <span > <input class="Wdate" type="text" value="{$offer['expire_time']}" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',minDate:'%y-%M-#{%d+1}'})" name="expire_time" value=""></span>
                            <span></span>
                        </td>

                    </tr>

                    <tr>
                        <td style="vertical-align:top;">上传图片：</td>
                        {if:isset($product['imgData'])}
                        {set:$imgData=$product['imgData']}
                        {/if}

                        <td>
                            {include:layout/webuploader.tpl}
                        </td>
                    </tr>
                    <tr>
                        <th colspan="3"><b>详细信息</b></th>
                    </tr>

                    </tr>


                    <tr>
                        <td>交收地点：</td>
                        <td colspan="2">
                            <span><input type="text" class='text' datatype="s1-30"  errormsg="请填写有效地址" nullmsg="请填写交收地点" name="accept_area" value="{$offer['accept_area']}"></span>
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
                            <textarea name="note" >{$product['note']}</textarea>
                        </td>
                    </tr>
                <tr>
                    <td></td>
                    <td colspan="2" class="btn">
                        <input type="hidden" name="offer_id" value="{$offer['id']}" />
                        <input type="hidden" name='cate_id' id="cate_id" value="{$product['cate_id']}">
                        <input type="hidden" name="token" value="{$token}" />
                        <input  type="submit"  value="提交审核" />
                        <span class="color"></span>
                    </td>
                </tr>

                </table>
            </form>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        getCategory({$product['cate_id']},{$attr});
    })
</script>



			
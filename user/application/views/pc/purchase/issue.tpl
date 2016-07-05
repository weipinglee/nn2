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


</div>

       <input type="hidden" name="attr_url" value="{url:/ManagerDeal/ajaxGetCategory}"  />
<script type="text/javascript" src="{views:js/product/attr.js}" ></script>
            <!--start中间内容-->    
            <div class="user_c">
                <div class="user_zhxi pro_classify">
                    <div class="zhxi_tit">
                        <p><a>产品管理</a>><a>发布采购</a></p>
                    </div>
                    <div class="center_tabl">
                    <div class="lx_gg">
                        <b>商品类型和规格</b>
                    </div>

                    {if: !empty($categorys)}
                        {foreach: items=$categorys item=$category key=$level}   
                            <div class="class_jy" id="level{$level}">
                                <span class="jy_title">市场类型：</span>
                                <ul>
                                    {foreach: items=$category['show'] item=$cate}
                                    <li value="{$cate['id']}"  {if: $key==0} class="a_choose" {/if} ><a>{$cate['name']}</a></li>
                                    {/foreach}
                                </ul>
                            </div>
                        {/foreach}
                        {/if}


                    <form action="{url:/Purchase/issue}" method="POST" auto_submit redirect_url="{url:/Purchase/issue}">
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
        <td nowrap="nowrap"><span></span>商品名称：</td>
        <td colspan="2">
            <span><input class="text" type="text" datatype="s1-30" errormsg="填写商品标题" name="warename"></span>
            <span></span>
        </td>

    </tr>
    <tr>
        <td nowrap="nowrap"><span></span>商品价格区间:</td>
        <td>
            <span>
                <input class="text" style="width:90px;" type="text" errormsg="填写正确填写单价" name="price"> -
                <input class="text" style="width:90px;" type="text" errormsg="填写正确填写单价" name="price_r">
                (/ <span class="unit" >{$unit}</span>)
            </span>

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
            <span><input class="text" type="text" datatype="float" errormsg="填写正确填写数量" name="quantity"></span>
            <span></span>
        </td>
        <span></span>
        <!--  <td>
            请选择支付保证金比例：
            <input type="button" id="jian" value="-"><input type="text" id="num" value="1"><input type="button" id="add" value="+">

        </td> -->

    <tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>单位:</td>
                                <td>
                                    <span class="unit" >{$unit}</span>
                                </td>

                                <!--  <td>
                                    请选择支付保证金比例：
                                    <input type="button" id="jian" value="-"><input type="text" id="num" value="1"><input type="button" id="add" value="+">

                                </td> -->

                            <tr>
        <td>产地:</td>
        <td colspan="2">
            <span>{area:data=getAreaData()}</span>
            <span></span>
        </td>

    </tr>




    <tr>
        <td>上传图片：</td>
        <td>
                                   {include:layout/webuploader.tpl}
        </td>
    </tr>
    <tr>
        <th colspan="3"><b>详细信息</b></th>
    </tr>

    </tr>
   
    <tr id='nowrap' style="display: none">
        <td nowrap="nowrap" ><span>*</span>最小起订量：</td>
        <td>
            <input name="minimum" id="" type="text" class="text"  />
        </td>
        <td>
            <span>*</span>
            最小起订量即为最小起增量，最小设为1，不填写规则为不可拆分
        </td>
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
        <span>T+<input type="text" class='text' style="width:100px"  name="accept_day">天</span>
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
                            <td></td>
                            <td colspan="2" class="btn">
                            <input type="hidden" name='cate_id' id="cate_id" value="{$cate_id}">
                                <input  type="submit" onclick="checkform()" value="提交审核" />
                        </tr>
                         
                 </table>
                </form>
                        
                    </div>
                </div>
            </div>






﻿<script type="text/javascript" src="{root:js/area/AreaData_min.js}" ></script>
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
    <div class="sl_ext">
        <a href="javascript:;" class="sl_e_more info-show" style="visibility: visible;">展开</a>
    </div>

</div>

       <input type="hidden" name="attr_url" value="{url:/ManagerDeal/ajaxGetCategory}"  />
<script type="text/javascript" src="{views:js/product/attr.js}" ></script>
            <!--start中间内容-->    
            <div class="user_c">
                <div class="user_zhxi pro_classify">
                    <div class="zhxi_tit">
                        <p><a>产品管理</a>><a>商品分类</a></p>
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
                                    <li value="{$cate['id']}"  {if: $key==0} class="a_choose"{/if}  ><a>{$cate['name']}</a></li>
                                    {/foreach}
                                </ul>

                                    {if: !empty($category['hide'])}
                                    <ul class="infoslider" style="display: none;">
                                        {foreach: items=$category['hide'] item=$cate}
                                        <li value="{$cate['id']}"  ><a>{$cate['name']}</a></li>
                                        {/foreach}
                                    </ul>
                                        <div class="sl_ext">
                                        <a href="javascript:;" class="sl_e_more info-show" style="visibility: visible;">展开</a>
                                        </div>
                                    {/if}
                            </div>
                        {/foreach}
                        {/if}


                    <form action="{url:/ManagerDeal/doStoreProduct}" method="POST" auto_submit redirect_url="{url:/managerdeal/storeproductlist}">
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
                                <input class="text" type="text" datatype="s1-30" errormsg="填写商品标题" name="warename">
                            </td>
                        </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>商品单价:</td>
                                <td> 
                                    <input class="text" type="text" datatype="float" errormsg="填写正确填写数量" name="price">
                                    
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
                                    <input class="text" type="text" datatype="float" errormsg="填写正确填写数量" name="quantity">
                                </td>
                               <!--  <td> 
                                   请选择支付保证金比例：
                                   <input type="button" id="jian" value="-"><input type="text" id="num" value="1"><input type="button" id="add" value="+">
                                           
                               </td> -->

                                <tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>单位:</td>
                                <td>
                                    <span id="unit">{$unit}</span>
                                </td>
                                <!--  <td>
                                    请选择支付保证金比例：
                                    <input type="button" id="jian" value="-"><input type="text" id="num" value="1"><input type="button" id="add" value="+">

                                </td> -->

                            <tr>
                            <td>产地:</td>
                            <td colspan="2">
                                {area:data=getAreaData()}
                            </td>
                         
                        </tr>
                            
                               
                            
                            <tr>
                                <td>图片预览：</td>
                                <td colspan="2">
                                    <span class="zhs_img" id='imgContainer'>

                                    </span>
                                </td>              
                            </tr>
                            <tr>
                                <td>上传图片：</td>
                                <td>
                                    <span>
                                        <div>

                                            <input id="pickfiles"  type="button" value="选择文件">
                                            <input type="button"  id='uploadfiles' class="tj" value="上传">
                                        </div>
                                        <div id="filelist"></div>
                                        <pre id="console"></pre>
                                    </span> 
                                 </td>
                             </tr>
                         <tr>
                             <th colspan="3"><b>详细信息</b></th>
                        </tr>


                                 </tr>
                                    <tr>
                                        <td><span>*</span>选择仓库：</td>
                                        <td>
                                            <select name="store_id" id="store_id">
                                            {foreach: items=$storeList item=$list}
                                                <option value="{$list['id']}" {if: $key==0} selected {/if} >{$list['name']}</option>
                                            {/foreach}
                                            </select>
                                        </td>
                                        </tr>
                                   <tr>
                                        <td>是否包装：</td>
                                        <td colspan="2">
                                            <select name="package" id="package">
                                                <option value="1" selected="selected">是</option>
                                                <option value="0">否</option>
                                            </select>
                                        </td>

                                             </tr>

                                            <tr id="packUnit" >
                                                 <td>计量单位：</td>
                                            <td colspan="2">
                                                <input type="text" class='text' name="packUnit">
                                            </td>
                                            </tr>
                                            <tr id='packNumber'>
                                            <td>包装数量：</td>
                                            <td colspan="2">
                                                <input type="text" class='text' name="packNumber">
                                            </td>
                                            </tr>
                                            <tr id='packWeight'>
                                            <td>包装重量：</td>
                                            <td colspan="2">
                                                <input type="text" class='text' name="packWeight">
                                            </td>
                                            </tr>


<!--                               <tr>
                            <td>是否投保：</td>
                            <td colspan="2">
  <input type ="radio" name ="safe" checked="checked" style="width:auto;height:auto;">投保
      <input type ="radio" name ="safe" style="width:auto;height:auto;"> 不投保
                            </td>
                        </tr> -->
                        <tr>
                            <td>产品描述：</td>
                            <td colspan="2">
                                <textarea name="note"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td colspan="2" class="btn">
                            <input type="submit" value='提交审核' >
                            <input type="hidden" name='cate_id' id="cate_id" value="{$cate_id}">


                                
                            </td>
                        </tr>
                         
                 </table>
                </form>
                        
                    </div>
                </div>
            </div>

            {$plupload}



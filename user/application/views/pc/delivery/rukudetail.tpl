<div class="user_c">
    <div class="user_zhxi">
        <div class="zhxi_tit">
            <p><a>入库单管理</a>><a>入库单详情</a></p>
        </div>
        <div class="center_tabl">

                <table class="table2" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="spmx_title" colspan="8">入库详细信息</td>
                    </tr>
                    <tr>
                        <td colspan="2">仓单编号</td>
                        <td colspan="6">{$info['sign_no']}</td>
                    </tr>
                    <tr>
                        <td colspan="2">仓库名称</td>
                        <td colspan="6">{$info['store_name']}</td>
                    </tr>


                    <tr>
                        <td colspan="2">库位</td>
                        <td colspan="6">
                            {$info['store_pos']}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"> 仓位</td>
                        <td colspan="6"> {$info['cang_pos']}</td>
                    </tr>

                    <tr>
                        <td colspan="2">检测机构</td>
                        <td colspan="6">{$info['check_org']}</td>
                    </tr>
                    <tr>
                        <td colspan="2">质检证书编号</td>
                        <td colspan="6">{$info['check_no']}</td>
                    </tr>
                    <tr>
                        <td colspan="2">是否包装</td>
                        <td colspan="6"> {if: $info['package'] == 1} 是 {else:} 否{/if}</td>
                    </tr>

                    {if: $info['package'] == 1}
                        <tr  >
                            <td colspan="2"> 包装单位：</td>
                            <td colspan="6">
                                {$info['package_unit']}
                            </td>
                        </tr>
                        <tr >
                            <td colspan="2">包装数量：</td>
                            <td colspan="6">
                                {$info['package_num']}
                            </td>
                        </tr>
                        <tr  >
                            <td colspan="2">包装重量：</td>
                            <td colspan="6">
                                {$info['package_weight']}({$info['package_units']})
                            </td>
                        </tr>
                    {/if}
                    <tr>
                        <td class="spmx_title" colspan="8">商品信息</td>
                    </tr>
                    <tr>
                        <td colspan="2">商品名称</td>
                        <td colspan="6">
                            {$info['product']['product_name']}
                        </td>
                    </tr>


                    <tr>
                        <td colspan="2">属性</td>
                        <td colspan="6"> {$info['product']['attrs']}</td>
                    </tr>

                    <tr>
                        <td colspan="2">分类</td>
                        <td colspan="6">
                            {foreach:items=$info['product']['cate'] item=$cate key=$k}
                                {if:$k==0}
                                    {$cate['name']}
                                {else:}
                                    > {$cate['name']}
                                {/if}

                            {/foreach}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">重量</td>
                        <td colspan="6">{$info['quantity']}({$info['unit']})</td>
                    </tr>
                    <tr>
                        <td colspan="2">产地</td>
                        <td colspan="6">{areatext:data=$info['product']['produce_area']}</td>
                    </tr>
                     <tr>
                        <td colspan="2">商品描述</td>
                        <td colspan="6">{$info['product']['note']}</td>
                    </tr>
                    <tr>
                        <td colspan="2">图片预览</td>
                        <td colspan="6">
                            <span class="zhs_img">
                                    {foreach: items=$info['product']['photos'] item=$url}
                                        <img src="{$url}"/>
                                    {/foreach}
    				        </span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">签字入库单</td>
                        <td colspan="6"> <img src="{$info['confirm_thumb']}" /></td>
                    </tr>
                     <tr>
                        <td colspan="2">质检证书：</td>
                        <td colspan="6"> <img src="{$info['quality']}" /></td>
                    </tr>
                    <tr>
                        <td colspan="2">产品描述：</td>
                        <td colspan="6">
                            {$info['product']['note']}
                        </td>
                    </tr>

                </table>


        </div>
    </div>
</div>





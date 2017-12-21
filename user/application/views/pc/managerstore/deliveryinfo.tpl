
<script type="text/javascript" src='{root:js/area/Area.js}'></script>
<script type="text/javascript" src='{root:js/area/AreaData_min.js}'></script>

<div class="user_c_list">
    <div class="user_zhxi">
        <div class="zhxi_tit">
            <p><a>出库单管理</a>&gt;<a>出库单</a></p>
        </div>
        <div class="inventory_table">
            <form method="post" confirm="1" confirm_text="确认要出库？" action="{url:/ManagerStore/storeDeliveryCheck}" auto_submit="1" redirect_url="{url:/Managerstore/storechecklist}">
                <input type="hidden" name="id" value="{$info['id']}" />
            <table class="table1">
                <tr><th colspan="6">提货单(出库单)</th></tr>
                <tr>
                    <td>提单号</td>
                    <td>{$info['id']}</td>
                    <td>开单日期</td>
                    <td> {$info['create_time']}</td>
                    <td>提单状态</td>
                    <td> {$info['status_txt']}</td>
                </tr>
                <tr>
                    <td>购货单位</td>
                    <td>{$info['order']['buyer_name']}</td>
                    <td>仓库</td>
                    <td colspan="3">
                        {$info['store_name']}
                    </td>
                </tr>
                <tr>
                    <td>提货人</td>
                    <td> {$info['delivery_man']}</td>
                    <td class="bz_td" colspan="4" rowspan="6"><div class="bz">备注: {$info['remark']}</div></td>
                </tr>
                <tr>
                    <td>联系电话</td>
                    <td> {$info['phone']}</td>
                </tr>
                <tr>
                    <td>身份证号码</td>
                    <td> {$info['idcard']}</td>
                </tr>
                <tr>
                    <td>车牌号</td>
                    <td> {$info['plate_number']}</td>
                </tr>
                <tr>
                    <td>记重方式</td>
                    <td>{$info['weight_type']}</td>
                </tr>
                <tr>
                    <td>出库日期</td>
                    <td>
                        <input class="Wdate text" datatype="*"  type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',minDate:'%y-%M-#{%d}'})"
                               name="out_time" value="{if:$info['out_time']!='0000-00-00'}{$info['out_time']}{/if}"/>
                    </td>
                </tr>
                <tr>
                    <td>品名</td>
                    <td colspan="3">{$info['name']}</td>
                    <td>提货量（{$info['unit']}）</td>
                    <td>{$info['delivery_num']}</td>
                </tr>
                <tr>
                    <td rowspan="2">出库明细</td>
                    <td>货号</td>
                    <td colspan="2">生产厂商</td>
                    <td>库位</td>
                    <td>提货量（{$info['unit']}）</td>
                </tr>
                <tr>
                    <td>{$info['product_id']}</td>
                    <td colspan="2">{$info['order']['seller_name']}</td>
                    <td>{$info['store_pos']}</td>
                    <td>{$info['delivery_num']}</td>
                </tr>
                <tr>
                    <td>出库数量</td>
                    <td>实际提货量（{$info['unit']}）：</td>
                    <td colspan="2"><input type="text" name="act_num" value="{$info['act_num']}"/></td>
                    <td>实际磅秤（{$info['unit']}）：</td>
                    <td><input type="text" name="act_bang" value="{$info['act_bang']}" /></td>
                </tr>
            </table>
            <table class="table2">
                <tr>
                    <td>现场操作员签字：</td>
                    <td>日期：</td>
                    <td>备注：</td>
                </tr>
                <tr>
                    <td>仓管员签字：</td>
                    <td>日期：</td>
                    <td>备注：</td>
                </tr>
                <tr>
                    <td>提货人签字：</td>
                    <td>日期：</td>
                    <td>备注：</td>
                </tr>
            </table>
            <div class="button_div">
                <a href="{url:/Managerstore/deliveryInfoPrint?id=$info['id']@user}">打印</a>
               {if:$info['pstatus']== \nainai\Delivery\delivery::DELIVERY_MANAGER_CHECKOUT}
                   <input type="submit" value="确认出库" />
               {/if}

            </div>
                </form>
        </div>

    </div>
</div>

			
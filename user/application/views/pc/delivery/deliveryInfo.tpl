<script type="text/javascript" src="{root:js/jquery/jquery-1.7.2.min.js}"></script>
<script type="text/javascript" src='{root:js/area/Area.js}'></script>
<script type="text/javascript" src='{root:js/area/AreaData_min.js}'></script>

<div class="user_c_list">
    <div class="user_zhxi">
        <div class="zhxi_tit">
            <p><a>出库单管理</a>&gt;<a>出库单</a></p>
        </div>
        <div class="inventory_table">
            <table class="table1">
                <tr><th colspan="6">提货单(出库单)</th></tr>
                <tr>
                    <td>提单号</td>
                    <td>{$info['delivery_id']}</td>
                    <td>开单日期</td>
                    <td> {$info['create_time']}</td>
                    <td>提单状态</td>
                    <td> {$info['title']}</td>
                </tr>
                <tr>
                    <td>购货单位</td>
                    <td>{$info['order']['buyer_name']}</td>
                    <td>仓库</td>
                    <td colspan="3">
                        {areatext:data=$info['order']['store_area']}&nbsp;
                        {$info['order']['store_address']}&nbsp;
                        {$info['order']['store_name']}
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
                    <td>{$info['order']['weight_type']}</td>
                </tr>
                <tr>
                    <td>出库日期</td>
                    <td>{$info['out_time']}</td>
                </tr>
                <tr>
                    <td>品名</td>
                    <td colspan="3">{$info['order']['name']}</td>
                    <td>提货量（{$info['order']['unit']}）</td>
                    <td>{$info['num']}</td>
                </tr>
                <tr>
                    <td rowspan="2">出库明细</td>
                    <td>货号</td>
                    <td colspan="2">生产厂商</td>
                    <td>库位</td>
                    <td>提货量（{$info['order']['unit']}）</td>
                </tr>
                <tr>
                    <td>{$info['order']['product_id']}</td>
                    <td colspan="2">{$info['order']['seller_name']}</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>出库数量</td>
                    <td>实际提货量（{$info['order']['unit']}）：</td>
                    <td colspan="2">{$info['act_num']}</td>
                    <td>实际磅秤（{$info['order']['unit']}）：</td>
                    <td>{$info['act_bang']}</td>
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
                <a href="{url:/delivery/deliveryInfoPrint?delivery_id=$info['delivery_id']&order_no=$info['order_no']@user}"><button class="button_print">打印</button></a>
            </div>
        </div>
    </div>
</div>

			
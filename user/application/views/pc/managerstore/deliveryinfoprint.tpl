<script type="text/javascript" src="{root:js/jquery/jquery-1.7.2.min.js}"></script>
<script type="text/javascript" src='{root:js/area/Area.js}'></script>
<script type="text/javascript" src='{root:js/area/AreaData_min.js}'></script>
<link href="{views:css/user_index.css}" rel="stylesheet" type="text/css" />
<div class="user_c_list">
    <div class="user_zhxi">

        <div class="inventory_table">
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
                    <td>{$info['out_time']}</td>
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
                    <td colspan="2">{$info['act_num']}</td>
                    <td>实际磅秤（{$info['unit']}）：</td>
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
                <button class="button_print" onclick="window.print()">打印</button>
            </div>
        </div>
    </div>
</div>

			
<!--
        CONTENT
                  -->
<div id="content" class="white">
    <h1><img src="{views:img/icons/dashboard.png}" alt="" />出库单详情
    </h1>

    <div class="bloc">
        <div class="title">
            出库单详情
        </div>
        <div class="pd-20">

            <input type="hidden" name="delivery_id" value="{$info['delivery_id']}" />
                <input type="hidden" name="order_no" value="{$info['order_no']}" />
                <input type="hidden" name="buyer_id" value="{$info['user_id']}" />
                <input type="hidden" name="seller_id" value="{$info['seller_id']}" />
                <table class="table table-border table-bordered table-bg">

                    <tr>
                        <th>提单号</th>
                        <td>{$info['delivery_id']}</td>
                        <th>开单日期</th>
                        <td>{$info['create_time']}</td>
                        <th>提单状态</th>
                        <td>{$info['status_txt']}</td>
                    </tr>
                    <tr>
                        <th>购货单位</th>
                        <td>{$info['order']['buyer_name']}</td>
                        <th>仓库</th>
                        <td>{$info['store_name']}</td>
                        <th>提货人</th>
                        <td>{$info['delivery_man']}</td>

                    </tr>
                    <tr>
                        <th>联系电话</th>
                        <td >{$info['phone']}</td>
                        <th>车牌号</th>
                        <td >{$info['plate_number']}</td>
                        <th>身份证号</th>
                        <td >{$info['idcard']}</td>
                    </tr>
                    <tr>
                        <th>计重方式</th>
                        <td >{$info['weight_type']}</td>
                        <th>出库日期</th>
                        <td >{$info['out_time']}</td>
                        <th>品名</th>
                        <td >{$info['product_name']}</td>
                    </tr>
                    <tr>
                        <th>货号</th>
                        <td >{$info['product_id']}</td>
                        <th>生产厂家</th>
                        <td >{$info['order']['seller_name']}</td>
                        <th>提货量</th>
                        <td >{$info['delivery_num_txt']}</td>
                    </tr>
                    <tr>
                        <th>库位</th>
                        <td >{$info['store_pos']}</td>
                        <th>实际提货量（{$info['unit']}）</th>
                        <td >{$info['act_num']}</td>
                        <th>实际磅秤量（{$info['unit']}）</th>
                        <td >{$info['act_bang']}</td>
                    </tr>
                    <tr>
                        <th>备注</th>
                        <th scope="col" colspan="7">
                            {$info['remark']}
                        </th>
                    </tr>
                    <tr>
                        <th>审核意见</th>
                        <th scope="col" colspan="7">
                            {$info['admin_msg']}
                        </th>
                    </tr>

                    <tr>
                        <th>操作</th>
                        <th scope="col" colspan="7">
                          <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove fa-remove"></i> 返回</a>
                        </th>
                    </tr>

                </table>

        </div>
    </div>
</div>


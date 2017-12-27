

        <script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
        <script type="text/javascript" src="{views:js/validform/validform.js}"></script>
        <script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
        <script type="text/javascript" src="{views:js/layer/layer.js}"></script>
        <!--            
              CONTENT 
                        -->
        <div id="content" class="white">

            <h1><img src="{views:img/icons/dashboard.png}" alt="" />交易完结确认

</h1>

<div class="bloc">
    <div class="title">

       交易完结确认单

    </div>
     <div class="pd-20">
     <form action="{url:trade/pairing/doTradeComplate}" method="POST" auto_submit redirect_url="{url:trade/pairing/contractList}">
     
     <table class="table table-border table-bordered table-bg">


            
            <tr>

              <th>买方单位名称</th>
              <td >
               {$info['buyer_name']}
              </td>
                <th>卖方单位名称</th>
                <td >
                    {$info['seller_name']}
                </td>

            </tr>
            <tr>


                <th>合同编号</th>
                <td colspan="3">
                    {$info['order_no']}
                </td>
            </tr>

            <tr>
                <th>合同金额：</th>
                <td >大写：
                     {echo:\Library\tool::toChineseNumber($info['amount'])}
                </td>
                <th>小写</th>
                <td >
                   {$info['amount']}
                </td>
            </tr>

            <tr>
                <th>下单日期</th>
                <td >
                     {$info['create_time']}
                </td>
                <th>付款时间</th>
                <td >
                     {if:isset($info['pay_log'][1]['create_time'])}
                        {$info['pay_log'][1]['create_time']}
                     {/if}
                </td>
            </tr>

            <tr>
                <th>提货日期</th>
                <td >
                   {$delivery['expect_time']}
                </td>
                <th>出库日期</th>
                <td >
                    {$delivery['out_time']}
                </td>
            </tr>

              <tr>
                 <th>操作</th>
                 <input type="hidden" name="order_id" value="{$info['id']}" />
                  <td scope="col" colspan="3">
                    <input class="btn btn-primary radius" type="submit" value="确认完成&nbsp;&nbsp;">
                  <a class="btn btn-default radius" type="" onclick="javascript:history.back();"><i class="icon-remove fa-remove"></i>&nbsp;&nbsp;返回&nbsp;&nbsp;</a>
                  
                 </td>
             </tr>

    </table>
    </form>
  </div>
</div>
</div>





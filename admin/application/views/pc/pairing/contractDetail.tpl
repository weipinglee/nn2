

        <script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
        <script type="text/javascript" src="{views:js/validform/validform.js}"></script>
        <script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
        <script type="text/javascript" src="{views:js/layer/layer.js}"></script>
        <!--            
              CONTENT 
                        -->
        <div id="content" class="white">

            <h1><img src="{views:img/icons/dashboard.png}" alt="" />添加撮合人

</h1>

<div class="bloc">
    <div class="title">

        合同信息

       合同信息

    </div>
     <div class="pd-20">
     <form action="{url:trade/pairing/addPairing}" method="POST" auto_submit redirect_url="{url:trade/pairing/contractList}">
     
     <table class="table table-border table-bordered table-bg">

      <tr>
        <th>订单号</th>
        <td colspan="5">{$info['order_no']}</td>
      </tr>
            
            <tr>

              <th>撮合人</th>
              <td colspan="5">
                    <select name='admin_id'>
                      {$admin_list}
                    </select>
              </td>

            </tr>
            <tr>

              <th>商品名</th>
              <td colspan="5">{$info['name']}</td>
            </tr>

            <tr>
              <th>所属分类</th>
              <td colspan="5">{$info['cate_name']}</td>
            </tr>

            <tr>
               <th>提货数量</th>
               <td colspan="6">{$info['num']}{$info['unit']}</td>
            </tr>

            <tr>
              <th>下单时间</th>
              <td colspan="6">{$info['create_time']}</td>
            </tr>
            
            <tr>
                <th>买方信息</th>
                <td>{$info['buyer']['username']}</td>
                <td>{$info['buyer']['email']}</td>
                <td>{$info['buyer']['mobile']}</td>
            </tr>
            <tr>
                <th>卖方信息</th>
                <td>{$info['seller']['username']}</td>
                <td>{$info['seller']['email']}</td>
                <td>{$info['seller']['mobile']}</td>
            </tr>  


              <tr>
                 <th>操作</th>
                 <input type="hidden" name="order_id" value="{$info['id']}" />
                 <input type="hidden" name="pairing_id" value="{$info['pairing_id']}" />
                  <th scope="col" colspan="7">

                  
                    <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;{if:empty($info['pairing_id'])}添加{else:}更新{/if}&nbsp;&nbsp;">
                  <a class="btn btn-default radius" type="" onclick="javascript:history.back();"><i class="icon-remove"></i>&nbsp;&nbsp;返回&nbsp;&nbsp;</a>
                  
                 </th>
             </tr>

    </table>
    </form>
  </div>
</div>
</div>

        
    </body>
</html>




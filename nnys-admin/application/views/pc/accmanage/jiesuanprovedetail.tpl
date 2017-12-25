

        <script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
        <script type="text/javascript" src='{root:js/upload/ajaxfileupload.js}'></script>
        <script type="text/javascript" src='{root:js/upload/upload.js}'></script>
        <script type="text/javascript" src="{views:js/validform/validform.js}"></script>
        <script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
        <script type="text/javascript" src="{views:js/layer/layer.js}"></script>
        <!--            
              CONTENT 
                        -->
        <div id="content" class="white">

            <h1><img src="{views:img/icons/dashboard.png}" alt="" />结算证明单确认

</h1>

<div class="bloc">
    <div class="title">

        合同信息

       合同信息

    </div>
     <div class="pd-20">
     <form action="{url:balance/accmanage/dojiesuanProve}" method="POST" auto_submit redirect_url="{url:balance/accmanage/jiesuanProveList}">
     
     <table class="table table-border table-bordered table-bg">

      <tr>
        <th>订单号</th>
        <td colspan="5">{$info['order_no']}</td>
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
         {if:$info['jiesuan_prove']!=''}
             <tr>
                 <th>结算证明</th>
                 <td colspan="5">
                   <a href="{$info['jiesuan_prove']}">
                       <img src="{$info['jiesuan_prove']}" width="200"/>
                   </a>
                 </td>
             </tr>
        {else:}

             <tr>
                 <th>上传结算证明单</th>
                 <td colspan="5">  <input type="hidden" name="uploadUrl"             value="{url:balance/fundOut/upload}" />
                     <input type='file' name="file2" id="file2"  onchange="javascript:uploadImg(this);" /></td>

             </tr>
             <tr>
                 <th></th>
                 <td>   <img name="file2" />
                     <input type="hidden" name="imgfile2" id="imgfile2" /></td>
             </tr>
         {/if}


              <tr>
                 <th>操作</th>

                  <th scope="col" colspan="7">
                      {if:$info['jiesuan_prove']==''}
                      <input type="hidden" name="order_id" value="{$info['id']}" />
                      <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                      {/if}

                      <a class="btn btn-default radius" type="" onclick="javascript:history.back();"><i class="icon-remove fa-remove"></i>&nbsp;&nbsp;返回&nbsp;&nbsp;</a>
                  
                 </th>
             </tr>

    </table>
    </form>
  </div>
</div>
</div>






<script type="text/javascript" src="{root:js/area/Area.js}" ></script>
<script type="text/javascript" src="{root:js/area/AreaData_min.js}" ></script>
<div id="content" class="white">
<h1><img src="{views:img/icons/dashboard.png}" alt="" />交易管理
</h1>
                
<div class="bloc">
    <div class="title">
       合同撮合人
    </div>
    <form action="{url:trade/pairing/addPairing}" method="post" class="form form-horizontal" id="form-member-add" auto_submit redirect_url="{url:store/storeorder/checkorderList}">
   <div class="pd-20">
      <input type="hidden" name="order_id" value="{$info['id']}" />
  
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>撮合人：</label>
      <div class="formControls col-5">
        {if:isset($info['admin_id'])}
        {$info['admin_name']}
        <input type="hidden" name="admin_id" value="{$info['admin_id']}">
        {else:}
        <select name='admin_id'>
          {$admin_list}
        </select>
        {/if}
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>订单号：</label>
      <div class="formControls col-5">
        {$info['order_no']}
      </div>
      <div class="col-4"> </div>
    </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>商品名：</label>
          <div class="formControls col-5">
             {$info['name']}
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>所属分类：</label>
          <div class="formControls col-5">
              {$info['cate_name']}
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>提货数量：</label>
          <div class="formControls col-5">
              {$info['num']}{$info['unit']}
          </div>
          <div class="col-4"> </div>
      </div>

      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>下单时间：</label>
          <div class="formControls col-5">
              {$info['create_time']}
          </div>
          <div class="col-4"> </div>
      </div>
    </div>
    
         

   
    <div class="row cl">
      <div class="col-9 col-offset-3" style="margin-bottom: 20px">
        {if:!isset($info['admin_id'])}
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;添加&nbsp;&nbsp;">

        {/if}
        <a class="btn btn-primary radius" type="" onclick="javascript:history.back();">&nbsp;&nbsp;返回&nbsp;&nbsp;</a>
      </div>
    </div>
    </form>
</div>
</div>
</div>

</div>


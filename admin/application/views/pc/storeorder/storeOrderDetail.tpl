<script type="text/javascript" src="{root:js/area/Area.js}" ></script>
<script type="text/javascript" src="{root:js/area/AreaData_min.js}" ></script>
<div id="content" class="white">
<h1><img src="{views:img/icons/dashboard.png}" alt="" />仓库管理
</h1>
                
<div class="bloc">
    <div class="title">
       仓库订单详情
    </div>
   <div class="pd-20">
  <form action="{url:store/storeorder/storeOrderPass}" method="post" class="form form-horizontal" id="form-member-add" auto_submit redirect_url="{url:store/storeorder/checkorderList}">
      <input type="hidden" name="id" value="{$info['delivery_id']}" />
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>订单号：</label>
      <div class="formControls col-5">
        {$info['order_no']}
      </div>
      <div class="col-4"> </div>
    </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>提货单号：</label>
          <div class="formControls col-5">
              {$info['delivery_id']}
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>仓库名：</label>
          <div class="formControls col-5">
              {$info['store_name']}
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>商品名：</label>
          <div class="formControls col-5">
             {$info['product_name']}
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
              {$info['delivery_num']}{$info['unit']}
          </div>
          <div class="col-4"> </div>
      </div>
     <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>提货时间：</label>
          <div class="formControls col-5">
              {$info['delivery_time']}
          </div>
          <div class="col-4"> </div>
      </div>
    
         

   
    <div class="row cl">
      <div class="col-9 col-offset-3">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;通过&nbsp;&nbsp;">
      </div>
    </div>
  </form>
</div>
</div>
</div>

</div>


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
      <input type="hidden" name="order_no" value="{$info['order_no']}" />
      <input type="hidden" name="buyer_id" value="{$info['user_id']}" />
      <input type="hidden" name="seller_id" value="{$info['seller_id']}" />
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
          <label class="form-label col-3"><span class="c-red">*</span>提货数量：</label>
          <div class="formControls col-5">
              {$info['delivery_num']}{$info['unit']}
          </div>
          <div class="col-4"> </div>
      </div>
       <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>申请提货时间：</label>
          <div class="formControls col-5">
              {$info['delivery_time']}
          </div>
          <div class="col-4"> </div>
      </div>
       <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>预计提货时间：</label>
          <div class="formControls col-5">
              {$info['expect_time']}
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>结算时间：</label>
          <div class="formControls col-5">
              {$info['jiesuan_time']}
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>提货时间：</label>
          <div class="formControls col-5">
              {$info['out_time']}
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
          <label class="form-label col-3"><span class="c-red">*</span>产品大类：</label>
          <div class="formControls col-5">
              {$info['cate_name']}
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>规格：</label>
          <div class="formControls col-5">
              {$info['attrs']}
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>产地：</label>
          <div class="formControls col-5" id="areat">
          {areatext: data=$info['produce_area'] id=areat }
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>商品单价：</label>
          <div class="formControls col-5">
              {$info['price']}
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>商品数量：</label>
          <div class="formControls col-5">
              {$info['quantity']}{$info['unit']}
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
          <label class="form-label col-3"><span class="c-red">*</span>有效期：</label>
          <div class="formControls col-5">
              {$info['expire_time']}
          </div>
          <div class="col-4"> </div>
      </div>
      
     <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>提货人：</label>
          <div class="formControls col-5">
              {$info['delivery_man']}
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>电话：</label>
          <div class="formControls col-5">
              {$info['phone']}
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>身份证：</label>
          <div class="formControls col-5">
              {$info['idcard']}
          </div>
          <div class="col-4"> </div>
      </div>
     <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>车牌号：</label>
          <div class="formControls col-5">
              {$info['plate_number']}
          </div>
          <div class="col-4"> </div>
      </div>
       <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>备注</label>
          <div class="formControls col-5">
              {$info['remark']}
          </div>
          <div class="col-4"> </div>
      </div>
         
<div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>审核结果</label>
          <div class="formControls col-5">
             <input type="radio" name="status" value="1" checked>通过<input type="radio" name="status" value="0" >驳回
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>审核意见</label>
          <div class="formControls col-5">
            <textarea name="msg"></textarea>
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


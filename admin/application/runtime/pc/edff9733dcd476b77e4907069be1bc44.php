<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<script type="text/javascript" src="/nn2/admin/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>

	<link rel="stylesheet" href="/nn2/admin/views/pc/css/min.css" />
	<script type="text/javascript" src="/nn2/admin/views/pc/js/validform/validform.js"></script>
	<script type="text/javascript" src="/nn2/admin/views/pc/js/validform/formacc.js"></script>
	<script type="text/javascript" src="/nn2/admin/views/pc/js/layer/layer.js"></script>
	<link rel="stylesheet" href="/nn2/admin/views/pc/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="/nn2/admin/views/pc/css/H-ui.min.css">
	<script type="text/javascript" src="/nn2/admin/js/area/Area.js" ></script>
	<script type="text/javascript" src="/nn2/admin/js/area/AreaData_min.js" ></script>
	<script type="text/javascript" src="/nn2/admin/views/pc/js/My97DatePicker/WdatePicker.js"></script>
</head>
<body>

<script type="text/javascript" src="/nn2/admin/js/area/Area.js" ></script>
<script type="text/javascript" src="/nn2/admin/js/area/AreaData_min.js" ></script>
<div id="content" class="white">
<h1><img src="/nn2/admin/views/pc/img/icons/dashboard.png" alt="" />仓库管理
</h1>
                
<div class="bloc">
    <div class="title">
       仓库订单详情
    </div>
   <div class="pd-20">
  <form action="http://localhost/nn2/admin/store/storeorder/storeorderpass" method="post" class="form form-horizontal" id="form-member-add" auto_submit redirect_url="http://localhost/nn2/admin/store/storeorder/checkorderlist">
      <input type="hidden" name="id" value="<?php echo isset($info['delivery_id'])?$info['delivery_id']:"";?>" />
      <input type="hidden" name="order_no" value="<?php echo isset($info['order_no'])?$info['order_no']:"";?>" />
      <input type="hidden" name="buyer_id" value="<?php echo isset($info['user_id'])?$info['user_id']:"";?>" />
      <input type="hidden" name="seller_id" value="<?php echo isset($info['seller_id'])?$info['seller_id']:"";?>" />
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>订单号：</label>
      <div class="formControls col-5">
        <?php echo isset($info['order_no'])?$info['order_no']:"";?>
      </div>
      <div class="col-4"> </div>
    </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>提货单号：</label>
          <div class="formControls col-5">
              <?php echo isset($info['delivery_id'])?$info['delivery_id']:"";?>
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>提货数量：</label>
          <div class="formControls col-5">
              <?php echo isset($info['delivery_num'])?$info['delivery_num']:"";?><?php echo isset($info['unit'])?$info['unit']:"";?>
          </div>
          <div class="col-4"> </div>
      </div>
       <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>申请提货时间：</label>
          <div class="formControls col-5">
              <?php echo isset($info['delivery_time'])?$info['delivery_time']:"";?>
          </div>
          <div class="col-4"> </div>
      </div>
       <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>预计提货时间：</label>
          <div class="formControls col-5">
              <?php echo isset($info['expect_time'])?$info['expect_time']:"";?>
          </div>
          <div class="col-4"> </div>
      </div>

      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>商品名：</label>
          <div class="formControls col-5">
             <?php echo isset($info['product_name'])?$info['product_name']:"";?>
          </div>
          <div class="col-4"> </div>
      </div>
       <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>产品大类：</label>
          <div class="formControls col-5">
              <?php echo isset($info['cate_name'])?$info['cate_name']:"";?>
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>规格：</label>
          <div class="formControls col-5">
              <?php echo isset($info['attrs'])?$info['attrs']:"";?>
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>产地：</label>
          <div class="formControls col-5" id="areat">
                              <span id="areatextareat">
                        <script type="text/javascript">
                         ( function(){
                            var areatextObj = new Area();
                            var text = areatextObj.getAreaText('<?php echo $info['produce_area'] ; ?>',' ');
                            $('#areatextareat').html(text);

                            })()
                        </script>
                     </span>


          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>商品单价：</label>
          <div class="formControls col-5">
              <?php echo isset($info['price'])?$info['price']:"";?>
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>商品数量：</label>
          <div class="formControls col-5">
              <?php echo isset($info['quantity'])?$info['quantity']:"";?><?php echo isset($info['unit'])?$info['unit']:"";?>
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>仓库名：</label>
          <div class="formControls col-5">
              <?php echo isset($info['store_name'])?$info['store_name']:"";?>
          </div>
          <div class="col-4"> </div>
      </div>
      
     <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>有效期：</label>
          <div class="formControls col-5">
              <?php echo isset($info['expire_time'])?$info['expire_time']:"";?>
          </div>
          <div class="col-4"> </div>
      </div>
      
     <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>提货人：</label>
          <div class="formControls col-5">
              <?php echo isset($info['delivery_man'])?$info['delivery_man']:"";?>
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>电话：</label>
          <div class="formControls col-5">
              <?php echo isset($info['phone'])?$info['phone']:"";?>
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>身份证：</label>
          <div class="formControls col-5">
              <?php echo isset($info['idcard'])?$info['idcard']:"";?>
          </div>
          <div class="col-4"> </div>
      </div>
     <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>车牌号：</label>
          <div class="formControls col-5">
              <?php echo isset($info['plate_number'])?$info['plate_number']:"";?>
          </div>
          <div class="col-4"> </div>
      </div>
       <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>备注</label>
          <div class="formControls col-5">
              <?php echo isset($info['remark'])?$info['remark']:"";?>
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




</body>
</html>
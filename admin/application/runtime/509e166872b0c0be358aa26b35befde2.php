<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jquery/1.6/jquery.min.js"></script>
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>

	<link rel="stylesheet" href="http://localhost/nn2/admin/public/views/pc/css/min.css" />
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/validform/validform.js"></script>
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/validform/formacc.js"></script>
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/layer/layer.js"></script>
	<link rel="stylesheet" href="http://localhost/nn2/admin/public/views/pc/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="http://localhost/nn2/admin/public/views/pc/css/H-ui.min.css">
</head>
<body>
<script type="text/javascript" src="http://localhost/nn2/admin/public/js/area/Area.js" ></script>
<script type="text/javascript" src="http://localhost/nn2/admin/public/js/area/AreaData_min.js" ></script>
<div id="content" class="white">
<h1><img src="http://localhost/nn2/admin/public/views/pc/img/icons/dashboard.png" alt="" />仓库管理
</h1>
                
<div class="bloc">
    <div class="title">
       仓库订单详情
    </div>
   <div class="pd-20">
      <input type="hidden" name="id" value="<?php echo isset($info['delivery_id'])?$info['delivery_id']:"";?>" />
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
          <label class="form-label col-3"><span class="c-red">*</span>仓库名：</label>
          <div class="formControls col-5">
              <?php echo isset($info['store_name'])?$info['store_name']:"";?>
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
          <label class="form-label col-3"><span class="c-red">*</span>所属分类：</label>
          <div class="formControls col-5">
              <?php echo isset($info['cate_name'])?$info['cate_name']:"";?>
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
          <label class="form-label col-3"><span class="c-red">*</span>提货时间：</label>
          <div class="formControls col-5">
              <?php echo isset($info['delivery_time'])?$info['delivery_time']:"";?>
          </div>
          <div class="col-4"> </div>
      </div>
    
         

   
    <div class="row cl">
      <div class="col-9 col-offset-3">
        <a class="btn btn-primary radius" onclick='javascript:history.back()' value="&nbsp;&nbsp;返回&nbsp;&nbsp;">返回</a>
      </div>
    </div>
</div>
</div>
</div>

</div>


</body>
</html>
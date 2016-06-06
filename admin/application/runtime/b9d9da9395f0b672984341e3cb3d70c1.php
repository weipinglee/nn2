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
<h1><img src="http://localhost/nn2/admin/public/views/pc/img/icons/dashboard.png" alt="" />交易管理
</h1>
                
<div class="bloc">
    <div class="title">
       合同撮合人
    </div>
    <form action="http://localhost/nn2/admin/public/trade/pairing/addpairing" method="post" class="form form-horizontal" id="form-member-add" auto_submit redirect_url="http://localhost/nn2/admin/public/store/storeorder/checkorderlist">
   <div class="pd-20">
      <input type="hidden" name="order_id" value="<?php echo isset($info['id'])?$info['id']:"";?>" />
  
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>撮合人：</label>
      <div class="formControls col-5">
        <?php if(isset($info['admin_id'])){?>
        <?php echo isset($info['admin_name'])?$info['admin_name']:"";?>
        <input type="hidden" name="admin_id" value="<?php echo isset($info['admin_id'])?$info['admin_id']:"";?>">
        <?php }else{?>
        <select name='admin_id'>
          <?php echo isset($admin_list)?$admin_list:"";?>
        </select>
        <?php }?>
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>订单号：</label>
      <div class="formControls col-5">
        <?php echo isset($info['order_no'])?$info['order_no']:"";?>
      </div>
      <div class="col-4"> </div>
    </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>商品名：</label>
          <div class="formControls col-5">
             <?php echo isset($info['name'])?$info['name']:"";?>
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
              <?php echo isset($info['num'])?$info['num']:"";?><?php echo isset($info['unit'])?$info['unit']:"";?>
          </div>
          <div class="col-4"> </div>
      </div>

      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>下单时间：</label>
          <div class="formControls col-5">
              <?php echo isset($info['create_time'])?$info['create_time']:"";?>
          </div>
          <div class="col-4"> </div>
      </div>
    </div>
    
         

   
    <div class="row cl">
      <div class="col-9 col-offset-3" style="margin-bottom: 20px">
        <?php if(!isset($info['admin_id'])){?>
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;添加&nbsp;&nbsp;">

        <?php }?>
        <a class="btn btn-primary radius" type="" onclick="javascript:history.back();">&nbsp;&nbsp;返回&nbsp;&nbsp;</a>
      </div>
    </div>
    </form>
</div>
</div>
</div>

</div>


</body>
</html>
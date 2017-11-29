<!DOCTYPE html>
<html>
 <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        
        <!-- jQuery AND jQueryUI -->
        <script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
        <script type="text/javascript" src="js/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="css/min.css" />
        <script type="text/javascript" src="js/min.js"></script>
        <script type="text/javascript" src="{views:js/validform/validform.js}"></script>
        <script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
        <script type="text/javascript" src="{views:js/layer/layer.js}"></script>

		<link rel="stylesheet" type="text/css" href="css/H-ui.min.css">
		<link rel="stylesheet" href="css/font-awesome.min.css" />
    </head>
    <body>     
        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" />统计商品
</h1>
                
<div class="bloc">
    <div class="title">
       添加统计商品
    </div>
   <div class="pd-20">
  <form action="{url:information/productStats/addproductstats}" method="post" class="form form-horizontal" id="form-admin-add" auto_submit redirect_url="{url:/information/productStats/productStatsList}">
  <input type="hidden" name="id" value="{$detail['id']}">
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品名：</label>

      <div class="formControls col-5">
        <input type="text" class="input-text" value="{$detail['pro_name']}" datatype="*" name="pro_name" errormsg="请填写商品名"  >
      </div>
      <div class="col-4"> </div>
    </div>
	<div class="row cl">
     <label class="form-label col-3"><span class="c-red">*</span>货号：</label>

      <div class="formControls col-5">
        <input type="text" class="input-text" value="{$detail['pro_no']}" datatype="*" name="pro_no" errormsg="请填写商品名"  >
      </div>
      <div class="col-4"> </div>
    </div>
	
	<div class="row cl">
     <label class="form-label col-3"><span class="c-red">*</span>含铝量：</label>

      <div class="formControls col-5">
        <input type="text" class="input-text" value="{$detail['al']}" datatype="*" name="al" errormsg="请填写商品名"  >
      </div>
      <div class="col-4"> </div>
    </div>
	
	<div class="row cl">
     <label class="form-label col-3"><span class="c-red">*</span>剩余量：</label>

      <div class="formControls col-5">
        <input type="text" class="input-text" value="{$detail['last']}" datatype="*" name="last" errormsg="请填写商品名"  >
      </div>
      <div class="col-4"> </div>
    </div>
	
	<div class="row cl">
     <label class="form-label col-3"><span class="c-red">*</span>起订量：</label>

      <div class="formControls col-5">
        <input type="text" class="input-text" value="{$detail['mininum']}" datatype="*" name="mininum" errormsg="请填写商品名"  >
      </div>
      <div class="col-4"> </div>
    </div>
	
	<div class="row cl">
     <label class="form-label col-3"><span class="c-red">*</span>价格：</label>

      <div class="formControls col-5">
        <input type="text" class="input-text" value="{$detail['price']}" datatype="*" name="price" errormsg="请填写商品名"  >
      </div>
      <div class="col-4"> </div>
    </div>
	
	<div class="row cl">
     <label class="form-label col-3"><span class="c-red">*</span>涨跌额：</label>

      <div class="formControls col-5">
        <input type="text" class="input-text" value="{$detail['increase']}" datatype="*" name="increase" errormsg="请填写商品名"  >
      </div>
      <div class="col-4"> </div>
    </div>
	
	<div class="row cl">
     <label class="form-label col-3"><span class="c-red">*</span>涨跌幅</label>

      <div class="formControls col-5">
        <input type="text" class="input-text" value="{$detail['inc_perc']}" datatype="*" name="inc_perc" errormsg="请填写商品名"  >
      </div>
      <div class="col-4"> </div>
    </div>
	
	<div class="row cl">
     <label class="form-label col-3"><span class="c-red">*</span>交收方式：</label>

      <div class="formControls col-5">
        <input type="text" class="input-text" value="{$detail['acc_type']}" datatype="*" name="acc_type" errormsg="请填写商品名"  >
      </div>
      <div class="col-4"> </div>
    </div
	
	<div class="row cl">
     <label class="form-label col-3"><span class="c-red">*</span>交收仓库：</label>

      <div class="formControls col-5">
        <input type="text" class="input-text" value="{$detail['acc_store']}" datatype="*" name="acc_store" errormsg="请填写商品名"  >
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <div class="col-9 col-offset-3">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
        &emsp;<a class="btn btn-primary radius" href="{url:/information/productStats/productStatsList}">&nbsp;&nbsp;返回&nbsp;&nbsp;</a>
      </div>
    </div>
  </form>
</div>
</div>
</div>

</div>  
    </body>
</html>
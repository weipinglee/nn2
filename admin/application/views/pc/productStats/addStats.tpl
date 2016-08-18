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
            <h1><img src="{views:img/icons/dashboard.png}" alt="" />统计数据
</h1>
                
<div class="bloc">
    <div class="title">
       添加统计数据
    </div>
   <div class="pd-20">
  <form action="{url:information/productStats/addStats}" method="post" class="form form-horizontal" id="form-admin-add" auto_submit redirect_url="{url:information/productStats/statsList}">
  <input type="hidden" name="id" value="{$detail['id']}">
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>商品名：</label>

      <div class="formControls col-5">
        <input type="hidden" name="products_stats_id" value="{$detail['products_stats_id']}">
        <input type="text" class="input-text" value="{$detail['name']}" readonly="readonly" datatype="*" errormsg=""  >
      </div>
      <div class="col-4"> </div>
    </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>价格：</label>

          <div class="formControls col-5">
              <input type="text" class="input-text" value="{$detail['price']}" name="price" datatype="float" nullmsg="请输入价格" errormsg="请输入正确的价格"  >
          </div>
          <div class="col-4"> </div>
      </div>

    <div class="row cl">
      <div class="col-9 col-offset-3">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
        {if:$detail['id']}
        &emsp;<a class="btn btn-primary radius" href="{url:/information/productStats/statsList}">&nbsp;&nbsp;返回&nbsp;&nbsp;</a>
        {else:}
        &emsp;<a class="btn btn-primary radius" href="{url:/information/productStats/productStatsList}">&nbsp;&nbsp;返回&nbsp;&nbsp;</a>
        {/if}
      </div>
    </div>
  </form>
</div>
</div>
</div>

</div>  
    </body>
</html>
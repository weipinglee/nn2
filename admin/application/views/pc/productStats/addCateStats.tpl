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
            <h1><img src="{views:img/icons/dashboard.png}" alt="" />统计分类
</h1>
                
<div class="bloc">
    <div class="title">
       添加统计分类
    </div>
   <div class="pd-20">
  <form action="{url:information/marketStats/addCateStats}" method="post" class="form form-horizontal" id="form-admin-add" auto_submit redirect_url="">
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>分类名：</label>

      <div class="formControls col-5">
        <select class='input-select roles' name='cate_id' nullmsg = '请选择分类' dataType="/^[1-9]\d*$/">
          <option value='-1'>请选择分类</option>
            {foreach:items=$cateTree}
              <option value="{$item['id']}">{echo: str_repeat('&nbsp',$item['level']*2)}{$item['name']}</option>
            {/foreach}
        </select>
      </div>
      <div class="col-4"> </div>
    </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>分类名：</label>

          <div class="formControls col-5">
              <select class='input-select roles' name='type' nullmsg = '请选择类型' dataType="/^[1-9]\d*$/">
                  <option value='-1'>请选择类型</option>
                  {foreach:items=$statsType}
                      <option value="{$key}">{$item}</option>
                  {/foreach}
              </select>
          </div>
          <div class="col-4"> </div>
      </div>

    <div class="row cl">
      <div class="col-9 col-offset-3">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
        &emsp;<a class="btn btn-primary radius" href="{url:/information/marketStats/marketStatsList}">&nbsp;&nbsp;返回&nbsp;&nbsp;</a>
      </div>
    </div>
  </form>
</div>
</div>
</div>

</div>  
    </body>
</html>
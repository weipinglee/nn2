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
            <h1><img src="{views:img/icons/dashboard.png}" alt="" />市场统计
</h1>
                
<div class="bloc">
    <div class="title">
       添加统计名称
    </div>
   <div class="pd-20">
  <form action="{url:information/statsMarket/addStatsMarket}" method="post" class="form form-horizontal" id="form-admin-add" auto_submit redirect_url="{url:information/statsMarket/statsMarketList}">
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>分类名：</label>

      <div class="formControls col-5">
        <select class='input-select roles' name='cate_id' nullmsg = '请选择分类' dataType="/^[1-9]\d*$/">
          <option value='-1'>请选择分类</option>
            {foreach:items=$topCate}
              <option value="{$item['id']}" {if:$detail['cate_id']==$item['id']}selected="selected"{/if}>{$item['name']}</option>
            {/foreach}
        </select>
      </div>
      <div class="col-4"> </div>
    </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>名称：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" value="{$detail['name']}" datatype="*" name="name" errormsg="请填写商品名"  >
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>状态：</label>
          <div class="formControls col-5">
              <input type="radio" name="status" value="1" {if:$detail['status'] == 1}checked{/if}>开启
              <input type="radio" name="status" value="0" {if:$detail['status'] == 0}checked{/if}>关闭
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>是否删除：</label>

          <div class="formControls col-5">
              <input type="radio" name="is_del" value="1" {if:$detail['is_del'] == 1}checked{/if}>是
              <input type="radio" name="is_del" value="0" {if:$detail['is_del'] == 0}checked{/if}>否
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
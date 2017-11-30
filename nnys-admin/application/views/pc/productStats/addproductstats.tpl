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
     <script type="text/javascript" src="{root:js/arttemplate/artTemplate.js}"></script>
     <script type="text/javascript" src="{views:js/productstats/stats.js}"></script>
		<link rel="stylesheet" type="text/css" href="css/H-ui.min.css">
		<link rel="stylesheet" href="css/font-awesome.min.css" />
    </head>
    <body>     
        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" />统计项
</h1>
<script type="text/javascript">
    var ajaxNextlevelCateUrl = '{url:information/productStats/ajaxnextlevelCate}';
    var ajaxAttrUrl = "{url:information/productStats/ajaxGetAttr}";

</script>
<div class="bloc">
    <div class="title">
       添加统计项
    </div>
   <div class="pd-20">
  <form action="{url:information/productStats/addproductstats}" method="post" class="form form-horizontal" id="form-admin-add" auto_submit redirect_url="{url:/information/productStats/productStatsList}">

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red"></span>统计名称：</label>

      <div class="formControls col-5">
        <input type="text" class="input-text" value="" datatype="*" name="name"  >

      </div>
      <div class="col-4"> </div>
    </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red"></span>市场分类：</label>

          <div class="formControls col-5" id="cate_box">
              <input type ="hidden" name="cate_id" datatype="/^[1-9]\d*$/" errormsg="请选择分类"/>
              <select name="market_id">
                  <option value="0">选择市场分类</option>
                  {foreach:items=$topCate}
                      <option value="{$item['id']}">{$item['name']}</option>
                  {/foreach}

              </select>

          </div>

          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red"></span>选择属性：</label>

          <div class="formControls col-5" id="attr_box">


          </div>
          <div class="col-4"> </div>
      </div>
    <div class="row cl">
      <div class="col-9 col-offset-3">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
        &emsp;<a class="btn btn-primary radius" href="{url:/information/productStats/productStatsList}">&nbsp;&nbsp;返回&nbsp;&nbsp;</a>
     说明：同一分类下所选属性值相同的产品会进行价格涨跌幅的比较计算
      </div>
    </div>
  </form>

       <!--下级分类模板-->
       <script type="text/html" id="nextlevelCateTemplate" >
           <select >
               <option value="0">选择分类</option>
               <%if (data.length>0) { %>
               <%for (var i=0;i<data.length;i++) { %>
               <option value="<%=data[i].id%>"><%=data[i].name%></option>
               <% } %>
               <% } %>
           </select>
       </script>
       <!--属性列表-->
       <script type="text/html" id="attrTemplate" >
           <%if (data.length>0) { %>
           <%for (var i=0;i<data.length;i++) { %>
           <label><input type="checkbox" name="attr[]" value="<%=data[i].id%>-<%=data[i].name%>" /><%=data[i].name%></label>
           <% } %>
           <% } %>
       </script>
</div>
</div>
</div>

</div>  
    </body>
</html>
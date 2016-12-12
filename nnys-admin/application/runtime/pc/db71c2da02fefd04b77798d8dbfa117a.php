<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<script type="text/javascript" src="/nn2/nnys-admin/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>

	<link rel="stylesheet" href="/nn2/nnys-admin/views/pc/css/min.css" />
	<script type="text/javascript" src="/nn2/nnys-admin/views/pc/js/validform/validform.js"></script>
	<script type="text/javascript" src="/nn2/nnys-admin/views/pc/js/validform/formacc.js"></script>
	<script type="text/javascript" src="/nn2/nnys-admin/views/pc/js/layer/layer.js"></script>
	<link rel="stylesheet" href="/nn2/nnys-admin/views/pc/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="/nn2/nnys-admin/views/pc/css/H-ui.min.css">
	<script type="text/javascript" src="/nn2/nnys-admin/js/area/Area.js" ></script>
	<script type="text/javascript" src="/nn2/nnys-admin/js/area/AreaData_min.js" ></script>
	<script type="text/javascript" src="/nn2/nnys-admin/views/pc/js/My97DatePicker/WdatePicker.js"></script>
</head>
<body>


        
        <!-- jQuery AND jQueryUI -->
        <script type="text/javascript" src="/nn2/nnys-admin/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>
        <script type="text/javascript" src="js/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/nn2/nnys-admin/views/pc/js/validform/validform.js"></script>
        <script type="text/javascript" src="/nn2/nnys-admin/views/pc/js/validform/formacc.js"></script>
        <script type="text/javascript" src="/nn2/nnys-admin/views/pc/js/layer/layer.js"></script>
        <script type="text/javascript" src="/nn2/nnys-admin/js/upload/ajaxfileupload.js"></script>
        <script type="text/javascript" src="/nn2/nnys-admin/js/upload/upload.js"></script>


        <link rel="stylesheet" href="css/min.css" />
        <script type="text/javascript" src="js/min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/H-ui.min.css">
		<link rel="stylesheet" href="css/font-awesome.min.css" />   
        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="/nn2/nnys-admin/views/pc/img/icons/dashboard.png" alt="" />添加会员分组
</h1>
                
<div class="bloc">
    <div class="title">
       添加会员分组
    </div>
   <div class="pd-20">
  <form action="http://localhost/nn2/nnys-admin/member/payusergroup/groupAdd/" method="post" class="form form-horizontal" id="form-usergroup-add" auto_submit redirect_url = "http://localhost/nn2/nnys-admin/member/payusergroup/groupList/">
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>分组名：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="group_name" name="group_name" datatype="*2-16" nullmsg="分组名不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3">分组图标：</label>
      <div class="formControls col-5"> 
        <span class="btn-upload form-group">
          <input type="file" name="file2" id="file2"  onchange="javascript:uploadImg(this);" />
        </span> 
      </div>

      <div  class="up_img" style="margin: 50px 0 10px 280px;">
        <img style="width:150px;height: 150px;" name="file2" src=""/>
        <input type="hidden"  name="imgfile2" value="" pattern="required" alt="请上传图片" />
      </div><!--img name属性与上传控件id相同-->
      <div class="col-4"> </div>
    </div>
    
    <div class="row cl">
      <div class="col-9 col-offset-3">
        <input type="hidden" name="uploadUrl"  value="http://localhost/nn2/nnys-admin/index/index/upload/" />
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
        &emsp;<a class="btn btn-primary radius" href="http://localhost/nn2/nnys-admin/member/payusergroup/groupList/">&nbsp;&nbsp;返回&nbsp;&nbsp;</a>
      </div>
    </div>
  </form>
</div>
</div>
</div>

</div>
        
        
    </body>
</html>


</body>
</html>
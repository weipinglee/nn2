<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<script type="text/javascript" src="/nn2/admin/public/views/pc/js/libs/jquery/1.6/jquery.min.js"></script>
	<script type="text/javascript" src="/nn2/admin/public/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>

	<link rel="stylesheet" href="/nn2/admin/public/views/pc/css/min.css" />
	<script type="text/javascript" src="/nn2/admin/public/views/pc/js/validform/validform.js"></script>
	<script type="text/javascript" src="/nn2/admin/public/views/pc/js/validform/formacc.js"></script>
	<script type="text/javascript" src="/nn2/admin/public/views/pc/js/layer/layer.js"></script>
	<link rel="stylesheet" href="/nn2/admin/public/views/pc/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="/nn2/admin/public/views/pc/css/H-ui.min.css">
	<script type="text/javascript" src="/nn2/admin/public/js/area/Area.js" ></script>
	<script type="text/javascript" src="/nn2/admin/public/js/area/AreaData_min.js" ></script>
	<script type="text/javascript" src="/nn2/admin/public/views/pc/js/My97DatePicker/WdatePicker.js"></script>
</head>
<body>
<script type="text/javascript" src="/nn2/admin/public/js/area/AreaData_min.js" ></script>
<script type="text/javascript" src="/nn2/admin/public/js/area/Area.js" ></script>

        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">

            <h1><img src="/nn2/admin/public/views/pc/img/icons/dashboard.png" alt="" />添加代理商

</h1>
                
<div class="bloc">
    <div class="title">
       添加代理商
    </div>
   <div class="pd-20">

  <form action="http://localhost/nn2/admin/public/member/agent/addagent" method="post" class="form form-horizontal" id="form-member-add" auto_submit redirect_url="http://localhost/nn2/admin/public/member/agent/agentlist">
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>用户名：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo isset($agentData['username'])?$agentData['username']:"";?>"  id="member-name" name="username" datatype="*2-16" nullmsg="用户名不能为空">
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>手机：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo isset($agentData['mobile'])?$agentData['mobile']:"";?>" id="member-tel" name="mobile"  datatype="m" nullmsg="手机不能为空">

      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>邮箱：</label>
      <div class="formControls col-5">

        <input type="text" class="input-text" value="<?php echo isset($agentData['email'])?$agentData['email']:"";?>" name="email" id="email" datatype="e" nullmsg="请输入邮箱！">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>公司名称：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo isset($agentData['company_name'])?$agentData['company_name']:"";?>" name="company" id="email" datatype="*2-16" nullmsg="请输入公司名称：！">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>地区：</label>
      <div class="formControls col-5" id="areabox">
        <?php if(isset($agentData['area'])){?>
                        <script type="text/javascript">
                 areaObj = new Area();

                  $(function () {
                     areaObj.initComplexArea('seachprov', 'seachcity', 'seachdistrict', '<?php echo $agentData['area'] ; ?>','area');
                  });
                </script>
			 <select  id="seachprov"  onchange=" areaObj.changeComplexProvince(this.value, 'seachcity', 'seachdistrict');">
              </select>&nbsp;&nbsp;
              <select  id="seachcity"  onchange=" areaObj.changeCity(this.value,'seachdistrict','seachdistrict');">
              </select>&nbsp;&nbsp;<span id='seachdistrict_div' >
               <select   id="seachdistrict"  onchange=" areaObj.changeDistrict(this.value);">
               </select></span>
               <input type="hidden"  name="area"  alt="" value='<?php echo $agentData['area'] ; ?>' />
                <span></span>
        <?php }else{?>
                          <script type="text/javascript">
                 areaObj = new Area();

                  $(function () {
                     areaObj.initComplexArea('seachprov', 'seachcity', 'seachdistrict', '','area');
                  });
                </script>
			 <select  id="seachprov"  onchange=" areaObj.changeComplexProvince(this.value, 'seachcity', 'seachdistrict');">
              </select>&nbsp;&nbsp;
              <select  id="seachcity"  onchange=" areaObj.changeCity(this.value,'seachdistrict','seachdistrict');">
              </select>&nbsp;&nbsp;<span id='seachdistrict_div' >
               <select   id="seachdistrict"  onchange=" areaObj.changeDistrict(this.value);">
               </select></span>
               <input type="hidden"  name="area"  alt="" value='' />
                <span></span>
        <?php }?>

      </div>
      <div class="col-4"> </div>
    </div>


    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>联系人名称：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo isset($agentData['contact'])?$agentData['contact']:"";?>" name="contactName" id="email" datatype="*2-16" nullmsg="请输入联系人名称！">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>联系人电话：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo isset($agentData['contact_phone'])?$agentData['contact_phone']:"";?>"  name="contacttel" id="email" datatype="*2-16" nullmsg="请输入联系人电话！">

      </div>
      <div class="col-4"> </div>
    </div>


    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>详细地址：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php echo isset($agentData['address'])?$agentData['address']:"";?>" name="contactAddress" id="email" datatype="*2-16" nullmsg="请输入地址！">
        <input type="hidden" class="input-text" value="<?php echo isset($agentData['id'])?$agentData['id']:"";?>" name="id" id="email"  nullmsg="请输入地址：！">

      </div>
      <div class="col-4"> </div>
    </div>


    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>是否开启：</label>
      <div class="formControls col-5">
        <?php if(isset($agentData)){?>
        <input type="radio" name="status" value='1' <?php if($agentData['status'] == 1){?>checked='1'<?php }?> id="">是
        <input type="radio" name="status" value='0' <?php if($agentData['status'] == 0){?>checked='1'<?php }?> id="">否
        <?php }else{?>
          <input type="radio" name="status" value='1' checked='1' id="">是
          <input type="radio" name="status" value='0' id="">否
        <?php }?>

      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <div class="col-9 col-offset-3">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
      </div>
    </div>
  </form>
</div>
</div>
</div>

</div>
        
        

</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
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


          
            
                
                <script type="text/javascript" src="/nn2/admin/public/views/pc/js/product/cate.js"></script>
        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="img/icons/posts.png" alt="" /> 菜单管理</h1>
<div class="bloc">
    <div class="title">
        添加菜单角色
    </div>
    <div class="content">
        <div class="pd-20">

            <div class="zhannei">
             <form action="http://localhost/nn2/admin/public/member/menu/roleedit" method="post" class="form form-horizontal" id="form-user-character-add">

                <div class="row cl">
                    <label class="form-label col-2">角色名称：</label>
                    <div class="formControls col-10">
                        <input type="text" class="input-text" value="<?php echo isset($detail['name'])?$detail['name']:"";?>" placeholder="" id="" name="name">
                    </div>
                </div>
                 <div class="row cl">
                     <label class="form-label col-2">认证角色：</label>
                     <div class="formControls col-10">
                         <select name="name_en" >
                             <?php $cert = \nainai\cert\certificate::$certText ; ?>
                             <?php if(!empty($cert)) foreach($cert as $key => $item){?>
                                 <option value="<?php echo isset($key)?$key:"";?>" <?php if($key==$detail['cert']){?>selected=true<?php }?>><?php echo isset($item)?$item:"";?></option>
                             <?php }?>
                         </select>
                     </div>
                 </div>
                <div class="row cl">
                    <label class="form-label col-2">角色描述：</label>
                    <div class="formControls col-10">
                        <textarea name="comment" id="" cols="30" rows="10"><?php echo isset($detail['explanation'])?$detail['explanation']:"";?></textarea>
                    </div>
                </div>
                


                <div class="row cl">
                    <div class="col-10 col-offset-2">
                    <input type="hidden" name="id" value="<?php echo isset($detail['id'])?$detail['id']:"";?>">
                        <button type="submit" class="btn btn-success radius" id="admin-role-save" name="admin-role-save"><i class="icon-ok fa-ok"></i> 提交</button>
                    </div>
                </div>
            </form>
        </div>
       
</div>




</body>
</html>
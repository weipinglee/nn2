<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jquery/1.6/jquery.min.js"></script>
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>

	<link rel="stylesheet" href="http://localhost/nn2/admin/public/views/pc/css/min.css" />
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/min.js"></script>
	<link rel="stylesheet" href="http://localhost/nn2/admin/public/views/pc/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="http://localhost/nn2/admin/public/views/pc/css/H-ui.min.css">
</head>
<body>

        
        <script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/content/settings/main.js"></script>
<link rel="stylesheet" href="http://localhost/nn2/admin/public/views/pc/content/settings/style.css" />
<link rel="stylesheet" type="text/css" href="http://localhost/nn2/admin/public/views/pc/css/H-ui.admin.css">

          
            
                
                
        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="http://localhost/nn2/admin/public/views/pc/img/icons/posts.png" alt="" /> 子账户角色添加</h1>
<div class="bloc">
    <div class="title">
        子账户角色
    </div>
    <div class="content">
        <div class="pd-20">
    <form action="http://localhost/nn2/admin/public/member/doroleadd" method="post" class="form form-horizontal" id="form-user-character-add">
        <input name='role_id' type="hidden" value="<?php if(isset($roleData['id'])){?><?php echo isset($roleData['id'])?$roleData['id']:"";?><?php }?>" />
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>角色名称：</label>
            <div class="formControls col-10">
                <input type="text" class="input-text" value="<?php if(isset($roleData['name'])){?><?php echo isset($roleData['name'])?$roleData['name']:"";?><?php }?>" placeholder="" id="user-name" name="role_name" datatype="*4-16" nullmsg="用户账户不能为空">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-2"><span class="c-red">*</span>是否启用：</label>
            <div class="formControls col-10">
                <input type="radio" class="input-text"  value="1" name="status" <?php if(!isset($roleData['status']) || $roleData['status']==1){?>checked<?php }?> >启用
                <input type="radio" class="input-text" value="0"   name="status" <?php if(isset($roleData['status']) && $roleData['status']==0){?>checked<?php }?> >关闭
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-2">备注：</label>
            <div class="formControls col-10">
                <input type="text" class="input-text" value="<?php if(isset($roleData['note'])){?><?php echo isset($roleData['note'])?$roleData['note']:"";?><?php }?>" placeholder="" id="" name="role_note">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-2">网站角色：</label>
            <div class="formControls col-10">
                <?php foreach($tree as $key => $first){?>
                <dl class="permission-list">
                <?php $first_check=false; ?>
                    <?php if(isset($roleData['right']) && in_array($first['id'],$roleData['right'])){?>
                        <?php $first_check=true; ?>
                    <?php }?>
                    <dt>
                        <label>
                            <input type="checkbox" value="<?php echo isset($first['id'])?$first['id']:"";?>" <?php if($first_check==true){?>checked<?php }?> name="first_role_id[]" id="user-Character-0">
                            <?php echo isset($first['note'])?$first['note']:"";?></label>
                    </dt>

                    <dd>
                        <?php foreach($first['child'] as $key => $second){?>
                            <?php $second_check= false; ?>
                            <?php if(isset($roleData['right']) && in_array($second['id'],$roleData['right'])){?>
                                <?php $second_check=true; ?>
                            <?php }?>
                        <dl class="cl permission-list2">
                            <dt>
                                <label class="">
                                    <input type="checkbox" value="<?php echo isset($second['id'])?$second['id']:"";?>" <?php if($first_check || $second_check){?>checked<?php }?> name="second_role_id[<?php echo isset($first['id'])?$first['id']:"";?>][]" id="user-Character-0-0">
                                    <?php echo isset($second['note'])?$second['note']:"";?></label>
                            </dt>
                            <dd>
                                <?php foreach($second['child'] as $key => $item){?>
                                    <?php $third_check=false; ?>
                                    <?php if(isset($roleData['right']) && in_array($item['id'],$roleData['right'])){?>
                                        <?php $third_check=true; ?>
                                    <?php }?>
                                <label class="">
                                    <input type="checkbox" value="<?php echo isset($item['id'])?$item['id']:"";?>" <?php if($first_check || $second_check || $third_check){?>checked<?php }?> name="third_role_id[<?php echo isset($first['id'])?$first['id']:"";?>][<?php echo isset($second['id'])?$second['id']:"";?>][]" id="user-Character-0-0-0">
                                    <?php echo isset($item['note'])?$item['note']:"";?></label>
                                <?php }?>
                            </dd>
                        </dl>

                        <?php }?>
                    </dd>

                </dl>
                <?php }?>
            </div>
        </div>
        <div class="row cl">
            <div class="col-10 col-offset-2">
                <button type="submit" class="btn btn-success radius" id="admin-role-save" name="admin-role-save"><i class="icon-ok"></i> 确定</button>
            </div>
        </div>
    </form>
</div>


</body>
</html>
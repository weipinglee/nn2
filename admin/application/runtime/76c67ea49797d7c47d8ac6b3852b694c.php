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

        <div id="content" class="white">
            <h1><img src="http://localhost/nn2/admin/public/views/pc/img/icons/dashboard.png" alt="" /> 添加属性
</h1>
                
<div class="bloc">
    <div class="title">
     属性信息
    </div>
 <div class="pd-20">
  <form action="http://localhost/nn2/admin/public/index.php//product/attributeadd" method="post" class="form form-horizontal" id="form-user-add">
      <input type="hidden" name="id" value="<?php if(isset($attr)){?><?php echo isset($attr['id'])?$attr['id']:"";?><?php }?>" />
    <div class="row cl">
      <label class="form-label col-2"><span class="c-red">*</span>属性名称：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php if(isset($attr)){?><?php echo isset($attr['name'])?$attr['name']:"";?><?php }?>" placeholder="" name="name">
      </div>
      <div class="col-5"> </div>
    </div>
      <div class="row cl">
          <label class="form-label col-2"><span class="c-red"></span>类型：</label>
          <div class="formControls col-5">
              <input type="radio" class="input-text" <?php if(!isset($attr) || $attr['type']==1){?>checked="checked"<?php }?> value="1" name="type">输入框
              <input type="radio" class="input-text" <?php if(isset($attr) && $attr['type']==2){?>checked="checked"<?php }?> value="2" name="type">单选
              <input type="radio" class="input-text" <?php if(isset($attr) && $attr['type']==3){?>checked="checked"<?php }?> value="3" name="type">多选
          </div>
          <div class="col-5"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-2"><span class="c-red"></span>值：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" value="<?php if(isset($attr)){?><?php echo isset($attr['value'])?$attr['value']:"";?><?php }?>" placeholder="" name="value">
              多个值以'，'相隔
          </div>
          <div class="col-5"> </div>
      </div>

      <div class="row cl">
          <label class="form-label col-2"><span class="c-red"></span>排序：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" value="<?php if(isset($attr)){?><?php echo isset($attr['sort'])?$attr['sort']:"";?><?php }?>" placeholder="" name="sort">
          </div>
          <div class="col-5"> </div>
      </div>
    <div class="row cl">
      <label class="form-label col-2">备注：</label>
      <div class="formControls col-5">
        <textarea name="" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,100)"><?php if(isset($attr)){?><?php echo isset($attr['note'])?$attr['note']:"";?><?php }?></textarea>
        <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
      </div>
      <div class="col-5"> </div>
    </div>
    <div class="row cl">
      <div class="col-9 col-offset-2">
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
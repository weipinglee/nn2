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
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/product/cate.js"></script>
        <div id="content" class="white">
            <h1><img src="http://localhost/nn2/admin/public/views/pc/img/icons/dashboard.png" alt="" /> 添加商品类型
</h1>
                
<div class="bloc">
    <div class="title">
     类型基本信息
    </div>
 <div class="pd-20">
  <form action="http://localhost/nn2/admin/public/index.php//product/categoryadd" method="post" class="form form-horizontal" id="form-user-add">
      <input type="hidden" name="id" value="<?php if(isset($cate)){?><?php echo isset($cate['id'])?$cate['id']:"";?><?php }?>" />
    <div class="row cl">
      <label class="form-label col-2"><span class="c-red">*</span>分类名称：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="<?php if(isset($cate)){?><?php echo isset($cate['name'])?$cate['name']:"";?><?php }?>" placeholder="" name="name">
      </div>
      <div class="col-5"> </div>
    </div>
      <div class="row cl">
          <label class="form-label col-2"><span class="c-red"></span>下级分类统称：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" value="<?php if(isset($cate)){?><?php echo isset($cate['childname'])?$cate['childname']:"";?><?php }?>" placeholder="" name="childname">
          </div>
          <div class="col-5"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-2"><span class="c-red"></span>计量单位：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" value="<?php if(isset($cate)){?><?php echo isset($cate['unit'])?$cate['unit']:"";?><?php }?>" placeholder="" name="unit">
          </div>
          <div class="col-5"> 子级分类的优先级更高</div>
      </div>
      <div class="row cl">
          <label class="form-label col-2"><span class="c-red"></span>首付款比例：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" value="<?php if(isset($cate)){?><?php echo isset($cate['percent'])?$cate['percent']:"";?><?php }?>" placeholder="" name="percent">
          </div>
          <div class="col-5">%，请填写0-100之间的整数， 子级分类的优先级更高</div>
      </div>
      <div class="row cl">
          <label class="form-label col-2"><span class="c-red"></span>父级分类：</label>
          <div class="formControls col-5">
              <select name="pid">
                <option value="0" selected >顶级分类</option>
                <?php foreach($tree as $key => $item){?>
                    <option value="<?php echo isset($item['id'])?$item['id']:"";?>" <?php if(isset($cate['pid']) && $item['id']==$cate['pid']){?>selected<?php }?>><?php echo str_repeat('--',$item['level']);?><?php echo isset($item['name'])?$item['name']:"";?></option>

                <?php }?>
              </select>
          </div>
          <div class="col-5"> </div>
      </div>
      <div class="row cl">
           <label class="form-label col-2"><span class="c-red"></span>所选属性：</label>
          <div class="formControls col-5" id="attr_box">
            <?php if(isset($attr_sel)&&!empty($attr_sel)){?>
                <?php foreach($attr_sel as $key => $item){?>
                    <div ><input type="text"  value="<?php echo isset($item)?$item:"";?>"/> <input type="hidden" value="<?php echo isset($key)?$key:"";?>" name="attr_id[]"/><a href="javascript:void(0);" >删除</a></div>
                <?php }?>
            <?php }?>
          </div>
            <div class="col-5"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-2"><span class="c-red"></span>属性：</label>
          <div class="formControls col-5">
             <!-- <input type="hidden" name="attrs[]" value="1"/>
              <input type="hidden" name="attrs[]" value="2"/> -->
              <select id='all_attr'>
                  <?php if(!empty($attr)){?>
                      <?php foreach($attr as $key => $item){?>
                          <option value="<?php echo isset($item['id'])?$item['id']:"";?>"><?php echo isset($item['name'])?$item['name']:"";?></option>

                      <?php }?>
                  <?php }?>

              </select>

          </div><a href="javascript:void(0)" onclick="addAttr()">添加</a>
          <div class="col-5"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-2"><span class="c-red"></span>排序：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" value="<?php if(isset($cate)){?><?php echo isset($cate['sort'])?$cate['sort']:"";?><?php }?>" placeholder="" name="sort">
          </div>
          <div class="col-5"> </div>
      </div>
    <div class="row cl">
      <label class="form-label col-2">备注：</label>
      <div class="formControls col-5">
        <textarea name="" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,100)"><?php if(isset($cate)){?><?php echo isset($cate['note'])?$cate['note']:"";?><?php }?></textarea>
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
<div class="attr" style="display:none;"><input type="text"  /> <input type="hidden" /><a href="javascript:void(0);">删除</a></div>
</body>
</html>
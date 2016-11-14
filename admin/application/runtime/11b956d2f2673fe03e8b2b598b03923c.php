<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<script type="text/javascript" src="/nn2/admin/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>

	<link rel="stylesheet" href="/nn2/admin/views/pc/css/min.css" />
	<script type="text/javascript" src="/nn2/admin/views/pc/js/validform/validform.js"></script>
	<script type="text/javascript" src="/nn2/admin/views/pc/js/validform/formacc.js"></script>
	<script type="text/javascript" src="/nn2/admin/views/pc/js/layer/layer.js"></script>
	<link rel="stylesheet" href="/nn2/admin/views/pc/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="/nn2/admin/views/pc/css/H-ui.min.css">
	<script type="text/javascript" src="/nn2/admin/js/area/Area.js" ></script>
	<script type="text/javascript" src="/nn2/admin/js/area/AreaData_min.js" ></script>
	<script type="text/javascript" src="/nn2/admin/views/pc/js/My97DatePicker/WdatePicker.js"></script>
</head>
<body>

﻿
        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="img/icons/dashboard.png" alt="" /> 委托费率
</h1>
                
<div class="bloc">
    <div class="title">
       委托费率设置
    </div>
 <div class="pd-20">
	  <form action="http://localhost/nn2/admin/system/confsystem/entrustadd" method="post" class="form form-horizontal" id="form-user-add" auto_submit redirect_url="http://localhost/nn2/admin/system/confsystem/entrustlist">

		<div class="row cl">
			<label class="form-label col-3">选择分类：</label>
			<div class="formControls col-5">
               <?php if( !empty($tree)){?>
				<select class="select" name="cate_id" size="1" id="cate_id">
                    <option value="0">请选择</option>
					 <?php if(!empty($tree)) foreach($tree as $key => $item){?>
                  <?php if( !in_array($item['id'], $data)){?>
                    <option value="<?php echo isset($item['id'])?$item['id']:"";?>" <?php if(isset($cate['pid']) && $item['id']==$cate['pid']){?>selected<?php }?>><?php echo str_repeat('--',$item['level']);?><?php echo isset($item['name'])?$item['name']:"";?></option>
                    <?php }?>
                <?php }?>
				</select>
                    <?php }else{?>
                         <label><?php echo isset($cate['name'])?$cate['name']:"";?></label>
                    <?php }?>
			</div>
		</div>

      <div class="row cl">
      <label class="form-label col-3">费率类型：</label>
      <div class="formControls col-5">
             <select name="type">
               <option value="0">百分比</option>
               <option value="1">定值</option>
             </select>
      </div>
    </div>

     <div class="row cl">
      <label class="form-label col-3">费率值：</label>
      <div class="formControls col-5">
        <input class="input-text" name="value" class="text"  nullmsg='请填写费率值'>
      </div>
    </div>

     <div class="row cl">
      <label class="form-label col-3">备注：</label>
      <div class="formControls col-5">
        <textarea name="note"></textarea>
      </div>
    </div>
<div class="row cl">
      <label class="form-label col-3">状态：</label>
      <div class="formControls col-5">
        <input type="radio" name="status" value="0" checked="true">停用<input type="radio" name="status" value="1">启用
      </div>
    </div>
		
		<input type="hidden" name="ajax_url" id="ajax_url" value="http://localhost/nn2/admin/trade/insurance/ajaxgetcate">
          <input type="hidden" name="id" id="id" value="<?php echo isset($cate['id'])?$cate['id']:"";?>">
		<div class="row cl">
			<div class="col-9 col-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</div>
</div>

</div>
<script type="text/javascript">
     
$(document).ready(function(){

     $('#cate_id').on('change', function(){
          var cate_id = $(this).val();
          $('#id').val(cate_id);
          if (cate_id <= 0) {return;}
          $.ajax({
               'url' :  $('#ajax_url').val(),
               'type' : 'post',
               'async':true,
               'data' : {cate_id : cate_id},
               'dataType': 'json',
               success:function(data){//alert(JSON.stringify(data));
                    for (var i = 0; i < $('.bid').length; i++) {
                        $('.bid').eq(i).removeAttr('checked');
                        $('.input-text').eq(i).val('');
                    }
                    if (data.risk_data != undefined) {
                         $.each(data.risk_data, function(k, val){
                              for (var i = 0; i < $('.bid').length; i++) {
                                   if ($('.bid').eq(i).val() == val) {
                                        $('.bid').eq(i).prop('checked', 'checked');
                                   }
                              }
                         })
                    }
               }
          });
     })
})
</script>
        



</body>
</html>
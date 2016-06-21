<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jquery/1.6/jquery.min.js"></script>
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>

	<link rel="stylesheet" href="http://localhost/nn2/admin/public/views/pc/css/min.css" />
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/validform/validform.js"></script>
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/validform/formacc.js"></script>
	<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/layer/layer.js"></script>
	<link rel="stylesheet" href="http://localhost/nn2/admin/public/views/pc/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="http://localhost/nn2/admin/public/views/pc/css/H-ui.min.css">
</head>
<body>
   <script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>
    <script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/layer/layer.js"></script>
<script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/validform/formacc.js"></script>
        <div id="content" class="white">
            <h1><img src="http://localhost/nn2/admin/public/views/pc/img/icons/posts.png" alt="" /> 菜单管理</h1>
<div class="bloc">
    <div class="title">
        菜单列表
    </div>
        <div class="content">
        <div class="pd-20">
  
       <div class="mt-20">
       <form action="http://localhost/nn2/admin/public/member/menu/allocationusermenu" method="post" class="form form-horizontal" id="form-user-character-add">
    <table class="table table-border table-bordered table-hover table-bg table-sort">
    <thead>
      <tr class="text-c">
        <th width="25"><input type="checkbox" id="menuIds_all" <?php if( count($lists) == count($usergroupInfo['purview'])){?>checked='true'<?php }?>></th>
        <th width="80">菜单名</th>
      </tr>
    </thead>
    <tbody>

        <?php foreach($lists as $key => $list){?>
<tr class="text-c">
        <td><input type="checkbox" value="<?php echo isset($list['id'])?$list['id']:"";?>" name="menuIds[]" <?php if( (!empty($usergroupInfo['purview']) && in_array($list['id'], $usergroupInfo['purview']))){?> checked='true' <?php }?>> </td>
        <td>
        <?php  echo str_repeat('&nbsp;&nbsp;', $list['level'] * 5); ?> 
        <?php if( !empty($icon[$list['level']])){?><?php echo isset($icon[$list['level']])?$icon[$list['level']]:"";?> <?php }?>
        <?php echo isset($list['menu_zn'])?$list['menu_zn']:"";?>
        </td>
      </tr>
      <?php }?>
      </tbody>
  </table>
<input type="hidden" name="id" value="<?php echo isset($usergroupInfo['id'])?$usergroupInfo['id']:"";?>">
      <div class="row cl">
      <div class="col-10 col-offset-2">
          <button type="submit" class="btn btn-success radius" id="admin-role-save" name="admin-role-save"><i class="icon-ok"></i> 确认分配</button>
      </div>
  </div>
  </form>

  </div>
</div>
<script type="text/javascript">
$("#menuIds_all").click(function(){ 
    if(this.checked){
        $("input[name='menuIds[]']").each(function(){
            this.checked = true;
        }); 
    }else{ 
        $("input[name='menuIds[]']").each(function(){
            this.checked = false;
        }); 
    } 
});
</script>

</div>

</body>
</html>
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
    <table class="table table-border table-bordered table-hover table-bg table-sort">
    <thead>
      <tr class="text-c">
        <th width="25"><input type="checkbox" name="" value=""></th>
        <th width="80">菜单名</th>
        <th width="100">操作</th>
      </tr>
    </thead>
    <tbody>

        <?php foreach($lists as $key => $list){?>
<tr class="text-c">
        <td><input type="checkbox" value="" name=""></td>
        <td>
        <?php  echo str_repeat('&nbsp;&nbsp;', $list['level'] * 5); ?> 
        <?php if( !empty($icon[$list['level']])){?><?php echo isset($icon[$list['level']])?$icon[$list['level']]:"";?> <?php }?>
        <?php echo isset($list['menu_zn'])?$list['menu_zn']:"";?>
        </td>
        <td class="td-manage">
          <a title="编辑" href="http://localhost/nn2/admin/public/member/menu/updatemenu/id/<?php echo $list['id'];?>" class="ml-5" style="text-decoration:none">
            <i class="icon-edit"></i>
          </a>
          <a title="删除" href="javascript:;" ajax_status=-1 ajax_url="http://localhost/nn2/admin/public/member/menu/deletemenu/id/<?php echo $list['id'];?>"class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a>
          </a>

        </td>
      </tr>
      <?php }?>
      </tbody>
  </table>

  </div>
</div>


</div>

</body>
</html>
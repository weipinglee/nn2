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


<!--
      CONTENT
                -->
<div id="content" class="white">
    <h1><img src="/nn2/admin/views/pc/img/icons/posts.png" alt="" /> 客服管理</h1>
    <div class="bloc">
        <div class="title">
            客服列表
        </div>
        <div class="content">
            <div class="cl pd-5 bg-1 bk-gray"> <a class="btn btn-primary radius" href="http://localhost/nn2/admin/system/kefu/kefuadd"><i class=" icon-plus fa-plus"></i> 添加客服</a> </span>  </div>
            <div class="pd-20">

                <div class="mt-20">
                    <table class="table table-border table-bordered table-hover table-bg table-sort">
                        <thead>
                        <tr class="text-c">
                            <th width="100">用户名</th>
                            <th width="100">客服名称</th>
                            <th width="90"> 手机</th>
                            <th width="50">QQ</th>
                            <th width='100'>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(!empty($data)) foreach($data as $key => $item){?>
                            <tr class="text-c">
                                <td><u style="cursor:pointer" class="text-primary" ><?php echo isset($item['name'])?$item['name']:"";?></u></td>
                               <td><u style="cursor:pointer" class="text-primary" ><?php echo isset($item['ser_name'])?$item['ser_name']:"";?></u></td>
                                <td class="text-primary" ><?php echo isset($item['phone'])?$item['phone']:"";?></td>
                                <td><?php echo isset($item['qq'])?$item['qq']:"";?></td>
                                <td class="td-manage">
                                    <a title="编辑" href="http://localhost/nn2/admin/system/kefu/kefuadd/id/<?php echo $item['admin_id'];?>" class="ml-5" style="text-decoration:none"><i class="icon-edit fa-edit"></i></a>
                                    <a title="删除" href="javascript:void(0);"  ajax_status=-1 ajax_url="http://localhost/nn2/admin/system/kefu/del/id/<?php echo $item['admin_id'];?>"  class="ml-5" style="text-decoration:none"><i class="icon-trash fa-trash"></i></a></td>
                            </tr>
                        <?php }?>
                        </tbody>

                    </table>
                    <?php echo isset($bar)?$bar:"";?>
                </div>
            </div>


</body>
</html>
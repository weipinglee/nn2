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

<!--   <link rel="stylesheet" href="css/font-awesome.min.css" />
	<link rel="stylesheet" href="css/H-ui.min.css" />
 -->
                
        <!--            
              CONTENT 
                        --> 
<script type="text/javascript" src="/nn2/admin/public/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>
<script type="text/javascript" src="/nn2/admin/public/views/pc/js/layer/layer.js"></script>
<script type="text/javascript" src="/nn2/admin/public/views/pc/js/validform/formacc.js"></script>
        <div id="content" class="white">
            <h1><img src="/nn2/admin/public/views/pc/img/icons/posts.png" alt="" /> 报盘管理</h1>
<div class="bloc">
    <div class="title">
      报盘信息列表
    </div>
    <div class="content">
        <div class="pd-20">
            
<?php if($data['search']!=''){?>
    <?php if( empty($begin)){?>
    <?php $begin=\Library\safe::filterGet('begin');; ?>
    <?php }?>
    <?php if( empty($end)){?>
    <?php $end=\Library\safe::filterGet('end');; ?>
    <?php }?>

    <?php $like=\Library\safe::filterGet('like');; ?>
    <?php $min=\Library\safe::filterGet('min');; ?>
    <?php $max=\Library\safe::filterGet('max');; ?>
    <?php $select=\Library\safe::filterGet('select');; ?>

    <?php if($select==='all' || !isset($_GET['select']) ){?>
        <?php $select = -9999; ?>
    <?php }?>

    <form action="" method="get" >
        <div class="text-c">
            <?php if(isset($data['search']['time'])){?>
                <?php echo isset($data['search']['time'])?$data['search']['time']:"";?>：

                <input type="text" onfocus="WdatePicker()" id="datemin" class="input-text Wdate" name="begin" value="<?php echo isset($begin)?$begin:"";?>" style="width:120px;">
                -
                <input type="text" onfocus="WdatePicker()" id="datemax" class="input-text Wdate" name="end" value="<?php echo isset($end)?$end:"";?>" style="width:120px;">
            <?php }?>

            <?php if(isset($data['search']['like'])){?>
                <input type="text" class="input-text" style="width:250px" placeholder="输入<?php echo isset($data['search']['like'])?$data['search']['like']:"";?>" id="" name="like" value="<?php echo isset($like)?$like:"";?>">
            <?php }?>
            <?php if( !empty($data['search']['likes'])){?>
                <?php if(!empty($data['search']['likes'])) foreach($data['search']['likes'] as $key => $item){?>
                    <?php echo isset($item)?$item:"";?>：<input type="text" class="input-text" style="width:250px" placeholder="输入<?php echo isset($item)?$item:"";?>"  name="<?php echo isset($key)?$key:"";?>" value="<?php echo isset($data['search']['likesval'][$key])?$data['search']['likesval'][$key]:"";?>">
                <?php }?>
            <?php }?>
            <?php if(isset($data['search']['between'])){?>
                <?php echo isset($data['search']['between'])?$data['search']['between']:"";?>:
                <input type="text" class="input-text" style="width:100px"  id="" name="min" value="<?php echo isset($min)?$min:"";?>">-
                <input type="text" class="input-text" style="width:100px"  id="" name="max" value="<?php echo isset($max)?$max:"";?>">
            <?php }?>
            <?php if(isset($data['search']['select'])){?>
                <?php echo isset($data['search']['select'])?$data['search']['select']:"";?>：
                <select name="select" >
                    <option value="all">所有</option>
                    <?php if(!empty($data['search']['selectData'])) foreach($data['search']['selectData'] as $key => $item){?>
                        <option value="<?php echo isset($key)?$key:"";?>" <?php if($select==$key){?>selected=true<?php }?>><?php echo isset($item)?$item:"";?></option>
                    <?php }?>
                </select>
            <?php }?>
            <button type="submit" class="btn btn-success radius" id="" name=""><i class="icon-search fa-search"></i> 搜索</button>
   
            <?php if( isset($data['search']['down']) && $data['search']['down']==1){?>
            <button type="submit" class="btn btn-success radius" id="" name="down" value="1"><i class="icon-search fa-search"></i> 导出</button>
            <?php }?>

        </div>
    </form>
<?php }?>

		 </div>
		 <table class="table table-border table-bordered table-hover table-bg">
        <thead>
            <tr>
                <th scope="col" colspan="12">报盘信息</th>
            </tr>
            <tr class="text-c">

                <th>ID</th>
                <th>用户名</th>
                <th>姓名/企业名称</th>
                <th>商品名</th>
                <th>交易方式</th>
                <th>类型</th>
                <th>可否拆分</th>
                <th>数量</th>
                <th>挂牌价</th>
                <th>状态</th>

                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($data['list'])) foreach($data['list'] as $key => $item){?>
                <tr class="text-c">

                    <td><?php echo isset($item['id'])?$item['id']:"";?></td>
                    <td><a href="#"><?php echo isset($item['username'])?$item['username']:"";?></a></td>
                    <td><?php if($item['company_name']!=''){?><?php echo isset($item['company_name'])?$item['company_name']:"";?><?php }else{?><?php echo isset($item['true_name'])?$item['true_name']:"";?><?php }?></td>
                    <td><?php echo isset($item['name'])?$item['name']:"";?></td>
                    <td><?php echo isset($item['type_txt'])?$item['type_txt']:"";?></td>
                    <td><?php echo isset($item['mode_txt'])?$item['mode_txt']:"";?></td>
                    <td><?php echo isset($item['divide_text'])?$item['divide_text']:"";?></td>
                    <td><?php echo isset($item['quantity'])?$item['quantity']:"";?></td>
                    <td><?php echo isset($item['price'])?$item['price']:"";?></td>
                    <td><?php echo isset($item['status_txt'])?$item['status_txt']:"";?></td>
                     <td class="td-manage"> <a title="查看" href="http://localhost/nn2/admin/public/trade/offermanage/offerdetails/id/<?php echo $item['id'];?>/user/<?php echo $item['username'];?>" class="ml-5" style="text-decoration:none"><i class="icon-eye-open fa-eye-open"></i></a> <a title="删除" ajax_status=-1 ajax_url="http://localhost/nn2/admin/public/trade/offermanage/logicdel/id/<?php echo $item['id'];?>"  class="ml-5" style="text-decoration:none"><i class="icon-trash fa-trash"></i></a></td>
                </tr>
           <?php }?>
        </tbody>
    </table>
            <?php echo isset($data['bar'])?$data['bar']:"";?>
</div>




</body>
</html>
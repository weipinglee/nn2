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
            <h1><img src="/nn2/admin/views/pc/img/icons/posts.png" alt="" /> 交易商认证</h1>
<div class="bloc">
    <div class="title">
        会员认证
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

           <table class="table table-border table-bordered table-hover table-bg">
        <thead>
            <tr>
                <th scope="col" colspan="9">会员账户</th>
            </tr>
            <tr class="text-c">
               <!-- <th><input type="checkbox" value="" name="checkall"></th>-->
                <th>ID</th>
                <th >登录账号</th>
                <th>会员类型</th>
                <th>手机号</th>
				<th>认证状态</th>
				<th>申请时间</th>
				<th>操作</th>
            </tr>
        </thead>
        <tbody>
        <?php if(!empty($data['list'])) foreach($data['list'] as $key => $item){?>
            <tr class="text-c">
                <!--<td><input type="checkbox" value="" name="check"></td>-->
                <td><?php echo isset($item['id'])?$item['id']:"";?></td>
                <td><?php echo isset($item['username'])?$item['username']:"";?></td>
                <td><?php if( $item['type'] != ''){?><?php echo \nainai\member::getType($item['type']);?><?php }?></td>
                <td><?php echo isset($item['mobile'])?$item['mobile']:"";?></td>
				<td><?php echo \nainai\cert\certDealer::getStatusText($item['status']);?></td>
				<td><?php echo isset($item['apply_time'])?$item['apply_time']:"";?></td>

                <td class="f-14"><a title="编辑" href="http://localhost/nn2/admin/member/certmanage/dealercertdetail/uid/<?php echo $item['id'];?>"  style="text-decoration:none"><i class=" icon-edit fa-edit"></i></a> </td>
				
            </tr>
        <?php }?>

        </tbody>
    </table>
        </div>        
       <?php echo isset($data['bar'])?$data['bar']:"";?>
    </div>
</div>


     
        



</body>
</html>
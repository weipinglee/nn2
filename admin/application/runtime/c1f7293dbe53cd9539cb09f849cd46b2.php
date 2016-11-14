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

        <script type="text/javascript" src="/nn2/admin/public/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>
        <script type="text/javascript" src="/nn2/admin/public/views/pc/js/validform/validform.js"></script>
        <script type="text/javascript" src="/nn2/admin/public/views/pc/js/validform/formacc.js"></script>
        <script type="text/javascript" src="/nn2/admin/public/views/pc/js/layer/layer.js"></script>
        <!--            
              CONTENT 
                        -->
        <div id="content" class="white">
            <h1><img src="/nn2/admin/public/views/pc/img/icons/dashboard.png" alt="" />申述管理
</h1>

<div class="bloc">
    <div class="title">
       申述信息
    </div>
     <div class="pd-20">
     <?php if( $handler==1){?>
     <form action="http://localhost/nn2/admin/public/trade/complain/docheck" method="POST" auto_submit redirect_url="http://localhost/nn2/admin/public/trade/complain/complainlist/status/0">
     <?php }elseif( $handler == 2){?>
     <form action="http://localhost/nn2/admin/public/trade/complain/dohandler" method="POST" auto_submit redirect_url="http://localhost/nn2/admin/public/trade/complain/complainlist/status/0">
     <?php }?>

	 	 <table class="table table-border table-bordered table-bg">

	 		<tr>
	 			<th>订单号</th>
	 			<td><?php echo isset($detail['order_no'])?$detail['order_no']:"";?></td>
	 			<th>申述类型</th>
	 			<td><?php echo isset($detail['type'])?$detail['type']:"";?></td>
	 			<th>申述用户</th>
	 			<td><?php echo isset($detail['username'])?$detail['username']:"";?></td>
	 		</tr>
            <tr>
                <th>申请日期</th>
                <td><?php echo isset($detail['apply_time'])?$detail['apply_time']:"";?></td>
                <th>审核日期</th>
                <td><?php echo isset($detail['check_time'])?$detail['check_time']:"";?></td>
                <th>处理日期</th>
                <td><?php echo isset($detail['handle_time'])?$detail['handle_time']:"";?></td>

            </tr>
      	 		<tr>
                    <th>申述标题</th>
                    <td colspan="5"><?php echo isset($detail['title'])?$detail['title']:"";?></td>
      	 		</tr>
             <tr>
                <th>申述内容</th>
                <td colspan="5">
                         <?php echo isset($detail['detail'])?$detail['detail']:"";?>
                </td>
            </tr>
            <tr>
                <th>申述凭证</th>
                <td colspan="5">
                        <ul>
                        <?php if( !empty($detail['proof'])){?>
                            <li>
                        <?php if(!empty($detail['proof'])) foreach($detail['proof'] as $key => $img){?>
                        <img src="<?php echo isset($img)?$img:"";?>">
                        <?php }?>
                            </li>
                        <?php }?>
                        </ul>
                </td>
            </tr>
            <tr>

              <th>状态</th>
              <td colspan="5"><?php echo isset($detail['statuscn'])?$detail['statuscn']:"";?></td>

            </tr>
            <tr>

              <th>审核意见</th>
              <td colspan="3"><?php echo isset($detail['check_msg'])?$detail['check_msg']:"";?></td>
             <th>审核用户</th>
              <td ><?php echo isset($checkAdminData['name'])?$checkAdminData['name']:"";?></td>
            </tr>
            <tr>

              <th>处理意见</th>
              <td colspan="3"><?php echo isset($detail['handle_msg'])?$detail['handle_msg']:"";?></td>
<th>处理用户</th>
              <td ><?php echo isset($handlerAdminData['name'])?$handlerAdminData['name']:"";?></td>
            </tr>
           
             <tr>
             <?php if( $handler == 1){?>
             <tr>
             <th>填写审核意见</th>
             <td colspan="6">
              <textarea name="msg" cols="" rows="" class="textarea"  onKeyUp="textarealength(this,1000)"></textarea>
              </td>
              </tr>
             <?php }elseif( $handler == 2){?>
              <tr>
             <th>填写处理意见</th>
             <td colspan="6">
              <textarea name="msg" cols="" rows="" class="textarea"  onKeyUp="textarealength(this,1000)"></textarea>
              </td>
              </tr>
             <?php }?>
                 <th>处理结果</th>
                 <input type="hidden"  name='id' value="<?php echo isset($detail['id'])?$detail['id']:"";?>" />
                 <input type="hidden"  name='oid' value="<?php echo isset($detail['oid'])?$detail['oid']:"";?>" />
                  <th scope="col" colspan="7">
                  <input  type="hidden" name="id" value="<?php echo isset($detail['id'])?$detail['id']:"";?>" />
                  <?php if( $handler == 1){?>
                     <label><input type="radio" name="status" value="1" checked/>介入处理</label>
                      <label><input type="radio" name="status" value="0"/>不通过</label>
                  <?php }elseif( $handler == 2){?>
                      <label><input type="radio" name="status" value="1" checked/>介入后协商通过</label>
                      <label><input type="radio" name="status" value="2"/>买方违约</label>
                      <label><input type="radio" name="status" value="3"/>卖方违约</label>
                  <?php }?>

                 </th>
             </tr>
             <tr>
                 <th>操作</th>
                 <th scope="col" colspan="7">
                 <?php if( $handler == 2 || $handler == 1){?>
                     <input type="submit" class="btn btn-primary radius" value="提交"/>
                     <?php }?>
                     <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove fa-remove"></i> 返回</a>
                 </th>
             </tr>

	 	</table>
    </form>
 	</div>
</div>
</div>



</body>
</html>
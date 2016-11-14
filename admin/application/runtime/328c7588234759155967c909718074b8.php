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
            <h1><img src="/nn2/admin/public/views/pc/img/icons/dashboard.png" alt="" />收费明细
</h1>

<div class="bloc">
    <div class="title">
       明细详情
    </div>
     <div class="pd-20">


	 	 <table class="table table-border table-bordered table-bg">

	 		<tr>
	 			<th>用户名称</th>
	 			<td><?php echo isset($data['user']['username'])?$data['user']['username']:"";?></td>
	 			<th>企业名称</th>
	 			<td><?php echo isset($data['user']['company_name'])?$data['user']['company_name']:"";?></td>
	 			<th>联系电话</th>
	 			<td><?php echo isset($data['user']['mobile'])?$data['user']['mobile']:"";?></td>

	 		</tr>
            <tr>
                <th>报盘类型</th>
                <td><?php echo isset($data['offer']['mode_text'])?$data['offer']['mode_text']:"";?></td>
                <th>商品名称</th>
                <td><?php echo isset($data['offer']['name'])?$data['offer']['name']:"";?></td>
                
                <th>接收地点</th>
                <td><span id="area">                    <span id="areatextarea">
                        <script type="text/javascript">
                         ( function(){
                            var areatextObj = new Area();
                            var text = areatextObj.getAreaText('<?php echo $data['offer']['accept_area'] ; ?>',' ');
                            $('#areatextarea').html(text);

                            })()
                        </script>
                     </span>

</span></td>




            </tr>

             
            <tr>
                <th>收费类别</th>
                <td><?php echo isset($data['charge_type_text'])?$data['charge_type_text']:"";?></td>
                <th>收费金额</th>
                <td><?php echo isset($data['num'])?$data['num']:"";?></td>
                
                <th>收费时间</th>
                <td><?php echo isset($data['create_time'])?$data['create_time']:"";?></td>

            </tr>

            <tr>
                <th>备注</th>
                <td colspan="5"><?php echo isset($data['remark'])?$data['remark']:"";?></td>
                
            </tr>
             <!-- <tr>
                 <th>操作</th>
                 <th scope="col" colspan="7">
                     <input type="submit" class="btn btn-primary radius" value="提交"/>
                     <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove fa-remove"></i> 返回</a>
                 </th>
             </tr> -->

	 	</table>
 	</div>
</div>
</div>

        
    </body>
</html>


</body>
</html>
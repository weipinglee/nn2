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
	<script type="text/javascript" src="http://localhost/nn2/admin/public/js/area/Area.js" ></script>
	<script type="text/javascript" src="http://localhost/nn2/admin/public/js/area/AreaData_min.js" ></script>
</head>
<body>

        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="http://localhost/nn2/admin/public/views/pc/img/icons/dashboard.png" alt="" />信誉保证金账户
</h1>
                
<div class="bloc">
    <div class="title">
       用户信息
    </div>
    <form action="http://localhost/nn2/admin/public/balance/accmanage/userCreditAdd/" method="post" auto_submit redirect_url='http://localhost/nn2/admin/public/balance/accmanage/userCreditList/'>
         <div class="pd-20">
             <table class="table table-border table-bordered table-bg">
                 <tr>
                     <th>用户名</th>
                     <td><?php echo isset($info['username'])?$info['username']:"";?></td>
                     <th>注册手机号</th>
                     <td><?php echo isset($info['mobile'])?$info['mobile']:"";?></td>
                     <th>邮箱</th>
                     <td><?php echo isset($info['email'])?$info['email']:"";?></td>
                 </tr>
                 <tr>
                     <th>企业名称</th>
                     <td><?php echo isset($info['company_name'])?$info['company_name']:"";?></td>
                     <th>法人</th>
                     <td><?php echo isset($info['legal_person'])?$info['legal_person']:"";?></td>
                     <th>注册资金</th>
                     <td><?php echo isset($info['reg_fund'])?$info['reg_fund']:"";?></td>
                 </tr>
                 <tr>
                     <th>企业详细地址</th>
                     <td id='area'>                <script type="text/javascript">
                 areaObj = new Area();

                  $(function () {
                    var text = areaObj.getAreaText('<?php echo $info['area'] ; ?>',' ');
                    $('#area').html(text);
                  });
                </script>
&nbsp;<?php echo isset($info['address'])?$info['address']:"";?></td>
                     <th>联系人</th>
                     <td><?php echo isset($info['contact'])?$info['contact']:"";?></td>
                     <th>联系人电话</th>
                     <td><?php echo isset($info['contact_phone'])?$info['contact_phone']:"";?></td>
                     

                 </tr>
                <tr>
                    <th scope="col" colspan="1">信誉保证金充值</th>
                    <td colspan="5"><input type="text" class="text" datatype='n' style="width:200px;height: 30px;" name="credit"/></td>
                </tr>
                <tr>
                  <th scope="col" colspan="6">
                    <input type="hidden" name="user_id" value="<?php echo isset($info['user_id'])?$info['user_id']:"";?>">
                     <a onclick="javascript:$('form').submit();" class="btn btn-success radius"><i class="icon-remove"></i> 确认</a>
                     <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove"></i> 返回</a>
                  </th>
                </tr>
            </table>
        </div>
    </form>
</div>

</div>
        
        
    </body>
</html>
</body>
</html>
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
        <script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/libs/jquery/1.11/jquery.min.js"></script>
        <script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/validform/validform.js"></script>
        <script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/validform/formacc.js"></script>
        <script type="text/javascript" src="http://localhost/nn2/admin/public/views/pc/js/layer/layer.js"></script>
        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="http://localhost/nn2/admin/public/views/pc/img/icons/dashboard.png" alt="" />报盘管理
</h1>

<div class="bloc">
    <div class="title">
       报盘信息
    </div>
     <div class="pd-20">
	 	 <table class="table table-border table-bordered table-bg">
	 		<tr>
	 			<th>标的编号</th>
	 			<td>HDBD08003-1</td>
	 			<th>客户编号</th>
	 			<td>HDBD08003-1</td>
	 			<th>委托方</th>
	 			<td><?php echo isset($info['user'])?$info['user']:"";?></td>
	 		</tr>
            <tr>
                <th>交易方式</th>
                <td><?php echo isset($info['type'])?$info['type']:"";?></td>
                <th>交易种类</th>
                <td>现货交易</td>
                <th>商品大类</th>
                <td><?php echo isset($info['topcate_name'])?$info['topcate_name']:"";?></td>
            </tr>
      	 		<tr>
      	 			<th>商品种类</th>
      	 			<td><?php echo isset($info['parent_cates'])?$info['parent_cates']:"";?></td>
      	 			<th>可否拆分</th>
      	 			<td><?php if($info['divide'] == 0){?>可拆分<?php }else{?>否<?php }?></td>
      	 			<th>数量</th>
      	 			<td><?php echo isset($info['minimum'])?$info['minimum']:"";?></td>
      	 		</tr>
            <tr>
              <th>包装单位</th>
              <td><?php echo isset($info['unit'])?$info['unit']:"";?></td>
              <th>单位重量</th>
              <td>--</td>
              <th>计量单位</th>
              <td>吨</td>
              
            </tr>
            <tr>
              <th>商品总重</th>
              <td>10</td>
              <th>挂牌价</th>
              <td><?php echo isset($info['price'])?$info['price']:"";?></td>
              <th>状态</th>
              <td>待审核</td>
             
            </tr>
            <tr>
              <th>类型</th>
              <td><?php echo isset($info['mode_txt'])?$info['mode_txt']:"";?></td>
            </tr>

            <tr>
              <th scope="col" colspan="6">
                 <a href="javascript:;" class="btn btn-danger radius pass"><i class="icon-ok"></i> 通过</a> 
                 <a href="javascript:;" class="btn btn-primary radius ref"><i class="icon-remove"></i> 不通过</a>
                 <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove"></i> 返回</a>
              </th>
            </tr>
	 	</table>
 	</div>
</div>
</div>
      <script type="text/javascript">
        $(function(){
          var formacc = new nn_panduo.formacc();
          var status = '';
          $('a.pass').click(function(){
            $(this).unbind('click');
            msg = '已通过';
            setStatus(0,msg);
          })

          $('a.ref').click(function(){
            $(this).unbind('click');
            msg = '已驳回';
            setStatus(2,msg);
          })

          function setStatus(status,msg){
            formacc.ajax_post("http://localhost/nn2/admin/public/index.php//trade/offermanage/setStatus/",{status:status,id:<?php echo isset($info['id'])?$info['id']:"";?>},function(){
              layer.msg(msg+"稍后自动跳转");
                  setTimeout(function(){
                      window.location.href = "http://localhost/nn2/admin/public/index.php//trade/offermanage/offerReview/";
                  },1500);
            });
          }
        })

      </script>
        
    </body>
</html>
</body>
</html>
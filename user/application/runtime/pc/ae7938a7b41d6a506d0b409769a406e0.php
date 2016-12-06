<!DOCTYPE html>
<html>
<head>
  <title>个人中心</title>
  <meta name="keywords"/>
  <meta name="description"/>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=EDGE">
  <link href="/nn2/user/views/pc/css/user_index.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="/nn2/user/js/jquery/jquery-1.7.2.min.js"></script>



  <script language="javascript" type="text/javascript" src="/nn2/user/views/pc/js/My97DatePicker/WdatePicker.js"></script>
  <script type="text/javascript" src="/nn2/user/views/pc/js/regular.js"></script>
   <script src="/nn2/user/views/pc/js/center.js" type="text/javascript"></script>
  <link href="/nn2/user/views/pc/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
   <!-- 头部控制 -->
  <link href="/nn2/user/views/pc/css/topnav20141027.css" rel="stylesheet" type="text/css">
  <script src="/nn2/user/views/pc/js/topnav20141027.js" type="text/javascript"></script>
    <!-- 头部控制 -->

    <script type="text/javascript" src="/nn2/user/js/form/validform.js" ></script>
    <script type="text/javascript" src="/nn2/user/js/form/formacc.js" ></script>
    <script type="text/javascript" src="/nn2/user/js/layer/layer.js"></script>
    <script type="text/javascript" src="/nn2/user/js/layer/extend/layer.ext.js"></script>

     <link href="/nn2/user/js/form/validate/error.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="/nn2/user/js/area/AreaData_min.js" ></script>
    <script type="text/javascript" src="/nn2/user/js/area/Area.js" ></script>

</head>
<body>
<!--    公用头部控件 -->
    <div class="bg_topnav">
    <div class="topnav_width">
        <div class="topnav_left">
            <div class="top_index">
                <img class="index_img" src="/nn2/user/views/pc/images/icon/icon_index.png"/>
                <a rel="external nofollow" href="http://124.166.246.120:8000/user/public/index/index" target="_blank" >耐耐网首页</a>
            </div>

            <div class="index_user">
            <?php if(isset($username)){?>
                <a rel="external nofollow"  href="http://localhost/nn2/user/public/ucenterindex/index"  target="_blank" class="">您好，<?php echo isset($username)?$username:"";?></a>
                <?php }else{?>
                <span>您好，欢迎进入耐耐网</span>
                <?php }?>
            </div>
            <?php if($login==0){?>
            <div class="login_link" id="toploginbox">
                <a rel="external nofollow" href="http://localhost/nn2/user/public/login/login" target="_blank" class="topnav_login">请登录</a>
            </div>
            <div class="topnav_regsiter">
                <a rel="external nofollow" href="http://localhost/nn2/user/public/login/register" target="_blank">免费注册</a>
            </div>
            <?php }else{?>
            <div class="login_link" id="toploginbox">
                <a rel="external nofollow" href="http://localhost/nn2/user/public/login/logout" target="_blank" class="topnav_login">退出</a>
            </div>
            <?php }?>
        </div>
        <div class="topnav_right">
            <ul>
                <?php if($login!=0){?>
                 <li>
                   <a href="http://localhost/nn2/user/public/ucenterindex/index">会员中心</a><span class="line_l">|<span>
                </li>
                <li>
                    <?php if($usertype==1){?>
                        <a href="http://localhost/nn2/user/contract/sellerlist">我的合同</a>
                    <?php }else{?>
                        <a href="http://localhost/nn2/user/contract/buyerlist">我的合同</a>
                    <?php }?>
                    <span class="line_l">|<span>
                </li>
                <?php }?>
                <li>
                    <a href="http://localhost/nn2/user/public/message/usermail">消息中心<?php if($mess!=0){?><em class="information"><?php echo isset($mess)?$mess:"";?></em><?php }?></a><span class="line_l">|<span>
                </li>
                <!--<li>
                    <img class="iphon_img" src="/nn2/user/views/pc/images/icon/icon_iphon.png"/>
                    <a href="">手机版</a><span class="line_l">|<span>
                </li>-->
                <li>
                    <a href="http://crm2.qq.com/page/portalpage/wpa.php?uin=4006238086&aty=0&a=0&curl=&ty=1" target="_blank" ><!--onclick="javascript:window.open('http://b.qq.com/webc.htm?new=0&sid=279020473&o=new.nainaiwang.com&q=7', '_blank', 'height=502, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');" --> 在线客服</a><span class="line_l">|<span>
                </li>
                <li style="padding-top:2px;">
                    <span>交易时间：<?php echo isset($deal['start_time'])?$deal['start_time']:"";?>--<?php echo isset($deal['end_time'])?$deal['end_time']:"";?></span>
                </li>

            </ul>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<!-- 公用头部控件 -->
<div class="header">
		<div class="nav">
            <div class="logo-box zn-l">
                <a href="http://124.166.246.120:8000/user/public/index/index" alt="返回耐耐首页"><img src="/nn2/user/views/pc/images/icon/nainaiwang.png"/></a></dd>
            </div>
			<div class="nav-tit">
                <ul class="nav-list">
                    <?php if(!empty($topArray)) foreach($topArray as $key => $topList){?>
                        <li>
                            <a href="<?php echo isset($topList['url'])?$topList['url']:"";?>" <?php if( isset($topList['isSelect']) && $topList['isSelect'] == 1){?> class="cur" <?php }?>><?php echo isset($topList['title'])?$topList['title']:"";?></a>
                        </li>
                    <?php }?>

                </ul>
			</div>
		</div>
	</div>
	<div class="user_body">
		<div class="user_b">
			<!--start左侧导航--> 
            <div class="user_l">
                <?php if(!empty($leftArray) && count($leftArray)>1){?>
                <div class="left_navigation">
                    <ul>

                    	<?php if(!empty($leftArray)) foreach($leftArray as $k => $leftList){?>
                    		<?php if( $k == 0){?>
                    		<li class="let_nav_tit"><h3><?php echo isset($leftList['title'])?$leftList['title']:"";?></h3></li>
                    		<?php }else{?>
                            <li class="btn1" id="btn<?php echo isset($k)?$k:"";?>">
                                <a class="nav-first <?php if($action==$leftList['action']){?>cur<?php }?>" <?php if( !empty($leftList['url'])){?> href="<?php echo isset($leftList['url'])?$leftList['url']:"";?>"<?php }?> >
                                    <?php echo isset($leftList['title'])?$leftList['title']:"";?>
                                    <i class="icon-caret-down"></i>
                                </a>
                                <?php if( !empty($leftList['list'])){?>
                                    <ul class="zj_zh" >
                                        <?php if(!empty($leftList['list'])) foreach($leftList['list'] as $key => $list){?>
                                            <li><a  href="<?php echo isset($list['url'])?$list['url']:"";?>" <?php if( in_array($action, $list['action'])){?>class="cur"<?php }?> ><?php echo isset($list['title'])?$list['title']:"";?></a></li>
                                        <?php }?>
                                    </ul>
                                <?php }?>
                            </li>

                    		<?php }?>



                    	<?php }?>
                        
                      
                    </ul>
                </div>
                <?php }else{?>
                    <div class="wrap_con">
                        <div class="personal_data">
                            <div class="head_portrait">
                                <a href="#">
                                    <img src="/nn2/user/views/pc/images/icon/head_portrait.jpg">
                                </a>
                            </div>
                            <div class="per_username">
                                <p class="username_p"><b>您好，<?php echo isset($username)?$username:"";?></b></p>
                                <p class="username_p"><!--<img src="<?php echo isset($group['icon'])?$group['icon']:"";?>">--><?php echo isset($group['group_name'])?$group['group_name']:"";?></p>
                                <p class="username_p">消息提醒：<a href="http://localhost/nn2/user/message/usermail"><b class="colaa0707"><?php echo isset($mess)?$mess:"";?></b></a></p>
                            </div>
                            <div class="per_function">
                                <a href="http://localhost/nn2/user/ucenter/baseinfo">基本信息设置</a>
                                <a href="http://localhost/nn2/user/ucenter/password">修改密码</a>
                            </div>

                        </div>
                    </div>
                <?php }?>
            </div>
            <!--end左侧导航-->
            <div id="cont">
<style type="text/css">
	.node_tree li {float: left;text-decoration: none;list-style: none;}
	.clearfix{clear: left;}
	.node_tree .v1{background-color: #F4F2F2;margin:5px 10px;padding: 10px 10px;padding-top:9px;color: #666;border-radius: 3px;font-size: 16px;}
	.node_tree .v2{text-indent: 2em;font-weight: bolder;padding: 5px 10px;font-size: 14px;}
	.node_tree .v2 span{font-size: 14px;}
	.node_tree .v3{padding-left: 50px;}	
	.node_tree .v3 .ins{font-size: 14px;line-height: 35px;}
	.v3_li{position: relative;padding-left: 25px;font-size: 14px;}
	b.del{cursor: pointer;}
	input.btn-primary{
		background: #d61515;
		color: #fff;
		border: 1px solid #d61515;
		font-size: 16px;
		padding: 8px 30px;
		margin: 5px 10px;
		cursor: pointer;
		margin-left: 105px;
	}
</style>
<div class="user_c">
	<div class="user_zhxi">
		<div class="zhxi_tit">
			<p><?php echo isset($navi)?$navi:"";?></p>
		</div>
		<div class="xx_center">
		<form action="http://localhost/nn2/user/ucenter/subaccpow" method="post" class="form form-horizontal" id="form-access-add" no_redirect="1" auto_submit>
			<div class='node_tree' style="font-size:16px;">
				<input type="hidden" name="id" value="<?php echo isset($roleInfo['id'])?$roleInfo['id']:"";?>" />
				<?php if(!empty($lists)) foreach($lists as $k => $item){?>
				<!-- 模块 -->
				<div class='root'>
					<div class='v1'><input type="checkbox" name="menuIds[]" value="<?php echo isset($item['id'])?$item['id']:"";?>" <?php if( !empty($roleInfo['gid']) && in_array($item['id'],$roleInfo['gid'])){?>checked='checked'<?php }?>/>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo isset($item['title'])?$item['title']:"";?></div>
					<?php if(!empty($item['list'])) foreach($item['list'] as $k1 => $v1){?>
					<!-- 控制器 -->
						<div class='controller'>
							<div class='v2'><input type="checkbox" name="menuIds[]" value="<?php echo isset($v1['id'])?$v1['id']:"";?>" <?php if( !empty($roleInfo['gid']) && in_array($v1['id'],$roleInfo['gid'])){?>checked='checked'<?php }?>/>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo isset($v1['title'])?$v1['title']:"";?>
							</div>
							<div class='v3'>
								<?php if(!empty($v1['list'])) foreach($v1['list'] as $k2 => $v2){?>
									<ul>
									<div class='ins'><input type="checkbox" <?php if( !empty($roleInfo['gid']) && in_array($v2['id'],$roleInfo['gid'])){?>checked='checked'<?php }?> name="menuIds[]" value="<?php echo isset($v2['id'])?$v2['id']:"";?>" />&nbsp;&nbsp;&nbsp;&nbsp;[<?php echo isset($v2['title'])?$v2['title']:"";?>]</div>
									<!-- action -->
									<?php if(!empty($v2['list'])) foreach($v2['list'] as $key => $v3){?>
										<li class='v3_li'>
											<input type="checkbox" name="menuIds[]" value="<?php echo isset($v3['id'])?$v3['id']:"";?>"  <?php if( !empty($roleInfo['gid']) && in_array($v3['id'],$roleInfo['gid'])){?>checked='checked'<?php }?>/>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo isset($v3['title'])?$v3['title']:"";?>
										</li>
									<?php }?>
									</ul>	
									<div class='clearfix'></div>
								<?php }?>
								
							</div>
							<div class='clearfix'></div>
						</div>
					<?php }?>
				</div>
				<?php }?>
			</div>
			<div class="col-9 col-offset-3">
				<input class="btn btn-primary radius" type="submit" value="提交">
			</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	;$(function(){
		$(".ins").each(function(){
			var _this = this;
			$(this).siblings("li").each(function(i){
				var bo = $(this).find(":checkbox").is(":checked");
				if(bo){
					$(_this).find(":checkbox").prop("checked",true);
				}
			});
		});


		$('.v1 :checkbox').unbind('click').click(function(){
			$(this).parent().siblings('.controller').find('.v3 :checkbox,.v2 :checkbox').prop("checked",this.checked);
		});

		$('.v2 :checkbox').click(function(){
			$(this).parents('.controller').find('.v3 :checkbox').prop("checked",this.checked);
			if($(this).is(":checked")){
				$(this).parents('.root').find('.v1 :checkbox').prop('checked',true);
			}
		});

		$('.v3 li :checkbox').click(function(){
			if($(this).is(":checked")){
				$(this).parents('.controller').find('.v2 :checkbox').prop('checked',true);
				$(this).parents('.root').find('.v1 :checkbox').prop('checked',true);
				$(this).parents('ul').find('.ins :checkbox').prop('checked',true);
			}
		});

		$('.ins :checkbox').click(function(){
			$(this).parents('ul').find(':checkbox').prop("checked",this.checked);
			if($(this).is(":checked")){
				$(this).parents('.root').find('.v1 :checkbox').prop('checked',true);
				$(this).parents('.v3').siblings('.v2').find(':checkbox').prop('checked',true);
			}
		});

		var url = "http://localhost/nn2/user/system/rbac/accessList/";
		//切换角色
		$('.roles').change(function(){
			var role_id = $(this).val();
			var rec_url = url+'?role_id='+role_id;
			window.location.href=rec_url;
		});



		$('b.del').click(function(){
			var _this = $(this);
			var url = "http://localhost/nn2/user/system/rbac/nodedel";
			layer.confirm('确认删除',{
				shade:false
			},function(){
				layer.closeAll();
				layer.load(2);
				var node_id = _this.attr('node_id');

				$.ajax({
					type:'post',
					data:{node_id:node_id},
					url:url,
					success:function(data){
						layer.closeAll();
						
						if(data.success == 1){
							window.location.reload();
						}else{
							layer.msg(data.info);
						}

					},
					error:function(){
						layer.closeAll();
						layer.msg('服务器错误');
					},
					dataType:'json'
				});
			});
		});
	})

</script>






</div>

				<!--end中间内容-->	
			
		</div>
	</div>
<script type="text/javascript">
    $(function() {
        $('.left_navigation ').find('.cur').parents('.btn1').find('.nav-first').trigger('click');
    })
</script>
</body>
</html>
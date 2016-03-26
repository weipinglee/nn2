<!DOCTYPE html>
<html>
<head>
  <title>个人中心</title>
  <meta name="keywords"/>
  <meta name="description"/>
  <meta charset="utf-8">
  <link href="http://localhost/nn2/user/public/views/pc/css/user_index.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="http://localhost/nn2/user/public/js/jquery/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="http://localhost/nn2/user/public/js/autovalidate/validate.js" ></script>
	<link href="http://localhost/nn2/user/public/js/autovalidate/style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="header">
		<div class="nav">
			<div class="logo-box zn-l">
				<dl>
					<dt><a href="" class="logo">
						耐耐网
					</a></dt>
					<dd><a href="/" class="back-index">返回耐耐首页</a></dd>
				</dl>	
			</div>
			<div class="nav-tit">
				<ul class="nav-list">
					<li>
						<a href="http://localhost/nn2/user/public/ucenter/index" class="cur">首页</a>
					</li>
					<li>
						<a href="http://localhost/nn2/user/public/ucenter/info">账户管理</a>
					</li>
					<li>
						<a href="user_zj.html">资金管理</a>
					</li>
					<li>
						<a href="user_chp.html">产品管理</a>
					</li>
					<li>
						<a href="user_dd.html">交易管理</a>
					</li>
					<li>
						<a href="user_gz.html">关注中心</a>
					</li>
			 	</ul>
			</div>
		</div>
	</div>
	﻿
<script type="text/javascript" src="http://localhost/nn2/user/public/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="http://localhost/nn2/user/public/views/pc/js/upload.js"></script>
<div class="user_body">
		<div class="user_b">
			<div class="user_l">
				<div class="left_navigation">
					<ul>
						<li class="let_nav_tit"><h3>账户管理</h3></li>
						<li><a href="http://localhost/nn2/user/public/ucenter/info" >基本信息</a></li>
						<li><a href="http://localhost/nn2/user/public/ucenter/password"class="cur">修改密码</a></li>
						<li><a href="javascript:void(0)"class="cur">资质认证</a>
							<ul>
								<li><a href="http://localhost/nn2/user/public/ucenter/dealcert">交易商</a></li>
								<li><a href="http://localhost/nn2/user/public/ucenter/storecert">仓库管理</a></li>
							</ul>
						</li>
						<li><a href="javascript:void(0)"class="cur">子账户管理</a>
							<ul>
								<li><a href="http://localhost/nn2/user/public/ucenter/subacc">添加子账户</a></li>

							</ul>
						</li>
					</ul>
				</div>
			</div>
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>账号管理</a>><a>添加子账户</a></p>
					</div>
					<input type="hidden" name="uploadUrl"  value="http://localhost/nn2/user/public/ucenter/upload" />

				<form method="post" action="http://localhost/nn2/user/public/ucenter/dosubacc" >
					<div style="float:left">

						<input type="hidden" name="id" value="<?php echo isset($user['id'])?$user['id']:"";?>"/>
						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>用户名：</span>
							<span><input class="text" type="text" name="username" pattern="/^[a-zA-Z0-9_]{3,30}$/" value="<?php echo isset($user['username'])?$user['username']:"";?>" /></span>
						</div>

						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>手机号：</span>
							<span><input class="text" type="text" name="mobile" pattern="mobile" value="<?php echo isset($user['mobile'])?$user['mobile']:"";?>" /></span>
						</div>

						<div class="zhxi_con">
							<span class="con_tit">邮箱：</span>
							<span><input class="text" type="text" name="email" empty pattern="email" value="<?php echo isset($user['email'])?$user['email']:"";?>" /></span>
						</div>

						<div class="zhxi_con">
							<span class="con_tit">密码：</span>
							<span><input class="text" type="password" name="password" empty bind="repassword" pattern="/^\S{6,20}$/" alt="6-20位非空字符" /></span>
						</div>

						<div class="zhxi_con">
							<span class="con_tit">重复密码：</span>
							<span><input class="text" type="password" name="repassword" empty bind="password"  pattern="/^\S{6,20}$/" alt="6-20位非空字符"  /></span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit">状态：</span>
							<span>
									<input type="radio" name="status" <?php if($user['status']==1){?>checked<?php }?> value="1"/>开启
									<input type="radio" name="status" <?php if($user['status']==0){?>checked<?php }?> value="0"/>关闭
							</span>
						</div>






						<div class="zhxi_con">
							<span><input class="submit" type="submit" value="保存"/></span>
						</div>
						<!--身份信息结束-->


					</div>
					<div class="zhxi_upimg">
						<div id="dd" class="up_img"><img name="file1" src="<?php if(isset($user['head_photo_thumb'])){?><?php echo isset($user['head_photo_thumb'])?$user['head_photo_thumb']:"";?><?php }else{?>http://localhost/nn2/user/public/views/pc/images/icon/wt.jpg<?php }?>"/></div>
						<div>
							<input type="file" name="file1" id="file1"  onchange="javascript:uploadImg(this);" />
							<input type="hidden" name="imgfile1" value="<?php echo isset($user['head_photo'])?$user['head_photo']:"";?>"/>
						</div>
					</div>
				</form>

					<div style="clear:both;"></div>
				</div>

			</div>


	<div class="user_r">
		<div class="wrap_con">
			<div class="tit clearfix">
				<h3>公告</h3>
			</div>
			<div class="con">
				<div class="con_medal clearfix">
					<ul>
						<li><a>暂无勋章</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	</div>

	</div>
</body>
</html>
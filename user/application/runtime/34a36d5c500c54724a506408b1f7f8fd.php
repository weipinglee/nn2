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
	<div class="user_body">
		<div class="user_b">
			<div class="user_l">
				<div class="left_navigation">
					<ul>
						<li class="let_nav_tit"><h3>账户管理</h3></li>
						<li><a href="http://localhost/nn2/user/public/ucenter/info" >基本信息</a></li>
						<li><a href="http://localhost/nn2/user/public/ucenter/password"class="cur">修改密码</a></li>
						<li><a href="zh_rez.html">资质认证</a></li>
					</ul>
				</div>
			</div>
			<div class="user_c">
				<div class="user_zhxi">
				<form method="post" action="http://localhost/nn2/user/public/ucenter/chgpass" >
					<div class="zhxi_tit">
						<p><a>账号管理</a>><a>修改密码</a></p>
					</div>
					<div style="float:left">

						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>原始密码：</span>
							<span><input class="text" type="password" pattern="/^\S{6,20}$/" alt="请输入原始密码" name="old_pass"/></span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>新密码：</span>
							<span><input class="text" type="password" pattern="/^\S{6,20}$/" alt="请输入新密码" name="new_pass"/></span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>确认新密码：</span>
							<span><input class="text" type="password" bind="new_pass" pattern="/^\S{6,20}$/" alt="请重复输入密码" name="new_repass"/></span>
						</div>
						
						<div class="zhxi_con">
							<span><input class="submit" type="submit" value="保存"/></span>
						</div>
					</div>
					<div style="clear:both;"></div>
				</form>
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
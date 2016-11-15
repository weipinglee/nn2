<!DOCTYPE html>
<html>
<head>
  <title>个人中心</title>
  <meta name="keywords"/>
  <meta name="description"/>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=EDGE">
  <link href="/nn2/user/public/views/pc/css/user_index.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="/nn2/user/public/js/jquery/jquery-1.7.2.min.js"></script>



  <script language="javascript" type="text/javascript" src="/nn2/user/public/views/pc/js/My97DatePicker/WdatePicker.js"></script>
  <script type="text/javascript" src="/nn2/user/public/views/pc/js/regular.js"></script>
   <script src="/nn2/user/public/views/pc/js/center.js" type="text/javascript"></script>
  <link href="/nn2/user/public/views/pc/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
   <!-- 头部控制 -->
  <link href="/nn2/user/public/views/pc/css/topnav20141027.css" rel="stylesheet" type="text/css">
  <script src="/nn2/user/public/views/pc/js/topnav20141027.js" type="text/javascript"></script>
    <!-- 头部控制 -->

    <script type="text/javascript" src="/nn2/user/public/js/form/validform.js" ></script>
    <script type="text/javascript" src="/nn2/user/public/js/form/formacc.js" ></script>
    <script type="text/javascript" src="/nn2/user/public/js/layer/layer.js"></script>
    <script type="text/javascript" src="/nn2/user/public/js/layer/extend/layer.ext.js"></script>

     <link href="/nn2/user/public/js/form/validate/error.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="/nn2/user/public/js/area/AreaData_min.js" ></script>
    <script type="text/javascript" src="/nn2/user/public/js/area/Area.js" ></script>

</head>
<body>
<!--    公用头部控件 -->
    <div class="bg_topnav">
    <div class="topnav_width">
        <div class="topnav_left">
            <div class="top_index">
                <img class="index_img" src="/nn2/user/public/views/pc/images/icon/icon_index.png"/>
                <a rel="external nofollow" href="http://deal.test.com/index/index" target="_blank" >耐耐网首页</a>
            </div>

            <div class="index_user">
            <?php if($username){?>
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
                   <a href="http://localhost/nn2/user/public/contract/buyerlist">我的合同</a><span class="line_l">|<span>
                </li>
                <?php }?>
                <li>
                    <a href="http://localhost/nn2/user/public/message/usermail">消息中心<em class="information"><?php echo isset($mess)?$mess:"";?></em></a><span class="line_l">|<span>
                </li>
                <!--<li>
                    <img class="iphon_img" src="/nn2/user/public/views/pc/images/icon/icon_iphon.png"/>
                    <a href="">手机版</a><span class="line_l">|<span>
                </li>-->
                <li>
                    <a href="javascript:;" onclick="javascript:window.open('http://b.qq.com/webc.htm?new=0&sid=4006238086&o=new.nainaiwang.com&q=7', '_blank', 'height=502, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');"  border="0" SRC=http://wpa.qq.com/pa?p=1:4006238086:1 alt="点击这里给我发消息">在线客服</a><span class="line_l">|<span>
                </li>
                <li style="padding-top:2px;">
                    <span>交易时间：09:00--17:50</span>
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
                <a href="http://deal.test.com/index/index" alt="返回耐耐首页"><img src="/nn2/user/public/views/pc/images/icon/nainaiwang.png"/></a></dd>
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
                                            <li><a  href="<?php echo isset($list['url'])?$list['url']:"";?>" <?php if($action==$list['action']){?>class="cur"<?php }?> ><?php echo isset($list['title'])?$list['title']:"";?></a></li>
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
                                    <img src="/nn2/user/public/views/pc/images/icon/head_portrait.jpg">
                                </a>
                            </div>
                            <div class="per_username">
                                <p class="username_p"><b>您好，<?php echo isset($username)?$username:"";?></b></p>
                                <p class="username_p"><!--<img src="<?php echo isset($group['icon'])?$group['icon']:"";?>">--><?php echo isset($group['group_name'])?$group['group_name']:"";?></p>
                                <p class="username_p">消息提醒：<a href="http://localhost/nn2/user/public/message/usermail"><b class="colaa0707"><?php echo isset($mess)?$mess:"";?></b></a></p>
                            </div>
                            <div class="per_function">
                                <a href="http://localhost/nn2/user/public/ucenter/baseinfo">基本信息设置</a>
                                <a href="http://localhost/nn2/user/public/ucenter/password">修改密码</a>
                            </div>

                        </div>
                    </div>
                <?php }?>
            </div>
            <!--end左侧导航-->
            <div id="cont">
                
			<!--start中间内容-->	
			<div class="user_c">
				<!--start代理账户提现-->
				<div class="user_zhxi">
				<form action="http://localhost/nn2/user/public/fund/zxtxhandle" method='post' auto_submit redirect_url="http://localhost/nn2/user/public/fund/zx">
					<input type="hidden" name="token" value="<?php echo isset($token)?$token:"";?>" />
					<div class="zhxi_tit">
						<p><a>资金管理</a>><a>签约账户管理</a>><a>提现</a>
						</p>
					</div>
					<div class="pay_cot">

						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>提现金额：</span>
							<span><input class="text" type="text" errormsg="金额填写错误" datatype="money" name="num"/></span>
							<span></span>
						</div>

						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>收款银行账号：</span>
							<span><input class="text" type="text" name="recvaccno"/></span>
						</div>

						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>收款银行账户名：</span>
							<span><input class="text" type="text" name="recvaccnm"/></span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>收款银行为中信银行：</span>
							<span>
								<input class="radio" type="radio" name="samebank" checked="checked" value='1'/>是
								<input class="radio" type="radio" name="samebank" value='0'/>否
							</span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit" style="display: block;width:100%;text-align:left;text-indent: 14em;"><i></i>以下为二选一：</span>
							<span></span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit"><i></i>收款账户开户行支付联行号：</span>
							<span><input class="text" type="text" name="recvtgfi"/></span>
						</div>

						<div class="zhxi_con">
							<span class="con_tit"><i></i>收款账户开户行名：</span>
							<span><input class="text" type="text" name="recvbanknm"/></span>
						</div>
						
						<div class="zhxi_con">
							<span><input class="submit" type="submit" value="提现"/></span>
						</div>
					</div>
				</form>
					<!-- <div class="zj_mx">
						<div class="mx_l">账户提现明细</div>
						<form action="http://localhost/nn2/user/public/fund/tx" method="GET" name="">
							<div class="mx_r">
								交易时间：<input class="Wdate" name="begin" type="text" value="<?php echo isset($cond['begin'])?$cond['begin']:"";?>" onClick="WdatePicker({dateFmt: 'yyyy-MM-dd HH:mm:ss'})">
								-
								<input class="Wdate" type="text" name="end" value="<?php echo isset($cond['end'])?$cond['end']:"";?>" onClick="WdatePicker({dateFmt: 'yyyy-MM-dd HH:mm:ss'})">
								交易号：<input type="text" value="<?php echo isset($cond['no'])?$cond['no']:"";?>" name="Sn">
								<select name="day" >
									<option value="7" <?php if($cond['day']==7){?>selected<?php }?>>一周内</option>
									<option value="30" <?php if($cond['day']==30){?>selected<?php }?>>一个月内</option>
									<option value="365" <?php if($cond['day']==365){?>selected<?php }?>>一年内</option>
								</select>
								<button type="submit" class="search_an">搜索</button>
							</div>
						</form>
					</div>
					<div class="jy_xq">
						<table cellpadding="0" cellspacing="0" style="margin:20px auto;width:725px;border-top:1px #dcdcdc solid;border-left: 1px #dcdcdc solid;text-align: center;">
							<tr>
								<th>交易号</th>
								<th>交易时间</th>
								<th>金额</th>
								<th>状态</th>
								<th>审核意见</th>
							</tr>
							<?php if(!empty($flow)) foreach($flow as $key => $item){?>
								<tr>

									<td><?php echo isset($item['request_no'])?$item['request_no']:"";?></td>
									<td><?php echo isset($item['create_time'])?$item['create_time']:"";?></td>
									<td><?php echo isset($item['amount'])?$item['amount']:"";?></td>
									<td><?php echo isset($item['status'])?$item['status']:"";?></td>
									<?php if( $item['first_time']!=null&&$item['final_time']==null){?>
									<td><?php echo isset($item['first_message'])?$item['first_message']:"";?></td>

									<?php }elseif( $item['first_time']!=null&&$item['final_time']!=null){?>
									<td><?php echo isset($item['final_message'])?$item['final_message']:"";?></td>
									<?php }else{?>
										<td></td>
									<?php }?>
								</tr>
							<?php }?>
							<tr>
								<td colspan="100"><div class="page_num"><?php echo isset($pageBar)?$pageBar:"";?></div></td>
							</tr>
						</table>

					</div> -->
				</div>


			</div>

			
	<!--end中间内容-->		
	
            </div>

				<!--end中间内容-->	
			<!--start右侧广告-->			
		<!--	<div class="user_r">
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
			</div>-->
			<!--end右侧广告-->
		</div>
	</div>
<script type="text/javascript">
    $(function() {
        $('.left_navigation ').find('.cur').parents('.btn1').find('.nav-first').trigger('click');
    })
</script>
</body>
</html>
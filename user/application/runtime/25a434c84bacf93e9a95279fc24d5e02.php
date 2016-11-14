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
                <script src="/nn2/user/public/views/pc/js/jquery.extend.js"></script>
<script src="/nn2/user/public/views/pc/js/passwordReset.js"></script>
<link href="/nn2/user/public/views/pc/css/center_top.css" rel="stylesheet" type="text/css" />
<!-- 基本信息css -->
<link href="/nn2/user/public/views/pc/css/center_date.css" rel="stylesheet" type="text/css" />
    <div class="right_c">
      <div class="r_c_title">
        <a class="tit_span">支付密码申诉找回</a>
      </div>
      <div class="rc_bate">
        <div class="jd_img">
          <img src="/nn2/user/public/views/pc/images/icon/icon_jd.jpg">
          <div class="jd_ts">
            <img src="/nn2/user/public/views/pc/images/icon/icon_ts.jpg"/>
            <span>请确保手机通畅，以便于我们与您联系，并接收申诉结果。</span>
          </div>
        </div>

          <div class="bate-input clear">
            <span class="span_in_tit">
              手机号：
            </span>
            <span class="input_span"><?php echo isset($info['mobile'])?$info['mobile']:"";?></span>
          </div>
          <div class="bate-input clear">
            <span class="span_in_tit">
              验证码：
            </span>
            <div class="input_span">
              <input id="inputCode" placeholder="请输入验证码" type="text" id="inputCode" class="gradient wbk">
              <!-- <span id="code" class="mycode" style="overflow: hidden;"> -->
                <img id="image"src="http://localhost/nn2/user/public/login/getcaptcha" onclick="this.src='http://localhost/nn2/user/public/login/getcaptcha?'+Math.random()"/>
              <!-- </span> -->

              <!-- <input type="button" class="yzm_submit" value="确定" id="submit"> -->
            </div>
          </div>
          <div class="bate-input clear">
            <span class="span_in_tit">
              短信验证码：
            </span>
            <span class="input_span">
              <input type="text" id="txtCode" class="infos wbk" placeholder="请输入验证码"/>
              <input class="send1"  type="button" value="获取验证码" id="yzmBtn"/></span>
          </div>
          <div class="bate-input clear">
          <input type="hidden" class="text1" id="txtMobile" name="mobile" value="<?php echo isset($info['mobile'])?$info['mobile']:"";?>"> 
           <input type='hidden' value='http://localhost/nn2/user/public/ucenter/checkpaymobilecode' id='findUrl'>
           <input type='hidden' value='http://localhost/nn2/user/public/ucenter/getmobilecode' id='codeUrl'>
          <input type="hidden" name="uid" id="uid" value="<?php echo isset($info['id'])?$info['id']:"";?>">
            <div class="but_div"><a class="but_in" id="btnSubmit" href=#"/>下一步</a></div>
          </div>
      </div>
    </div>

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
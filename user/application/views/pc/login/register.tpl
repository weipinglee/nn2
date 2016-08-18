<!DOCTYPE html>
<html>
<head>
  <title>注册</title>
  <meta name="keywords"/>
  <meta name="description"/>
  <meta charset="utf-8">
  <link href="{views:css/password_new.css}" rel="stylesheet">
  <link href="{views:css/reg.css}" rel="stylesheet" type="text/css" />
  <link href="{views:css/city.css}" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="{root:js/jquery/jquery-1.7.2.min.js}"></script>
  <script type="text/javascript" src="{views:js/reg.js}"></script>
  <script type="text/javascript" src="{root:js/area/Area.js}" ></script>
  <script type="text/javascript" src="{root:js/area/AreaData_min.js}" ></script>
    <script type="text/javascript" src="{root:js/form/formacc.js}" ></script>
  <script type="text/javascript" src="{root:js/form/validform.js}" ></script>
    <script type="text/javascript" src="{root:js/layer/layer.js}"></script>
    <script type="text/javascript" src="{views:js/common.js}"></script>
</head>
<body>


<div class="wrap">
  <div class="login_top">
    <ul class="w1200">
      <ul class="topnav_left">
        <li><a href="index.html"><img class="shouy icon" src="{views:images/password/shouy.png}">耐耐网首页</a></li>
        <li class="space">您好，欢迎进入耐耐网</li>
        <li><a href="{url:/login/login}">请登录</a></li>
        <li>欢迎注册</li>
      </ul>
      <ul class="topnav_right">
        <!-- <li><a href="">会员中心</a><i>|</i></li>
        <li><a href="">我的合同</a><i>|</i></li> -->
        <li><a href="">消息中心</a><i>|</i></li>
        <li><a href=""><img class="shouy icon" src="{views:images/password/mobile.png}">手机版</a><i>|</i></li>
        <li><a href="">在线客服</a><i>|</i></li>
        <li>交易时间&nbsp;09:00-18:00</li>
     </ul>  
    </ul>
</div>
   <div class="toplog_bor">
    <div class="m_log w1200">
        <div class="logoimg_left">
            <div class="img_box"><img class="shouy" src="{views:images/password/logo.png}" id="btnImg"></div>
            <div class="word_box">欢迎注册</div>
        </div>
         <div class="logoimg_right">
            <img class="shouy" src="{views:images/password/iphone.png}"> 
            <h3>服务热线：<b>400-6238-086</b></h3>
         </div>
        
    </div>
   </div> 

  <!-- <div class="banner-show" id="js_ban_content">
    <div class="cell bns-01">
      <div class="con"> </div>
    </div>
  </div> -->
  <div>
   <span style="display:none;"> {url:/login/doReg} </span>
    <div class="register"> 
      <div class="beinit">
        <span>已有账号?</span><a href="{url:/login/login}">立即登录</a>
      </div>
      <div class="reg_top">
      <div class="register_top">
          <div class="reg_zc register_l border_bom">个人注册<img class="show_gr" src="{views:images/password/sanj.png}" alt=""></div>
          
          <div class="reg_zc register_r">企业注册<img class="hide_qy" style="display:none;" src="{views:images/password/sanj.png}" alt=""></div>
      </div>
      </div>
    <script>
    $(function(){
      $(".register_l").click(function(){ 
          $(".hide_qy").hide();
          $(".show_gr").show();
          $(".secondaryend").css({"bottom": "0px"});
          $(".background_img.bottom").css({"bottom": "58px"});
      });
      $(".register_r").click(function(){
          $(".show_gr").hide();
          $(".hide_qy").show();
          $(".secondaryend").css({"bottom": "-312px"});
          $(".background_img.bottom").css({"bottom": "-252px"});
      })
    })

    //验证码验证地址
    var captchaCheckUrl = '{url:/login/captchaCheck}';
    //发送短信地址
    var sendMessageUrl = '{url:/login/sendMessage}';
    </script>
      <!--个人注册-->
      <div class="reg_cot gr_reg">
        <input name="checkUrl" value="{url:/login/checkIsOne}" type="hidden" />
        <form action="{url:/login/doReg}" method="post" auto_submit redirect_url="{url:/ucenter/baseinfo}">
          <input type="hidden" name="type" value="0"/>
          <div class="cot">
            <span class="cot_tit">用户名：</span>
            <span><input class="text" type="text" name="username" datatype="/^[a-zA-Z0-9_]{3,30}$/" nullmsg="请填写用户名" errormsg="请使用3-30位字母数字下划线的组合"/></span>
            <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">密码：</span>
            <span><input class="text" type="password" name="password" datatype="/^[\S]{6,15}$/" nullmsg="请填写密码" errormsg="请使用6-15位字符" /><a href=""><img class="show_eye" src="{views:images/password/eye.png}" alt=""></a></span>
              <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">确认密码：</span>
            <span><input class="text" type="password" name="repassword" datatype="*" recheck="password" nullmsg="请重复填写密码" errormsg="两次密码输入不一致" /><a href=""><img class="show_eye" src="{views:images/password/eye.png}" alt=""></a></span>
              <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">手机号：</span>
            <span><input class="text" type="text" name="mobile" maxlength="11" datatype="mobile" nullmsg="请填写手机号" errormsg="手机号格式错误"/></span>
              <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">验证码：</span>
            <span><input class="text" style="width: 50px;" type="text" name="captcha" maxlength="4"/></span>
              <a class='chgCode' href="javascript:void(0)" onclick="changeCaptcha('{url:/login/getCaptcha}?w=200&h=50',$(this).find('img'))"><img src="{url:/login/getCaptcha}?w=200&h=50" /></a>
              <span></span>
          </div>
           <div class="cot">
            <span class="cot_tit">校验码：</span>
            <span><input style="width:122px;" class="text" type="text" name="validPhoneCode"/> <a class="jiaoyma">获取校验码</a><span></span> </span>
              <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">邮箱：</span>
            <span><input class="text" type="text" name="email"  datatype="e" errormsg="邮箱格式错误"/></span>
              <span></span>
          </div>
           
           <div class="form-agreen">
                    <div><input type="checkbox" name="agreen" checked="">我已阅读并同意<a href="javascript:;" id="protocol">《耐耐网网站用户协议》</a> </div>
                    <div class="input-tip">
                        <span></span>
                    </div>
                </div>

           <div class="cot">
            <span class="zc"><input class="but" type="submit"value="注&nbsp;&nbsp;册"/></span>
          </div>
        </form>
      </div>
       <!--个人注册结束-->
        <!--企业注册-->
      <div class="reg_cot qy_reg">
        <form action="{url:/login/doReg}" method="post" auto_submit redirect_url="{url:/ucenter/baseinfo}" >
          <input type="hidden" name="type" value="1"/>
         <div class="cot">
            <span class="cot_tit">用户名：</span>
            <span><input class="text" type="text" name="username" callback="checkUser" nullmsg="请填写用户名"  datatype="/^[a-zA-Z0-9_]{3,30}$/" errormsg="请填写3-30位英文字母、数字" /></span>
            <span></span>
		  </div>
          <div class="cot">
            <span class="cot_tit">密码：</span>
            <span><input class="text" type="password" name="password" datatype="/^\S{6,15}$/" nullmsg='请输入密码' errormsg="6-15位非空字符"  /><a href=""><img class="show_eye" src="{views:images/password/eye.png}" alt=""></a></span>
            <span></span>
		  </div>
          <div class="cot">
            <span class="cot_tit">确认密码：</span>
            <span><input class="text" type="password" name="repassword" datatype="*" nullmsg="请确认密码" errormsg="两次密码输入不一致" recheck="password" /><a href=""><img class="show_eye" src="{views:images/password/eye.png}" alt=""></a></span>
			<span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">手机号：</span>
            <span><input class="text" type="text" name="mobile"  datatype="mobile" nullmsg="请输入手机号" errormsg="请正确填写手机号" /></span>
			<span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">验证码：</span>
            <span><input class="text" style="width: 50px;" type="text" name="captcha" maxlength="4"/></span>
              <a class='chgCode' href="javascript:void(0)" onclick="changeCaptcha('{url:/login/getCaptcha}?w=200&h=50',$(this).find('img'))"><img src="{url:/login/getCaptcha}?w=200&h=50" /></a>
              <span></span>
          </div>
           <div class="cot">
            <span class="cot_tit">校验码：</span>
            <span><input style="width:122px;" class="text" type="text" name="validPhoneCode"/> <a  class="jiaoyma">获取校验码</a><span></span> </span>
              <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">邮箱：</span>
            <span><input class="text" type="text" name="email"  datatype="e" errormsg="邮箱格式错误" nullmsg="请填写邮箱" /></span>
			<span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">公司名称：</span>
            <span><input class="text" type="text" name="company_name"  datatype="s2-20" errormsg="请填写公司名称" nullmsg="请填写邮箱" /></span>
			<span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">公司地址：</span>
            <div >
              <span>{area:  inputName=area pattern=area }</span>
                <span></span>
            </div>
          </div>

          <div class="cot">
            <span class="cot_tit">法人：</span>
            <span><input class="text" type="text" name="legal_person" datatype="s2-20" errormsg="请填写法人名称" nullmsg="请填写法人名称"/></span>
			<span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">注册资金：</span>
            <span>
              <input class="text" type="text" name="reg_fund" datatype="float" nullmsg="请正确填写注册资金" errormsg="请正确填写注册资金" placeholder="万"/>
           </span>
		   <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">企业类型：</span>
            <span> 
              <select class="select sel_d" name="category" datatype="/[1-9]\d{0,}/" nullmsg="请选择企业类型" errormsg="请选择企业类型">
              <option value="0">请选择...</option>
                  {foreach:items=$comtype}
                      <option value="{$item['id']}">{$item['name']}</option>
                  {/foreach}
             </select>
           </span>
		   <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">企业性质：</span>
            <span> 
              <select class="select sel_d" name="nature" datatype="/^[1-9]\d{0,}$/" nullmsg="请选择企业性质" errormsg="选择企业性质">
                  <option value="0">请选择...</option>
                  {foreach:items=$comNature}
                    <option value="{$key}">{$item}</option>
                  {/foreach}
             </select>
           </span>
		   <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">联系人：</span>
            <span><input class="text" type="text" name="contact" datatype="zh2-20" errormsg="请填写联系人姓名" /></span>
			<span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">联系电话：</span>
            <span><input class="text" type="text" name="contact_phone" datatype="m" nullmsg="请填写联系人电话 " errormsg="请正确填写联系人电话"/></span>
			<span></span>
          </div>
         
           <div class="form-agreen">
                    <div><input type="checkbox" name="agreen" checked="">我已阅读并同意<a href="javascript:;" id="protocol">《耐耐网网站用户协议》</a> </div>
                    <div class="input-tip">
                        <span></span>
                    </div>
                </div>
        

           <div class="cot">
            <span class="zc"><input class="but" type="submit" value="注&nbsp;&nbsp;册"/></span>
          </div>
        </form>
      </div>
       <!--企业注册结束-->
    </div>
  </div>
  <div style=" clear:both"></div>
</div>
<script type="text/javascript">

    $(function(){
        var validObj = formacc;

        //为地址选择框添加验证规则
        var rules = [{
            ele:"input[name=area]",
            datatype:"n4-6",
            nullmsg:"请选择地址！",
            errormsg:"请选择地址！"
        }];
        validObj.addRule(rules);

    })
</script>
<div class="background_img bottom"></div>
    <div class="w1200 secondaryend">
    <p>Copyright 2014-2016 耐耐云商科技有限公司 www.nainaiwang.cn All Rights Reserved </p>
    <p>
        <a href="#" target="_blank" style="color: #666666;">沪ICP备15028925号</a>
        <a href="#" target="_blank" style="color: #006aa8;">ICP许可证</a>
    </p>
</div>
</body>
</html>

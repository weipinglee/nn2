<!DOCTYPE html>
<html>
<head>
  <title>耐耐网</title>
  <meta http-equiv = "X-UA-Compatible" content = "IE=edge,chrome=1" />
  <meta name="keywords"/>
  <meta name="description"/>
  <meta charset="utf-8">
  
</head>
<body>
  <div class="login_top">
    <ul class="w1200">
      <ul class="topnav_left">
        <li><a href="/index/index"><img class="shouy" src="/nn2/user/views/pc/images/password/shouy.png"><span class="inde_txt">耐耐网首页</span></a></li>
        <li class="space">您好，欢迎进入耐耐网</li>
        <li><a href="http://localhost/nn2/user/login/login">请登录</a></li>
        <li><a href="http://localhost/nn2/user/login/register">欢迎注册</a></li>
      </ul>
      <ul class="topnav_right">
        <!--<li><a href="">会员中心</a><i>|</i></li>
        <li><a href="">我的合同</a><i>|</i></li>
        <li><a href="">消息中心</a><i>|</i></li>
        <li><a href=""><img class="shouy icon" src="/nn2/user/views/pc/images/password/mobile.png">手机版</a><i>|</i></li>-->
        <li><a href="javascript:;" onclick="javascript:window.open('http://b.qq.com/webc.htm?new=0&sid=4006238086&o=new.nainaiwang.com&q=7', '_blank', 'height=502, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');"  border="0" SRC=http://wpa.qq.com/pa?p=1:4006238086:1 alt="点击这里给我发消息">在线客服</a><i>|</i></li>
        <li>交易时间&nbsp;09:00-17:30</li>
     </ul>  
    </ul>
</div>            
    <link href="/nn2/user/views/pc/css/password_new.css" rel="stylesheet">
    <script src="/nn2/user/views/pc/js/jquery-1.8.0.min.js"></script>
    <script src="/nn2/user/views/pc/js/jquery.extend.js"></script>
    <script src="/nn2/user/views/pc/js/pub_js.js"></script>
    <script src="/nn2/user/views/pc/js/passwordReset.js"></script>
    <script type="text/javascript">

        $(function () {
            $("#btnImg").click(function () {
                window.location = $("#txtUrl").val();
            });
        })
    </script>

   <div class="toplog_bor none">
    <div class="m_log w1200">
        <div class="logoimg_left">
            <div class="img_box"><img class="shouy" src="/nn2/user/views/pc/images/password/logo.png" id="btnImg"></div>
            <div class="word_box">找回密码</div>

  

        </div>
         <div class="logoimg_right">
            <img class="shouy" src="/nn2/user/views/pc/images/password/iphone.png"> 
            <h3>服务热线：<b>400-6238-086</b></h3>
         </div>
        
    </div>
   </div> 
  <div class="zhaohui">
        <div class="w1200">
           <div class="step_box">
            <div><img class="" src="/nn2/user/views/pc/images/password/one_r.png"><p>验证手机号</p></div>
            <div><img class="" src="/nn2/user/views/pc/images/password/two_g.png"><p>重置密码</p></div>
            <div><img class="" src="/nn2/user/views/pc/images/password/three_g.png"><p>修改成功</p></div>
           </div>
            <input type="hidden" value="http://localhost/nn2/user/login/login" name="url" id="txtUrl">
            <input type='hidden' value='http://localhost/nn2/user/login/getmobilecode' id='codeUrl'>
            <input type='hidden' value='http://localhost/nn2/user/login/checkmobilecode' id='findUrl'>
            <input type='hidden' value='http://localhost/nn2/user/login/getuserinfo' id='getUrl'>
<form action="http://localhost/nn2/user/login/checkmobilecode" method="post" id="647727080" auto_submit >                <ul>
                    <li><span class="error red"><span class="field-validation-valid" data-valmsg-for="txtMessage" data-valmsg-replace="true" id="txtMessage"></span></span></li>
                    <li>
                        <label>手机号：</label><input type="text" class="text1" id="txtMobile" name="mobile"> 
                    </li>
                     <li>
                        <label class="yanzm">验证码：</label><input type="text" class="text1 text1_yzm" id="inputCode" placeholder="请输入验证码"  name="inputCode">
                        <img id="image"src="http://localhost/nn2/user/login/getcaptcha" onclick="this.src='http://localhost/nn2/user/login/getcaptcha?'+Math.random()"/>
                    </li>
                    <li>
                        <label>校验码：</label><input type="text" class=" text1 text1_yzm" id="txtCode" name="code"> <input  id="yzmBtn" type="button" value="获取校验码" class="yzm"> 
                    </li>
                   

                    <input type="hidden" name="uid" id="uid" value="">


                    <li><input type="button" value="下一步" class="tj_btn" id="btnSubmit"></li>
                    
                </ul>
</form>        </div>
    </div>

<!--公用底部控件 开始-->
<div class="background_img bottom"></div>
    <div class="w1200 secondaryend">
    <p>Copyright&nbsp;&nbsp; © 2000-2016&nbsp;&nbsp;耐耐云商科技有限公司&nbsp;版权所有&nbsp;&nbsp;网站备案/许可证号：沪ICP备15028925号</p>
    <p>服务电话：4006238086&nbsp;地址：上海浦东新区唐镇上丰路977号B座</p>
    <p>
        增值电信业务经营许可证沪B2-20150196
        <!-- <a href="#" target="_blank" style="color: #666666;">沪ICP备15028925号</a>
        <a href="#" target="_blank" style="color: #006aa8;">ICP许可证</a> -->
    </p>
</div>
</body>
</html>
<!DOCTYPE html>
<!-- saved from url=(0070)http://sso.nainaiwang.cn/PasswordReset/Index?ReturnUrl=http://www.nainaiwang.cn/ -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>耐耐网-找回密码</title>
    <link href="{views:css/password_new.css}" rel="stylesheet">
    <script src="{views:js/jquery-1.8.0.min.js}"></script>
    <script src="{views:js/jquery.extend.js}"></script>
    <script src="{views:js/pub_js.js}"></script>
    <script src="{views:js/passwordReset.js}"></script>
    <script type="text/javascript">

        $(function () {
            $("#btnImg").click(function () {
                window.location = $("#txtUrl").val();
            });
            $("#login").click(function () {
                window.location = $("#txtUrl").val();
            });
        })
    </script>
</head>
<body>
    <div class="login_top">
    <ul class="w1200">
      <ul class="topnav_left">
        <li><a href="index.html"><img class="shouy" src="{views:images/password/shouy.png}">耐耐网首页</a></li>
        <li class="space">您好，欢迎进入耐耐网</li>
        <li><a href="">请登录</a></li>
        <li><a href="">欢迎注册</a></li>
      </ul>
      <ul class="topnav_right">
        <li><a href="">会员中心</a><i>|</i></li>
        <li><a href="">我的合同</a><i>|</i></li>
        <li><a href="">消息中心</a><i>|</i></li>
        <li><a href=""><img class="shouy" src="{views:images/password/mobile.png}">手机版</a><i>|</i></li>
        <li><a href="">在线客服</a><i>|</i></li>
        <li>交易时间&nbsp;09:00-18:00</li>
     </ul>  
    </ul>
</div>
   <div class="toplog_bor">
    <div class="m_log w1200">
        <div class="logoimg_left">
            <div class="img_box"><img class="shouy" src="{views:images/password/logo.png}" id="btnImg"></div>
            <div class="word_box"><a href="">找回密码</a></div>
        </div>
         <div class="logoimg_right">
            <img class="shouy" src="{views:images/password/iphone.png}"> 
            <h3>服务热线：<b>400-6238-086</b></h3>
         </div>
        
    </div>
   </div> 

    <div class="zhaohui">
        <div class="w1200">
           <div class="step_box">
            <div><img class="" src="{views:images/password/one_q.png}"><p>验证手机号</p></div>
            <div><img class="" src="{views:images/password/two_q.png}"><p>重置密码</p></div>
            <div><img class="" src="{views:images/password/three_r.png}"><p>修改成功</p></div>
           </div>
            <input type="hidden" value="{url:/login/login}" name="url" id="txtUrl">      
               <ul class="mar_top">
                    <li><span class="error red"><span class="field-validation-valid" data-valmsg-for="txtMessage" data-valmsg-replace="true" id="txtMessage"></span></span></li>
                    <li><h3>恭喜您，新密码设置成功！</h3></li>


                    <li><input type="button" value="立即登录" class="tj_btn success" id="login"></li>
                </ul> </div>
    </div>
    <div class="background_img"></div>
    <div class="w1200 secondaryend">
    <p>Copyright 2014-2016 耐耐云商科技有限公司 www.nainaiwang.cn All Rights Reserved </p>
    <p>
        <a href="#" target="_blank" style="color: #666666;">沪ICP备15028925号</a>
        <a href="#" target="_blank" style="color: #006aa8;">ICP许可证</a>
    </p>
</div>


</body></html>
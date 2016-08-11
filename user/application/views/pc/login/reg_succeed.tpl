<!DOCTYPE html>
<html>
<head>
  <title>注册成功</title>
  <meta name="keywords"/>
  <meta name="description"/>
  <meta charset="utf-8">
  <link href="{views:css/password_new.css}" rel="stylesheet">
  <link href="{views:css/home.css?v=2}" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="{root:js/jquery/jquery-1.7.2.min.js}"></script>
  <script type="text/javascript" src="{views:js/login.js}"></script>
  <script type="text/javascript" src="{views:js/common.js}"></script>
</head>
<body>
<script type="text/javascript" >
  var logPath = '{url:/login/doLog}';
</script>

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
            <div class="word_box"><a href="">欢迎登录</a></div>
        </div>
         <div class="logoimg_right">
            <img class="shouy" src="{views:images/password/iphone.png}"> 
            <h3>服务热线：<b>400-6238-086</b></h3>
         </div>
        
    </div>
   </div> 


<div class="wrap">
  
 <div  class="bacg_img succeed"> 
  

    <div class="happy_img">
      <img class="" src="{views:images/password/succeed.png}"> 
      <p class="big_word">恭喜您已注册成功！</p>
      <p>为了您更好的交易，请及时进行认证</p>
    </div>
    <div class="two_btn">
      <a class="reging" href="">进行认证</a>
      <a class="faleindex" href="">回到首页</a>
    </div>

    
 
  </div>
</div>
<div class="w1200 secondaryend">
    <p>Copyright 2014-2016 耐耐云商科技有限公司 www.nainaiwang.cn All Rights Reserved </p>
    <p>
        <a href="#" target="_blank" style="color: #666666;">沪ICP备15028925号</a>
        <a href="#" target="_blank" style="color: #006aa8;">ICP许可证</a>
    </p>
</div>
<script type="text/javascript">
  $(function(){
    document.onkeydown=function(event){
      e = event ? event :(window.event ? window.event : null);
      if(e.keyCode==13){
        double_submit();
      }
    }
  })
</script>
</body>
</html>

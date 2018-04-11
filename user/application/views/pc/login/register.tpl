
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
   <span style="display:none;"> {url:/login/doReg} </span>

   <div class="toplog_bor none">
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

   <div class="regis_boxs">

    <div class="register"> 
      <div class="beinit">
        <span>已有账号?</span><a href="{url:/login/login}">立即登录</a>
      </div>
      <div class="reg_top">
      <div class="register_top">
          <div class="reg_zc register_r">会员注册</div>
      </div>
      </div>
    <script>

    //发送短信地址
    var sendMessageUrl = '{url:/login/sendMessage}';
    </script>
        <!--注册-->
      <div class="reg_cot qy_reg">
          <input name="checkUrl" value="{url:/login/checkisone@user}" type="hidden" />

          <form action="{url:/login/doReg}" method="post" auto_submit redirect_url="{url:/login/regsucced}">

          <div class="cot">
            <span class="cot_tit">用户名：</span>
            <span><input class="text" type="text" name="username" nullmsg="请填写用户名"  datatype="/^[a-zA-Z0-9_]{3,30}$/" errormsg="请填写3-30位英文字母、数字" /></span>
            <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">密码：</span>
            <span><input class="text" type="password" name="password" datatype="/^\S{6,15}$/" nullmsg='请输入密码' errormsg="6-15位非空字符" /><a alt="0" class="pwd"><img class="show_eye" src="{views:images/password/eye.png}" ></a></span>
              <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">确认密码：</span>
            <span><input class="text" type="password" name="repassword" datatype="*" nullmsg="请确认密码" errormsg="两次密码输入不一致" recheck="password" /><a alt="0" class="pwd"><img class="show_eye" src="{views:images/password/eye.png}" ></a></span>
              <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">手机号：</span>
            <span><input class="text" type="text" name="mobile" maxlength="11" datatype="mobile" nullmsg="请输入手机号" errormsg="请正确填写手机号"/></span>
              <span></span>
          </div>

           <div class="cot">
            <span class="cot_tit">校验码：</span>
            <span><input style="width:122px;" class="text" type="text" name="validPhoneCode" maxlength="6" datatype="zip" nullmsg="请填写校验码" errormsg="校验码格式不正确"/> <a class="jiaoyma">获取校验码</a><span></span> </span>
              <span></span>
          </div>
           <div class="form-agreen">
                    <div><input type="checkbox" name="agent" value="1" checked="">我已阅读并同意<a href="{url:/login/agreement}" target="_bank" id="protocol">《耐耐网网站用户协议》</a> </div>
                    <div class="input-tip">
                        <span></span>
                    </div>
                </div>

           <div class="cot">
            <span class="zc"><input class="but" type="submit"value="注&nbsp;&nbsp;册"/></span>
          </div>
        </form>
       
      </div>
       <!--注册结束-->
    </div>
   <div>

  </div>
  <div style=" clear:both"></div>
</div>



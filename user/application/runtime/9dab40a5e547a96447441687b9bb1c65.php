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
  <link href="/nn2/user/views/pc/css/reg.css" rel="stylesheet" type="text/css" />
  <link href="/nn2/user/views/pc/css/city.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="/nn2/user/js/jquery/jquery-1.7.2.min.js"></script>
  <script type="text/javascript" src="/nn2/user/views/pc/js/reg.js"></script>
  <script type="text/javascript" src="/nn2/user/js/area/Area.js" ></script>
  <script type="text/javascript" src="/nn2/user/js/area/AreaData_min.js" ></script>
    <script type="text/javascript" src="/nn2/user/js/form/formacc.js" ></script>
  <script type="text/javascript" src="/nn2/user/js/form/validform.js" ></script>
    <script type="text/javascript" src="/nn2/user/js/layer/layer.js"></script>
    <script type="text/javascript" src="/nn2/user/views/pc/js/common.js"></script>
   <span style="display:none;"> http://localhost/nn2/user/login/doreg </span>

   <div class="toplog_bor none">
    <div class="m_log w1200">
        <div class="logoimg_left">
            <div class="img_box"><img class="shouy" src="/nn2/user/views/pc/images/password/logo.png" id="btnImg"></div>
            <div class="word_box">欢迎注册</div>

  

        </div>
         <div class="logoimg_right">
            <img class="shouy" src="/nn2/user/views/pc/images/password/iphone.png"> 
            <h3>服务热线：<b>400-6238-086</b></h3>
         </div>
        
    </div>
   </div> 

   <div class="regis_boxs">

    <div class="register"> 
      <div class="beinit">
        <span>已有账号?</span><a href="http://localhost/nn2/user/login/login">立即登录</a>
      </div>
      <div class="reg_top">
      <div class="register_top">
          <div class="reg_zc register_l border_bom">企业注册<img class="show_gr" src="/nn2/user/views/pc/images/password/sanj.png" alt=""></div>
          
          <div class="reg_zc register_r">个人注册<img class="hide_qy" style="display:none;" src="/nn2/user/views/pc/images/password/sanj.png" alt=""></div>
      </div>
      </div>
    <script>

    //发送短信地址
    var sendMessageUrl = 'http://localhost/nn2/user/login/sendmessage';
    </script>
      <!--企业注册-->
      <div class="reg_cot gr_reg">
        <input name="checkUrl" value="http://localhost/nn2/user/login/checkisone" type="hidden" />
        <form action="http://localhost/nn2/user/login/doreg" method="post" auto_submit redirect_url="http://localhost/nn2/user/login/regsucced" >
          <input type="hidden" name="type" value="1"/>
         <div class="cot">
            <span class="cot_tit">用户名：</span>
            <span><input class="text" type="text" name="username" callback="checkUser" nullmsg="请填写用户名"  datatype="/^[a-zA-Z0-9_]{3,30}$/" errormsg="请填写3-30位英文字母、数字" /></span>
            <span></span>
		  </div>
          <div class="cot">
            <span class="cot_tit">密码：</span>
            <span><input class="text" type="password" name="password" datatype="/^\S{6,15}$/" nullmsg='请输入密码' errormsg="6-15位非空字符"  /><a alt="0" class="pwd"><img class="show_eye" src="/nn2/user/views/pc/images/password/eye.png" ></a></span>
            <span></span>
		  </div>
          <div class="cot">
            <span class="cot_tit">确认密码：</span>
            <span><input class="text" type="password" name="repassword" datatype="*" nullmsg="请确认密码" errormsg="两次密码输入不一致" recheck="password" /><a alt="0" class="pwd"><img class="show_eye" src="/nn2/user/views/pc/images/password/eye.png" ></a></span>
			<span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">手机号：</span>
            <span><input class="text" type="text" name="mobile"  datatype="mobile" nullmsg="请输入手机号" errormsg="请正确填写手机号" /></span>
			<span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">验证码：</span>

            <span><input class="text" style="width: 122px;display:block;float:left;margin-right: 4px; " type="text" name="captcha" maxlength="4" datatype="*" nullmsg="请填写验证码" errormsg="验证码格式错误"/></span>
              <a class='chgCode' href="javascript:void(0)" onclick="changeCaptcha('http://localhost/nn2/user/login/getcaptcha?w=200&h=50',$(this).find('img'))"><img style="float:left;" src="http://localhost/nn2/user/login/getcaptcha?w=200&h=50" /></a>

              <span></span>
          </div>
           <div class="cot">
            <span class="cot_tit">校验码：</span>
            <span><input style="width:122px;" class="text" type="text" name="validPhoneCode" maxlength="6" datatype="zip" nullmsg="请填写校验码" errormsg="校验码格式不正确"/> <a  class="jiaoyma">获取校验码</a><span></span> </span>
              <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">邮箱：</span>
            <span><input class="text" type="text" name="email"  datatype="e" errormsg="邮箱格式错误" nullmsg="请填写邮箱" /></span>
			<span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">公司名称：</span>
            <span><input class="text" type="text" name="company_name"  datatype="s2-20" errormsg="请填写公司名称" nullmsg="请填写公司名称" /></span>
			<span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">公司地址：</span>
            <div >
              <span>                <script type="text/javascript">
                 areaObj = new Area();

                  $(function () {
                     areaObj.initComplexArea('seachprov', 'seachcity', 'seachdistrict', '','area');
                  });
                </script>
			 <select  id="seachprov"  onchange=" areaObj.changeComplexProvince(this.value, 'seachcity', 'seachdistrict');">
              </select>&nbsp;&nbsp;
              <select  id="seachcity"  onchange=" areaObj.changeCity(this.value,'seachdistrict','seachdistrict');">
              </select>&nbsp;&nbsp;<span id='seachdistrict_div' >
               <select   id="seachdistrict"  onchange=" areaObj.changeDistrict(this.value);">
               </select></span>
               <input type="hidden"  name="area" area alt="" value='' />
                <span></span></span>
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
                  <?php if(!empty($comtype)) foreach($comtype as $key => $item){?>
                      <option value="<?php echo isset($item['id'])?$item['id']:"";?>"><?php echo isset($item['name'])?$item['name']:"";?></option>
                  <?php }?>
             </select>
           </span>
		   <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">企业性质：</span>
            <span> 
              <select class="select sel_d" name="nature" datatype="/^[1-9]\d{0,}$/" nullmsg="请选择企业性质" errormsg="选择企业性质">
                  <option value="0">请选择...</option>
                  <?php if(!empty($comNature)) foreach($comNature as $key => $item){?>
                    <option value="<?php echo isset($key)?$key:"";?>"><?php echo isset($item)?$item:"";?></option>
                  <?php }?>
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
            <span><input class="text" type="text" name="contact_phone" datatype="mobile" nullmsg="请填写联系人电话 " errormsg="请正确填写联系人电话"/></span>
			<span></span>
          </div>
         
           <div class="form-agreen">
                    <div><input type="checkbox" name="agent" value="1"  checked="">我已阅读并同意<a href="http://localhost/nn2/user/login/agreement" target="_bank" id="protocol">《耐耐网网站用户协议》</a> </div>
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
        <!--个人注册-->
      <div class="reg_cot qy_reg">
	   <form action="http://localhost/nn2/user/login/doreg" method="post" auto_submit redirect_url="http://localhost/nn2/user/login/regsucced">
          <input type="hidden" name="type" value="0"/>
          <div class="cot">
            <span class="cot_tit">用户名：</span>
            <span><input class="text" type="text" name="username" nullmsg="请填写用户名"  datatype="/^[a-zA-Z0-9_]{3,30}$/" errormsg="请填写3-30位英文字母、数字" /></span>
            <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">密码：</span>
            <span><input class="text" type="password" name="password" datatype="/^\S{6,15}$/" nullmsg='请输入密码' errormsg="6-15位非空字符" /><a alt="0" class="pwd"><img class="show_eye" src="/nn2/user/views/pc/images/password/eye.png" ></a></span>
              <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">确认密码：</span>
            <span><input class="text" type="password" name="repassword" datatype="*" nullmsg="请确认密码" errormsg="两次密码输入不一致" recheck="password" /><a alt="0" class="pwd"><img class="show_eye" src="/nn2/user/views/pc/images/password/eye.png" ></a></span>
              <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">手机号：</span>
            <span><input class="text" type="text" name="mobile" maxlength="11" datatype="mobile" nullmsg="请输入手机号" errormsg="请正确填写手机号"/></span>
              <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">验证码：</span>

            <span><input class="text" style="width: 122px;" type="text" name="captcha" maxlength="4"/></span>
              <a class='chgCode' href="javascript:void(0)" onclick="changeCaptcha('http://localhost/nn2/user/login/getcaptcha?w=200&h=50',$(this).find('img'))"><img src="http://localhost/nn2/user/login/getcaptcha?w=200&h=50" /></a>
              <span></span>
          </div>
           <div class="cot">
            <span class="cot_tit">校验码：</span>
            <span><input style="width:122px;" class="text" type="text" name="validPhoneCode" maxlength="6" datatype="zip" nullmsg="请填写校验码" errormsg="校验码格式不正确"/> <a class="jiaoyma">获取校验码</a><span></span> </span>
              <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit">邮箱：</span>
            <span><input class="text" type="text" name="email" nullmsg="请填写邮箱"   datatype="e" errormsg="邮箱格式错误"/></span>
              <span></span>
          </div>
           
           <div class="form-agreen">
                    <div><input type="checkbox" name="agent" value="1" checked="">我已阅读并同意<a href="http://localhost/nn2/user/login/agreement" target="_bank" id="protocol">《耐耐网网站用户协议》</a> </div>
                    <div class="input-tip">
                        <span></span>
                    </div>
                </div>

           <div class="cot">
            <span class="zc"><input class="but" type="submit"value="注&nbsp;&nbsp;册"/></span>
          </div>
        </form>
       
      </div>
       <!--企业注册结束-->
    </div>
   <div>

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



        $('.pwd').on('click', function(){
          if ($(this).attr('alt') == 0) {
            var val = $(this).prev().val();
            $(this).prev().remove();
            $html = '<input class="text" type="text" name="password" datatype="/^[\S]{6,15}$/" nullmsg="请填写密码" errormsg="请使用6-15位字符" value="'+val+'" />';
            $(this).before($html);
            $(this).attr('alt', 1);
          }else{
            var val = $(this).prev().val();
            $(this).prev().remove();
            $html = '<input class="text" type="password" name="password" datatype="/^[\S]{6,15}$/" nullmsg="请填写密码" errormsg="请使用6-15位字符" value="'+val+'" />';
            $(this).before($html);
            $(this).attr('alt', 0);
          }
        })


      $(".register_l").click(function(){ 
          $(".hide_qy").hide();
          $(".show_gr").show();
      });
      $(".register_r").click(function(){
          $(".show_gr").hide();
          $(".hide_qy").show();
      })


    });

</script>



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
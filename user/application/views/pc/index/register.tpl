<!DOCTYPE html>
<html>
<head>
  <title>注册</title>
  <meta name="keywords"/>
  <meta name="description"/>
  <meta charset="utf-8">
  <link href="{views:css/reg.css}" rel="stylesheet" type="text/css" />
  <link href="{views:css/city.css}" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="{root:js/jquery/jquery-1.7.2.min.js}"></script>
  <script type="text/javascript" src="{views:js/reg.js}"></script>
  <script type="text/javascript" src="{root:js/area/Area.js}" ></script>
  <script type="text/javascript" src="{root:js/area/AreaData_min.js}" ></script>
    <script type="text/javascript" src="{root:js/form/formacc.js}" ></script>
  <script type="text/javascript" src="{root:js/form/validform.js}" ></script>
    <script type="text/javascript" src="{root:js/layer/layer.js}"></script>
</head>
<body>


<div class="wrap">
<img src="{views:images/mid_banner/banner_01.png}" style="position: fixed;
    width: 100%;"/>
  <!-- <div class="banner-show" id="js_ban_content">
    <div class="cell bns-01">
      <div class="con"> </div>
    </div>
  </div> -->
  <div>
    {url:/index/doReg}
    <div class="register">
      <div class="reg_top">
      <div class="register_top">
          <div class="reg_zc register_l border_bom">个人注册</div>
          <span class="jg">|</span>
          <div class="reg_zc register_r">企业注册</div>
      </div>
      </div>
      <!--个人注册-->
      <div class="reg_cot gr_reg">
        <input name="checkUrl" value="{url:/index/checkIsOne}" type="hidden" />
        <form action="{url:/index/doReg}" method="post" auto_submit redirect_url="{url:/ucenter/baseinfo}">
          <input type="hidden" name="type" value="0"/>
          <div class="cot">
            <span class="cot_tit"><i>*</i>用户名：</span>
            <span><input class="text" type="text" name="username" datatype="/^[a-zA-Z0-9_]{3,30}$/" nullmsg="请填写用户名" errormsg="请使用3-30位字母数字下划线的组合"/></span>
            <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>密码：</span>
            <span><input class="text" type="password" name="password" datatype="/^[\S]{6,15}$/" nullmsg="请填写密码" errormsg="请使用6-15位字符" /></span>
              <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>确认密码：</span>
            <span><input class="text" type="password" name="repassword" datatype="/^[\S]{6,15}$/" recheck="password" nullmsg="请重复填写密码" errormsg="两次密码输入不一致" /></span>
              <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>手机号：</span>
            <span><input class="text" type="text" name="mobile" datatype="mobile" nullmsg="请填写手机号" errormsg="手机号格式错误"/></span>
              <span></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i></i>邮箱：</span>
            <span><input class="text" type="text" name="email" ignore="ignore" datatype="e" errormsg="邮箱格式错误"/></span>
              <span></span>
          </div>

           <div class="cot">
            <span class="zc"><input class="but" type="submit"value="完成注册"/></span>
          </div>
        </form>
      </div>
       <!--个人注册结束-->
        <!--企业注册-->
      <div class="reg_cot qy_reg">
        <form action="{url:/index/doReg}" method="post" auto_submit redirect_url="{url:/ucenter/baseinfo}" >
          <input type="hidden" name="type" value="1"/>
         <div class="cot">
            <span class="cot_tit"><i>*</i>用户名：</span>
            <span><input class="text" type="text" name="username" callback="checkUser"  datatype="/^[a-zA-Z0-9_]{3,30}$/" errormsg="请填写3-30位英文字母、数字" /></span>
            <span></span>
		  </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>密码：</span>
            <span><input class="text" type="password" name="password" datatype="/^\S{6,15}$/" errormsg="6-15位非空字符"  /></span>
            <span></span>
		  </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>确认密码：</span>
            <span><input class="text" type="password" name="repassword" datatype="/^\S{6,15}$/" errormsg="两次密码输入不一致" recheck="password" /></span>
			<span></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>手机号：</span>
            <span><input class="text" type="text" name="mobile" datatype="m"  /></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i></i>邮箱：</span>
            <span><input class="text" type="text" name="email" ignore="ignore" datatype="e" errormsg="邮箱格式错误"/ /></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>公司名称：</span>
            <span><input class="text" type="text" name="company_name"  datatype="s2-50" errormsg="请填写公司名称" /></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>公司地址：</span>
            <div >
              {area:  inputName=area pattern=area }

            </div>
          </div>

          <div class="cot">
            <span class="cot_tit"><i>*</i>法人：</span>
            <span><input class="text" type="text" name="legal_person" datatype="s2-20" errormsg="请填写法人名称"/></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>注册资金：</span>
            <span>
              <input class="text" type="text" name="reg_fund" datatype="float" errormsg="请正确填写注册资金"/>万
           </span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>企业类型：</span>
            <span> 
              <select class="select sel_d" name="category" pattern="/^[1-9]\d{0,}$/" alt="选择企业类型">
              <option value="0">请选择...</option>
              <option value="1">建筑</option>
             </select>
           </span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>企业性质：</span>
            <span> 
              <select class="select sel_d" name="nature" pattern="/^[1-9]\d{0,}$/" alt="选择企业性质">
              <option value="0">请选择...</option>
              <option value="1">国有企业</option>
               <option value="2">私企</option>
             </select>
           </span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>联系人姓名：</span>
            <span><input class="text" type="text" name="contact" datatype="s2-20" errormsg="请填写联系人姓名" /></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>电话：</span>
            <span><input class="text" type="text" name="contact_phone" datatype="m" errormsg="请填写联系人电话"/></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>职务：</span>
            <span>
              <input name="contact_duty" type="radio" value="1" checked/>
              <span class="tit_zw">负责人</span>
              <input name="contact_duty" type="radio" value="2" />
              <span class="tit_zw">高级管理</span>
              <input name="contact_duty" type="radio" value="3" />
              <span class="tit_zw">员工 </span>
            </span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>选择代理商：</span>
            <span><input class="text" type="text" name="agent"/></span>
          </div>
          <div class="cot">
            <span class="cot_tit"><i>*</i>代理商密码：</span>
            <span><input class="text" type="text" name="agent_pass"/></span>
          </div>

           <div class="cot">
            <span class="zc"><input class="but" type="submit" value="完成注册"/></span>
          </div>
        </form>
      </div>
       <!--企业注册结束-->
    </div>
  </div>
  <div style=" clear:both"></div>
</div>
</body>
</html>

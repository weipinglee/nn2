
<link href="{views:css/center_top.css}" rel="stylesheet" type="text/css" />
<!-- 基本信息css -->
<link href="{views:css/center_date.css}" rel="stylesheet" type="text/css" />
    <div class="right_c">
      <div class="r_c_title">
        <a class="tit_span">支付密码申诉找回</a>
      </div>
      <div class="rc_bate">
        <div class="jd_img">
          <img src="{views:images/icon/icon_jd.jpg}">
          <div class="jd_ts">
            <img src="images/icon/icon_ts.jpg"/>
            <span>请确保手机通畅，以便于我们计算与您联系，并接收申诉结果。</span>
          </div>
        </div>

          <div class="bate-input clear">
            <span class="span_in_tit">
              手机号：
            </span>
            <span class="input_span">18562536777</span>
          </div>
          <div class="bate-input clear">
            <span class="span_in_tit">
              验证码：
            </span>
            <div class="input_span">
              <input id="inputCode" placeholder="请输入验证码" type="text" class="gradient wbk">
              <span id="code" class="mycode" style="overflow: hidden;"></span>
              <!-- <input type="button" class="yzm_submit" value="确定" id="submit"> -->
            </div>
          </div>
          <div class="bate-input clear">
            <span class="span_in_tit">
              短信验证码：
            </span>
            <span class="input_span">
              <input type="text" id="phone" class="infos wbk" placeholder="请输入验证码"/>
              <input class="send1" id="btnSendCode" type="button" value="获取验证码" onClick="sendMessage()" /></span>
          </div>
          <div class="bate-input clear">
            <div class="but_div"><a class="but_in" href="user_pay2.html"/>下一步</a></div>
          </div>
      </div>
    </div>

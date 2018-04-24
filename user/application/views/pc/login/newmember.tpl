
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
  <script type="text/javascript">
      //发送短信地址
      var sendMessageUrl = '{url:/login/sendMessage}';
  </script>
   <div class="toplog_bor none">
    <div class="m_log w1200">
        <div class="logoimg_left">
            <div class="img_box"><img class="shouy" src="{views:images/password/logo.png}" id="btnImg"></div>
            <div class="word_box">会员申请</div>
        </div>
         <div class="logoimg_right">
            <img class="shouy" src="{views:images/password/iphone.png}"> 
            <h3>服务热线：<b>400-6238-086</b></h3>
         </div>
    </div>
   </div> 

   <div class="regis_boxs">
    <div class="member_a clear">
      <div class="member_nav">
        <ul class="member_nav_ul">
          <li><a class="cur">会员</a>
          </li>
          <li><a>耐购联盟会员</a></li>
          <li class="member_nav_ul2"><a class="curs mtjian">免费体检</a></li>
          <li class="member_nav_ul2"><a class="hehuoren">合伙人</a></li>
        </ul>
      </div>
      <div class="member_content">
        <div class="member_title clear">
          <ul class="clear">
            <li><a class="member_t cur">会员特权</a></li>
            <li><a class="member_s">会员申请</a></li>
          </ul>
        </div>
        <div class="member_c_i">
          <div class="reg_cot qy_reg member_c_sq" style="display: none;">
            <input name="checkUrl" type="hidden" />

            <form action="{url:/login/newMember@user}" method="post" auto_submit redirect_url="">
             {if:!$login}
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
             {/if}
              <div class="cot">
                <span class="cot_tit">公司名称：</span>
                <span><input class="text" type="text" name="company_name"  datatype="*" errormsg="请填写公司名称" nullmsg="请填写公司名称" /></span>
                  <span></span>
              </div>
              <div class="cot">
                <span class="cot_tit">公司地址：</span>
                <div>
                  <span>{area:  inputName=area pattern=area }</span>
                    <span></span>
                </div>
              </div>
              <div class="cot">
                <span class="cot_tit">公司详细地址：</span>
                <span><input class="text" type="text" name="address" datatype="*" errormsg="请填写地址信息"><span class="Validform_checktip"></span></span>
                <span></span>
              </div>
              <div class="cot">
                <span class="cot_tit">联系人：</span>
                <span><input class="text" type="text" name="contact" datatype="zh2-20" errormsg="请填写联系人姓名"><span class="Validform_checktip"></span></span>
                <span></span>
              </div>
              <div class="cot">
                <span class="cot_tit">联系电话：</span>
                <span><input class="text" type="text" name="contact_phone" datatype="mobile" nullmsg="请填写联系人电话 " errormsg="请正确填写联系人电话"><span class="Validform_checktip"></span></span>
                <span></span>
              </div>
                {if:!$login}
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
              {/if}
              <div class="cot">
               <span class="zc"><input class="but" type="submit" value="申  请"/></span>
              </div>
            </form>
       
          </div>
          <div class="member_c_tq1">
            <p>1、信息匹配服务：匹配与企业经营相关的企业信息。</p>
            <p>2、企业所需生产原料的预定服务：提出采购需求后进行大数据匹配，匹配不成功，提供单次价值不高于20万元货物的企业定制化服务。</p>
            <p>3、会员价购买商品：会员购买商品提供比市场价更低的会员价服务。</p>
            <p>4、急速开票服务：买卖双方交易完成之后，五个工作日内发票邮寄至收票地址。</p>
            <p>5、品牌展示之家服务：平台线上专属产品展示服务。期限为一个月</p>

          </div>
          <div class="member_c_tq2" style="display: none">
            <p>1、云定制：购销信息匹配，生产环节跟踪，设备、金融产品分析推送，专家一对一互动服务为基础，根据企业的需求，定制独一无二的专属需求，解决企业发展难题。</p>
            <p>2、企业所需生产原料的预定服务：提出采购需求后进行大数据匹配，匹配不成功，提供单次价值不高于500万元货物的企业定制化服务。</p>
            <p>3、原始股权：合同期满后签署《耐耐持股平台认购协议》，成为持股平台一员。100家联盟会员共同持有持股平台股权，持股平台持有耐耐云商科技有限公司5%原始股权。联盟会员无需缴纳其他费用即可共享估值200亿的企业股权。100位企业家共同推进中国耐火行业的发展，成为耐火行业冲向世界的先驱者与缔造者。</p>
            <p>4、品牌展示之家服务：平台线上线下专属产品展示，办公区域共享洽谈，专家资源座谈交流，培青计划预先制定。</p>
            <p>5、金融贷款服务：平台将通过合作银行提供金融贷款服务。</p>
            <p>6、会员价购买商品：会员购买商品提供比市场价更低的会员价服务。</p>
            <p>7、急速开票服务：买卖双方交易完成之后，五个工作日内发票邮寄至收票地址。</p>
            <p>8、信息匹配服务：匹配与企业经营相关的企业信息。</p>
            <p>9、耐耐配送服务：选择配送方式时，可选择耐耐配送服务，获得信誉高价格低的车队进行配送</p>
            <p>10、竞价优先权：
            (1)优先竞价权：竞价活动启动前甲方即通知竞价活动信息，联盟商收到通知时即可进入排队竞价队列，第一个回复在竞价启动时即自动完成起拍价竞价（不限于铝矾土生料、熟料，联盟商可提供所需产品清单）。
            (2)竞价免保证金权益：根据竞价规则，参与竞价方需按出价金额缴纳保证金，联盟商参与竞价时无需缴纳保证金，若竞价成功，在竞价完成后2小时内缴纳货款即可。</p>
            <p>11、产品100%推荐服务：在合作期间，联盟商企业每月可选5款产品作为重点推荐，有需求此类产品信息时，平台保证100%进行信息推荐。</p>
            <p>12、样品邮寄服务：购买前先确认货物质量，取样质检实时跟踪，产品买的放心，用的舒心。期限为两年</p>


          </div>
        </div>
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


    });

</script>
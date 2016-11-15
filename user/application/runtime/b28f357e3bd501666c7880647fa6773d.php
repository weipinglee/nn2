<!DOCTYPE html>
<html>
<head>
  <title>个人中心</title>
  <meta name="keywords"/>
  <meta name="description"/>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=EDGE">
  <link href="/nn2/user/views/pc/css/user_index.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="/nn2/user/js/jquery/jquery-1.7.2.min.js"></script>



  <script language="javascript" type="text/javascript" src="/nn2/user/views/pc/js/My97DatePicker/WdatePicker.js"></script>
  <script type="text/javascript" src="/nn2/user/views/pc/js/regular.js"></script>
   <script src="/nn2/user/views/pc/js/center.js" type="text/javascript"></script>
  <link href="/nn2/user/views/pc/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
   <!-- 头部控制 -->
  <link href="/nn2/user/views/pc/css/topnav20141027.css" rel="stylesheet" type="text/css">
  <script src="/nn2/user/views/pc/js/topnav20141027.js" type="text/javascript"></script>
    <!-- 头部控制 -->

    <script type="text/javascript" src="/nn2/user/js/form/validform.js" ></script>
    <script type="text/javascript" src="/nn2/user/js/form/formacc.js" ></script>
    <script type="text/javascript" src="/nn2/user/js/layer/layer.js"></script>
    <script type="text/javascript" src="/nn2/user/js/layer/extend/layer.ext.js"></script>

     <link href="/nn2/user/js/form/validate/error.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="/nn2/user/js/area/AreaData_min.js" ></script>
    <script type="text/javascript" src="/nn2/user/js/area/Area.js" ></script>

</head>
<body>
<!--    公用头部控件 -->
    <div class="bg_topnav">
    <div class="topnav_width">
        <div class="topnav_left">
            <div class="top_index">
                <img class="index_img" src="/nn2/user/views/pc/images/icon/icon_index.png"/>
                <a rel="external nofollow" href="/index/index" target="_blank" >耐耐网首页</a>
            </div>

            <div class="index_user">
            <?php if(isset($username)){?>
                <a rel="external nofollow"  href="http://localhost/nn2/user//ucenterindex/index"  target="_blank" class="">您好，<?php echo isset($username)?$username:"";?></a>
                <?php }else{?>
                <span>您好，欢迎进入耐耐网</span>
                <?php }?>
            </div>
            <?php if($login==0){?>
            <div class="login_link" id="toploginbox">
                <a rel="external nofollow" href="http://localhost/nn2/user//login/login" target="_blank" class="topnav_login">请登录</a>
            </div>
            <div class="topnav_regsiter">
                <a rel="external nofollow" href="http://localhost/nn2/user//login/register" target="_blank">免费注册</a>
            </div>
            <?php }else{?>
            <div class="login_link" id="toploginbox">
                <a rel="external nofollow" href="http://localhost/nn2/user//login/logout" target="_blank" class="topnav_login">退出</a>
            </div>
            <?php }?>
        </div>
        <div class="topnav_right">
            <ul>
                <?php if($login!=0){?>
                 <li>
                   <a href="http://localhost/nn2/user//ucenterindex/index">会员中心</a><span class="line_l">|<span>
                </li>
                <li>
                    <?php if($usertype==1){?>
                        <a href="http://localhost/nn2/user/contract/sellerlist">我的合同</a>
                    <?php }else{?>
                        <a href="http://localhost/nn2/user/contract/buyerlist">我的合同</a>
                    <?php }?>
                    <span class="line_l">|<span>
                </li>
                <?php }?>
                <li>
                    <a href="http://localhost/nn2/user//message/usermail">消息中心<?php if($mess!=0){?><em class="information"><?php echo isset($mess)?$mess:"";?></em><?php }?></a><span class="line_l">|<span>
                </li>
                <!--<li>
                    <img class="iphon_img" src="/nn2/user/views/pc/images/icon/icon_iphon.png"/>
                    <a href="">手机版</a><span class="line_l">|<span>
                </li>-->
                <li>
                    <a href="http://crm2.qq.com/page/portalpage/wpa.php?uin=4006238086&aty=0&a=0&curl=&ty=1" target="_blank" ><!--onclick="javascript:window.open('http://b.qq.com/webc.htm?new=0&sid=279020473&o=new.nainaiwang.com&q=7', '_blank', 'height=502, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');" --> 在线客服</a><span class="line_l">|<span>
                </li>
                <li style="padding-top:2px;">
                    <span>交易时间：<?php echo isset($deal['start_time'])?$deal['start_time']:"";?>--<?php echo isset($deal['end_time'])?$deal['end_time']:"";?></span>
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
                <a href="/index/index" alt="返回耐耐首页"><img src="/nn2/user/views/pc/images/icon/nainaiwang.png"/></a></dd>
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
                                            <li><a  href="<?php echo isset($list['url'])?$list['url']:"";?>" <?php if( in_array($action, $list['action'])){?>class="cur"<?php }?> ><?php echo isset($list['title'])?$list['title']:"";?></a></li>
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
                                    <img src="/nn2/user/views/pc/images/icon/head_portrait.jpg">
                                </a>
                            </div>
                            <div class="per_username">
                                <p class="username_p"><b>您好，<?php echo isset($username)?$username:"";?></b></p>
                                <p class="username_p"><!--<img src="<?php echo isset($group['icon'])?$group['icon']:"";?>">--><?php echo isset($group['group_name'])?$group['group_name']:"";?></p>
                                <p class="username_p">消息提醒：<a href="http://localhost/nn2/user/message/usermail"><b class="colaa0707"><?php echo isset($mess)?$mess:"";?></b></a></p>
                            </div>
                            <div class="per_function">
                                <a href="http://localhost/nn2/user/ucenter/baseinfo">基本信息设置</a>
                                <a href="http://localhost/nn2/user/ucenter/password">修改密码</a>
                            </div>

                        </div>
                    </div>
                <?php }?>
            </div>
            <!--end左侧导航-->
            <div id="cont"><link href="/nn2/user/views/pc/css/user_index.css" rel="stylesheet" type="text/css" />
<link href="/nn2/user/views/pc/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="/nn2/user/views/pc/css/pay_ment.css" rel="stylesheet" type="text/css" /> 
<script src="/nn2/user/views/pc/js/pay_ment.js" type="text/javascript"></script>
<script type="text/javascript" src="/nn2/user/js/upload/ajaxfileupload.js"></script>
<script type="text/javascript" src="/nn2/user/views/pc/js/upload.js"></script>
			<!--start中间内容-->	
			<div class="user_c_list no_bor">
				<div class="user_zhxi">


					
                   <div class="checkim">
                       <h2>确认尾款线下凭证</h2>


                       <table class="detail_tab" border="1" cellpadding="0" cellspacing="0" width="100%">
                        <tbody><tr class="detail_title">
                          <td colspan="10"><strong>订单详情</strong></td>
                        </tr>
                        <tr style="line-height: 30px;">
                          <td style="background-color: #F7F7F7;" width="100px">订单号</td>
                          <td colspan="3" width="230px"><?php echo isset($data['order_no'])?$data['order_no']:"";?></td>
                          <td style="background-color: #F7F7F7;" width="100px">订单日期</td>
                          <td colspan="5" width="230px"><?php echo isset($data['create_time'])?$data['create_time']:"";?></td>
                        </tr>
                        <tr>
                          <td style="background-color: #F7F7F7; padding-top: 5px;" valign="top" width="100px">商品信息</td>
                          <td colspan="10" style="padding-left: 0px;">
                              <table style="line-height: 30px;" border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody><tr style="border-bottom:1px dashed #BFBFBF;">
                                  <td width="240px">品名</td>
                                  <!-- <td width="130px">生产厂家</td> -->
                                  <td width="120px">仓库</td>
                                  <td width="100px">单价</td>
                                  <td width="100px">单位</td>
                                  <td width="100px">重量</td>
                                  <td width="100px">小计</td>
                                  <td width="100px">手续费</td>
                                </tr>

                                
                                <tr>
                                  <td><?php echo isset($data['name'])?$data['name']:"";?></td>
                               <!--   <td></td> --> 
                                  <td><?php echo isset($data['store_name'])?$data['store_name']:"";?></td>
                                  <td>
                                          <label class="" id="d_price_1">
                                            ￥  <?php echo isset($data['price'])?$data['price']:"";?>
                                          </label>
                                  </td>
                                  <td>
                                      <?php echo isset($data['unit'])?$data['unit']:"";?>
                              </td>
                                  <td><?php echo isset($data['num'])?$data['num']:"";?></td>
                                  <td><label class="">
                              
                                  <label class="price02">￥</label>
                                  <label class="" id="d_sum_money_1">
                                      <?php echo isset($data['amount'])?$data['amount']:"";?>
                                  </label>
                              
                              
                              </label></td>
                              <td><label class="">
                              
                                  <label class="price02">￥</label>
                                  <label class="" id="d_sum_comm_1">
                                      0.00
                                  </label>
                              </label></td>
                                </tr>  
                                 
                              </tbody></table>
                      </td>
                    </tr>
                    <tr style="line-height: 35px;">
                      <td style="background-color: #F7F7F7;" width="100px">合同</td>
                      <td colspan="3" width=""><a href="http://localhost/nn2/user/contract/contract/order_id/<?php echo $data['id'];?>" style="color:blue;" target='_blank'>合同预览</a></td>
                      <td style="background-color: #F7F7F7;" width="100px">合计金额</td>
                      <td colspan="1" width="">
                              <span class="orange price02" style="font-size:18px; text-decoration: none; list-style: none;">￥</span>
                              <span class="orange" style="font-size:18px; text-decoration: none; list-style: none;" id="b_o_q">
                                  <?php echo isset($data['amount'])?$data['amount']:"";?>
                              </span>   
                      </td>
                      <?php if($data['show_deposit']){?>
                       <td style="background-color: #F7F7F7;" width="100px">已支付定金</td>
                      
                      <td colspan="1" width="">
                              <span class="orange price02" style="font-size:18px; text-decoration: none; list-style: none;">￥</span>
                              <span class="orange" style="font-size:18px; text-decoration: none; list-style: none;" id="b_o_q">
                                  <?php echo isset($data['pay_deposit'])?$data['pay_deposit']:"";?>
                              </span>   
                      </td>
                      <?php }?>
                      <td style="background-color: #F7F7F7;" width="100px">剩余尾款</td>
                      <td colspan="1" width="">
                              <span class="orange price02" style="font-size:18px; text-decoration: none; list-style: none;">￥</span>
                              <span class="orange" style="font-size:18px; text-decoration: none; list-style: none;" id="b_o_q">
                                  <?php echo isset($data['pay_retainage'])?$data['pay_retainage']:"";?>
                              </span>   
                      </td>
                    </tr>
                  </tbody></table>
                          
                          <div class="pay_type">
                              <h3 class="add_zhifu">支付方式：</h3>
                              <h3 class="addwidth">
                                <div class="yListr" id="yListr" >
                                      <ul>
                                          <li>
                                            <?php if($show_online){?>
                                            <em name="chooice" class="yListrclickem" payment='online'>线上支付<i></i></em> 

                                            <em name="chooice" payment='offline'>线下支付<i></i></em> 
                                            <?php }else{?>
                                              <em name="chooice" payment='offline' class="yListrclickem">线下支付<i></i></em> 
                                            <?php }?>
                                          </li>

                                      </ul>
                              </div> 

                        <script type="text/javascript">
                            $(function() {
                                $(".yListr ul li em").click(function() {
                                  var payment = $(this).attr('payment');
                                  $(this).addClass("yListrclickem").siblings().removeClass("yListrclickem");
                                  $('input[name=payment]').val(payment);
                                })
                            });
                        </script>
                       
                   <div id="bain_bo">
                   <div class="">
                        <ul>
                        	<li>凭证图片：</li>
                          <li><img src="<?php echo isset($data['proof_thumb'])?$data['proof_thumb']:"";?>"></li>
                        </ul>
                      
                    
                    </div>
                  </div>  
                            
                       </h3> 
                         </div>

                    <form action="http://localhost/nn2/user/order/confirmproof" method="post" auto_submit="1" redirect_url="http://localhost/nn2/user/contract/sellerdetail/id/<?php echo $data['id'];?>" >
                        <input type="hidden" name="order_id" value="<?php echo isset($data['id'])?$data['id']:"";?>" />
                        <div class="pay_bton">
                            <a href="javascript:void(0)" id='pay_retainage'  confirm="1" confirm_text="确认线下支付凭证无误？" >确认凭证</a>
                        </div>
                    </form>


                           </div>

               

				</div>				
				
			</div>
			<!--end中间内容-->


</div>

				<!--end中间内容-->	
			
		</div>
	</div>
<script type="text/javascript">
    $(function() {
        $('.left_navigation ').find('.cur').parents('.btn1').find('.nav-first').trigger('click');
    })
</script>
</body>
</html>
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
            <div id="cont">﻿<script type="text/javascript" src="/nn2/user/js/area/Area.js" ></script>
<script type="text/javascript" src="/nn2/user/js/area/AreaData_min.js" ></script>
<script type="text/javascript" src="/nn2/user/views/pc/js/product/attr.js" ></script>
			<!--start中间内容-->	
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>产品管理</a>><a>仓单报盘</a></p>
					</div>
					<div class="center_tabl">

                    <input type="hidden" id='ajaxGetStoreUrl' value="http://localhost/nn2/user/managerdeal/ajaxgetstore">
                    <form action="http://localhost/nn2/user/managerdeal/dostoreoffer" method="POST" auto_submit redirect_url="http://localhost/nn2/user/managerdeal/indexoffer">
						<table border="0">
                            <tr>
                                <th colspan="3">选择仓单</th>
           		</tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>可选仓单：</td>
                                <td colspan="2"> 
                                    <select id="storeList" name="storeproduct" datatype="/[1-9][\d]{0,}/">
                                        <option value="0">请选择仓单</option>
                                       <?php if(!empty($storeList)) foreach($storeList as $key => $list){?>
                                        <option value="<?php echo isset($list['id'])?$list['id']:"";?>"><?php echo isset($list['sname'])?$list['sname']:"";?>-<?php echo isset($list['pname'])?$list['pname']:"";?></option>
                                       <?php }?>
                                    </select>
                                </td>
                            </tr>
                            <tr >
                                <td class="spmx" colspan="3">
                                    <table class="table2" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td class="spmx_title" colspan="2">商品明细</td>
                                        </tr>
                                      
                                        <tr>
                                            <td>商品名称</td>
                                            <td id="pname"> 
    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>产品大类</td>
                                            <td id="cname">  

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>规格</td>
                                            <td id="attrs">
    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>产地</td>
                                            <td id="area"> 

                                            </td>
                                        </tr>
                                        <tr>
                                            <td >签发日期</td>
                                            <td id="create_time"> 

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="end_td">产品数量（<span id="unit"></span>）</td>
                                            <td class="end_td" id="quantity"> 
                          
                                            </td>
                                        </tr>
                                    </table>
                                    
                                </td>
                            </tr>
                            

                            <tr>
                               <th colspan="3">基本挂牌信息</th>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>商品单价：</td>
                                <td> 
                                    <input class="text" type="text" datatype="money" errormsg="价格错误" name="price">
                                    
                                </td>
                               <!--  <td> 
                                   请选择付款方式：
                                   <input type ="radio" name ="safe" checked="checked" style="width:auto;height:auto;"> 线上
                                   <input type ="radio" name ="safe" style="width:auto;height:auto;"> 线下
                               </td> -->
                            </tr>
                                <tr>
        <td>有效期：</td>
        <td colspan="2">
             <span><input class="Wdate text" datatype="*" value="<?php echo isset($offer['expire_time'])?$offer['expire_time']:"";?>" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',minDate:'%y-%M-#{%d+1}'})"
                           name="expire_time" value="">
                 </span>
            <span></span>
        </td>

    </tr>
                              <tr>
<!--         <td nowrap="nowrap"><span></span>是否投保：</td>
        <td>
            <span> <input type="radio" name="insurance" value="1"  >是 <input type="radio" name="insurance" value="0"  checked="true">否</span>
        </td>
    </tr>
    <tr id="riskdata" style="display:none;">
        <td ><span></span>投保：</td>
        <td>
            <span> 
            </span>
        </td>
    </tr> -->
                           <tr>
                            <td><span>*</span>是否可拆分：</td>
                            <td>

                                <select name="divide" id="divide">
                                    <option value="1" selected >是</option>
                                    <option value="0"  >否</option>
                                </select>
                            </td>
                            </tr>
                            <tr class='nowrap1' >
                                <td><span>*</span>最小起订量：</td>
                                <td>
                                    <span><input name="minimum" id="" type="text"  /></span>
                                    <span></span>
                                </td>
                            </tr>
                            <tr class='nowrap1'  >
                                <td><span>*</span>最小递增量：</td>
                                <td>
                                    <span><input name="minstep" id="" type="text"  /></span>
                                    <span></span>
                                </td>
                            </tr>
                            <script type="text/javascript">
                                $('#divide').change(function(){
                                    if($('#divide').val()==1){
                                        $('.nowrap1').show();

                                    }else{
                                        $('.nowrap1').hide();
                                    }
                                });
                            </script>
          					
                            <tr>
                                <td>图片预览：</td>
                                <td colspan="2">
    							<span class="zhs_img" id="photos">

    							</span>
                                </td>              
                            </tr>
                            <tr>
                        <td>交收地点：</td>
                            <td colspan="2">
                                <input type="text" class='text' datatype="s2-30" errormsg="请填写有效地址" nullmsg="请填写交收地点" name="accept_area">
                            </td>
                            </tr>
                            <td>交收时间：</td>
                            <td colspan="2">
                                <span>T+<input type="text" class='text' datatype="/[1-9]\d{0,5}/" name="accept_day" style="width:50px;">天</span>
                            </td>
                            </tr>
                            <tr>
    <td>记重方式：</td>
    <td colspan="2">
        <span>
            <select name="weight_type">
                <option value="理论值">理论值</option>
                <option value="过磅">过磅</option>
                <option value="轨道衡">轨道衡</option>
                <option value="吃水">吃水</option>
            </select>
        </span>
        <span></span>
    </td>
    </tr>
              			    <tr>
        <td>补充条款：</td>
        <td colspan="2">
            <textarea name="other"><?php echo isset($offer['other'])?$offer['other']:"";?></textarea>
        </td>
    </tr>                      

                        <tr>
                            <td></td>
                            <td colspan="2" class="btn">
                            <input type="hidden" name="mode" value="3">
                            <input type="hidden" name="quantity" value="0" >
                            <input type="hidden" name="product_id" id="product_id" value="<?php echo isset($storeDetail['pid'])?$storeDetail['pid']:"";?>">
                                <input type="hidden" name="token" value="<?php echo isset($token)?$token:"";?>" />
                        <input type="submit" value="提交审核">

                                
                            </td>
                        </tr>
                         
                 </table>
            	</form>

						
					</div>
				</div>
			</div>
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
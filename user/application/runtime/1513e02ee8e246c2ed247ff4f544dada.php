<!DOCTYPE html>
<html>
<head>
  <title>个人中心</title>
  <meta name="keywords"/>
  <meta name="description"/>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=EDGE">
  <link href="/nn2/user/public/views/pc/css/user_index.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="/nn2/user/public/js/jquery/jquery-1.7.2.min.js"></script>



  <script language="javascript" type="text/javascript" src="/nn2/user/public/views/pc/js/My97DatePicker/WdatePicker.js"></script>
  <script type="text/javascript" src="/nn2/user/public/views/pc/js/regular.js"></script>
   <script src="/nn2/user/public/views/pc/js/center.js" type="text/javascript"></script>
  <link href="/nn2/user/public/views/pc/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
   <!-- 头部控制 -->
  <link href="/nn2/user/public/views/pc/css/topnav20141027.css" rel="stylesheet" type="text/css">
  <script src="/nn2/user/public/views/pc/js/topnav20141027.js" type="text/javascript"></script>
    <!-- 头部控制 -->

    <script type="text/javascript" src="/nn2/user/public/js/form/validform.js" ></script>
    <script type="text/javascript" src="/nn2/user/public/js/form/formacc.js" ></script>
    <script type="text/javascript" src="/nn2/user/public/js/layer/layer.js"></script>
    <script type="text/javascript" src="/nn2/user/public/js/layer/extend/layer.ext.js"></script>

     <link href="/nn2/user/public/js/form/validate/error.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="/nn2/user/public/js/area/AreaData_min.js" ></script>
    <script type="text/javascript" src="/nn2/user/public/js/area/Area.js" ></script>

</head>
<body>
<!--    公用头部控件 -->
    <div class="bg_topnav">
    <div class="topnav_width">
        <div class="topnav_left">
            <div class="top_index">
                <img class="index_img" src="/nn2/user/public/views/pc/images/icon/icon_index.png"/>
                <a rel="external nofollow" href="http://localhost/nn2/deal/public/index/index" target="_blank" >耐耐网首页</a>
            </div>

            <div class="index_user">
            <?php if($username){?>
                <a rel="external nofollow"  href="http://localhost/nn2/user/public/ucenterindex/index"  target="_blank" class="">您好，<?php echo isset($username)?$username:"";?></a>
                <?php }else{?>
                <span>您好，欢迎进入耐耐网</span>
                <?php }?>
            </div>
            <?php if($login==0){?>
            <div class="login_link" id="toploginbox">
                <a rel="external nofollow" href="http://localhost/nn2/user/public/login/login" target="_blank" class="topnav_login">请登录</a>
            </div>
            <div class="topnav_regsiter">
                <a rel="external nofollow" href="http://localhost/nn2/user/public/login/register" target="_blank">免费注册</a>
            </div>
            <?php }else{?>
            <div class="login_link" id="toploginbox">
                <a rel="external nofollow" href="http://localhost/nn2/user/public/login/logout" target="_blank" class="topnav_login">退出</a>
            </div>
            <?php }?>
        </div>
        <div class="topnav_right">
            <ul>
                <?php if($login!=0){?>
                 <li>
                   <a href="http://localhost/nn2/user/public/ucenterindex/index">会员中心</a><span class="line_l">|<span>
                </li>
                <li>
                    <?php if($usertype==1){?>
                        <a href="http://localhost/nn2/user/public/contract/sellerlist">我的合同</a>
                    <?php }else{?>
                        <a href="http://localhost/nn2/user/public/contract/buyerlist">我的合同</a>
                    <?php }?>
                    <span class="line_l">|<span>
                </li>
                <?php }?>
                <li>
                    <a href="http://localhost/nn2/user/public/message/usermail">消息中心<?php if($mess!=0){?><em class="information"><?php echo isset($mess)?$mess:"";?></em><?php }?></a><span class="line_l">|<span>
                </li>
                <!--<li>
                    <img class="iphon_img" src="/nn2/user/public/views/pc/images/icon/icon_iphon.png"/>
                    <a href="">手机版</a><span class="line_l">|<span>
                </li>-->
                <li>
                    <a href="http://crm2.qq.com/page/portalpage/wpa.php?uin=4006238086&aty=0&a=0&curl=&ty=1" target="_blank" ><!--onclick="javascript:window.open('http://b.qq.com/webc.htm?new=0&sid=279020473&o=new.nainaiwang.com&q=7', '_blank', 'height=502, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');" --> 在线客服</a><span class="line_l">|<span>
                </li>
                <li style="padding-top:2px;">
                    <span>交易时间：09:00--17:30</span>
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
                <a href="http://localhost/nn2/deal/public/index/index" alt="返回耐耐首页"><img src="/nn2/user/public/views/pc/images/icon/nainaiwang.png"/></a></dd>
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
                                            <li><a  href="<?php echo isset($list['url'])?$list['url']:"";?>" <?php if($action==$list['action']){?>class="cur"<?php }?> ><?php echo isset($list['title'])?$list['title']:"";?></a></li>
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
                                    <img src="/nn2/user/public/views/pc/images/icon/head_portrait.jpg">
                                </a>
                            </div>
                            <div class="per_username">
                                <p class="username_p"><b>您好，<?php echo isset($username)?$username:"";?></b></p>
                                <p class="username_p"><!--<img src="<?php echo isset($group['icon'])?$group['icon']:"";?>">--><?php echo isset($group['group_name'])?$group['group_name']:"";?></p>
                                <p class="username_p">消息提醒：<a href="http://localhost/nn2/user/public/message/usermail"><b class="colaa0707"><?php echo isset($mess)?$mess:"";?></b></a></p>
                            </div>
                            <div class="per_function">
                                <a href="http://localhost/nn2/user/public/ucenter/baseinfo">基本信息设置</a>
                                <a href="http://localhost/nn2/user/public/ucenter/password">修改密码</a>
                            </div>

                        </div>
                    </div>
                <?php }?>
            </div>
            <!--end左侧导航-->
            <div id="cont"><script type="text/javascript" src="/nn2/user/public/js/jquery/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src='/nn2/user/public/js/area/Area.js'></script>
<script type="text/javascript" src='/nn2/user/public/js/area/AreaData_min.js'></script>

			<!--end左侧导航-->	
			<!--start中间内容-->	
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>提单管理</a>><a>提单详情</a></p>
					</div>
					<div class="center_tabl">
                    <div class="lx_gg">
                        <b>提货详细信息</b>
                    </div>
                    <div class="list_names">
                        <span>订单号:</span>
                        <span><?php echo isset($info['order_no'])?$info['order_no']:"";?></span>
                    </div>

						<table border="0">
                            <tr>
                                <td nowrap="nowrap"><span></span>商品名称：</td>
                                <td colspan="2">
                                    <?php echo isset($info['order']['name'])?$info['order']['name']:"";?>
                                </td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>交收地点：</td>
                                <td colspan="2">
                                    
                                    <?php echo isset($info['order']['accept_area'])?$info['order']['accept_area']:"";?>
                                </td>
                            </tr>

                            <?php if($info['order']['mode'] == \nainai\order\Order::ORDER_STORE){?>
                                <tr>
                                    <td nowrap="nowrap"><span></span>所在仓库：</td>
                                    <td colspan="2" id='areatext'>
                                                            <span id="areatext">
                        <script type="text/javascript">
                         ( function(){
                            var areatextObj = new Area();
                            var text = areatextObj.getAreaText('<?php echo $info['order']['store_area'] ; ?>',' ');
                            $('#areatext').html(text);

                            })()
                        </script>
                     </span>

&nbsp;
                                        <?php echo isset($info['order']['store_address'])?$info['order']['store_address']:"";?>&nbsp;
                                        <?php echo isset($info['order']['store_name'])?$info['order']['store_name']:"";?>
                                    </td>
                                </tr>
                            <?php }?>
                           
                            <tr>
                                <td nowrap="nowrap"><span></span>提货数量：</td>
                                <td colspan="2">
                                   <?php echo isset($info['num'])?$info['num']:"";?>
                                </td>
                            </tr>
                            <tr >
                                <td nowrap="nowrap"><span></span>申请提货时间：</td>
                                <td colspan="2">
                                    <?php echo isset($info['create_time'])?$info['create_time']:"";?>
                                </td>
                            </tr>
                            <tr>
              					<td nowrap="nowrap"><span></span>预计提货时间：</td>
                				<td colspan="2">
                                    <?php echo isset($info['expect_time'])?$info['expect_time']:"";?>
                                </td>
           				 	</tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>提货人：</td>
                                <td colspan="2">
                                    <?php echo isset($info['delivery_man'])?$info['delivery_man']:"";?>
                                </td>
                            </tr>
                            <tr >
                                <td nowrap="nowrap"><span></span>电话：</td>
                                <td colspan="2">
                                    <?php echo isset($info['phone'])?$info['phone']:"";?>
                                </td>
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>身份证号：</td>
                                <td colspan="2">
                                    <?php echo isset($info['idcard'])?$info['idcard']:"";?>
                                </td>
                            </tr>
                             <tr>
                                <td nowrap="nowrap"><span></span>车牌号：</td>
                                <td colspan="2">
                                    <?php echo isset($info['plate_number'])?$info['plate_number']:"";?>
                                </td>
                            </tr>
                            <tr >
                                <td nowrap="nowrap"><span></span>备注：</td>
                                <td colspan="2">
                                    <?php echo isset($info['remark'])?$info['remark']:"";?>
                                </td>
                            </tr>
                            
                            <?php if($info['delivery_time']){?>
                                <tr >
                                    <td nowrap="nowrap"><span></span>发货时间：</td>
                                    <td colspan="2"> 
                                        <?php echo isset($info['delivery_time'])?$info['delivery_time']:"";?>
                                    </td>
                                </tr>
                            <?php }?>
                            <?php if($info['confirm_time']){?>
                                <tr >
                                    <td nowrap="nowrap"><span></span>确认提货时间：</td>
                                    <td colspan="2"> 
                                        <?php echo isset($info['confirm_time'])?$info['confirm_time']:"";?>
                                    </td>
                                </tr>
                            <?php }?>
                            <tr >
                                <td nowrap="nowrap"><span></span>当前提货状态：</td>
                                <td colspan="2"> 
                                    <?php echo isset($info['title'])?$info['title']:"";?>
                                </td>
                            </tr>   
                            
                            <tr>
                                <td></td>
                                <td colspan="2" class="btn">

                                    <?php if(!empty($info['action'])) foreach($info['action'] as $key => $item){?>
                                        <!-- <?php if($item['name'] != '查看'){?> -->
                                        <a href="<?php echo isset($item['url'])?$item['url']:"";?>" confirm><?php echo isset($item['name'])?$item['name']:"";?></a>
                                        <!-- <?php }?> -->
                                    <?php }?>
                                    
                                </td>
                            </tr>
                         </table>
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
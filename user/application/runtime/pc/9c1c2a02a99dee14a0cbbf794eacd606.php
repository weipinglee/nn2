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
            <div id="cont">		<form method="post" action="http://localhost/nn2/user/delivery/genedelivery" auto_submit=1 redirect_url="http://localhost/nn2/user/delivery/delibuylist/index">
			<!--start中间内容-->	
			<div class="user_c_list">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>交易管理</a>><a>申请提货</a></p>
					</div>
					<div class="chp_xx">
						
						<div class="xx_center">
							<table border="0" cellpadding="" cellspacing="">
								<tbody>
								<tr class="title">
									<td align="left" colspan="7">&nbsp;商品清单</td>
								</tr>
								<tr class="title_head">
									<th>图片</th>
									<th>商品名称</th>
									<th>商品数量</th>
									<th>可提数量</th>
									<th>提货数量</th>
									<?php if($data['store_name']){?>
										<th>仓库</th>
									<?php }?>
								</tr>
								<tr>
									<td><img src="<?php echo isset($data['img'])?$data['img']:"";?>"/></td>
									<td><?php echo isset($data['name'])?$data['name']:"";?></td>
									<td><?php echo isset($data['num'])?$data['num']:"";?><?php echo isset($data['unit'])?$data['unit']:"";?></td>
									<td><?php echo isset($data['left'])?$data['left']:"";?><?php echo isset($data['unit'])?$data['unit']:"";?></td>
									<!-- 判断系统参数是否支持多次开单 如果单次开单则不能修改开单数量-->
									<td>
										<input type="text" class="thjs_input" name='num' datatype="float" nullmsg=' '>

									</td>
									<?php if($data['store_name']){?><td><?php echo isset($data['store_name'])?$data['store_name']:"";?></td><?php }?>

								</tr>
							</tbody></table>
						</div>
						<ul class="methed">
							<li class="clearfix">
								<label>预计提货日期：</label>
								<div>
					                <input name="expect_time" id="date_start" type="text" datatype="date" onclick="WdatePicker({dateFmt:'yyyy-MM-dd', minDate:'%y-%M-%d'});" class="Wdate gyctht_input" >
									记重方式：<?php echo isset($data['weight_type'])?$data['weight_type']:"";?>
						            <input type="hidden" id="weight_type" value="A">
						         </div>

				            </li>
							<li class="clearfix">
								<!-- <label>提货人：</label> -->
								<div>
									<p>
										<b></b>
										<label for="">提货人：</label><span id="man"><input type="text" datatype="s2-20" name="delivery_man"></span>
										<span></span>
									</p>
									<p>
										<b>  </b>
										<label for="">联系电话：</label><span id="tel"><input type="text" datatype="mobile" name="phone"></span><span></span>
									</p>
									<p>
										<b>  </b>
										<label for="">身份证号码：</label><span id="code"><input type="text" datatype="identify" name="idcard"/></span><span></span>
									</p>
									<p>
										<b>  </b>
										<label for="">车牌号：</label><span><input type="text" name="plate_number" datatype="*" placeholder="多个以逗号分隔"/></span><span></span>

									</p>
								</div>
							</li>
				            <li class="clearfix">
				                <label>备注：</label>
				                <div>
								    <textarea name="remark" cols="" rows="" id="REMARK" class="bz" maxlength="200"></textarea>最多输入200个字符
								</div>
				            </li>

						</ul>
						<div class="zhxi_con">	
							<input type="hidden" name="order_id" value="<?php echo isset($data['id'])?$data['id']:"";?>" />
							<span><input class="submit_zz" type="submit" confirm=1 value="提交"></span>
							<span><input class="submit_zz reset_zz" type="reset" onclick="javascript:history.back();" value="返回"></span>
						</div>
						<!-- <div class="sjxx">
							<p>支付配送</p>
							<div class="sj_detal">
								<b class="sj_de_tit">收货人：</b>
								<span>&nbsp;laijjj</span>
							</div>
							<div class="sj_detal">
								<b class="sj_de_tit">地址：</b>
								<span>&nbsp;山西省晋中市xxx县</span>
							</div>
							<div class="sj_detal">
								<b class="sj_de_tit">邮编：</b>
								<span>&nbsp;045000</span>
							</div>
						</div> -->
					</div>
				</div>
			</div>
			<!--end中间内容-->	
			</form>
			<script type="text/javascript">
				$(function(){

				});

			</script>


		<!-- 弹出层 -->
	<!-- 	<div id="bgblock" style="width: 100%; height: 100%; position: fixed; top: 0px; left: 0px; z-index: 999; background-color: rgb(0, 0, 0); opacity: 0.6; display:none; background-position: initial initial; background-repeat: initial initial;"></div>

		<div id="ermblock" style="position: fixed; left: 427.5px; top: 10%; width: 1000px; height: 320px; z-index: 1000; display:none;">
			<div class="ermblock_main">
				<p><h2>添加提货人</h2></p>
				<form>
					<table cellspacing="0" align="center" class="table_form">
					<tbody><tr>
						<td class="tr fb" width="35%">提货人姓名：</td>
						<td class="four-content" colspan="3"><input type="text" name="pickman_name" maxlength="12" id="pickman_name" value=""> <span style="color:red;">*</span></td>
					</tr>
					<tr>
						<td class="tr fb">联系电话：</td>
						<td class="four-content" colspan="3"><input type="text" name="mobile" id="mobile" maxlength="14" value=""> <span style="color:red;">*</span></td>
					</tr>
						<tr>
						<td class="tr fb">身份证号码：</td>
						<td class="four-content" colspan="3"><input type="text" name="IDENTITY_NUM" id="IDENTITY_NUM" maxlength="18" value=""> <span style="color:red;">*</span></td>
					</tr>
					<tr>
						<td class="tr fb">车牌号码：</td>< <input type="text" name="truck_num" id="truck_num" value="" /> 
						<td class="four-content" colspan="3"><textarea id="truck_num" name="truck_num" maxlength="500" style="width: 153px; height: 50px;"></textarea> <span style="color:red;">* 多个以逗号分隔</span></td>
					</tr>
					</tbody></table>

						<div class="zhxi_con">	
							<span><input class="submit_zz" type="submit" value="提交"></span>
							<span><input class="submit_zz reset_zz" type="reset" value="返回" id="close"></span>
						</div>
				</form>
			</div>
		</div>
		
		<script type="text/javascript">
			 $(document).ready(function(){
			  $("#clickdd").click(function(){
			   $("#ermblock").show();
			   $("#bgblock").show();
			     });
			  $(document).click(function(e){
			   var target = $(e.target);
			   if(target.closest("#clickdd").length == 0){
			    $("#ermblock").hide();
			    $("#bgblock").hide();
			   }
			      }); 
			 }); 
		</script> -->
		<!-- 弹出层 --></div>

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
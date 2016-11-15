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
            <?php if($username){?>
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
            <div id="cont">﻿	
			<!--end左侧导航-->	
			<!--start中间内容-->	
			<div class="user_c_list">
				<div class="user_zhxi">
					<div class="zhxi_tit add">
						<p><a>交易管理</a>><a>我要申诉</a></p>

						<!-- <p class="backg_red">我要申诉</p> -->
					</div>
					<div class="chp_xx">
						<div class="xx_center">
							<table class="sales_table" border="0"  cellpadding="0" cellspacing="0">
								<tr class="first_tr">
								  <th>合同编号</th>
								  <th width="180px">产品名</th>
								  <th>价格</th>
								  <!-- <th>卖家</th> -->
								</tr>
								<tr>
								  <td colspan="6">&nbsp;</td>
								</tr>

								<tr>
									<td><div class="div_heights"> 
											<?php if($ContractData=='sell'){?>
											<a href="http://localhost/nn2/user/contract/sellerdetail/id/<?php echo $ContractData['id'];?>">
												<?php echo isset($ContractData['order_no'])?$ContractData['order_no']:"";?>
											</a>
											<?php }else{?>
												<a href="http://localhost/nn2/user/contract/buyerdetail/id/<?php echo $ContractData['id'];?>">
													<?php echo isset($ContractData['order_no'])?$ContractData['order_no']:"";?>
												</a>
											<?php }?>
										</div>
									</td> 
									<td>
										<div class="div_heights">

										
										 <p style="line-height:50px"><?php echo isset($ContractData['pname'])?$ContractData['pname']:"";?></p>
										</div>
									</td>
									<td>
										<div class="div_heights colaa0707">合同总额：￥<?php echo isset($ContractData['amount'])?$ContractData['amount']:"";?></div>

									</td>

									<!-- <td>
										<div class="div_heights Place"><span><?php echo isset($ContractData['sellcn']['username'])?$ContractData['sellcn']['username']:"";?></span> 

										</div>
										
									</td> -->

								</tr>
							</table>

							<div class="plaint_com">
							<form action="http://localhost/nn2/user/contract/complaincontract" id="signupForm"  method="post" auto_submit redirect_url="http://localhost/nn2/user/contract/complainlist">
						
							<p>
								<label for="title" style="text-align:left;"><span class="complain_title"><i>*</i>申诉标题：</span></label>
								<input  type="text" id="title" name="title" datatype="*" style="width:255px;">
							</p>
							<br />
							<p>
							   <label for="content"><span class="explain"><i>*</i>申诉说明：<br />(200字)</span> </label>
							   <span><textarea name="content" id="content" cols="30" rows="10" datatype="*" ></textarea></span>

							</p>

									
							  <span class="upload_img">&nbsp;上传凭证：</span>  
								 <div class="choose_img" >
									<script type="text/javascript" src="/nn2/user/js/webuploader/webuploader.js"></script>
<script type="text/javascript" src="/nn2/user/js/webuploader/upload.js"></script>
<link href="/nn2/user/js/webuploader/webuploader.css" rel="stylesheet" type="text/css" />
<link href="/nn2/user/js/webuploader/demo.css" rel="stylesheet" type="text/css" />


<div id="uploader" class="wu-example">
    <input type="hidden" name="uploadUrl" value="http://localhost/nn2/user/ucenter/upload" />
    <input type="hidden" name="swfUrl" value="/nn2/user/js/webuploader/Uploader.swf" />
    <!--用来存放文件信息-->
    <ul id="filelist" class="filelist">
        <?php if(isset($imgData)){?>
            <?php if(!empty($imgData)) foreach($imgData as $key => $item){?>
                <li   class="file-item thumbnail">
                    <p>
                        <img width="110" src="<?php echo \Library\thumb::get($item,110,110);?>" />

                    </p>
                    <input type="hidden" name="imgData[]" value="<?php echo isset($item)?$item:"";?>" />
                </li>
            <?php }?>
        <?php }?>
    </ul>
    <div class="btns">
        <?php $filesize = \Library\tool::getConfig(array('application','uploadsize')); ?>
        <?php if(!$filesize){?>
            <?php $filesize = 2048;; ?>
        <?php }?>
        <?php $filesize = $filesize / 1024;; ?>
        <div id="picker" style="line-height:15px;">选择文件</div>
        <span>每张图片大小不能超过<?php echo isset($filesize)?$filesize:"";?>M,双击图片可以删除</span>
        <div class="totalprogress" style="display:none;">
            <span class="text">0%</span>
            <span class="percentage"></span>
        </div>
        <div class="info"></div>
    </div>
</div>
								</div>
							 
                               <input type="hidden" name="orderId" value="<?php echo isset($ContractData['id'])?$ContractData['id']:"";?>" />
                               <input type="hidden" name="user_id" value="<?php echo isset($ContractData['user_id'])?$ContractData['user_id']:"";?>" />
                               <input type="hidden" name="offer_user" value="<?php echo isset($ContractData['offer_user'])?$ContractData['offer_user']:"";?>" />
                               <input type="hidden" name="type" value="<?php echo isset($ContractData['offer_type'])?$ContractData['offer_type']:"";?>" />
								<div class="subclear"><input name="submit" type="submit" value="提交申请">
									
								</div>
							</form>
							</div>
						</div>
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
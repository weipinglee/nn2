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
                <a rel="external nofollow" href="http://124.166.246.120:8000/user/public/index/index" target="_blank" >耐耐网首页</a>
            </div>

            <div class="index_user">
            <?php if(isset($username)){?>
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
                        <a href="http://localhost/nn2/user/contract/sellerlist">我的合同</a>
                    <?php }else{?>
                        <a href="http://localhost/nn2/user/contract/buyerlist">我的合同</a>
                    <?php }?>
                    <span class="line_l">|<span>
                </li>
                <?php }?>
                <li>
                    <a href="http://localhost/nn2/user/public/message/usermail">消息中心<?php if($mess!=0){?><em class="information"><?php echo isset($mess)?$mess:"";?></em><?php }?></a><span class="line_l">|<span>
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
                <a href="http://124.166.246.120:8000/user/public/index/index" alt="返回耐耐首页"><img src="/nn2/user/views/pc/images/icon/nainaiwang.png"/></a></dd>
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
            <div id="cont">
﻿<script type="text/javascript" src="/nn2/user/js/area/AreaData_min.js" ></script>
<script type="text/javascript" src="/nn2/user/js/area/Area.js" ></script>
			<!--start中间内容-->	
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>产品管理</a>><a>产品详情</a></p>
					</div>
					<div class="center_tabl">
                    <form action="http://localhost/nn2/user/managerdeal/ajaxsetstatus" method="post" auto_submit="1" redirect_url="http://localhost/nn2/user/managerdeal/productlist/index" >
					   <table class="table2" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="spmx_title" colspan="2">商品明细</td>
                            </tr>

                           <tr>
                               <td>商品标题</td>
                               <td><?php echo isset($product['product_name'])?$product['product_name']:"";?></td>
                           </tr>

                            <tr>
                                <td>产品大类</td>
                                 <td><?php echo isset($product['cate'][0]['name'])?$product['cate'][0]['name']:"";?></td>
                            </tr>
                           <tr>
                               <td>产品分类</td>
                               <td>
                                   <?php if(!empty($product['cate'])) foreach($product['cate'] as $key => $item){?>
                                        <?php if($key!=0){?>
                                            <?php if($key==1){?>
                                                <?php echo isset($item['name'])?$item['name']:"";?>
                                            <?php }else{?>
                                               > <?php echo isset($item['name'])?$item['name']:"";?>
                                            <?php }?>
                                        <?php }?>
                                   <?php }?>
                               </td>
                           </tr>
                            <tr>
                                <td>规格</td>
                                <td>
                                   <?php echo isset($product['attrs'])?$product['attrs']:"";?>
                                </td>
                            </tr>
                            <tr>
                                <td>产地</td>
                                <td id="areat">                    <span id="areatextareat">
                        <script type="text/javascript">
                         ( function(){
                            var areatextObj = new Area();
                            var text = areatextObj.getAreaText('<?php echo $product['produce_area'] ; ?>',' ');
                            $('#areatextareat').html(text);

                            })()
                        </script>
                     </span>

</td>
                            </tr>
                            <tr>
                                <td>申请时间</td>
                                <td><?php echo isset($product['create_time'])?$product['create_time']:"";?></td>
                            </tr>
                           <tr>
                               <td>过期时间</td>
                               <td><?php echo isset($offer['expire_time'])?$offer['expire_time']:"";?></td>
                           </tr>
                            <tr>

                                <td>产品数量(单位)</td>
                                <td class="end_td"><?php echo isset($product['quantity'])?$product['quantity']:"";?>（<?php echo isset($product['unit'])?$product['unit']:"";?>）</td>

                            </tr>
                            <tr>
                                <td class="spmx_title" colspan="2">报盘详情</td>
                            </tr>
                             <tr>
                                <td>报盘状态</td>
                                <td>

                                    <span class="col12aa07"><?php echo isset($offer['status_txt'])?$offer['status_txt']:"";?></span>

                                </td>
                            </tr>

                          <!--   <tr>
                              <td>交易类型</td>
                              <td>销售</td>
                          </tr>
                          <tr>
                              <td>担保类型</td>
                              <td>仓单</td>
                          </tr>
                          <tr>
                              <td>是否投保</td>
                              <td>是</td>
                          </tr>
                          <tr>
                              <td>支付方式</td>
                              <td>现汇</td>
                          </tr> -->
                          <tr>
                                <td>是否投保</td>
                                <td><?php if( $offer['insurance'] == 1){?>是<?php }else{?>否<?php }?></td>
                            </tr>
                             <?php if( $offer['insurance'] == 1){?>
                            <tr>
                                <td>投保产品</td>
                                <td>
                                     <?php if(!empty($riskData)) foreach($riskData as $key => $item){?>
                                      保险公司：<?php echo isset($item['company'])?$item['company']:"";?> - 保险产品：<?php echo isset($item['name'])?$item['name']:"";?> <?php if($item['mode']==1){?>比例 : (<?php echo isset($item['fee'])?$item['fee']:"";?>)<?php }else{?>定额 : (<?php echo isset($item['fee'])?$item['fee']:"";?>)<?php }?><br />
                                     <?php }?>
                                </td>
                            </tr>
                            <?php }?>
                            <tr>
                                <td>可否拆分</td>
                                <td><?php echo isset($offer['divide_txt'])?$offer['divide_txt']:"";?></td>
                            </tr>
                            <tr>

                                <td>报盘数量</td>
                                <td><?php echo isset($product['quantity'])?$product['quantity']:"";?></td>

                            </tr>
                           <tr>
                               <td>单位</td>
                               <td><?php echo isset($product['unit'])?$product['unit']:"";?></td>
                           </tr>
                           <?php if($offer['divide']==1){?>
                            <tr>
                                <td>起订量</td>
                                <td><?php echo isset($offer['minimum'])?$offer['minimum']:"";?></td>
                            </tr>
                               <tr>
                                   <td>最小递增量</td>
                                   <td><?php echo isset($offer['minstep'])?$offer['minstep']:"";?></td>
                               </tr>
                           <?php }?>
                            <tr>
                                <td>商品单价</td>
                                <td><?php echo isset($offer['price'])?$offer['price']:"";?>元</td>
                            </tr>
                            <tr>
                                <td>交货地址</td>
                                <td><?php echo isset($offer['accept_area'])?$offer['accept_area']:"";?></td>
                            </tr>
                           <tr>
                               <td>交收时间</td>
                               <td>T+<?php echo isset($offer['accept_day'])?$offer['accept_day']:"";?>天</td>
                           </tr>
                           <tr>
                               <td>记重方式</td>
                               <td><?php echo isset($offer['weight_type'])?$offer['weight_type']:"";?></td>
                           </tr>
                            <tr>
                                <td>产品描述</td>
                                <td><?php echo isset($product['note'])?$product['note']:"";?></td>
                            </tr>
                            <tr>
                                <td>补充条款</td>
                                <td><?php echo isset($offer['other'])?$offer['other']:"";?></td>
                            </tr>
                            <tr>
                                <td>产品图片</td>
                                <td>
                                <?php if(!empty($product['photos'])) foreach($product['photos'] as $key => $v){?>
                                    <img src="<?php echo isset($v)?$v:"";?>">
                                    <?php }?>

                                </td>
                            </tr>
                             <tr>
                                <td>审核意见</td>
                                <td><?php echo isset($offer['admin_msg'])?$offer['admin_msg']:"";?>
                                </td>
                            </tr>
                             <tr>
                                <td colspan="2">
                                   <input class="cg_fb" type="button" value="返回" onclick="history.go(-1)" style="float:left;"/>
                                  <input type="hidden" name="id" value="<?php echo isset($offer['id'])?$offer['id']:"";?>" />
                                  <?php if( ($product['quantity'] - $product['sell'] - $product['freeze']) > 0){?>
                                  <div class="pay_bton">
                                      <a href="javascript:void(0)" class="submit_chag"  id='pay_retainage'  confirm="1" confirm_text="确认撤销报盘？">撤销报盘</a>
                                  </div>
                                  <?php }?>
                                    <?php if(isset($updateUrl)){?>
                                        <a class="submit_chag"  href="<?php echo isset($updateUrl)?$updateUrl:"";?>" >修改<a/>
                                    <?php }?>
                                </td>
                            </tr>
                        </table>
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
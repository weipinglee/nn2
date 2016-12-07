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
            <div id="cont">﻿<?php if( $stop == 1){?>
<div class="user_c_list">    
<img src="/nn2/user/views/pc/images/weituo.png" style="width:100%;">
</div>

<?php }else{?>

<script type="text/javascript" src="/nn2/user/js/area/AreaData_min.js" ></script>
<script type="text/javascript" src="/nn2/user/js/area/Area.js" ></script>
<script type="text/javascript" src="/nn2/user/js/upload/ajaxfileupload.js"></script>
<script type="text/javascript" src="/nn2/user/js/upload/upload.js"></script>
<div class="class_jy" id="cate_box" style="display:none;">
    <span class="jy_title"></span>
    <ul>
        <!-- <li value=""   class="a_choose" ><a></a></li>
-->
    </ul>

    <ul class="infoslider" style="display: none;">
        <li value=""   class="a_choose"  ><a></a></li>

    </ul>
    <div class="sl_ext">
     <!--   <a href="javascript:;" class="sl_e_more info-show" style="visibility: visible;">展开</a>-->
    </div>

</div>

       <input type="hidden" name="attr_url" value="http://localhost/nn2/user/managerdeal/ajaxgetcategory"  />
<script type="text/javascript" src="/nn2/user/views/pc/js/product/attr.js" ></script>
            <div class="user_c">
                <div class="user_zhxi pro_classify">
                    <div class="zhxi_tit">
                        <p><a>产品管理</a>><a>委托报盘</a></p>
                    </div>
                    <div class="center_tabl">
                    <div class="lx_gg">
                        <b>商品类型</b>
                    </div>

                      <?php if( !empty($categorys)){?>

                        <?php if(!empty($categorys)) foreach($categorys as $level => $category){?>
                            <div class="class_jy" id="level<?php echo isset($level)?$level:"";?>">
                                <span class="jy_title">
                                    <?php if( isset($childName)){?>
                                        <?php echo isset($childName)?$childName:"";?>：
                                    <?php }else{?>
                                        市场类型：
                                    <?php }?>
                                </span>
                                <ul>
                                    <?php if(!empty($category['show'])) foreach($category['show'] as $key => $cate){?>
                                    <li value="<?php echo isset($cate['id'])?$cate['id']:"";?>"  <?php if( $key==0){?> class="a_choose" <?php }?> ><a><?php echo isset($cate['name'])?$cate['name']:"";?></a></li>
                                    <?php if( $key == 0){?>
                                    <?php  $childName = $cate['childname']; ?>
                                    <?php }?>
                                    <?php }?>
                                </ul>


                            </div>
                        <?php }?>
                        <?php }?>
                        <input type="hidden" name="uploadUrl"  value="http://localhost/nn2/user/ucenter/upload" />
                    <form action="http://localhost/nn2/user/managerdeal/dodeputeoffer" method="POST" auto_submit redirect_url="http://localhost/nn2/user/managerdeal/indexoffer">
                        <table border="0" >

    <tr>
        <th colspan="3">基本挂牌信息</th>
    </tr>
    <tr>
        <td nowrap="nowrap"><span></span>商品标题：</td>
        <td colspan="2">
            <span><input class="text" type="text" datatype="s1-30" value="<?php echo isset($product['product_name'])?$product['product_name']:"";?>" errormsg="填写商品标题" name="warename"></span>
            <span></span>
        </td>

    </tr>
    <tr>
        <td nowrap="nowrap"><span></span>商品单价：</td>
        <td>
            <span> <input class="text" type="text" datatype="money" value="<?php echo isset($offer['price'])?$offer['price']:"";?>" errormsg="请正确填写单价" name="price"></span>
            <span></span>
        </td>
        <!--                                 <td>
            请选择付款方式：
            <input type ="radio" name ="safe" checked="checked" style="width:auto;height:auto;"> 线上
            <input type ="radio" name ="safe" style="width:auto;height:auto;"> 线下
        </td> -->
    </tr>
    <tr>
        <td nowrap="nowrap"><span></span>数量：</td>
        <td>
            <span><input class="text" value="<?php echo isset($product['quantity'])?$product['quantity']:"";?>" type="text" datatype="/^\d{1,10}(\.\d{0,5})?$/" errormsg="请正确填写数量" name="quantity"></span>
            <span></span>
        </td>
        <span></span>
        <!--  <td>
            请选择支付保证金比例：
            <input type="button" id="jian" value="-"><input type="text" id="num" value="1"><input type="button" id="add" value="+">

        </td> -->
    </tr>
    <tr>
        <td nowrap="nowrap"><span></span>单位：</td>
        <td>
            <input class="text" type="text" name="unit" value="<?php echo isset($product['unit'])?$product['unit']:"";?>"/>
        </td>
        <!--  <td>
            请选择支付保证金比例：
            <input type="button" id="jian" value="-"><input type="text" id="num" value="1"><input type="button" id="add" value="+">

        </td> -->
    </tr>

    <tr style="display:none" id='productAdd'>
                            <td ></td>
                            <td ></td>
     </tr>
                            
    <!-- <tr>
        <td nowrap="nowrap"><span></span>是否投保：</td>
        <td>
            <span> <input type="radio" name="insurance" value="1"  checked="true">是 <input type="radio" name="insurance" value="0" >否</span>
        </td>
    </tr>

    <tr id="riskdata" >
        <td ><span></span>保险：</td>
        <td>
            <span> 

            </span>
        </td>
    </tr> -->
    <input type="hidden" name="cate_id" id="cid">
    <input type="hidden" name="ajax_url" id="ajax_url" value="http://localhost/nn2/user/trade/insurance/ajaxgetcate">

    <tr>
        <td>产地：</td>
        <td colspan="2">
            <span id="areabox">                <script type="text/javascript">
                 areaObj = new Area();

                  $(function () {
                     areaObj.initComplexArea('seachprov', 'seachcity', 'seachdistrict', '<?php echo $product['produce_area'] ; ?>','area');
                  });
                </script>
			 <select  id="seachprov"  onchange=" areaObj.changeComplexProvince(this.value, 'seachcity', 'seachdistrict');">
              </select>&nbsp;&nbsp;
              <select  id="seachcity"  onchange=" areaObj.changeCity(this.value,'seachdistrict','seachdistrict');">
              </select>&nbsp;&nbsp;<span id='seachdistrict_div' >
               <select   id="seachdistrict"  onchange=" areaObj.changeDistrict(this.value);">
               </select></span>
               <input type="hidden"  name="area"  alt="" value='<?php echo $product['produce_area'] ; ?>' />
                <span></span></span>
            <span></span>
        </td>

    </tr>

    <tr>
        <td>有效期：</td>
        <td colspan="2">
             <span><input class="Wdate text" datatype="*" value="<?php echo isset($offer['expire_time'])?$offer['expire_time']:"";?>" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd',minDate:'%y-%M-#{%d+1}'})"
                           name="expire_time" value="">
                           有效期不能超过二十年
                 </span>
            <span></span>
        </td>

    </tr>


    <tr>
        <td style="vertical-align:top;">上传图片：</td>
        <td>

            <script type="text/javascript" src="/nn2/user/js/webuploader/webuploader.js"></script>
            <script type="text/javascript" src="/nn2/user/js/webuploader/upload.js"></script>
            <link href="/nn2/user/js/webuploader/webuploader.css" rel="stylesheet" type="text/css" />
            <link href="/nn2/user/js/webuploader/demo.css" rel="stylesheet" type="text/css" />


            <div id="uploader" class="wu-example">
                <input type="hidden" name="uploadUrl" value="http://localhost/nn2/user/ucenter/upload" />
                <input type="hidden" name="swfUrl" value="/nn2/user/js/webuploader/Uploader.swf" />
                <!--用来存放文件信息-->
                <ul id="filelist" class="filelist">
                    <?php if(isset($product['imgData'])){?>
                        <?php if(!empty($product['imgData'])) foreach($product['imgData'] as $key => $item){?>
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
                    <div id="picker" style="line-height:15px;">选择文件</div><span>每张图片大小不能超过<?php echo isset($filesize)?$filesize:"";?>M,双击图片可以删除</span>
                    <div class="totalprogress" style="display:none;">
                        <span class="text">0%</span>
                        <span class="percentage"></span>
                    </div>
                    <div class="info"></div>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <th colspan="3"><b>详细信息</b></th>
    </tr>

    <tr>
        <td><span>*</span>是否可拆分：</td>
        <td>
            <select name="divide" id="divide">
                <option value="1"  >是</option>
                <option value="0" <?php if($offer['divide']==0){?>selected<?php }?>>否</option>
            </select>
        </td>
    </tr>
    <tr class='nowrap' <?php if(!isset($offer['divide']) || $offer['divide']==0){?>style="display: none"<?php }?>>
        <td nowrap="nowrap" ><span>*</span>最小起订量：</td>
        <td>
            <span><input name="minimum" id="" type="text" class="text" value="<?php echo isset($offer['minimum'])?$offer['minimum']:"";?>" /></span>
            <span></span>
        </td>
    </tr>
    <tr class='nowrap' <?php if(!isset($offer['divide']) || $offer['divide']==0){?>style="display: none"<?php }?>>
        <td nowrap="nowrap" ><span>*</span>最小递增量：</td>
        <td>
            <span><input name="minstep" id="" type="text" class="text" value="<?php echo isset($offer['minstep'])?$offer['minstep']:"";?>" /></span>
            <span></span>
        </td>
    </tr>
    <tr>
        <td><span>*</span>交收地点：</td>
        <td colspan="2">

            <span><input type="text" class='text' datatype="s1-30" value="<?php echo isset($offer['accept_area'])?$offer['accept_area']:"";?>" errormsg="请填写有效地址" nullmsg="请填写交收地点" name="accept_area"></span>

            <span></span>
        </td>
    </tr>
    <tr>
    <td><span>*</span>交收时间：</td>
    <td colspan="2">
        <span>T+<input type="text" class='text' datatype="/[1-9]\d{0,5}/" value="<?php echo isset($offer['accept_day'])?$offer['accept_day']:"";?>" name="accept_day" style="width:50px;">天</span>
        <span></span>
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
        <!--  <td>是否投保：</td>
         <td colspan="2">
<input type ="radio" name ="safe" checked="checked" style="width:auto;height:auto;">投保
<input type ="radio" name ="safe" style="width:auto;height:auto;"> 不投保
         </td>
     </tr>  -->
    <tr>
        <td>产品描述：</td>
        <td colspan="2">
            <textarea name="note" ><?php echo isset($product['note'])?$product['note']:"";?></textarea>
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
                                <td>
                                    <span>

                                        <div>请您下载<a href="/nn2/user/down/耐耐网委托报盘协议书.docx" style="color:#1852ca;font-size:14px;">《耐耐网委托报盘协议书》</a>，并签字扫描上传

                                         </div>
                                       <div class="zhxi_con">

                                           <div>
                                               <input type="file" name="file1" id="file1"  onchange="javascript:uploadImg(this);" />

                                           </div>
                                           <div  >
                                               <img name="file1" src=""/>
                                               <input type="hidden"  name="imgfile1" value=""  alt="请上传图片" />
                                           </div>


                                       </div>
                                    </span>
                                </td>
                            </tr>
                        <tr>
                            <td></td>
                            <td colspan="2" class="btn">
                            <input type="hidden" name='cate_id' id="cate_id" value="<?php echo isset($cate_id)?$cate_id:"";?>">
                            <input type="hidden" name='mode' id="mode" value="weitou">
                                <input type="hidden" name="token" value="<?php echo isset($token)?$token:"";?>" />
                                <input  type="submit"  value="提交审核" />
                                <?php if($is_vip){?>
                                    <span class="color">您是收费会员,无需支付委托费</span>
                                <?php }else{?>
                                    <span class="color">需在线下支付总金额的<span id='weitou'><?php if(!empty($rate)){?><?php echo isset($rate['value'])?$rate['value']:"";?><?php if($rate['type'] == 0){?>%<?php }else{?>元<?php }?><?php }else{?>0<?php }?></span>的委托金</span>
                                <?php }?>
                            </td>
                        </tr>

                 </table>
                </form>

                    </div>
                </div>
            </div>

<?php }?>


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
<!DOCTYPE html>
<html>
<head>
  <title>个人中心</title>
  <meta name="keywords"/>
  <meta name="description"/>
  <meta charset="utf-8">
  <link href="http://localhost/nn2/user/public/views/pc/css/user_index.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="http://localhost/nn2/user/public/js/jquery/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="http://localhost/nn2/user/public/js/autovalidate/validate.js" ></script>
	<link href="http://localhost/nn2/user/public/js/autovalidate/style.css" rel="stylesheet" type="text/css">



  <script language="javascript" type="text/javascript" src="http://localhost/nn2/user/public/views/pc/js/My97DatePicker/WdatePicker.js"></script>
  <script type="text/javascript" src="http://localhost/nn2/user/public/views/pc/js/regular.js"></script>
   <script src="http://localhost/nn2/user/public/views/pc/js/center.js" type="text/javascript"></script>
  <link href="http://localhost/nn2/user/public/views/pc/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
   <!-- 头部控制 -->
  <link href="http://localhost/nn2/user/public/views/pc/css/topnav20141027.css" rel="stylesheet" type="text/css">
  <script src="http://localhost/nn2/user/public/views/pc/js/topnav20141027.js" type="text/javascript"></script>
    <!-- 头部控制 -->
</head>
<body>
<!--    公用头部控件 -->
    <div class="bg_topnav">
    <div class="topnav_width">
        <div class="topnav_left">
            <div class="login_link" id="toploginbox">
                <a rel="external nofollow" href="login.html" target="_blank" class="topnav_login">登录</a>
                <div class="login_box" id="login_boxMain" style="display: none;">
                    <input name="gtxh_LoginMobile" type="text" id="gtxh_LoginMobile" class="txt_topnav" value="手机号码" maxlength="11">
                    <br>
                    <input type="text" id="gtxh_importpwd" class="txt_topnav" value="登录密码" maxlength="11">
                    <input name="gtxh_LoginPwd" type="password" id="gtxh_LoginPwd" maxlength="20" style=" display:none;">
                    <br>
                    <input type="button" value="登录" id="gtxh_btnLogin" class="btn_topnav_login" onclick="javascript:_utaq.push(['trackEvent','btn-log']);">
                    &nbsp;
                    <input name="gtxh_autoLogin" type="checkbox" id="gtxh_autoLogin" style="vertical-align: middle" checked="checked">
                    <label for="checkbox">两周内自动登录</label>
                    <br>
                    <a href="PasswordReset.html" target="_blank">忘记密码</a> <a href="register.html" target="_blank">立即注册</a>
                </div>
                <div class="topnav_regsiter" style=" float:right;">
                    <a rel="external nofollow" href="register.html" target="_blank">免费注册</a>
                </div>
            </div>
            <div class="topnav_login_in" id="userCenterbox" style="display: none;">
                您好，<label class="icon_topnav_loginin" id="gtxh_uame"></label>
                <a id="userCenter" href="centre/user_index.html" target="_blank">会员中心</a>
                <a id="loginOut" href="javascript:">退出</a>
                <iframe id="iframe_loginOut" frameborder="0" height="1" width="1" scrolling="no"></iframe>
            </div>
        </div>
        <div class="topnav_right">
            <ul>
                <li>
                    <div class="top_app" id="topPhone">
                        <a href="javascript:;"><em class="icons iphone"></em><span>手机APP</span></a>
                        <a rel="external nofollow" href="http://app.nainaiwang.com/" class="top_a" target="_blank" style="display:none !important;visibility: hidden"><!--<em class="icons zz"></em>--><i style="font-size:14px;">▪</i><span>掌中耐耐APP</span></a>
                    </div>
                </li>
                <li>
                    <div class="popueButton">
                        <a href="javascript:window.external.AddFavorite('http://www.nainaiwang.com', '耐耐网——大宗商品交易中心')">加入收藏</a>
                    </div>
                </li>
                <li>
                    <div class="popueButton">
                        <div id="popue_quick">
                            网站导航<b> </b></div>
                    </div>
                    <div class="popuePanel" id="quickPanel" style="display: none;">
                        <div class="quick_market">
                            <b>产品分类</b><br>
                            <span>耐火市场 </span>&nbsp; 
                            <a href="http://market.nainaiwang.com/#sortId=2394&amp;nsortId=2411" target="_blank">低合金板</a>
                            <a href="http://market.nainaiwang.com/#sortId=2394&amp;nsortId=2414" target="_blank">容器板</a>
                            <a href="http://market.nainaiwang.com/#sortId=2394&amp;nsortId=2406" target="_blank">热轧开平板</a>
                            <a href="http://market.nainaiwang.com/#sortId=2394&amp;nsortId=2410" target="_blank">中厚板</a><br>
                            <span>建材市场 </span>&nbsp; 
                            <a href="http://market.nainaiwang.com/#sortId=2403&amp;nsortId=2405" target="_blank">热轧卷板</a>
                            <a href="http://market.nainaiwang.com/#sortId=2403&amp;nsortId=2592" target="_blank">镀锌带钢</a>
                            <a href="http://market.nainaiwang.com/#sortId=2403&amp;nsortId=2415" target="_blank">冷轧卷板</a>
                            <a href="http://market.nainaiwang.com/#sortId=2403&amp;nsortId=2603" target="_blank">低合金卷</a><br>
                            <span>钢铁市场 </span>&nbsp; 
                            <a href="http://market.nainaiwang.com/#sortId=2395&amp;nsortId=2475" target="_blank">等边角钢</a>
                            <a href="http://market.nainaiwang.com/#sortId=2395&amp;nsortId=2423" target="_blank">H型钢</a>
                            <a href="http://market.nainaiwang.com/#sortId=2395&amp;nsortId=2421" target="_blank">槽钢</a>
                            <a href="http://market.nainaiwang.com/#sortId=2395&amp;nsortId=2422" target="_blank">工字钢</a><br>
                            <span>冶金化工 </span>&nbsp; 
                            <a href="http://market.nainaiwang.com/#sortId=2397&amp;nsortId=2434" target="_blank">无缝管</a>
                            <a href="http://market.nainaiwang.com/#sortId=2397&amp;nsortId=2435" target="_blank">方管</a>
                            <a href="http://market.nainaiwang.com/#sortId=2397&amp;nsortId=2433" target="_blank">镀锌管</a>
                            <a href="http://market.nainaiwang.com/#sortId=2397&amp;nsortId=2432" target="_blank">焊管</a><br>
                            <span>其他市场 </span>&nbsp; 
                            <a href="http://market.nainaiwang.com/#sortId=2396&amp;nsortId=2427" target="_blank">螺纹钢</a>
                            <a href="http://market.nainaiwang.com/#sortId=2396&amp;nsortId=2429" target="_blank">圆钢</a>
                            <a href="http://market.nainaiwang.com/#sortId=2396&amp;nsortId=2430" target="_blank">高线</a>
                            <a href="http://market.nainaiwang.com/#sortId=2396&amp;nsortId=2522" target="_blank">盘螺</a><br>
                            <span>核心企业 </span>&nbsp; 
                            <a href="http://market.nainaiwang.com/#sortId=2398&amp;nsortId=2440" target="_blank">合结圆</a>
                            <a href="http://market.nainaiwang.com/#sortId=2398&amp;nsortId=2439" target="_blank">碳结圆</a>
                            <a href="http://market.nainaiwang.com/#sortId=2398&amp;nsortId=2631" target="_blank">合金钢</a>
                            <a href="http://market.nainaiwang.com/#sortId=2398&amp;nsortId=2458" target="_blank">轴承钢</a><br>
                            <span>仓储专区 </span>&nbsp; 
                            <a href="http://market.nainaiwang.com/#sortId=2398&amp;nsortId=2440" target="_blank">合结圆</a>
                            <a href="http://market.nainaiwang.com/#sortId=2398&amp;nsortId=2439" target="_blank">碳结圆</a>
                            <a href="http://market.nainaiwang.com/#sortId=2398&amp;nsortId=2631" target="_blank">合金钢</a>
                            <a href="http://market.nainaiwang.com/#sortId=2398&amp;nsortId=2458" target="_blank">轴承钢</a>
                        </div>
                        <div class="quick_info">
                            <div class="quick_city">
                                <b>地区分站</b><br>
                                <a href="http://news.nainaiwang.com/xianhuojiage.html#areaName=%E4%B8%8A%E6%B5%B7" target="_blank">上海</a>
                                <a href="http://news.nainaiwang.com/xianhuojiage.html#areaName=%E6%9D%AD%E5%B7%9E" target="_blank">杭州</a>
                                <a href="http://news.nainaiwang.com/xianhuojiage.html#areaName=%E6%97%A0%E9%94%A1" target="_blank">无锡</a>
                                <a href="http://news.nainaiwang.com/xianhuojiage.html#areaName=%E9%83%91%E5%B7%9E" target="_blank">郑州</a>
                                <a href="http://news.nainaiwang.com/xianhuojiage.html#areaName=%E6%AD%A6%E6%B1%89" target="_blank">武汉</a>
                                <a href="http://news.nainaiwang.com/xianhuojiage.html#areaName=%E9%95%BF%E6%B2%99" target="_blank">长沙</a><br>
                                <a href="http://news.nainaiwang.com/xianhuojiage.html#areaName=%E5%B9%BF%E5%B7%9E" target="_blank">广州</a>
                                <a href="http://news.nainaiwang.com/xianhuojiage.html#areaName=%E5%94%90%E5%B1%B1" target="_blank">唐山</a>
                                <a href="http://news.nainaiwang.com/xianhuojiage.html#areaName=%E6%88%90%E9%83%BD" target="_blank">成都</a>
                                <a href="http://news.nainaiwang.com/xianhuojiage.html#areaName=%E9%82%AF%E9%83%B8" target="_blank">邯郸</a>
                                <a href="http://news.nainaiwang.com/xianhuojiage.html#areaName=%E9%87%8D%E5%BA%86" target="_blank">重庆</a>
                                <a href="http://news.nainaiwang.com/xianhuojiage.html#areaName=%E5%A4%A9%E6%B4%A5" target="_blank">天津</a>
                            </div>
                            <b>信息行情</b><br>
                            <a href="http://news.nainaiwang.com/xianhuojiage.html" target="_blank">现货价格</a>
                            <a href="http://news.nainaiwang.com/gangweizixun.html" target="_blank">钢为资讯</a>
                            <a href="http://news.nainaiwang.com/hangyefenxi.html" target="_blank">行业分析</a><br>
                            <a href="http://news.nainaiwang.com/jiageyuce.html" target="_blank">价格预测</a>
                            <a href="http://news.nainaiwang.com/gangchangtiaojia.html" target="_blank">钢厂调价</a>
                            <a href="http://news.nainaiwang.com/yuancailiao.html" target="_blank">原材料</a>
                            <div class="quick_info_bottom">
                                <span><a href="http://market.nainaiwang.com/brand.html" target="_blank">品牌店</a></span>
                                <span><a href="http://bbs.nainaiwang.com/" target="_blank">耐耐朋友圈</a></span>
                                <span class="red"> <a href="http://app.nainaiwang.com/" target="_blank">掌中耐耐APP</a></span>
                            </div>
                        </div>
                    </div>
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
                <a href="../index.html" alt="返回耐耐首页"><img src="http://localhost/nn2/user/public/views/pc/images/icon/nainaiwang.png"/></a></dd>
            </div>
			<div class="nav-tit">
		<ul class="nav-list">
			<?php foreach($topArray as $key => $topList){?>
				<li>
		                        <a href="<?php echo isset($topList['url'])?$topList['url']:"";?>" <?php if( $topList['isSelect']){?> class="cur" <?php }?>><?php echo isset($topList['title'])?$topList['title']:"";?></a>
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
                <div class="left_navigation">
                    <ul>
                    	<?php foreach($leftArray as $k => $leftList){?>
                    	<li class="btn1" id="btn{k}">
                    		<?php if( $k == 0){?>
                    		<li class="let_nav_tit"><span class="line"></span><h3><?php echo isset($leftList['name'])?$leftList['name']:"";?></h3></li>
                    		<?php }else{?>
                    			<?php if( empty($leftList['url'])){?>
					<a class="nav-first"><i class="icon-caret-down"></i><?php echo isset($leftList['name'])?$leftList['name']:"";?></a>
                    			<?php }else{?>
                    			<a class="nav-first" href="<?php echo isset($leftList['url'])?$leftList['url']:"";?>"><i class="icon-caret-down"></i><?php echo isset($leftList['name'])?$leftList['name']:"";?></a>
                    			<?php }?>
                    		
                    		<?php }?>
                    		
                    		<?php if( !empty($leftList['list'])){?>
                    			<ul class="zj_zh" id="zj_zh{k}">
                    				<?php foreach($leftList['list'] as $key => $list){?>
                    					<li><a href="<?php echo isset($list['url'])?$list['url']:"";?>"><?php echo isset($list['title'])?$list['title']:"";?></a></li>
                    				<?php }?>
                    			</ul>
				<?php }?>
			</li>  
                    	<?php }?>
                        
                      
                    </ul>
                </div>
            </div>
            <!--end左侧导航-->  
	﻿<script type="text/javascript" src="http://localhost/nn2/user/public/js/area/AreaData_min.js" ></script>
<script type="text/javascript" src="http://localhost/nn2/user/public/js/area/Area.js" ></script>

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
        <a href="javascript:;" class="sl_e_more info-show" style="visibility: visible;">展开</a>
    </div>

</div>

       <input type="hidden" name="attr_url" value="http://localhost/nn2/user/public/index.php//managerdeal/ajaxgetcategory"  />
<script type="text/javascript" src="http://localhost/nn2/user/public/views/pc/js/product/attr.js" ></script>
            <!--start中间内容-->    
            <div class="user_c">
                <div class="user_zhxi">
                    <div class="zhxi_tit">
                        <p><a>产品管理</a>><a>商品分类</a></p>
                    </div>
                    <div class="center_tabl">
                    <div class="lx_gg">
                        <b>商品类型和规格</b>
                    </div>

                    <?php if( !empty($categorys)){?>
                        <?php foreach($categorys as $level => $category){?>   
                            <div class="class_jy" id="level<?php echo isset($level)?$level:"";?>">
                                <span class="jy_title">市场类型：</span>
                                <ul>
                                    <?php foreach($category['show'] as $key => $cate){?>
                                    <li value="<?php echo isset($cate['id'])?$cate['id']:"";?>"  <?php if( $key=0){?> class="a_choose" <?php }?> ><a><?php echo isset($cate['name'])?$cate['name']:"";?></a></li>
                                    <?php }?>
                                </ul>

                                    <?php if( !empty($category['hide'])){?>
                                    <ul class="infoslider" style="display: none;">
                                        <?php foreach($category['hide'] as $key => $cate){?>
                                        <li value="<?php echo isset($cate['id'])?$cate['id']:"";?>"  <?php if( $key=0){?> class="a_choose" <?php }?> ><a><?php echo isset($cate['name'])?$cate['name']:"";?></a></li>
                                        <?php }?>
                                    </ul>
                                        <div class="sl_ext">
                                        <a href="javascript:;" class="sl_e_more info-show" style="visibility: visible;">展开</a>
                                        </div>
                                    <?php }?>
                            </div>
                        <?php }?>
                        <?php }?>


                    <form action="http://localhost/nn2/user/public/index.php//managerdeal/dostoreproduct" method="POST">
                        <table border="0"  id='productAdd'>
                            <?php foreach($attrs as $key => $attr){?>

                                    <tr class="attr">
                                        <td nowrap="nowrap"><span></span><?php echo isset($attr['name'])?$attr['name']:"";?>：</td>
                                        <td colspan="2">
                                            <input class="text" type="text" name="attribute[<?php echo isset($attr['id'])?$attr['id']:"";?>]" >
                                        </td>
                                    </tr>


                            <?php }?>
                            <tr>
                               <th colspan="3">基本挂牌信息</th>
                            </tr>
                            <tr>
                            <td nowrap="nowrap"><span></span>商品标题：</td>
                            <td colspan="2"> 
                                <input class="text" type="text" name="warename">
                            </td>
                        </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>商品单价:</td>
                                <td> 
                                    <input class="text" type="text" name="price">
                                    
                                </td>
<!--                                 <td> 
    请选择付款方式：
    <input type ="radio" name ="safe" checked="checked" style="width:auto;height:auto;"> 线上
    <input type ="radio" name ="safe" style="width:auto;height:auto;"> 线下
</td> -->
                            </tr>
                            <tr>
                                <td nowrap="nowrap"><span></span>数量:</td>
                                <td> 
                                    <input class="text" type="text" name="quantity">(吨)
                                </td>
                               <!--  <td> 
                                   请选择支付保证金比例：
                                   <input type="button" id="jian" value="-"><input type="text" id="num" value="1"><input type="button" id="add" value="+">
                                           
                               </td> -->

                                <tr>
                            <td>产地:</td>
                            <td colspan="2">
                                                <script type="text/javascript">
                 areaObj = new Area();

                  $(function () {
                     areaObj.initComplexArea('seachprov', 'seachcity', 'seachdistrict', 'getAreaData()','area');
                  });
                </script>
			 <select  id="seachprov"  onchange=" areaObj.changeComplexProvince(this.value, 'seachcity', 'seachdistrict');">
              </select>&nbsp;&nbsp;
              <select  id="seachcity"  onchange=" areaObj.changeCity(this.value,'seachdistrict','seachdistrict');">
              </select>&nbsp;&nbsp;<span id='seachdistrict_div' >
               <select   id="seachdistrict"  onchange=" areaObj.changeDistrict(this.value);">
               </select></span>
               <input type="hidden" name="area"  alt="请选择地区" value='getAreaData()' />

                            </td>
                         
                        </tr>
                            
                               
                            
                            <tr>
                                <td>图片预览：</td>
                                <td colspan="2">
                                    <span class="zhs_img" id='imgContainer'>

                                    </span>
                                </td>              
                            </tr>
                            <tr>
                                <td>上传图片：</td>
                                <td>
                                    <span>
                                        <div>

                                            <input id="pickfiles"  type="button" value="选择文件">
                                            <input type="button"  id='uploadfiles' class="tj" value="上传">
                                        </div>
                                        <div id="filelist"></div>
                                        <pre id="console"></pre>
                                    </span> 
                                 </td>
                             </tr>
                         <tr>
                             <th colspan="3"><b>详细信息</b></th>
                        </tr>


                                 </tr>
                                    <tr>
                                        <td><span>*</span>选择仓库：</td>
                                        <td>
                                            <select name="store_id" id="store_id">
                                            <?php foreach($storeList as $key => $list){?>
                                                <option value="<?php echo isset($list['id'])?$list['id']:"";?>" <?php if( $key==0){?> selected <?php }?> ><?php echo isset($list['name'])?$list['name']:"";?></option>
                                            <?php }?>
                                            </select>
                                        </td>
                                        </tr>
                                   <tr>
                                        <td>是否包装：</td>
                                        <td colspan="2">
                                            <select name="package" id="package">
                                                <option value="1" selected="selected">是</option>
                                                <option value="0">否</option>
                                            </select>
                                        </td>

                                             </tr>

                                            <tr id="packUnit" >
                                                 <td>计量单位：</td>
                                            <td colspan="2">
                                                <input type="text" class='text' name="packUnit">
                                            </td>
                                            </tr>
                                            <tr id='packNumber'>
                                            <td>包装数量：</td>
                                            <td colspan="2">
                                                <input type="text" class='text' name="packNumber">
                                            </td>
                                            </tr>
                                            <tr id='packWeight'>
                                            <td>包装重量：</td>
                                            <td colspan="2">
                                                <input type="text" class='text' name="packWeight">
                                            </td>
                                            </tr>


<!--                               <tr>
                            <td>是否投保：</td>
                            <td colspan="2">
  <input type ="radio" name ="safe" checked="checked" style="width:auto;height:auto;">投保
      <input type ="radio" name ="safe" style="width:auto;height:auto;"> 不投保
                            </td>
                        </tr> -->
                        <tr>
                            <td>产品描述：</td>
                            <td colspan="2">
                                <textarea name="note"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td colspan="2" class="btn">
                            <input type="submit" value='submit'>
                            <input type="hidden" name='cate_id' id="cate_id" value="<?php echo isset($cate_id)?$cate_id:"";?>">
                                <a href="javascript:void(0);" onclick="checkform()">提交审核</a> 

                                
                            </td>
                        </tr>
                         
                 </table>
                </form>
                        
                    </div>
                </div>
            </div>

            <?php echo isset($plupload)?$plupload:"";?>



				<!--end中间内容-->	
			<!--start右侧广告-->			
			<div class="user_r">
				<div class="wrap_con">
					<div class="tit clearfix">
						<h3>公告</h3>
					</div>
					<div class="con">
						<div class="con_medal clearfix">
							<ul>
								<li><a>暂无勋章</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!--end右侧广告-->
		</div>
	</div>
</body>
</html>
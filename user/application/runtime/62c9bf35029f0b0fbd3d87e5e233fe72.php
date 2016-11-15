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
            <div id="cont">
<script type="text/javascript" src="/nn2/user/js/area/Area.js" ></script>
<script type="text/javascript" src="/nn2/user/js/area/AreaData_min.js" ></script>
<script type="text/javascript" src="/nn2/user/js/upload/ajaxfileupload.js"></script>
<script type="text/javascript" src="/nn2/user/js/upload/upload.js"></script>
<script type="text/javascript" src="/nn2/user/views/pc/js/cert/cert.js"></script>
<input type="hidden" name="uploadUrl"  value="http://localhost/nn2/user/ucenter/upload" />
			<div class="user_c">
				<div class="user_zhxi">

					<div class="zhxi_tit">
						<p><a>账户管理</a>><a>身份认证</a>><a>企业认证</a></p>
					</div>
					<div class="rz_title">
						<ul class="rz_ul">
							<li class="rz_start"></li>
							<li class="rz_li cur"><a class="rz">认证信息</a></li>
							<li class="rz_li"><a class="yz">资质照片</a></li>
							<li class="rz_li"><a class="shjg">审核结果</a></li>
							<li class="rz_end"></li>
						</ul>

					</div>
					<form method="post" action="http://localhost/nn2/user/ucenter/dodealcert" auto_submit>
					<div class="re_xx">

						<!--公司信息-->
						<?php if($userType==1){?>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>公司名：</span>
								<span>
									<input class="text" type="text" name="company_name" datatype="s2-20" errormsg="请输入2-20位中文或字母数字下划线点" value="<?php echo isset($certData['company_name'])?$certData['company_name']:"";?>"/>
								</span>
								<span></span>
							</div>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>法定代表人：</span>
							<span>
								<input class="text" type="text" name="legal_person" datatype="zh2-20" errormsg="请输入2-20个中文字符" value="<?php echo isset($certData['legal_person'])?$certData['legal_person']:"";?>"/>
							</span>
								<span></span>
							</div>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>联系人：</span>
							<span>
								<input class="text" type="text" name="contact" datatype="zh2-20" errormsg="请输入2-20个中文字符" value="<?php echo isset($certData['contact'])?$certData['contact']:"";?>"/>
							</span>
								<span></span>
							</div>

							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>联系电话：</span>
							<span>
								<input class="text" type="text" name="phone" datatype="mobile" value="<?php echo isset($certData['contact_phone'])?$certData['contact_phone']:"";?>"/>
							</span>
								<span></span>
							</div>

							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>地区：</span>
								<span id="areabox">
										                <script type="text/javascript">
                 areaObj = new Area();

                  $(function () {
                     areaObj.initComplexArea('seachprov', 'seachcity', 'seachdistrict', '<?php echo $certData['area'] ; ?>','area');
                  });
                </script>
			 <select  id="seachprov"  onchange=" areaObj.changeComplexProvince(this.value, 'seachcity', 'seachdistrict');">
              </select>&nbsp;&nbsp;
              <select  id="seachcity"  onchange=" areaObj.changeCity(this.value,'seachdistrict','seachdistrict');">
              </select>&nbsp;&nbsp;<span id='seachdistrict_div' >
               <select   id="seachdistrict"  onchange=" areaObj.changeDistrict(this.value);">
               </select></span>
               <input type="hidden"  name="area"  alt="" value='<?php echo $certData['area'] ; ?>' />
                <span></span>

								</span>
								<span></span>
							</div>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>详细地址：</span>
							<span>
								<input class="text" type="text" name="address" datatype="*2-100" errormsg="请至少填写2位字符" value="<?php echo isset($certData['address'])?$certData['address']:"";?>"/>
							</span>
								<span></span>
							</div>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>主营品种：</span>
							<span>
								<input class="text" type="text" datatype="*1-100" name="zhuying" value="<?php echo isset($certData['business'])?$certData['business']:"";?>" errormsg="请填写主营品种" />
							</span>
								<span></span>
							</div>



						<?php }else{?>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>真实姓名：</span>
								<span>
									<input class="text" type="text" name="name" datatype="zh2-20" errormsg="请填写姓名" value="<?php echo isset($certData['true_name'])?$certData['true_name']:"";?>"/>
								</span>
								<span></span>
							</div>


							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>身份证号：</span>
							<span>
								<input class="text" type="text" name="no" datatype="identify" errormsg="请正确填写身份证号" value="<?php echo isset($certData['identify_no'])?$certData['identify_no']:"";?>"/>
							</span>
								<span></span>
							</div>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>地区：</span>
								<span id="area">
										                <script type="text/javascript">
                 areaObj = new Area();

                  $(function () {
                     areaObj.initComplexArea('seachprov', 'seachcity', 'seachdistrict', '<?php echo $certData['area'] ; ?>','area');
                  });
                </script>
			 <select  id="seachprov"  onchange=" areaObj.changeComplexProvince(this.value, 'seachcity', 'seachdistrict');">
              </select>&nbsp;&nbsp;
              <select  id="seachcity"  onchange=" areaObj.changeCity(this.value,'seachdistrict','seachdistrict');">
              </select>&nbsp;&nbsp;<span id='seachdistrict_div' >
               <select   id="seachdistrict"  onchange=" areaObj.changeDistrict(this.value);">
               </select></span>
               <input type="hidden"  name="area"  alt="" value='<?php echo $certData['area'] ; ?>' />
                <span></span>

								</span>
								<span></span>
							</div>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>详细地址：</span>
							<span>
								<input class="text" type="text" name="address" datatype="*2-100" errormsg="请正确填写地址" value="<?php echo isset($certData['address'])?$certData['address']:"";?>"/>
							</span>
								<span></span>
							</div>


						<?php }?>
						<div class="zhxi_con">
							<span><input class="submit" id="next_step" type="button"  value="下一步"/></span>
						</div>

					</div>

					<div class="yz_img">
						<?php if($userType==1){?>
						<div class="zhxi_con">
							<span class="con_tit"><i></i>营业执照：</span>
							<span class="input-file">选择文件<input class="doc" type="file" name="file1" id="file1" onchange="javascript:uploadImg(this);" ></span>
							<input type="hidden" name="imgfile1" value="<?php echo isset($certData['cert_bl'])?$certData['cert_bl']:"";?>" />
							
						</div>
							<span></span>
						<div class="zhxi_con">
							<span class="con_tit tit_img"><i></i></span>
							<span class="zh_img">
								<img name="file1" src="<?php if(isset($certData['cert_bl_thumb'])){?><?php echo isset($certData['cert_bl_thumb'])?$certData['cert_bl_thumb']:"";?><?php }else{?>/nn2/user/views/pc/images/icon/wt.jpg<?php }?>"/>
							</span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit"><i></i>税务登记证：</span>
							<span class="input-file">选择文件<input class="doc" type="file" name="file2" id="file2" onchange="javascript:uploadImg(this);" ></span>
							<input type="hidden" name="imgfile2" value="<?php echo isset($certData['cert_tax'])?$certData['cert_tax']:"";?>" />

						</div>
							<span></span>
						<div class="zhxi_con">
							<span class="con_tit tit_img"><i></i></span>
							<span class="zh_img">
								<img name="file2" src="<?php if(isset($certData['cert_tax_thumb'])){?><?php echo isset($certData['cert_tax_thumb'])?$certData['cert_tax_thumb']:"";?><?php }else{?>/nn2/user/views/pc/images/icon/wt.jpg<?php }?>"/>
							</span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit"><i></i>组织机构代码证：</span>
							<span class="input-file">选择文件<input class="doc" type="file" name="file3" id="file3" onchange="javascript:uploadImg(this);" ></span>
							<input type="hidden" name="imgfile3" value="<?php echo isset($certData['cert_oc'])?$certData['cert_oc']:"";?>" />

						</div>
							<span></span>
						<div class="zhxi_con">
							<span class="con_tit tit_img"><i></i></span>
							<span class="zh_img">
								<img name="file3" src="<?php if(isset($certData['cert_oc_thumb'])){?><?php echo isset($certData['cert_oc_thumb'])?$certData['cert_oc_thumb']:"";?><?php }else{?>/nn2/user/views/pc/images/icon/wt.jpg<?php }?>"/>
							</span>
						</div>
						<div class="zhxi_con">
							<p class="font-color">1.业务认证须提供有效期3个月以上的营业执照</p>
							<p class="font-color">2.请保证营业执照上的信息清晰可见</p>
							<p class="font-color">3.支持jpg,bmp,png,gif,文件不超过4MB</p>
							<p class="font-color">4.为了您方便交易请您上传完整的资质证书</p>
						</div>

						<?php }else{?>
							<div class="zhxi_con">
								<span class="con_tit"><i></i>身份证正面：</span>
								<span class="input-file">选择文件<input class="doc" type="file" name="file1" id="file1" onchange="javascript:uploadImg(this);" ></span>
								<input type="hidden" name="imgfile1" value="<?php echo isset($certData['identify_front'])?$certData['identify_front']:"";?>" />

							</div>
							<div class="zhxi_con">
								<span class="con_tit tit_img"><i></i></span>
								<span class="zh_img">
									<img name="file1" src="<?php if(isset($certData['identify_front_thumb'])){?><?php echo isset($certData['identify_front_thumb'])?$certData['identify_front_thumb']:"";?><?php }else{?>/nn2/user/views/pc/images/icon/wt.jpg<?php }?>"/>
								</span>
							</div>

							<div class="zhxi_con">
								<span class="con_tit"><i></i>身份证背面：</span>
								<span class="input-file">选择文件<input class="doc" type="file" name="file2" id="file2" onchange="javascript:uploadImg(this);" ></span>
								<input type="hidden" name="imgfile2" value="<?php echo isset($certData['identify_back'])?$certData['identify_back']:"";?>" />

							</div>
							<div class="zhxi_con">
								<span class="con_tit tit_img"><i></i></span>
								<span class="zh_img">
									<img name="file2" src="<?php if(isset($certData['identify_back_thumb'])){?><?php echo isset($certData['identify_back_thumb'])?$certData['identify_back_thumb']:"";?><?php }else{?>/nn2/user/views/pc/images/icon/wt.jpg<?php }?>"/>
								</span>
							</div>

							<div class="zhxi_con">
								<p class="font-color">1.请保证证件上的信息清晰可见</p>
								<p class="font-color">2.支持jpg,bmp,png,gif,文件不超过2MB</p>
							</div>
						<?php }?>
						<div class="zhxi_con">
							<span><input class="submit"  type="submit" value="提交审核"></span>
						</div>
					</div>
					</form>
					<div class="sh_jg">
						<div class="success_text">
							<p><b class="b_size">认证状态：<?php echo isset($certShow['status_text'])?$certShow['status_text']:"";?></b></p>
							<?php if($certData['cert_status']==\nainai\cert\certificate::CERT_SUCCESS || $certData['cert_status']==\nainai\cert\certificate::CERT_FAIL){?><p>审核意见：<?php echo isset($certData['message'])?$certData['message']:"";?></p><?php }?>
							<?php if($certShow['button_show']===true){?>
							<p>您还可以进行以下操作:</p>
							<p><a class="look" href="javascript:void(0)" onclick="nextTab(1)"><?php echo isset($certShow['button_text'])?$certShow['button_text']:"";?></a>
							<?php }?>
						</div>
					</div>
				</form>
				</div>
			</div>
<script type="text/javascript">
	$(function(){
		nextTab(<?php echo isset($certShow['step'])?$certShow['step']:"";?>);
	})
</script></div>

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
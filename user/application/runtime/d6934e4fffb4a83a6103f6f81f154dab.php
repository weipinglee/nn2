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
</head>
<body>
	<div class="header">
		<div class="nav">
			<div class="logo-box zn-l">
				<dl>
					<dt><a href="" class="logo">
						耐耐网
					</a></dt>
					<dd><a href="/" class="back-index">返回耐耐首页</a></dd>
				</dl>	
			</div>
			<div class="nav-tit">
				<ul class="nav-list">
					<li>
						<a href="http://localhost/nn2/user/public/ucenter/index" class="cur">首页</a>
					</li>
					<li>
						<a href="http://localhost/nn2/user/public/ucenter/info">账户管理</a>
					</li>
					<li>
						<a href="user_zj.html">资金管理</a>
					</li>
					<li>
						<a href="user_chp.html">产品管理</a>
					</li>
					<li>
						<a href="user_dd.html">交易管理</a>
					</li>
					<li>
						<a href="user_gz.html">关注中心</a>
					</li>
			 	</ul>
			</div>
		</div>
	</div>
	﻿<script type="text/javascript" src="http://localhost/nn2/user/public/js/area/Area.js" ></script>
<script type="text/javascript" src="http://localhost/nn2/user/public/js/area/AreaData_min.js" ></script>
<script type="text/javascript" src="http://localhost/nn2/user/public/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="http://localhost/nn2/user/public/views/pc/js/upload.js"></script>
<script language="javascript" type="text/javascript" src="http://localhost/nn2/user/public/views/pc/js/My97DatePicker/WdatePicker.js"></script>
	<div class="user_body">
		<div class="user_b">
			<div class="user_l">
				<div class="left_navigation">
					<ul>
						<li class="let_nav_tit"><h3>账户管理</h3></li>
						<li><a href="http://localhost/nn2/user/public/ucenter/info" >基本信息</a></li>
						<li><a href="http://localhost/nn2/user/public/ucenter/password"class="cur">修改密码</a></li>
						<li><a href="javascript:void(0)"class="cur">资质认证</a>
							<ul>
								<li><a href="http://localhost/nn2/user/public/ucenter/dealcert">交易商</a></li>
								<li><a href="http://localhost/nn2/user/public/ucenter/storecert">仓库管理</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>

			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>账号管理</a>><a>基本信息</a></p>
					</div>
					<input type="hidden" name="uploadUrl"  value="http://localhost/nn2/user/public/ucenter/upload" />
					<?php if($type==0){?>
				<form method="post" action="http://localhost/nn2/user/public/ucenter/personupdate">
					<div style="float:left">

							<input type="hidden" name="id" value="<?php echo isset($user['id'])?$user['id']:"";?>"  />
						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>用户名：</span>
							<span><input class="text" type="text" name="username" pattern="/^[a-zA-Z0-9_]{3,30}$/" alt="格式错误" value="<?php echo isset($user['username'])?$user['username']:"";?>"/></span>
						</div>

						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>手机号：</span>
							<span><input class="text" type="text" name="mobile" disabled value="<?php echo isset($user['mobile'])?$user['mobile']:"";?>"/></span>
						</div>

						<div class="zhxi_con">
							<span class="con_tit">邮箱：</span>
							<span><input class="text" type="text" name="email" empty pattern="email" alt="请正确填写邮箱" value="<?php echo isset($user['email'])?$user['email']:"";?>"/></span>
						</div>

						<!--身份信息开始-->
						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>真实姓名：</span>
							<span><input class="text" type="text" name="true_name" pattern="required" value="<?php echo isset($user['true_name'])?$user['true_name']:"";?>"/></span>
						</div>

						<div class="zhxi_con">
							<span class="con_tit"><i></i>性别：</span>
							<span>
								<select class="select" name="sex">
									<option value="0" <?php if($user['sex']==0){?>selected<?php }?>>男</option>
									<option value="1" <?php if($user['sex']==1){?>selected<?php }?>>女</option>
								</select>
							</span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit">生日：</span>
							<span><input class="Wdate text" name="birth" type="text" empty pattern="date" onClick="WdatePicker()" value="<?php echo isset($user['birth'])?$user['birth']:"";?>"></span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit"><i></i>学历：</span>
						<span>
							<select class="select" name="education">
								<option value="0">请选择</option>
								<option value="1">初中</option>
								<option value="2">高中</option>
								<option value="3">专科</option>
								<option value="4">本科</option>
								<option value="5">硕士</option>
							</select>
						</span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit">QQ号：</span>
							<span><input class="text" type="text" name="qq" empty pattern="qq" value="<?php echo isset($user['qq'])?$user['qq']:"";?>"/></span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit">职称：</span>
							<span><input class="text" type="text" name="zhichen" value="<?php echo isset($user['zhichen'])?$user['zhichen']:"";?>"/></span>
						</div>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>身份证号：</span>
								<span><input class="text" type="text" name="identify_no" pattern="/^\d+$/" value="<?php echo isset($user['identify_no'])?$user['identify_no']:"";?>" /></span>
							</div>

							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>身份证正面照：</span>
								<div>
									<input type="file" name="file1" id="file1"  onchange="javascript:uploadImg(this);" />

								</div>
								<span class="con_tit">  &nbsp;&nbsp;</span>
								<div  class="up_img">
									<img name="file1" src="<?php if($user['identify_front']==''){?>http://localhost/nn2/user/public/views/pc/images/icon/wt.jpg<?php }else{?><?php echo isset($user['identify_front_thumb'])?$user['identify_front_thumb']:"";?><?php }?>"/>
									<input type="hidden"  name="imgfile1" value="<?php echo isset($user['identify_front'])?$user['identify_front']:"";?>" pattern="required" alt="请上传图片" />
								</div><!--img name属性与上传控件id相同-->

							</div>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>身份证背面照：</span>
								<div>
									<input type="file" name="file2" id="file2"  onchange="javascript:uploadImg(this);" />

								</div>
								<span class="con_tit">  &nbsp;&nbsp;</span>
								<div  class="up_img">
									<img name="file2"  src="<?php if($user['identify_back']==''){?>http://localhost/nn2/user/public/views/pc/images/icon/wt.jpg<?php }else{?><?php echo isset($user['identify_back_thumb'])?$user['identify_back_thumb']:"";?><?php }?>"/>
									<input type="hidden" name="imgfile2" value="<?php echo isset($user['identify_back'])?$user['identify_back']:"";?>" pattern="required" alt="请上传图片"/>
								</div>

							</div>




						<div class="zhxi_con">
							<span><input class="submit" type="submit" value="保存"/></span>
						</div>
						<!--身份信息结束-->


					</div>
					<div class="zhxi_upimg">
						<div id="dd" class="up_img"><img name="file3" src="<?php if(isset($user['head_photo_thumb'])){?><?php echo isset($user['head_photo_thumb'])?$user['head_photo_thumb']:"";?><?php }else{?>http://localhost/nn2/user/public/views/pc/images/icon/wt.jpg<?php }?>"/></div>
						<div>
							<input type="file" name="file3" id="file3"  onchange="javascript:uploadImg(this);" />
							<input type="hidden" name="imgfile3" value="<?php echo isset($user['head_photo'])?$user['head_photo']:"";?>" />
						</div>
					</div>
				</form>
					<?php }else{?>
						<form method="post" action="http://localhost/nn2/user/public/ucenter/companyupdate">
							<div style="float:left">

								<input type="hidden" name="id" value="<?php echo isset($user['id'])?$user['id']:"";?>"  />
								<div class="zhxi_con">
									<span class="con_tit"><i>*</i>用户名：</span>
									<span><input class="text" type="text" name="username" pattern="/^[a-zA-Z0-9_]{3,30}$/" alt="格式错误" value="<?php echo isset($user['username'])?$user['username']:"";?>"/></span>
								</div>

								<div class="zhxi_con">
									<span class="con_tit"><i>*</i>手机号：</span>
									<span><input class="text" type="text" name="mobile" disabled value="<?php echo isset($user['mobile'])?$user['mobile']:"";?>"/></span>
								</div>

								<div class="zhxi_con">
									<span class="con_tit">邮箱：</span>
									<span><input class="text" type="text" name="email" empty pattern="email" alt="请正确填写邮箱" value="<?php echo isset($user['email'])?$user['email']:"";?>"/></span>
								</div>


								<div class="zhxi_con">
									<span class="con_tit"><i>*</i>企业名称：</span>
									<span><input class="text" type="text" name="company_name" pattern="required" value="<?php echo isset($user['company_name'])?$user['company_name']:"";?>"/></span>
								</div>
								<div class="zhxi_con">
									<span class="con_tit"><i>*</i>企业地址：</span>
									<span>                <script type="text/javascript">
                 areaObj = new Area();

                  $(function () {
                     areaObj.initComplexArea('seachprov', 'seachcity', 'seachdistrict', '<?php echo $user['area'] ; ?>','area');
                  });
                </script>
			 <select  id="seachprov"  onchange=" areaObj.changeComplexProvince(this.value, 'seachcity', 'seachdistrict');">
              </select>&nbsp;&nbsp;
              <select  id="seachcity"  onchange=" areaObj.changeCity(this.value,'seachdistrict','seachdistrict');">
              </select>&nbsp;&nbsp;<span id='seachdistrict_div' >
               <select   id="seachdistrict"  onchange=" areaObj.changeDistrict(this.value);">
               </select></span>
               <input type="hidden" name="area" pattern="area" alt="请选择地区" value='<?php echo $user['area'] ; ?>' />
</span>
								</div>
								<div class="zhxi_con">
									<span class="con_tit"><i>*</i>详细地址：</span>
									<span><input class="text" type="text" name="address" pattern="required" value="<?php echo isset($user['address'])?$user['address']:"";?>"/></span>
								</div>

								<div class="zhxi_con">
									<span class="con_tit"><i></i>企业类型：</span>
									<span>
										<select class="select" name="category" pattern="/^[1-9][0-9]?$/">
											<option value="0">请选择</option>
											<option value="1">初中</option>
											<option value="2">高中</option>
										</select>
									</span>
								</div>
								<div class="zhxi_con">
									<span class="con_tit"><i></i>企业性质：</span>
									<span>
										<select class="select" name="nature" pattern="/^[1-9][0-9]?$/" >
											<option value="0">请选择</option>
											<option value="1">初中</option>
											<option value="2">高中</option>
										</select>
									</span>
								</div>
								<div class="zhxi_con">
									<span class="con_tit"><i>*</i>法人姓名：</span>
									<span><input class="text" type="text" name="legal_person" pattern="required" value="<?php echo isset($user['legal_person'])?$user['legal_person']:"";?>"/></span>
								</div>
								<div class="zhxi_con">
									<span class="con_tit"><i>*</i>注册资金：</span>
									<span><input class="text" type="text" name="reg_fund" pattern="float" value="<?php echo isset($user['reg_fund'])?$user['reg_fund']:"";?>"/>万</span>
								</div>

								<div class="zhxi_con">
									<span class="con_tit"><i>*</i>联系人：</span>
									<span><input class="text" type="text" name="contact" pattern="required" value="<?php echo isset($user['contact'])?$user['contact']:"";?>"/></span>
								</div>
								<div class="zhxi_con">
									<span class="con_tit"><i></i>联系人职务：</span>
									<span>
										<select class="select" name="contact_duty" pattern="/^[1-9][0-9]?$/" >
											<option value="1">负责人</option>
											<option value="2">高级管理</option>
											<option value="3">员工</option>
										</select>
									</span>
								</div>
								<div class="zhxi_con">
									<span class="con_tit"><i>*</i>联系人电话：</span>
									<span><input class="text" type="text" name="contact_phone" pattern="mobile" value="<?php echo isset($user['contact_phone'])?$user['contact_phone']:"";?>"/></span>
								</div>

								<div class="zhxi_con">
									<span class="con_tit"><i>*</i>收票人：</span>
									<span><input class="text" type="text" name="check_taker" pattern="required" value="<?php echo isset($user['check_taker'])?$user['check_taker']:"";?>"/></span>
								</div>
								<div class="zhxi_con">
									<span class="con_tit"><i>*</i>收票人电话：</span>
									<span><input class="text" type="text" name="check_taker_phone" pattern="mobile" value="<?php echo isset($user['check_taker_phone'])?$user['check_taker_phone']:"";?>"/></span>
								</div>
								<div class="zhxi_con">
									<span class="con_tit"><i>*</i>收票人地址：</span>
									<span><input class="text" type="text" name="check_taker_add" pattern="required" value="<?php echo isset($user['check_taker_add'])?$user['check_taker_add']:"";?>"/></span>
								</div>
								<div class="zhxi_con">
									<span class="con_tit"><i>*</i>开户行：</span>
									<span><input class="text" type="text" name="deposit_bank" pattern="required" value="<?php echo isset($user['deposit_bank'])?$user['deposit_bank']:"";?>"/></span>
								</div>
								<div class="zhxi_con">
									<span class="con_tit"><i>*</i>银行账号：</span>
									<span><input class="text" type="text" name="bank_acc" pattern="int" value="<?php echo isset($user['bank_acc'])?$user['bank_acc']:"";?>"/></span>
								</div>
								<div class="zhxi_con">
									<span class="con_tit"><i>*</i>税号：</span>
									<span><input class="text" type="text" name="tax_no" pattern="required" value="<?php echo isset($user['tax_no'])?$user['tax_no']:"";?>"/></span>
								</div>

								<div class="zhxi_con">
									<span class="con_tit">QQ号：</span>
									<span><input class="text" type="text" name="qq" empty pattern="qq" value="<?php echo isset($user['qq'])?$user['qq']:"";?>"/></span>
								</div>


								<div class="zhxi_con">
									<span class="con_tit"><i>*</i>营业执照：</span>
									<div>
										<input type="file" name="file1" id="file1"  onchange="javascript:uploadImg(this);" />

									</div>
									<span class="con_tit">  &nbsp;&nbsp;</span>
									<div  class="up_img">
										<img name="file1" src="<?php if($user['cert_bl']==''){?>http://localhost/nn2/user/public/views/pc/images/icon/wt.jpg<?php }else{?><?php echo isset($user['cert_bl_thumb'])?$user['cert_bl_thumb']:"";?><?php }?>"/>
										<input type="hidden"  name="imgfile1" value="<?php echo isset($user['cert_bl'])?$user['cert_bl']:"";?>" pattern="required" alt="请上传图片" />
									</div><!--img name属性与上传控件id相同-->

								</div>
								<div class="zhxi_con">
									<span class="con_tit"><i>*</i>组织机构代码证：</span>
									<div>
										<input type="file" name="file2" id="file2"  onchange="javascript:uploadImg(this);" />

									</div>
									<span class="con_tit">  &nbsp;&nbsp;</span>
									<div  class="up_img">
										<img name="file2" src="<?php if($user['cert_oc']==''){?>http://localhost/nn2/user/public/views/pc/images/icon/wt.jpg<?php }else{?><?php echo isset($user['cert_oc_thumb'])?$user['cert_oc_thumb']:"";?><?php }?>"/>
										<input type="hidden"  name="imgfile2" value="<?php echo isset($user['cert_oc'])?$user['cert_oc']:"";?>" pattern="required" alt="请上传图片" />
									</div><!--img name属性与上传控件id相同-->

								</div>
								<div class="zhxi_con">
									<span class="con_tit"><i>*</i>税务登记证：</span>
									<div>
										<input type="file" name="file3" id="file3"  onchange="javascript:uploadImg(this);" />

									</div>
									<span class="con_tit">  &nbsp;&nbsp;</span>
									<div  class="up_img">
										<img name="file3" src="<?php if($user['cert_tax']==''){?>http://localhost/nn2/user/public/views/pc/images/icon/wt.jpg<?php }else{?><?php echo isset($user['cert_tax_thumb'])?$user['cert_tax_thumb']:"";?><?php }?>"/>
										<input type="hidden"  name="imgfile3" value="<?php echo isset($user['cert_tax'])?$user['cert_tax']:"";?>" pattern="required" alt="请上传图片" />
									</div><!--img name属性与上传控件id相同-->

								</div>

								<div class="zhxi_con">
									<span><input class="submit" type="submit" value="保存"/></span>
								</div>
								<!--身份信息结束-->


							</div>
							<div class="zhxi_upimg">
								<div id="dd" class="up_img"><img name="file4" src="<?php if(isset($user['head_photo_thumb'])){?><?php echo isset($user['head_photo_thumb'])?$user['head_photo_thumb']:"";?><?php }else{?>http://localhost/nn2/user/public/views/pc/images/icon/wt.jpg<?php }?>"/></div>
								<div>
									<input type="file" name="file4" id="file4"  onchange="javascript:uploadImg(this);" />
									<input type="hidden" name="imgfile4" value="<?php echo isset($user['head_photo'])?$user['head_photo']:"";?>" />
								</div>
							</div>
						</form>
					<?php }?>

					<div style="clear:both;"></div>
				</div>

			</div>


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
	</div>

	</div>
</body>
</html>
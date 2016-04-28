
<script type="text/javascript" src="{root:js/area/Area.js}" ></script>
<script type="text/javascript" src="{root:js/area/AreaData_min.js}" ></script>
<script type="text/javascript" src="{root:js/ajaxfileupload.js}"></script>
<script type="text/javascript" src="{views:js/upload.js}"></script>
<input type="hidden" name="uploadUrl"  value="{url:/ucenter/upload}" />
			<div class="user_c">
				<div class="user_zhxi">

					<div class="zhxi_tit">
						<p><a>账号管理</a>><a>身份认证</a>><a>企业认证</a></p>
					</div>
					<div class="rz_title">
						<ul class="rz_ul">
							<li class="rz_start"></li>
							<li class="rz_li cur"><a class="rz">认证信息</a></li>
							<li class="rz_li"><a class="yz">营业执照</a></li>
							<li class="rz_li"><a class="shjg">审核结果</a></li>
							<li class="rz_end"></li>
						</ul>

					</div>
					<div class="re_xx">
						<form method="post" action="{url:/ucenter/dealerCert}">
						<!--公司信息-->
						{if:$userType==1}
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>公司名：</span>
								<span>
									<input class="text" type="text" name="company_name" value="{$certData['company_name']}"/>
								</span>
							</div>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>法定代表人：</span>
							<span>
								<input class="text" type="text" value="{$certData['legal_person']}"/>
							</span>
							</div>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>联系人：</span>
							<span>
								<input class="text" type="text" value="{$certData['contact']}"/>
							</span>
							</div>

							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>联系电话：</span>
							<span>
								<input class="text" type="text" value="{$certData['contact_phone']}"/>
							</span>
							</div>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>地区：</span>
							<span>
								{area:data=$certData['area']}
							</span>
							</div>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>详细地址：</span>
							<span>
								<input class="text" type="text" value="{$certData['address']}"/>
							</span>
							</div>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>主营品种：</span>
							<span>
								<input class="text" type="text" />
							</span>
							</div>
							<div class="zhxi_con">
								<span class="con_tit"><i></i>公司介绍：</span>
								<span><textarea style="width:300px"></textarea></span>
							</div>


						{else:}
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>真实姓名：</span>
								<span>
									<input class="text" type="text" name="company_name" value="{$certData['true_name']}"/>
								</span>
							</div>


							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>手机号：</span>
							<span>
								<input class="text" type="text" value="{$certData['mobile']}"/>
							</span>
							</div>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>地区：</span>
							<span>
								{area:data=$certData['area']}
							</span>
							</div>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>详细地址：</span>
							<span>
								<input class="text" type="text" value="{$certData['address']}"/>
							</span>
							</div>
							<div class="zhxi_con">
								<span class="con_tit"><i>*</i>主营品种：</span>
							<span>
								<input class="text" type="text" />
							</span>
							</div>

						{/if}
						<div class="zhxi_con">
							<span><input class="submit" type="submit" value="保存"/></span>
						</div>
						</form>
					</div>

					<div class="yz_img">
						{if:$userType==1}
						<div class="zhxi_con">
							<span class="con_tit"><i></i>营业执照：</span>
							<span><input class="doc" type="file" name="file1" id="file1" onchange="javascript:uploadImg(this);" ></span>
							<input type="hidden" name="imgfile1" value="{$user['cert_bl']}" />
							
						</div>
						<div class="zhxi_con">
							<span class="con_tit tit_img"><i></i></span>
							<span class="zh_img">
								<img name="file1" src="{if:isset($user['cert_bl_thumb'])}{$user['cert_bl_thumb']}{else:}{views:/images/icon/wt.jpg}{/if}"/>
							</span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit"><i></i>税务登记证：</span>
							<span><input class="doc" type="file" name="file2" id="file2" onchange="javascript:uploadImg(this);" ></span>
							<input type="hidden" name="imgfile2" value="{$user['cert_tax']}" />

						</div>
						<div class="zhxi_con">
							<span class="con_tit tit_img"><i></i></span>
							<span class="zh_img">
								<img name="file2" src="{if:isset($user['cert_tax_thumb'])}{$user['cert_tax_thumb']}{else:}{views:/images/icon/wt.jpg}{/if}"/>
							</span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit"><i></i>组织机构代码证：</span>
							<span><input class="doc" type="file" name="file3" id="file3" onchange="javascript:uploadImg(this);" ></span>
							<input type="hidden" name="imgfile3" value="{$user['cert_oc']}" />

						</div>
						<div class="zhxi_con">
							<span class="con_tit tit_img"><i></i></span>
							<span class="zh_img">
								<img name="file3" src="{if:isset($user['cert_oc_thumb'])}{$user['cert_oc_thumb']}{else:}{views:/images/icon/wt.jpg}{/if}"/>
							</span>
						</div>
						<div class="zhxi_con">
							<p class="font-color">1.业务认证须提供有效期3个月以上的营业执照</p>
							<p class="font-color">2.请保证营业执照上的信息清晰可见</p>
							<p class="font-color">3.支持jpg,bmp,png,gif,文件不超过4MB</p>
						</div>

						{else:}
							<div class="zhxi_con">
								<span class="con_tit"><i></i>身份证正面：</span>
								<span><input class="doc" type="file" name="file1" id="file1" onchange="javascript:uploadImg(this);" ></span>
								<input type="hidden" name="imgfile1" value="{$user['identify_front']}" />

							</div>
							<div class="zhxi_con">
								<span class="con_tit tit_img"><i></i></span>
								<span class="zh_img">
									<img name="file1" src="{if:isset($user['identify_front_thumb'])}{$user['identify_front_thumb']}{else:}{views:/images/icon/wt.jpg}{/if}"/>
								</span>
							</div>

							<div class="zhxi_con">
								<span class="con_tit"><i></i>身份证背面：</span>
								<span><input class="doc" type="file" name="file2" id="file2" onchange="javascript:uploadImg(this);" ></span>
								<input type="hidden" name="imgfile2" value="{$user['identify_back']}" />

							</div>
							<div class="zhxi_con">
								<span class="con_tit tit_img"><i></i></span>
								<span class="zh_img">
									<img name="file2" src="{if:isset($user['identify_back_thumb'])}{$user['identify_back_thumb']}{else:}{views:/images/icon/wt.jpg}{/if}"/>
								</span>
							</div>

							<div class="zhxi_con">
								<p class="font-color">1.请保证证件上的信息清晰可见</p>
								<p class="font-color">2.支持jpg,bmp,png,gif,文件不超过4MB</p>
							</div>
						{/if}
						<div class="zhxi_con">
							<span><input class="submit" type="submit" value="提交审核"></span>
						</div>
					</div>

					<div class="sh_jg">
						<div class="success_text">
							<p><b class="b_size">恭喜您，认证申请已提交成功！</b></p>
							<p>我们将在3个工作日内完成审核，审核结束会在第一时间通知您。</p>
							<p>您还可以进行以下操作:</p>
							<p><a class="a_color" href="">物流企业</a>  <a class="a_color" href="">个人身份认证</a></p>
							<p><a class="look">看看我可以做什么</a></p>
							
						</div>
					</div>
				</form>
				</div>
			</div>

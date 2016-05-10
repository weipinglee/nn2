
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>账号管理</a>><a>基本信息</a></p>
					</div>
					<div style="float:left">
						<form method="post" action="{url:/ucenter/dobase}">
						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>用户名：</span>
							<span><input class="text" type="text"  value="{$user['username']}" name="username"/></span>
                             <div><input type="text" readonly="readonly" name="checkb" class="username"></div>
						</div>
						<div class="zhxi_con">
							<span class="con_tit"><i></i>手机号码：</span>
							<span><input class="text" disabled="disabled" value="{$user['mobile']}" type="text" name="mobile_no"/>
							<a href="mobile_edit.html"><i class="icon-info-sign"></i>点击修改手机号码</a>
							<!-- <input type="text" readonly="readonly" name="checkh" class="mobile_no"/></span> -->
						</div>


						<div class="zhxi_con">
                            <span class="con_tit"><i>*</i>邮箱：</span>
                            <span><input class="text" type="text" name="email" value="{$user['email']}"></span>
                            <div> <input type="text" readonly="readonly" name="check" class="email"></div>
                        </div>
						<div class="zhxi_con">
							<span><input class="submit" type="submit" value="保存"/></span>
						</div>
						</form>
					</div>
					<div style="clear:both;"></div>
				</div>
			</div>

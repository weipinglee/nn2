
			<div class="user_c">
				<div class="user_zhxi">
				<form method="post" action="{url:/ucenter/chgPass}" >
					<div class="zhxi_tit">
						<p><a>账号管理</a>><a>修改密码</a></p>
					</div>
					<div style="float:left">

						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>原始密码：</span>
							<span><input class="text" type="password" pattern="/^\S{6,20}$/" alt="请输入原始密码" name="old_pass"/></span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>新密码：</span>
							<span><input class="text" type="password" pattern="/^\S{6,20}$/" alt="请输入新密码" name="new_pass"/></span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit"><i>*</i>确认新密码：</span>
							<span><input class="text" type="password" bind="new_pass" pattern="/^\S{6,20}$/" alt="请重复输入密码" name="new_repass"/></span>
						</div>
						
						<div class="zhxi_con">
							<span><input class="submit" type="submit" value="保存"/></span>
						</div>
					</div>
					<div style="clear:both;"></div>
				</form>
				</div>
			</div>


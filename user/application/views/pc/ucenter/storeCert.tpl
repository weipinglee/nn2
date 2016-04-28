<script type="text/javascript" src="{views:js/certificate.js}"></script>

			<div class="user_c">
				<div class="user_zhxi">

					<div class="zhxi_tit">
						<p><a>账号管理</a>><a>资质认证</a>><a>仓储管理员认证</a></p>
					</div>
					<div style="float:left">
					<form >
						<div class="zhxi_con">
							<span class="con_tit"><i></i>认证仓库：</span>
							<span><select class="select" name="store">
									<option value="0">请选择</option>
									<option value="1">初中</option>
									<option value="2">高中</option>
								</select></span>
						</div>
						<div class="zhxi_con">
							<span class="con_tit"><i></i>认证状态：</span>
							<span>{$cert['status_text']}</span>
						</div>
						{if:$cert['button_show']}
						<div class="zhxi_con">
							<input type="hidden" name="ajaxUrl" value="{url:/ucenter/doStoreCert}" />
							<span><input class="submit" type="button" onclick="dealCert();" value="{$cert['button_text']}"/></span>
						</div>
						{/if}
					</div>
					</form>
					<div style="clear:both;"></div>

				</div>
			</div>


<script type="text/javascript" src="{views:js/certificate.js}"></script>

			<div class="user_c">
				<div class="user_zhxi">
				<form >
					<div class="zhxi_tit">
						<p><a>账号管理</a>><a>资质认证</a>><a>交易商认证</a></p>
					</div>
					<div style="float:left">

						<div class="zhxi_con">
							<span class="con_tit"><i></i>认证状态：</span>
							<span>{$cert['status_text']}</span>
						</div>
						{if:$cert['button_show']}
						<div class="zhxi_con">
							<input type="hidden" name="ajaxUrl" value="{url:/ucenter/doDealCert}" />
							<span><input class="submit" type="button" onclick="dealCert();" value="{$cert['button_text']}"/></span>
						</div>
						{/if}
					</div>
					<div style="clear:both;"></div>
				</form>
				</div>
			</div>


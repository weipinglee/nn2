<link rel="stylesheet" type="text/css" href="{views:css/bidprice.css}">
<div id="mainContent" class="">
	<div class="page_width">
		<div class="bidpriceContent">
			<div class="bidpriceTop">
                <a href="">竞价</a> &gt; <a>竞价商品详情</a> &gt; <a>缴纳保证金</a> 
			</div>
			<div class="bidbond">
				<div class="bidbond_top clear">
					<div class="bidbond_left">
						<div class="bidbondname">竞价物品名称：铝矾土一级生矿混料</div>
						<div class="bidbondprice">
							需要缴纳保证金：<span>￥3000.00元</span>
						</div>
					</div>
					<div class="bidbond_right">
						<div class="bidbondsm clear">
							<span>说明：</span>
							<div class="sm_con">
								<p>1、此保证金仅适用于该竞价商品</p>
								<p>2、竞价结束后1个工作日内原路退回</p>
								<p>3、若竞价成功，需要2个小时内支付全部货款，否则保证金相应扣除作为违约赔付</p>
							</div>
						</div>
					</div>
				</div>
				<div class="bidBond_cont clear">
					<div class="bidbond_left">
						<div class="bidbondtitle">转账人信息</div>
						<from >
						<div class="bidbondInfo">
							<div class="bidbondInput">
								<span class="inputName">转账用户名称:</span>
								<input class="inputText" type="text" placeholder="请输入您转账单位名称" name="">
							</div>
							<div class="bidbondInput">
								<span class="inputName">开会银行:</span>
								<input class="inputText" type="text" placeholder="请输入您转账单位名称" name="">
							</div>
							<div class="bidbondInput">
								<span class="inputName">转账用户名称:</span>
								<input class="inputText" type="text" placeholder="请输入您转账单位名称" name="">
							</div>
							<div class="bidbond_btn">
								<input class="submitIn" type="submit" value="缴纳完成" name="">
							</div>
							<div class="bidBond_tip">
								<b class="prompt_b">*</b>
								<span>必须使用开户账户关联的银行账户进行汇款，否则导致的缴纳不成功自行负责。</span>
							</div>
						</div>
						</from>
						<!-- 若用户有过转账信息则显示已有的账户信息 -->
						<div class="bidbondInfo" style="display: none">
							<div class="bidbondInput">
								<span class="spanName">转账用户名称:</span>
								<span class="spanCont">xx有限公司</span>
							</div>
							<div class="bidbondInput">
								<span class="spanName">开户银行:</span>
								<span class="spanCont">中国光大银行山西阳泉支行</span>
							</div>
							<div class="bidbondInput">
								<span class="spanName">开户银行账号:</span>
								<span class="spanCont">55410199000214781</span>
							</div>
						</div>
						<!-- 若用户有过转账信息则显示已有的账户信息 end-->
					</div>
					<div class="bidbond_right">
						<div class="bidbondtitle">收款人信息</div>
						<div class="bidbondInfo">
							<div class="bidbondInput">
								<span class="spanName">收款用户名称:</span>
								<span class="spanCont">耐耐云商科技有限公司</span>
							</div>
							<div class="bidbondInput">
								<span class="spanName">开户银行1:</span>
								<span class="spanCont">中国光大银行山西阳泉支行</span>
							</div>
							<div class="bidbondInput">
								<span class="spanName">开户银行账号:</span>
								<span class="spanCont">75410188000114781</span>
							</div>
							<div style="height: 40px;width: 0px;"></div>
							<div class="bidbondInput">
								<span class="spanName">开户银行2:</span>
								<span class="spanCont">建设银行河南省分行营业部</span>
							</div>
							<div class="bidbondInput">
								<span class="spanName">开户银行账号:</span>
								<span class="spanCont">41050100360800000080</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="{views:js/biddetails.js}"></script>
<!-- 遮罩层 -->
<div class="bidbond_result">
	<div class="mark"></div>
	<div class="result">
		<div class="result_title">
			提示
			<i class="close"></i>
		</div>
		<div id="resule_success" class="result_cont">
			<div class="result_img"><img src="{views:images/icon/successIcon.png}"/></div>
			<div class="result_tip">恭喜，您的保证金已缴纳成功，现在可以去竞价！</div>
			<div class="result_tip success_tip">系统将自动在3秒内跳转到竞价页面</div>
		</div>
		<div id="resule_fail" class="result_cont" style="display: none;">
			<div class="result_img"><img src="{views:images/icon/failIcon.png}"/></div>
			<div class="result_tip">很抱歉，系统未收到帐的保证金，请先进行保证金缴纳！</div>
			<div class="result_tip fail_tip">若有疑问，联系客服热线400-6238086</div>
		</div>
	</div>
</div>
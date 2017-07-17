
  <script src="{views:/js/tender_con.js}" type="text/javascript"></script> 
			<!--start中间内容-->	
            <style type="text/css">
                
            </style>
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>我的招标</a>><a>发布招标</a></p>
					</div>

					<div class="center_tabl">
                                                            <ul class="step_list">
                                                                <li class="step">
                                                                    <span class="val_on on">1</span>
                                                                    <p class="step_name">
                                                                        <span class="on">公告发布</span>
                                                                    </p>
                                                                </li>
                                                                <li class="step">                                                                    
                                                                    <span class="val_on on">2</span>
                                                                    <p class="step_name">
                                                                        <span class="on">资格预审</span>
                                                                    </p>
                                                                </li>
                                                                <li class="step">                                                                    
                                                                    <span class="val_on on">3</span>
                                                                    <p class="step_name">
                                                                        <span class="on">开标</span>
                                                                    </p>
                                                                </li>
                                                                <li class="step">                                                                    
                                                                    <span class="val_on ">4</span>
                                                                    <p class="step_name">
                                                                        <span class="">中标结果</span>
                                                                    </p>
                                                                </li>
                                                            </ul>


                                                            <div class="invite" id="invite" style="padding-top:47px;">
                                                                <div class="invite_title">
                                                                    <span>资质信息</span>
                                                                </div>
                                                                {foreach:items=$certs}
                                                                <div class="bid_zige" style="padding-left:317px;">
                                                                    <p class="zigefile"><span>证书名称：{$item['cert_name']}</span></p>
                                                                    <p class="zigefile"><span>证书分类：{$item['cert_type']}</span></p>
                                                                    <p class="zigefile"><span>证书描述：{$item['cert_des']}</span></p>
                                                                    <p class="zigefile"><span>附件图片</span><img id="viewImg" src="{$item['cert_pic']}"></p>

                                                                </div>
                                                                {/foreach}
                                                            </div>

                                                            <div class="clear"></div>

                                                            <div class="button">
                                                                <button  onclick="window.history.go(-1)">返回</button>
                                                            </div>
                                                        </div>
				</div>
			</div>
			<!--end中间内容-->	
			<!--start右侧广告			
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
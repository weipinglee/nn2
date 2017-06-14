
  <script src="{views:/js/tender_con.js}" type="text/javascript"></script>

			<!--start中间内容-->	
            <style type="text/css">
                
            </style>
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>我的投标</a>><a>开标</a></p>
					</div>
                                                        <div class="project_detail">
                                                            <h1>501矿</h1>
                                                            <p>招标方：海天贸易</p>
                                                            <p>招标方式：公开招标</p>
                                                            <p>评标类型：分包</p>
                                                            <p>项目地点：中国 山西省 阳泉市 郊区</p>
                                                            <p>投标时间：2015-8-10——2015-10-8</p>
                                                            <p>开标地点：[线上]</p>
                                                        </div>
					<div class="center_tabl">
                                                            <ul class="step_list">
                                                                <li class="bid_step">
                                                                    <span class="val_on on">1</span>
                                                                    <p class="step_name">
                                                                        <span class="on">资格预审</span>
                                                                    </p>
                                                                </li>
                                                                <li class="bid_step">                                                                    
                                                                    <span class="val_on on">2</span>
                                                                    <p class="step_name">
                                                                        <span class="on">购买下载标书</span>
                                                                    </p>
                                                                </li>
                                                                <li class="bid_step">                                                                    
                                                                    <span class="val_on on">3</span>
                                                                    <p class="step_name">
                                                                        <span class="on">投标</span>
                                                                    </p>
                                                                </li>
                                                                <li class="bid_step">                                                                    
                                                                    <span class="val_on on">4</span>
                                                                    <p class="step_name">
                                                                        <span class="on">开标</span>
                                                                    </p>
                                                                </li>
                                                                <li class="bid_step">                                                                    
                                                                    <span class="val_on ">5</span>
                                                                    <p class="step_name">
                                                                        <span class="">中标结果</span>
                                                                    </p>
                                                                </li>
                                                            </ul>


                                                            <div class="invite" id="invite" style="padding-top:47px;">
                                                                
                                                                <div class="bid_zige" style="">
                                                                    <h2>开标倒计时：<span id="time_d"></span>天<span id="time_h"></span>时<span id="time_m"></span>分<span id="time_s"></span>秒</h2>
                                                                    <p>
                                                                        包件
                                                                        <select>
                                                                            <option value="">包件1</option>
                                                                            <option value="">包件2</option>
                                                                        </select>
                                                                        <button style="width:50px;height:30px;line-height:30px;">查看</button>
                                                                    </p>
                                                                    <h3>入围图示</h3>

                                                                                                                                        
                                                                </div>
                                                            </div>

                                                            <div class="clear"></div>

                                                        


                                                        </div>
				</div>
			</div>
<script type="text/javascript">    
        $(function(){ 
        show_time();
        }); 

        function show_time(){ 
        var time_start = new Date().getTime(); //设定当前时间
        var time_end =  new Date("2017/10/01 00:00:00").getTime(); //设定目标时间
        // 计算时间差 
        var time_distance = time_end - time_start; 
        // 天
        var int_day = Math.floor(time_distance/86400000) 
        time_distance -= int_day * 86400000; 
        // 时
        var int_hour = Math.floor(time_distance/3600000) 
        time_distance -= int_hour * 3600000; 
        // 分
        var int_minute = Math.floor(time_distance/60000) 
        time_distance -= int_minute * 60000; 
        // 秒 
        var int_second = Math.floor(time_distance/1000) 
        // 时分秒为单数时、前面加零 
        if(int_day < 10){ 
            int_day = "0" + int_day; 
        } 
        if(int_hour < 10){ 
            int_hour = "0" + int_hour; 
        } 
        if(int_minute < 10){ 
            int_minute = "0" + int_minute; 
        } 
        if(int_second < 10){
            int_second = "0" + int_second; 
        } 
        // 显示时间 
        $("#time_d").text(int_day); 
        $("#time_h").text(int_hour); 
        $("#time_m").text(int_minute); 
        $("#time_s").text(int_second); 
        // 设置定时器
        setTimeout("show_time()",1000); 
        }
</script>
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
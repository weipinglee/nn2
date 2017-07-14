
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
                                                            <h1>{$detail['pro_name']}</h1>
                                                            <p>招标方：{$detail['true_name']}</p>
                                                            <p>招标方式：{$detail['mode_text']}</p>
                                                            <p>评标类型：{$detail['pack_type_text']}</p>
                                                            <p>项目地点：{$detail['pro_address']}</p>
                                                            <p>投标时间：{$detail['begin_time']}——{$detail['end_time']}</p>
                                                            <p>开标地点：[{$detail['open_way_text']}]</p>
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
                                                                    <h2 id="time_limit">开标倒计时：<span id="time_d"></span>天<span id="time_h"></span>时<span id="time_m"></span>分<span id="time_s"></span>秒</h2>
                                                                    <!--<p>
                                                                        包件
                                                                        <select>
                                                                            <option value="">包件1</option>
                                                                            <option value="">包件2</option>
                                                                        </select>
                                                                        <button style="width:50px;height:30px;line-height:30px;">查看</button>
                                                                    </p>
                                                                    <h3>入围图示</h3>-->

                                                                                                                                        
                                                                </div>
                                                            </div>

                                                            <div class="clear"></div>
                        <!--<div class="button">
                            <a href="{url:/bid/bidoper3}?reply_id={$reply_id}" ><button>上一步</button></a>
                        </div>-->

                                                        


                                                        </div>
				</div>
			</div>
<script type="text/javascript">    
        $(function(){ 
        show_time();
        }); 

        function show_time(){ 
        var time_start = new Date().getTime(); //设定当前时间
        var time_end =  new Date("{$detail['open_time']}").getTime(); //设定目标时间
        // 计算时间差 
        var time_distance = time_end - time_start; 

        if(time_distance > 0){ 
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
        }else{
            $("#time_limit").text("项目已开标");
        }

        }

        
</script>
			<!--end中间内容-->	

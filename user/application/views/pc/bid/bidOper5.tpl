
  <script src="{views:/js/tender_con.js}" type="text/javascript"></script>
	
			<!--start中间内容-->	
            <style type="text/css">
                
            </style>
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>我的投标</a>><a>中标结果</a></p>
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
                                                                    <span class="val_on on">5</span>
                                                                    <p class="step_name">
                                                                        <span class="on">中标结果</span>
                                                                    </p>
                                                                </li>
                                                            </ul>


                                                            <div class="invite" id="invite" style="padding-top:47px;">
                                                                
                                                                <div class="bid_zige" style="">
                                                                    {set:$i=0;}
                                                                    {foreach:items=$zbinfo}
                                                                        {if:$item['selected']==1 && $i==0}
                                                                            {set:$i=$i+1}
                                                                            <h2 style="margin-bottom:50px;">恭喜您中标了！</h2>
                                                                        {/if}
                                                                    {/foreach}

                                                                    {if:$i==0}
                                                                        <h2 style="margin-bottom:50px;">很遗憾，没有中标！</h2>
                                                                    {/if}


                                                                <div class="invite_title">
                                                                    <span>中标结果</span>
                                                                </div>
                                                                <div class="bid_zige" style="">
                                                                   {foreach:items=$zbinfo}
                                                                    <p class="zigefile"><span>包件号：</span>{$item['pack_no']}</p>
                                                                    <p class="zigefile" style="color:#e00101;">中标状态：{if:$item['selected']==1}已中标{else:}未中标{/if}</p>
                                                                    {/foreach}
                                                                                                                                        
                                                                </div>   

                                                            <div class="clear"></div>

                                                        


                                                        </div>
				</div>
			</div>

			<!--end中间内容-->	


  <script src="{views:/js/tender_con.js}" type="text/javascript"></script>
	
			<!--start中间内容-->	
            <style type="text/css">
                
            </style>
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>我的招标</a>><a>中标结果</a></p>
					</div>
                                                        <div class="project_detail">
                                                            <h1>{$detail['pro_name']}</h1>
                                                            <p>招标方：{$detail['true_name']}</p>
                                                            <p>招标方式：{$detail['mode_text']}</p>
                                                            <p>评标类型：{$detail['pack_type_text']}</p>
                                                            <p>项目地点：{$detail['pro_address']}</p>
                                                            <p>投标时间：{$detail['begin_time']}——{$detail['end_time']}</p>
                                                            <p>开标地点：[{$detail['open_way_text']}]</p>
                                                            <p>审核意见：[{$detail['admin_message']}]</p>
                                                            <div class="tender_handle">
                                                                {if:$detail['status']==7 || $detail['status']==8}
                                                               <button  button_submit="1" confirm="1" confirm_text="确定退还未中标用户保证金？" ajax-data='{"bid_id":{$detail['id']}}' ajax-url="{url:/bid/rebackBail}">退还未中标投标方保证金</button>
                                                                {/if}
                                                            </div>

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
                                                                    <span class="val_on on">4</span>
                                                                    <p class="step_name">
                                                                        <span class="on">中标结果</span>
                                                                    </p>
                                                                </li>
                                                            </ul>


                                                            <div class="invite" id="invite" style="padding-top:47px;">
                                                                
                                                                <div class="bid_zige" style="">


                                                                <div class="invite_title">
                                                                    <span>中标结果</span>
                                                                </div>
                                                                <div class="bid_zige" style="">
                                                                    {if:$detail['status']==7}
                                                                        {foreach:items=$zbinfo}

                                                                            <p class="zigefile"><span>包件号：</span>{$item['pack_no']}</p>
                                                                            <p class="zigefile">{if:$item['win_user_id']==-1}包件状态：流标{else:}中标会员：{$item['username']}{/if}</p>
                                                                        {/foreach}
                                                                        {elseif:$detail['status']==8}
                                                                        项目流标

                                                                    {/if}

                                                                                                                                        
                                                                </div>   

                                                            <div class="clear"></div>



                                                    </div>
				</div>
			</div>

			<!--end中间内容-->	

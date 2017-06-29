
  <script src="{views:/js/tender_con.js}" type="text/javascript"></script>

			<!--start中间内容-->	
            <style type="text/css">
                #supplier_list .chose .ok{margin-left: 200px;}
            </style>
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>我的招标</a>><a>招标发布</a></p>
					</div>
                                                        <div class="project_detail">
                                                            <h1>{$detail['pro_name']}</h1>
                                                            <p>招标方：{$detail['true_name']}</p>
                                                            <p>招标方式：{$detail['mode_text']}</p>
                                                            <p>评标类型：{$detail['pack_type_text']}</p>
                                                            <p>项目地点：{$detail['pro_address']}</p>
                                                            <p>投标时间：{$detail['begin_time']}——{$detail['end_time']}</p>
                                                            <p>开标地点：[{$detail['open_way_text']}]</p>
                                                            <form method="post" action="{url:/bid/bidrelease}" auto_submit="1" >
                                                                <input type="hidden" name="bid_id" value="{$detail['id']}"/>

                                                            </form>
                                                            <!-- 补充公告 -->
                                                            <div class="tender_handle">

                                                               <!-- <button id="chose_supplier">发布补充公告</button>-->
                                                                <button name="cx" button_submit="1" ajax-data='{"bid_id":{$detail['id']}}' ajax-url="{url:/bid/cancleBid}">撤回</button>
                                                                <button name="zz" button_submit="1" ajax-data='{"bid_id":{$detail['id']}}' ajax-url="{url:/bid/closeBid}">终止</button>
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
                                                                    <span class="val_on ">2</span>
                                                                    <p class="step_name">
                                                                        <span class="on">资格预审</span>
                                                                    </p>
                                                                </li>
                                                                <li class="step">                                                                    
                                                                    <span class="val_on ">3</span>
                                                                    <p class="step_name">
                                                                        <span class="">开标</span>
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
                                                            <!--<div class="invite_title">
                                                                <span>补充公告</span>
                                                            </div>
                                                            <div class="bid_zige">
                                                                <h1>501矿招标公告补充公告</h1>
                                                                <p>补充条款1补充条款1补充条款1补充条款1补充条款1补充条款1补充条款1补充条款1补充条款1补充条款1补充条款1补充条款1补充条款1补充条款1补充条款1补充条款1</p>
                                                                <p style="float:right;">
                                                                    <button style="width:50px;height:30px;line-height:30px;">编辑</button>
                                                                    <button style="width:50px;height:30px;line-height:30px;">删除</button>
                                                                </p>                         
                                                            </div>
                                                            -->

                                                            <div class="clear"></div>

                                                            <div class="invite_title">
                                                                    <span style="width:80px;">包件列表</span>
                                                                </div>
                                                                <div class="bid_zige">
                                                                    <table>
                                                                        <tr>
                                                                            <td>包号</td>
                                                                            <td>货名</td>
                                                                            <td>品牌</td>
                                                                            <td>规格</td>
                                                                            <td>技术要求</td>
                                                                            <td>单位</td>
                                                                            <td>数量</td>
                                                                            <td>交付天数</td>
                                                                        </tr>
                                                                        {foreach:items=$detail['package']}
                                                                        <tr>
                                                                            <td>{$item['pack_no']}</td>
                                                                            <td>{$item['product_name']}</td>
                                                                            <td>{$item['brand']}</td>
                                                                            <td>{$item['spec']}</td>
                                                                            <td>{$item['tech_need']}</td>
                                                                            <td>{$item['unit']}</td>
                                                                            <td>{$item['num']}</td>
                                                                            <td>{$item['tran_days']}</td>

                                                                        </tr>
                                                                        {/foreach}
                                                                    </table>
                                                                                                                                        
                                                                </div>
                                                            </div>

                                                            <div class="clear"></div>


                                                            <div class="button">
                                                                {if:$detail['status']==0}
                                                                    <button name="fb">支付保证金</button>
                                                                {else:}
                                                                    <a href="{url:/bid/tenderdetail1}?id={$detail['id']}"><button>下一步</button></a>

                                                                {/if}
                                                                </div>

                                                        </div>
				</div>
			</div>
            <div id="supplier_list" style="display:none;width:600px;left:35%;">
                <div class="invite_mem">
                    <div class="title" style="width:580px;">
                        <h5>发布公告</h5>
                        <i class="close">X</i>
                    </div>

                    <div class="chose" style="width:580px;">
                        <div class="search">
                            <textarea></textarea>
                        </div>
                        <button class="ok">确定</button>
                        <button class="close">关闭</button>
                    </div>
                </div>
            </div>
			<!--end中间内容-->	
<script type="text/javascript">
    $(function(){
        $('button[name=fb]').on('click',function() {
            $('form').attr('action','{url:/bid/bidrelease}').submit();
        })

    })
</script>
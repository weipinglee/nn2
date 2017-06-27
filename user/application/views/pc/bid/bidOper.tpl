
			<!--start中间内容-->	
            <style type="text/css">
                
            </style>
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>我的招标</a>><a>投标</a></p>
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
                                                                    <span class="val_on ">2</span>
                                                                    <p class="step_name">
                                                                        <span class="">购买下载标书</span>
                                                                    </p>
                                                                </li>
                                                                <li class="bid_step">                                                                    
                                                                    <span class="val_on ">3</span>
                                                                    <p class="step_name">
                                                                        <span class="">投标</span>
                                                                    </p>
                                                                </li>
                                                                <li class="bid_step">                                                                    
                                                                    <span class="val_on ">4</span>
                                                                    <p class="step_name">
                                                                        <span class="">开标</span>
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
                                                                <div class="invite_title">
                                                                    <span>资格预审</span>
                                                                </div>
                                                                <div class="bid_zige">
                                                                    <table>
                                                                        <tr>
                                                                            <td>序号</td>
                                                                            <td>证书名称</td>
                                                                            <td>证书分类</td>
                                                                            <td>证书描述</td>
                                                                            <td>添加时间</td>
                                                                            <td>提交状态</td>
                                                                            <td>资审状态</td>
                                                                            <td></td>
                                                                        </tr>
                                                                        {foreach:$items=$certs}
                                                                        <tr>
                                                                            <td>{echo:$key+1}</td>
                                                                            <td>{$item['cert_name']}</td>
                                                                            <td>{$item['cert_type']}</td>
                                                                            <td>{$item['cert_des']}</td>
                                                                            <td>{$item['create_time']}</td>
                                                                            <td>{if:$certHasSubmit}已提交{else:}未提交{/if}</td>
                                                                            <td>待审核</td>
                                                                            <td><a href="javascript:void(0)" button_submit="1" ajax-data='{"cert_id":{$item["id"]},"reply_id":{$item["reply_id"]},"bid_id":{$detail["id"]}}' ajax-url="{url:/bid/delCert}" confirm_submit="1" confirm_text="确定要删除这个证书？">删除</a></td>
                                                                        </tr>
                                                                        {/foreach}
                                                                        <tr>
                                                                            <td colspan="8">
                                                                                <a href="{url:/bid/bidoper1}?id={$detail['id']}">请上传资质文件</a>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                            <div class="clear"></div>
                                                        {if:!$certHasSubmit}
                                                        <form method="post" action="{url:/bid/submitCert}" auto_submit="1">
                                                            <input type="hidden" name="id" value="{$certs[0]['reply_id']}" />
                                                            <div class="button">
                                                                <button style="float: left;margin-right:20px;">提交</button><!--<button style="margin:0;">删除</button>-->
                                                            </div>
                                                        </form>
                                                        {/if}

                                                        </div>
				</div>
			</div>

			<!--end中间内容-->	

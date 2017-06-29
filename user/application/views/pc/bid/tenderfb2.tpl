<!--start中间内容-->    
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
                                                                        <span class="on">选择招标类型</span>
                                                                    </p>
                                                                </li>
                                                                <li class="step">                                                                    
                                                                    <span class="val_on on">2</span>
                                                                    <p class="step_name">
                                                                        <span class="on">上传招标文件</span>
                                                                    </p>
                                                                </li>
                                                                <li class="step">                                                                    
                                                                    <span class="val_on on">3</span>
                                                                    <p class="step_name">
                                                                        <span class="on">填写招标公告</span>
                                                                    </p>
                                                                </li>
                                                                <li class="step">                                                                    
                                                                    <span class="val_on ">4</span>
                                                                    <p class="step_name">
                                                                        <span class="">提交保证金，发布招标</span>
                                                                    </p>
                                                                </li>
                                                            </ul>

                                                            <div class="clear"></div>
                        <form action="{url:/bid/createNewBid}" method="post" auto_submit="1">

                                                            <div class="bid" style="margin-top:30px;">


                                                                <div class="bid_cont" >
                                                                    <input type="hidden" name="mode" value="{$_GET['type']}" />
                                                                    <input type="hidden" name="docsrc" value="{$docSrc}" />
                                                                    <p>
                                                                        <span>市场分类：</span>
                                                                        <span><select name="top_cate">
                                                                            {foreach:$items=$topCate}
                                                                            <option value="{$item['id']}">{$item['name']}</option>
                                                                            {/foreach}
                                                                        </select></span>
                                                                    </p>

                                                                    <p>
                                                                        <span>项目名称：</span>
                                                                        <input type="text" style="width:314px;" name="pro_name" datatype="*" errormsg="请填写项目名称"><i>*</i>

                                                                        <span class="sec_op">项目地点：</span>
                                                                        <input type="text" name="pro_address" datatype="*" errormsg="请填写项目地点"/><i>*</i>
                                                                    </p>
                                                                    <p>
                                                                        <span>投标时间：</span>
                                                                        <input type="date" value="" name="begin_time" datatype="*" />
                                                                        <span>至</span>
                                                                        <input type="date" value="" name="end_time" datatype="*" /><i>*</i>
                                                                        <span class="tips">
                                                                            开始日期不晚于当前日期一个月，过程在10-30天内
                                                                        </span><br/>

                                                                        <span>开标时间：</span>
                                                                        <input type="date" value="" name="open_time" datatype="*" ><i>*</i>
                                                                        <span class="tips">
                                                                            截标后10-60天内
                                                                        </span>
                                                                    </p>

                                                                    <h3>一、招标条件<i>*</i></h3>

                                                                    <textarea style="resize: none;width:100%;" name="bid_require" datatype="*"></textarea>
                                                                    <h3>二、项目概况与招标内容</h3>
                                                                    <h4>1、项目概况<i>*</i></h4>
                                                                    <textarea style="resize: none;width:100%;" name="pro_brief" datatype="*"></textarea>
                                                                    <h4>2、招标内容<i>*</i></h4>
                                                                    <textarea style="resize: none;width:100%;" name="bid_content" datatype="*"></textarea>
                                                                    <p>
                                                                        <input type="radio" checked name="pack_type" value="1">分包&nbsp;&nbsp;说明：投标人可以单个包件投标
                                                                        
                                                                        <input type="radio" name="pack_type" style="margin-left:30px;" value="2">总包&nbsp;&nbsp;说明：选择此按钮投标人需要投所有的包件

                                                                    </p>



                                                                    <script type="text/javascript">

                                                                        $(document).ready(function () {
                                                                            $("#table").DataTable()
                                                                        });
                                                                        var i = 0;
                                                                        //添加行
                                                                        function addRow() {
                                                                            i++;
                                                                            var rowTem = '<tr class="tr_' + i + '">'
                                                                                    + '<td><input type="text" name="pack_no[]"  datatype="*"/></td>'
                                                                                    + '<td><input type="text" name="product_name[]" datatype="*"></td>'
                                                                                    + '<td><input type="text" name="brand[]"  datatype="*"></td>'
                                                                                    + '<td><input type="text" name="spec[]" datatype="*"></td>'
                                                                                    + '<td><input type="text" name="tech_need[]"  datatype="*"></td>'
                                                                                    + '<td><input type="text" name="unit[]"  datatype="*"></td>'
                                                                                    + '<td><input type="text" name="num[]"  datatype="n"></td>'
                                                                                    + '<td><input type="text" name="tran_days[]" datatype="n"></td>'
                                                                                    + '<td><a onclick=delRow('+i+') >删除</a></td>'
                                                                                + '</tr>';
                                                                           //var tableHtml = $("#table tbody").html();
                                                                           // tableHtml += rowTem;
                                                                              $("#table tbody:last").append(rowTem);
                                                                          //  $("#table tbody").html(tableHtml);

                                                                        }
                                                                        //删除行
                                                                        function delRow(_id) {
                                                                            $("#table .tr_"+_id).hide();
                                                                            i--;
                                                                        }
                                                                    </script>
                                                                        <table id="table" border="1" width="863px">
                                                                            <tr>
                                                                                <td>包件号</td>
                                                                                <td>货物名称</td>
                                                                                <td>品牌</td>
                                                                                <td>型号规格</td>
                                                                                <td>技术要求</td>
                                                                                <td>计量单位</td>
                                                                                <td>数量</td>
                                                                                <td>交付日期(天)</td>
                                                                                <td>操作</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><input type="text" name="pack_no[]"  datatype="*"></td>
                                                                                <td><input type="text" name="product_name[]" datatype="*"></td>
                                                                                <td><input type="text" name="brand[]" datatype="*"></td>
                                                                                <td><input type="text" name="spec[]" datatype="*"></td>
                                                                                <td><input type="text" name="tech_need[]" datatype="*"></td>
                                                                                <td><input type="text" name="unit[]" datatype="*"></td>
                                                                                <td><input type="text" name="num[]" datatype="n"></td>
                                                                                <td><input type="text" name="tran_days[]" datatype="n"></td>
                                                                                <td><input type="button" value="新增" onclick="addRow();" /></td>
                                                                            </tr>
                                                                        </table>
                                                                        <p>备注：以上列表内容全部必填，没有可填无。</p>


                                                                    <h3>三、资格要求</h3>
                                                                    <p>本项目采用资格后审的方式，由评审委员会对投标单位的资质进行审查，符合资质要求的单位才能进入下一步招标环节。</p>
                                                                    <p>1、在中华人民共和国境内依法经国家工商税务机关登记注册，符合投标项目经验范围，具有独立企业法人资格的生产商或代理商。</p>
                                                                    <p>2、其他备注信息</p>
                                                                    <textarea style="resize: none;width:100%;" name="eq[]" datatype="*"></textarea>
                                                                    <h3>四、项目报名与招标文件的获取</h3>
                                                                    <p>1、报名须知</p>
                                                                    <p>供应商应登录耐耐网电子商务平台，填报企业相关资料，进行网站注册认证，获取账号密码后进行报名。</p>
                                                                    <p>2、招标文件的获取</p>
                                                                    <p>经资格审查入围的供应商，将对其发放招标文件。入围供应商登录耐耐网电子商务平台自行下载招标文件，并根据文件要求在投标截止日之前通过耐耐网电子商务平台进行网上投标。</p>
                                                                    <p>3、我公司招标办于<input type="date" value="" name="doc_begin" datatype="*">起以每份
                                                                        <input type="text" value="" name="doc_price" datatype="n">元人民币的价格出售标书，售后不退。</p>
                                                                    

                                                                    <h3>五、投标文件的递交与开标时间及地点</h3>
                                                                    <p>1、合格投标人应在投标截止日前通过耐耐网电子商务平台进行网上投标，在上传投标文件的同时，提交保证金<input type="text" name="supply_bail" datatype="n">元，未中标者在投标结果发布之后退还，中标者在签订合同并缴纳合同履约金后予以退还。</p>
                                                                    <p>2、开标方式：<select name="open_way" id=""><option value="1">线上</option><option value="2">线下</option></select></p>
                                                                    <h3>六、支付方式</h3>
                                                                    <p><input name="pay_way[]" value="1" type="checkbox">代理账户&nbsp;&nbsp;
                                                                        <input name="pay_way[]" value="2" type="checkbox">中信银行&nbsp;&nbsp;

                                                                    <h3>七、其他事项</h3>
                                                                    <textarea style="resize: none;width:100%;height:150px;" name="other"></textarea>
                                                                    <h3>八、发布公告的媒介</h3>
                                                                    <p>本项目公告仅在耐耐网电子商务平台上发布，本公告的修改、补充，以在耐耐网电子商务平台发布的内容为准。本公告在各媒体发布的文本如有不同之处，以在耐耐网电子商务平台发布的文本为准。</p>
                                                                    <h3>九、联系方式（如没有代理机构可不填）</h3>
                                                                    <div class="contact">
                                                                        <p>招标人：<input type="text" name="bid_person" datatype="*"><i>*</i></p>
                                                                        <p>地址：<input type="text" name="cont_address" datatype="*"><i>*</i></p>
                                                                        <p>联系人：<input type="text" name="cont_person" datatype="*"><i>*</i></p>
                                                                        <p>电子邮件：<input type="text" name="cont_email" datatype="e"><i>*</i></p>
                                                                        <p>电话：<input type="text" name="cont_phone" datatype="m"><i>*</i></p>
                                                                        <p>传真：<input type="text" name="cont_tax" datatype="c"><i>*</i></p>
                                                                    </div>
                                                                    <div class="contact">
                                                                        <p>招标代理机构：<input type="text" name="agent"></p>
                                                                        <p>地址：<input type="text" name="agent_address"></p>
                                                                        <p>联系人：<input type="text" name="agent_person"></p>
                                                                        <p>电子邮件：<input type="text" name="agent_email"></p>
                                                                        <p>电话：<input type="text" name="agent_phone"></p>
                                                                        <p>传真：<input type="text" name="agent_tax"></p>
                                                                    </div>
                                                                    <h3>十、注意事项</h3>
                                                                    <p>1、所有电子投标文件应于投标截止及开标时间之前按照要求通过网上提交完毕。</p>
                                                                    <p>2、为避免因投标高峰期因网络堵塞等不可预见因素影响，各投标人应尽量提早上传投标文件并须在开标截止时间前完成电子投标文件的提交。</p>
                                                                    <p>3、非供应商会员投标需先完成注册后再投标。</p>
                                                                </div>


                                                            </div>

                                                            <div class="clear"></div>

                                                            <div class="button"><a href="{url:/bid/tenderfb1}?type={$type}"><button style="float: left;margin-right:20px;">上一步</button</a>><button style="margin:0;">保存</button></div>
                        </form>
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

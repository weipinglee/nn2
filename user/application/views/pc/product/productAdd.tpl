<script type="text/javascript" src="{root:js/swfupload/swfupload.js}" ></script>
<script type="text/javascript" src="{root:js/swfupload/handlers.js}" ></script>
{$swfupload}
	<div class="user_body">
		<div class="user_b">
			<!--start左侧导航-->	
			<div class="user_l">
				<div class="left_navigation">
					<ul>
						<li class="let_nav_tit"><h3>产品管理</h3></li>
						<li><a href="user_chp.html">产品信息</a></li>
						<li><a href="chp_fb.html" class="cur">产品发布</a></li>
						<li><a href="chp_lb.html">商品类别</a></li>
						<li><a href="chp_gp.html">挂牌</a></li>
					</ul>
				</div>
			</div>
			<!--end左侧导航-->	
			<!--start中间内容-->	
			<div class="user_c">
				<div class="user_zhxi">
					<div class="zhxi_tit">
						<p><a>产品管理</a>><a>产品发布</a></p>
					</div>
					<div class="center_tabl">
                    <form action="" method="">
						<table border="0">
                        <tr>
                            <th colspan="4">供求信息：</th>
                        </tr>

                        <tr>

                            <td><span>*</span>报盘类型：</td>
                            <td>
                                <select name="mode" id="">
                                    <option value="1" >自由报盘</option>
                                    <option value="2" >保证金报盘</option>
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td><span>*</span>货名：</td>
                            <td><input name="warename" id="warename" type="text"></td>
            				<td><span>*</span>商品类别：</td>
            				<td>	
                                <select name="classcode" id="classcode">
                                    
                                </select>
							</td>

           				 </tr>

           		 		<tr>
                            <td><span>*</span>单价：</td>
                            <td><input name="price" id="" type="text"></td>
                            <td><span>*</span>供货总量(单位)：</td>
                            <td><input name="quantity" id="" maxlength="7" type="text"></td>
                        </tr>

                        <tr>
                            <td><span>*</span>是否可拆分：</td>
                            <td>
                                <select name="divide" id="">
                                    <option value="0" selected >可以</option>
                                    <option value="1" selected >不可以</option>
                                </select>
                            </td>
                            <td><span>*</span>最小起订量：</td>
                            <td>
                                <input name="minimum" id="" type="text" />
                            </td>
                        </tr>
           				<!--<tr>
                            <td>交货方式：</td>
                            <td>
                            <select name="gg" id="gg">
                                <option value="1">承运</option>
                                <option value="2">自提</option>
                            </select>
                           </td>
                           <td>结算方式：</td>
                            <td>
                            <select name="grade" id="grade">
                                
                                <option value="A">电汇</option>
                                <option value="B">承兑</option>
                                <option value="C">现金</option>
                            </select>
                            </td>
                        </tr>-->

                        <tr>
                            <td>图片预览：</td>
                            <td colspan="3" id="imgContainer">

                            </td>              
                        </tr>
          				<tr>
                            <td>产品图片：</td>
                            <td colspan="3">
								<span>
									<div class="upload_btn">
                                        <span id="uploadButton">上传</span>
                                    </div>
								</span> 
               				 </td>
           				 </tr>

                        <tr>
                            <td>产品描述:</td>
                            <td colspan="3">
            					<textarea></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <th colspan="3" class="btn">
                                <a href="javascript:void(0);" onclick="checkform()">确 定</a>
                                <a href="javascript:void(0);" onclick="res()">重 置</a>
                            </th>
                        </tr>
                         
                 </table>
            	</form>
						
					</div>
				</div>
			</div>

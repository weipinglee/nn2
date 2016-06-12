        <script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
        <script type="text/javascript" src="{views:js/validform/validform.js}"></script>
        <script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
        <script type="text/javascript" src="{views:js/layer/layer.js}"></script>
        <!--            
              CONTENT 
                        -->
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" />申述管理
</h1>

<div class="bloc">
    <div class="title">
       申述信息
    </div>
     <div class="pd-20">
     {if: $handler==1}
     <form action="{url:trade/complain/docheck}" method="POST" auto_submit redirect_url="{url:trade/complain/complainList?status=0}">
     {elseif: $handler == 2}
     <form action="{url:trade/complain/dohandler}" method="POST" auto_submit redirect_url="{url:trade/complain/complainList?status=0}">
     {/if}

	 	 <table class="table table-border table-bordered table-bg">

	 		<tr>
	 			<th>订单号</th>
	 			<td>{$detail['order_no']}</td>
	 			<th>申述类型</th>
	 			<td>{$detail['type']}</td>
	 			<th>申述用户</th>
	 			<td>{$detail['username']}</td>
	 		</tr>
            <tr>
                <th>申请日期</th>
                <td>{$detail['apply_time']}</td>
                <th>审核日期</th>
                <td>{$detail['check_time']}</td>
                <th>处理日期</th>
                <td>{$detail['handle_time']}</td>

            </tr>
      	 		<tr>
                    <th>申述标题</th>
                    <td colspan="5">{$detail['title']}</td>
      	 		</tr>
             <tr>
                <th>申述内容</th>
                <td colspan="5">
                         {$detail['detail']}
                </td>
            </tr>
            <tr>
                <th>申述凭证</th>
                <td colspan="5">
                        <ul>
                        {if: !empty($detail['proof'])}
                        {foreach: items=$detail['proof']  item=$img}
                        <li><img src="{$img}"></li>
                        {/foreach}
                        {/if}
                        </ul>
                </td>
            </tr>
            <tr>

              <th>状态</th>
              <td colspan="5">{$detail['statuscn']}</td>

            </tr>
            <tr>

              <th>审核意见</th>
              <td colspan="3">{$detail['check_msg']}</td>
             <th>审核用户</th>
              <td >{$checkAdminData['name']}</td>
            </tr>
            <tr>

              <th>处理意见</th>
              <td colspan="3">{$detail['handle_msg']}</td>
<th>处理用户</th>
              <td >{$handlerAdminData['name']}</td>
            </tr>
           
             <tr>
             {if: $handler == 1}
             <tr>
             <th>填写审核意见</th>
             <td colspan="6">
              <textarea name="msg" cols="" rows="" class="textarea"  onKeyUp="textarealength(this,1000)"></textarea>
              </td>
              </tr>
             {elseif: $handler == 2}
              <tr>
             <th>填写处理意见</th>
             <td colspan="6">
              <textarea name="msg" cols="" rows="" class="textarea"  onKeyUp="textarealength(this,1000)"></textarea>
              </td>
              </tr>
             {/if}
                 <th>处理结果</th>
                 <input type="hidden"  name='id' value="{$detail['id']}" />
                 <input type="hidden"  name='oid' value="{$detail['oid']}" />
                  <th scope="col" colspan="7">
                  <input  type="hidden" name="id" value="{$detail['id']}" />
                  {if: $handler == 1}
                     <label><input type="radio" name="status" value="1" checked/>介入处理</label>
                      <label><input type="radio" name="status" value="0"/>不通过</label>
                  {elseif: $handler == 2}
                      <label><input type="radio" name="status" value="1" checked/>介入后协商通过</label>
                      <label><input type="radio" name="status" value="2"/>买方违约</label>
                      <label><input type="radio" name="status" value="3"/>卖方违约</label>
                  {/if}

                 </th>
             </tr>
             <tr>
                 <th>操作</th>
                 <th scope="col" colspan="7">
                     <input type="submit" class="btn btn-primary radius" value="提交"/>
                     <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove"></i> 返回</a>
                 </th>
             </tr>

	 	</table>
    </form>
 	</div>
</div>
</div>

        
    </body>
</html>
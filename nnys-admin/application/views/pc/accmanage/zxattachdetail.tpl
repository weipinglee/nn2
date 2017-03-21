        <script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
        <script type="text/javascript" src="{views:js/validform/validform.js}"></script>
        <script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
        <script type="text/javascript" src="{views:js/layer/layer.js}"></script>
        <!--            
              CONTENT 
                        -->
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" />中信附属账户详情
</h1>

<div class="bloc">
    <div class="title">
       附属账户信息
    </div>
     <div class="pd-20">

     <form action="{url:balance/accManage/editzxattach}" method="POST" auto_submit >


	 	 <table class="table table-border table-bordered table-bg">

	 		<tr>
	 			<th>用户名称</th>
	 			<td>{$user['company_name']}{$user['true_name']}</td>
	 			<th>用户类型</th>
	 			<td>{$user['user_type']}</td>
	 			<th>用户行业</th>
	 			<td>{$user['category']}</td>
                <th></th>
                <td></td>
	 		</tr>

      	 		<tr>
                    <th>银行名称</th>
                    <td >中信</td>
                    <th>账户名称</th>
                    <td >{$attach['name']}</td>
                    <th>法人</th>
                    <td >{$attach['legal']}</td>
                    <th></th>
                    <td></td>
      	 		</tr>
             <tr>

                 <th>开户身份证</th>
                 <td >{$attach['id_card']}</td>
                 <th>地址</th>
                 <td >{$attach['address']}</td>
                 <th>申请时间</th>
                 <td >{$attach['time']}</td>
                 <th></th>
                 <td></td>
             </tr>

             <tr>

                 <th>联系人</th>
                 <td >{$attach['contact_name']}</td>
                 <th>电话</th>
                 <td >{$attach['contact_phone']}</td>
                 <th>邮箱</th>
                 <td >{$attach['mail_address']}</td>
                 <th></th>
                 <td></td>
             </tr>

            <tr>

              <th>状态</th>
              <td colspan="5">{if:$attach['no']}申请成功{else:}申请中{/if}</td>
                <th></th>
                <td></td>
            </tr>
             <tr>
                 <th>附属账户</th>
                 <td colspan="5">
                     <input type="hidden" name="user_id" value="{$attach['user_id']}" />
                     <input  class="input-text" style="width:200px" type="text" name="attach_no" value="{$attach['no']}" /></td>
                 <th></th>
                 <td></td>
             </tr>

             <tr>
                 <th>操作</th>
                 <th scope="col" colspan="7">
                     <input type="submit" class="btn btn-primary radius" value="提交"/>
                     <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove fa-remove"></i> 返回</a>
                 </th>
             </tr>

	 	</table>
    </form>
 	</div>
</div>
</div>

        
    </body>
</html>
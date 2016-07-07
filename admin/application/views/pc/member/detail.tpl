
        <!--            
              CONTENT 
                        -->
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" />会员详情
</h1>

<div class="bloc">
    <div class="title">
       会员详情
    </div>
     <div class="pd-20">




	 	 <table class="table table-border table-bordered table-bg">

             <tr>
                 <th>用户名</th>
                 <td >{$user['username']}</td>
                 <th>注册手机号</th>
                 <td >{$user['mobile']}</td>
                 <th>邮箱</th>
                 <td >{$user['email']}</td>
                 <th>注册时间</th>
                 <td>{$user['create_time']}</td>
             </tr>

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
                {if:$user['type']==1}
                <th>联系人</th>
                <td>{$user['contact']}</td>
                <th>联系人电话</th>
                <td>{$user['contact']}</td>
                {else:}
                    <th>联系人电话</th>
                    <td>{$user['mobile']}</td>
                {/if}

                <th>用户地区</th>
                <td><span id="area">{areatext:data=$user['area'] id=area}</span></td>
                <th>详细地址</th>
                <td>{$user['address']}</td>
            {if:$user['type']==1}
            <tr>
                 <th>法人</th>
                 <td >{$user['legal_person']}</td>
                 <th>注册资金</th>
                 <td >{$user['reg_fund']}(万)</td>
                 <th>主营品种</th>
                 <td >{$user['business']}</td>
                 <th></th>
                 <td></td>
            </tr>
             {/if}


             <tr>
                 <th>操作</th>
                 <th scope="col" colspan="7">
                     <form action="{url:member/member/yewuAdd}" method="post" auto_submit redirect_url="{url:member/member/memberlist}">
                         <input type="hidden" name="id" value="{$user['id']}" />
                         <select name="yewu" datatype="/[1-9][\d]{0,}/">
                             <option value="0">请选择业务员</option>
                             {foreach:items=$yewu}
                                 <option value="{$item['admin_id']}" {if:$user['yewu']==$item['admin_id']}selected="true"{/if}>{$item['ser_name']}</option>
                             {/foreach}
                         </select>

                         <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;绑定业务员&nbsp;&nbsp;">
                     </form>
                     <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove fa-remove"></i> 返回</a>
                 </th>
             </tr>

	 	</table>

 	</div>
</div>
</div>

        
    </body>
</html>
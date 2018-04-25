
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



       <form action="{url:member/vipManage/setStatus}" method="post" auto_submit="1">
	 	 <table class="table table-border table-bordered table-bg">

             <tr>
                 <th>用户名</th>
                 <td >{$user['username']}</td>
                 <th>手机号</th>
                 <td >{$user['mobile']}</td>
                 <th>企业名称</th>
                 <td>{$user['name']}</td>
                 <th>申请时间</th>
                 <td>{$user['apply_time']}</td>
             </tr>

            <tr>
                <th>联系人</th>
                <td>{$user['contact_person']}</td>
                <th>联系人电话</th>
                <td>{$user['contact_phone']}</td>
                <th>地区</th>
                <td >{areatext:data=$user['area']}</td>
                <th>详细地址</th>
                <td>{$user['address']}</td>
             <tr>
             <tr>
                 <th>会员类型</th>
                 <td scope="col" colspan="7">
                     <select name="type">
                         <option value="1" {if:$user['type']==1}checked="true"{/if}>免费体验</option>
                         <option value="2" {if:$user['type']==2}checked="true"{/if}>合伙人</option>
                     </select>
                 </td>

             </tr>
                 <th>审核</th>
                 <th scope="col" colspan="7">
                     <input type="hidden" name="user_id" value="{$user['user_id']}" />
                     <label><input type="radio" name="status" checked="1" value="1">通过</label>
                     <label><input type="radio" name="status" value="0"/>驳回</label>

                 </th>
             </tr>
             <tr>
                <td colspan="8">
                    <input type="submit" class="btn btn-primary radius" value="提交"/>
                  <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove fa-remove"></i> 返回</a>  
                </td>
             </tr>

	 	</table>

       </form>

 	</div>
</div>
</div>

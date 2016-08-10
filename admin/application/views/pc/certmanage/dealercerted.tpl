
        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 交易商已认证</h1>
<div class="bloc">
    <div class="title">
        会员认证
    </div>
    <div class="content">
        <div class="pd-20">
            {include:layout/search.tpl}
           <table class="table table-border table-bordered table-hover table-bg">
        <thead>
            <tr>
                <th scope="col" colspan="9">会员账户</th>
            </tr>
            <tr class="text-c">
               <!-- <th><input type="checkbox" value="" name=""></th>-->
                <th>ID</th>
                <th >登录账号</th>
                <th>会员类型</th>
                <th>手机号</th>
				<th>认证状态</th>
				<th>申请时间</th>
				<th>操作</th>
            </tr>
        </thead>
        <tbody>
        {foreach:items=$data['list']}
            <tr class="text-c">
                <!--<td><input type="checkbox" value="" name=""></td>-->
                <td>{$item['id']}</td>
                <td>{$item['username']}</td>
                s<td>{$item['type_text']}</td>
                <td>{$item['mobile']}</td>
				<td>{$item['status_text']}</td>
				<td>{$item['apply_time']}</td>

                <td class="f-14"><a title="编辑" href="{url:member/certManage/dealercertDetail?uid=$item['id']}"  style="text-decoration:none"><i class=" icon-edit fa-edit"></i></a> </td>
				
            </tr>
        {/foreach}

        </tbody>
    </table>
        </div>
        {$data['bar']}
    </div>
</div>


     
        

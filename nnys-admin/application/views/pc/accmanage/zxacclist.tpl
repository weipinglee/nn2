
        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 中信账户</h1>
<div class="bloc">
    <div class="title">
        账户列表
    </div>
    <div class="content">
        <div class="pd-20">
            {include:layout/search.tpl}
    <div class="mt-20">
    <table class="table table-border table-bordered table-hover table-bg table-sort">
        <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="checkall" value=""></th>
                <th width="60">附属账号</th>
				<th width="60">会员号</th>
                <th width="70">附属账户名称</th>
                <th width="90">法人</th>
                <th width="60">总金额</th>
                <th width="50">身份证</th>
                <th width="100">申请时间</th>
                <th width='100'>操作</th>
            </tr>
        </thead>
        <tbody>
        {foreach:items=$data['list']}
            <tr class="text-c">
                <td><input type="checkbox" value="" name="check"></td>
                <td>{$item['no']}</td>
				 <td>{$item['user_no']}</td>
                <td><u style="cursor:pointer" class="text-primary" >{$item['username']}</u></td>
                <td>{$item['name']}</td>
                <td>{$item['legal']}</td>
                <td>{$item['id_card']}</td>
                <td>{$item['time']}</td>
                <td class="td-manage">
                    <a title="查看明细" href="{url:balance/accManage/zxattachdetail}?user_id={$item['user_id']}" class="ml-5" style="text-decoration:none"><i class="icon-edit fa-edit"></i></a>
            </tr>
        {/foreach}
        </tbody>

    </table>
        {$data['bar']}
    </div>
</div>
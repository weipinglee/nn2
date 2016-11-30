
<div id="content" class="white">
    <h1><img src="{views:img/icons/posts.png}" alt="" /> 风险管理</h1>
    <div class="bloc">
        <div class="title">
            管理员预警列表
        </div>
        <div class="content">
            <div class="pd-20">
                {include:layout/search.tpl}
                <div class="mt-20">
                    <table class="table table-border table-bordered table-hover table-bg table-sort">
                        <thead>
                        <tr class="text-c">

                            <th width="80">ID</th>
                            <th width="80">管理员编号</th>
                            <th width="100">管理员名</th>
                            <th width="100">管理分组</th>
                            <th width="130">预警原因</th>
                            <th width="130">预警时间</th>
                            <th width="100">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        {foreach:items=$data['list']}
                            <tr class="text-c">

                                <td>{$item['id']}</td>
                                <td>{$item['admin_id']}</td>
                                <td><u style="cursor:pointer" class="text-primary" >{$item['name']}</u></td>

                                <td>{if:$item['role']==0}超级管理员{else:}{$item['role_name']}{/if}</td>
                                <td>{$item['introduce']}</td>
                                <td>{$item['record_time']}</td>
                                     <td class="td-manage"><!--<a style="text-decoration:none" onClick="member_stop(this,'10001')" href="javascript:;" title="停用"><i class="icon-pause fa-pause"></i></a>--> <a title="编辑" href="{url:riskmgt/riskmgt/checkadminrisk?id=$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-edit fa-edit"></i> </a></td>
                            </tr>
                        {/foreach}
                        </tbody>

                    </table>
                    {$data['bar']}
                </div>
            </div>

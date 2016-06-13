
<!--
      CONTENT
                -->
<script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
<script type="text/javascript" src="{views:js/layer/layer.js}"></script>
<div id="content" class="white">
    <h1><img src="{views:img/icons/posts.png}" alt="" /> 推荐商户</h1>
    <div class="bloc">
        <div class="title">
            推荐列表
        </div>
        <div class="content">
            <div class="pd-20">

                <div class="mt-20">
                    <table class="table table-border table-bordered table-hover table-bg table-sort">
                        <thead>
                        <tr class="text-c">
                            <th width="25"><input type="checkbox" name="" value=""></th>
                            <th width="100">用户名</th>
                            <th width="90">企业名</th>
                            <th width="60">推荐类型</th>
                            <th width="50">开始时间</th>
                            <th width="80">结束时间</th>
                            <th width="80">状态</th>
                            <th width='100'>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        {foreach:items=$recList}
                            <tr class="text-c">
                                <td><input type="checkbox" value="" name=""></td>
                                <td><u style="cursor:pointer" class="text-primary" >{$item['username']}</u></td>
                                <td>{$item['company_name']}</td>
                                <td>{echo: \nainai\companyRec::getRecType($item['type'])}</td>
                                <td>{$item['start_time']}</td>
                                <td>{$item['end_time']}</td>
                                <td class="td-status">
                                    {if:$item['status'] == 1}

                                        <span class="label label-success radius">已启用</span>
                                    {else:}
                                        <span class="label label-error radius">停用</span>
                                    {/if}
                                </td>
                                <td class="td-manage">
                                    {if:$item['status'] == 1}
                                        <a style="text-decoration:none" href="javascript:;" title="停用" ajax_status=0 ajax_url="{url:member/companyRec/setStatus?id=$item['id']}"><i class="icon-pause"></i></a>
                                    {elseif:$item['status'] == 0}
                                        <a style="text-decoration:none" href="javascript:;" title="启用" ajax_status=1 ajax_url="{url:member/companyRec/setStatus?id=$item['id']}"><i class="icon-play"></i></a>
                                    {/if}
                                    <a title="审核" href="{url:member/companyRec/recEdit}?id={$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a>
                                    <a title="删除" href="javascript:void(0);" onclick="delRec({$item['id']},this)" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
                            </tr>
                        {/foreach}
                        </tbody>
                        <script type="text/javascript">
                            function delRec(id,obj){
                                var obj=$(obj);
                                var url="{url:/member/companyRec/recDel}";
                                if(confirm("确定要删除吗")){
                                    $.ajax({
                                        type:'get',
                                        cache:false,
                                        data:{id:id},
                                        url:url,
                                        dataType:'json',
                                        success:function(ms){
                                            if(ms['success']==1){
                                                layer.msg(ms['info'],{time:2000});
                                                obj.parents("tr").remove();
                                            }else{
                                                layer.msg(ms['info'],{time:2000,btn:['OK']});
                                            }
                                        }
                                    });
                                }
                            }
                        </script>
                    </table>
                    {$pageBar}
                </div>
            </div>

<!--
      CONTENT
                -->
<div id="content" class="white">
    <h1><img src="{views:img/icons/posts.png}" alt="" /> 帮助分类管理</h1>
    <div class="bloc">
        <div class="title">
            帮助分类列表
        </div>
        <div class="content">
            <div class="cl pd-5 bg-1 bk-gray"> <a class="btn btn-primary radius" href="{url:/tool/help/helpCatAdd}"><i class=" icon-plus"></i> 添加分类</a> </span>  </div>
            <div class="pd-20">

                <div class="mt-20">
                    <table class="table table-border table-bordered table-hover table-bg table-sort">
                        <thead>
                        <tr class="text-c">
                            <th width="25"><input type="checkbox" name="" value=""></th>
                            <th width="100">名称</th>
                            <th width="90"> 页面底部显示</th>
                            <th width="60">帮助页左侧显示</th>
                            <th width="50">排序</th>
                            <th width='100'>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        {foreach:items=$helpCatList}
                            <tr class="text-c">
                                <td><input type="checkbox" value="" name=""></td>
                                <td><u style="cursor:pointer" class="text-primary" >{$item['name']}</u></td>
                                <td class="td-status">{if:$item['position_foot']==1}<span class="label label-success radius">已启用</span>{else:}<span class="label label-error radius"></span>{/if}</td>
                                <td class="td-status">
                                    {if:$item['position_left'] == 1}

                                        <span class="label label-success radius">已启用</span>
                                    {else:}
                                        <span class="label label-error radius">停用</span>
                                    {/if}
                                </td>
                                <td>{$item['sort']}</td>
                                <td class="td-manage">
                                    <a title="编辑" href="{url:/tool/help/helpCatEdit}?id={$item['id']}" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a>
                                    <a title="删除" href="javascript:void(0);" onclick="delFundOut('{$item['id']}',this)" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
                            </tr>
                        {/foreach}
                        </tbody>
                        <script type="text/javascript">
                            function delFundOut(name,obj){
                                var obj=$(obj);
                                var name=name;
                                var url="{url:/tool/help/delHelpCat}";
                                if(confirm("确定要删除吗")){
                                    $.ajax({
                                        type:'get',
                                        cache:false,
                                        data:{id:name},
                                        url:url,
                                        dataType:'json',
                                        success:function(msg){
                                            if(msg['success']==1){

                                                obj.parents("tr").remove();
                                            }else{
                                                alert(msg['info']);
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
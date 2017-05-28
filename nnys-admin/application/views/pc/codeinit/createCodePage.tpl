<script type="text/javascript" src="{views:js/arttemplate/artTemplate.js}"></script>
<script type="text/javascript" src="{views:js/code/createList.js}"></script>
<!--
            CONTENT
                      -->
<div id="content" class="white">
    <h1><img src="{views:img/icons/posts.png}" alt="" /> 代码生成</h1>
    <div class="bloc">
        <div class="title">
            代码生成
        </div>
        <div class="content">
            <div class="pd-20">
                <div class="cl pd-5 bg-1 bk-gray">
                 <span class="l">
                    <input type="text" name="table_add" />
                     <input type="hidden" name="getTableUrl" value="{url:code/codeInit/getTableData}"/>
                     <a class="btn btn-primary radius" href="javascript:void(0)" id="addTable">
                         <i class=" icon-plus fa-plus"></i> 添加数据表
                     </a>
                 </span>

                </div>

            </div>
            <table class="table table-border table-bordered table-hover table-bg">
                <thead>
                <tr>
                    <th scope="col" colspan="9" ><span ></span></th>
                    <th scope="col" colspan="1">
                        <input type="button" name="del" value="删除"/>
                    </th>
                </tr>
                <tr class="text-c">
                    <th><input type="checkbox" value="" name="checkall"></th>
                    <th width="20">序号</th>
                    <th >表名</th>
                    <th>字段名</th>
                    <th>数据类型</th>
                    <th >中文名称</th>
                    <th>是否显示</th>
                    <th>显示类型</th>
                    <th>模板参数</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>


                <tr class="text-c" name="bottomTr">
                    <td style="height:10px;margin:0px;"><input type="checkbox" value="" name="checkall"></td>

                    <td style="height:10px;margin:0px;" >
                        <input type="button" name="del_trs" value="删除选中字段"/>
                    </td>
                    <td></td>
                    <td style="height:10px;margin:0px;"></td>
                    <td style="height:10px;margin:0px;"></td>
                    <td style="height:10px;margin:0px;">

                    </td>
                    <td style="height:10px;margin:0px;"></td>
                    <td style="height:10px;margin:0px;"></td>
                    <td></td>
                    <td class="f-14" style="height:10px;"></td>

                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script type="text/html" id="listPage">

            <% for(var i=0;i<data.length;i++){ %>
            <tr class="text-c tr_move" >
                <td style="height:10px;margin:0px;"><input type="checkbox" value="" name="check"></td>
                <td></td>
                <td><span name="tableName"><%=tableName%></span></td>
                <td style="height:10px;margin:0px;"><input type="text" name="field_name_<%=data[i].Field%>" value="<%=data[i].Field%>"/></td>
                <td style="height:10px;margin:0px;"><input type="text" value="<%=data[i].Type%>" /></td>
                <td style="height:10px;margin:0px;"><input type="text"  /></td>
                <td style="height:10px;margin:0px;">
                    <select name="show_<%=data[i].Field%>" >
                        <option value="1" >是</option>
                        <option value="0" >否</option>
                    </select>
                </td>
                <td style="height:10px;margin:0px;"><select name="showType_<%=data[i].Field%>" >
                        {foreach:$items=$listTags }
                        <option value="{$key}" name="{$item['arg']}" >{$key}</option>
                        {/foreach}
                    </select></td>
                <td style="height:10px;margin:0px;">
                    <span>$1:</span><input type="text"  name="$1_<%=data[i].Field%>"/></br>

                </td>

                <td class="f-14" style="height:10px;"><a title="编辑" href="javascript:void(0)" name="del_tr" style="text-decoration:none"><i class=" icon-trash fa-trash"></i></a> </td>

            </tr>
            <% } %>





    </script>
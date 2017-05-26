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

        </div>
    </div>

    <script type="text/html" id="listPage">
        <table class="table table-border table-bordered table-hover table-bg">
            <thead>
            <tr>
                <th scope="col" colspan="7" ><span name="tableName"><%=tableName%></span></th>
                <th scope="col" colspan="1">
                    <input type="button" name="del" value="删除"/>
                </th>
            </tr>
            <tr class="text-c">
                <th><input type="checkbox" value="" name="checkall"></th>
             
                <th>字段名</th>
                <th>数据类型</th>
                <th >中文名称</th>
                <th>是否显示</th>
                <th>显示类型</th>
                <th>联结字段</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <% for(var i=0;i<data.length;i++){ %>
            <tr class="text-c tr_move" >
                <td style="height:10px;margin:0px;"><input type="checkbox" value="" name="check"></td>

                <td style="height:10px;margin:0px;"><input type="text" name="field_name" value="<%=data[i].Field%>"/></td>
                <td style="height:10px;margin:0px;"><input type="text" value="<%=data[i].Type%>" /></td>
                <td style="height:10px;margin:0px;"><input type="text"  /></td>
                <td style="height:10px;margin:0px;">
                    <select name="show" >
                        <option value="1" >是</option>
                        <option value="0" >否</option>
                    </select>
                </td>
                <td style="height:10px;margin:0px;"><select name="show" >
                        <option value="1" >样式1</option>
                        <option value="2" >样式2</option>
                    </select></td>
                <td style="height:10px;margin:0px;"><input type="text"  name="join_field"/></td>

                <td class="f-14" style="height:10px;"><a title="编辑" href="javascript:void(0)" name="del_tr" style="text-decoration:none"><i class=" icon-trash fa-trash"></i></a> </td>

            </tr>
            <% } %>
            <tr class="text-c">
                <td style="height:10px;margin:0px;"><input type="checkbox" value="" name="checkall"></td>
                <td style="height:10px;margin:0px;">
                    <input type="button" name="del_trs" value="删除选中字段"/>
                </td>
                <td style="height:10px;margin:0px;"></td>
                <td style="height:10px;margin:0px;"></td>
                <td style="height:10px;margin:0px;">

                </td>
                <td style="height:10px;margin:0px;"></td>
                <td style="height:10px;margin:0px;"></td>

                <td class="f-14" style="height:10px;"></td>

            </tr>
            </tbody>
        </table>



    </script>
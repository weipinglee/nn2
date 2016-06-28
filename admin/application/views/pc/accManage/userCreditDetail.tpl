
        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" />报盘管理
</h1>
                
<div class="bloc">
    <div class="title">
       报盘信息
    </div>
     <div class="pd-20">
         <table class="table table-border table-bordered table-bg">
             <tr>
                 <th>用户名</th>
                 <td>{$info['type']}</td>
                 <th>注册手机号</th>
                 <td>{$info['mode_txt']}</td>
                 <th>邮箱</th>
                 <td></td>
             </tr>
             <tr>
                 <th>用户名称</th>
                 <td>{$info['topcate_name']}</td>
                 <th>用户类型</th>
                 <td>{$info['parent_cates']}</td>
                 <th>用户行业</th>
                 <td></td>
             </tr>
             <tr>
                 <th>联系人电话</th>
                 <td>{$info['quantity']}</td>
                 <th>用户地区</th>
                 <td>{$info['unit']}</td>
                 <th>详细地址</th>
                 <td></td>

             </tr>
            <tr>
                <th scope="col" colspan="1">信誉保证金充值</th>
                <td colspan="5"><input type="text" name="credit"/></td>
            </tr>
            <tr>
              <th scope="col" colspan="6">
                 <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove"></i> 返回</a>
              </th>
            </tr>
        </table>
    </div>
</div>

</div>
        
        
    </body>
</html>
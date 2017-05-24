
        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" />提现管理
</h1>
                
<div class="bloc">
    <div class="title">
       提现信息
    </div>
     <div class="pd-20">
         <form action="{url:balance/zx/txHandle}" confirm="1" method="post" auto_submit>
	 	 <table class="table table-border table-bordered table-bg">
             <tr>
                 <th>委托方</th>
                 <td>{$user['company_name']}{$user['true_name']}</td>
                 <th>用户类型</th>
                 <td>{$user['user_type']}</td>
                 <th>申请状态</th>
                 <td>{$detail['status_text']}</td>

             </tr>
             <tr>
                 <th>用户名</th>
                 <td>{$user['username']}</td>
                 <th>手机号</th>
                 <td>{$user['mobile']}</td>
                 <th>邮箱</th>
                 <td>{$user['email']}</td>
             </tr>

             <tr>
                 <th>提现银行</th>
                 <td>{$detail['bank_name']}</td>
                 <th>提现金额</th>
                 <td>
                     {$detail['amount']}
                 </td>
                 <th>提现序列号</th>
                 <td>
                     {$detail['request_no']}
                 </td>

             </tr>


             <tr>
                 <th>申请时间</th>
                 <td>{$detail['create_time']}</td>
                 <th>提现说明</th>
                 <td>{$detail['note']}</td>
                 <th></th>
                 <td >

                 </td>

             </tr>
             <tr>
                 <th>审核时间</th>
                 <td>{$detail['first_time']}</td>
                 <th>审核意见</th>
                 <td>{$detail['first_message']}</td>
                 <th></th>
                 <td ></td>

             </tr>
             {if:$detail['status']==0}
             <tr>
                 <th>处理结果</th>
                 <th scope="col" colspan="7">
                     <input  type="hidden" name="id" value="{$detail['id']}" />
                     <label><input type="radio" name="status" value="1" checked/>同意并提现</label>
                     <label><input type="radio" name="status" value="0"/>拒绝</label>


                 </th>
             </tr>

             <tr>
                 <th>操作</th>
                 <th scope="col" colspan="7">
                     <input type="submit"   class="btn btn-primary radius" value="提交"/>
                     <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove fa-remove"></i> 返回</a>
                 </th>

            </tr>
             {else:}
                 <tr>
                     <th>操作</th>
                     <th scope="col" colspan="7">
                         <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove fa-remove"></i> 返回</a>
                     </th>

                 </tr>
             {/if}
	 	</table>
         </form>
 	</div>
</div>

</div>
        
        
    </body>
</html>
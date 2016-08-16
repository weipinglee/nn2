
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




	 	 <table class="table table-border table-bordered table-bg">

             <tr>
                 <th>用户名</th>
                 <td >{$data['username']}</td>
                 <th>申请时间</th>
                 <td colspan="5">{$data['apply_time']}</td>
             </tr>
             {if: $data['type'] == 1}
             <tr>
                <th> 企业名称</th>
                <td>{$data['company_name']}</td>
                <th>企业法人</th>
                <td colspan="5">{$data['legal_person']}</td>
            </tr>
             {else:}
             <tr>
                <th> 真实姓名</th>
                <td>{$data['name']}</td>
                <th>身份证</th>
                <td colspan="5">{$data['ident_no']}</td>
            </tr>
             {/if}

            <tr>
                 <th>身份证照片</th>
                 <td colspan="2"><img src="{$data['ident_img']}"></td>
                 <th>申请单图片</th>
                 <td colspan="2"><img src="{$data['apply_img']}"></td>
            </tr>

            {if: $data['status'] == \nainai\user\ApplyResetpay::APPLY}
            <form action="{url:member/member/docheck}" method="post" auto_submit redirect_url="{url:member/member/applyPayList}">
            <tr>
                 <th>审核意见</th>
                 <td colspan="7"><textarea name="msg"></textarea></td>
             </tr>
            <tr>
                 <th>是否通过</th>
                 <td colspan="7">
                     <label><input type="radio" name="status" value="1" checked/>通过</label>
                      <label><input type="radio" name="status" value="0"/>不通过</label>
                 </td>
             </tr>

             <tr>
                 <th>操作</th>
                 <th scope="col" colspan="7">
                 <input type="hidden" name="id" value="{$data['id']}">
                 <input type="submit" class="btn btn-primary radius" value="提交"/>
                     <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove fa-remove"></i> 返回</a>
                 </th>
             </tr>
</form>
    {else:}
    <tr>
                 <th>审核意见</th>
                 <td colspan="7">{$data['msg']}</td>
             </tr>
    <form action="{url:member/member/reset}" method="post" auto_submit redirect_url="{url:member/member/resetpayList}">
             <tr>
                 <th>操作</th>
                 <th scope="col" colspan="7">
                 <input type="hidden" name="id" value="{$data['id']}">
                 <input type="submit" class="btn btn-primary radius" value="重置密码"/>
                     <a onclick="history.go(-1)" class="btn btn-default radius"><i class="icon-remove fa-remove"></i> 返回</a>
                 </th>
             </tr>
    </form>
    {/if}
             

	 	</table>

 	</div>
</div>
</div>

        
    </body>
</html>
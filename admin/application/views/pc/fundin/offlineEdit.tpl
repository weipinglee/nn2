
        
<script type="text/javascript" src="{views:content/settings/main.js}"></script>
<link rel="stylesheet" href="{views:content/settings/style.css}" />
<link rel="stylesheet" type="text/css" href="{views:css/H-ui.admin.css}">

          
            
                
                
        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="{views:img/icons/posts.png}" alt="" /> 线下入金审核</h1>
<div class="bloc">
    <div class="title">
        线下入金详情
    </div>
    <div class="content">
        <div class="pd-20">
    <form action="{$reInfo['url']}" method="post" class="form form-horizontal" id="offlineEidt" auto_submit redirect_url="{url:balance/fundIn/offlineList}">
        <input id='re_id' name='re_id' type="hidden" value="{if:isset($reInfo['id'])}{$reInfo['id']}{/if}" />
        <div class="row cl">
            <label class="form-label col-2">当前状态：</label>
            <div class="formControls col-10">
                {$reInfo['statusText']}
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-2">用户名：</label>
            <div class="formControls col-10">
                {$reInfo['username']}
            </div>
        </div>
         <div class="row cl">
            <label class="form-label col-2">手机号：</label>
            <div class="formControls col-10">
                {$reInfo['mobile']}
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-2">支付方式：</label>
             <div class="formControls col-10">
                线下 
            </div>
            
        </div>
             <div class="row cl">
            <label class="form-label col-2">订单号：</label>
                     <div class="formControls col-10">
                         {$reInfo['order_no']}
                    </div>
            </div>
              <div class="row cl">
            <label class="form-label col-2">金额：</label>
                      <div class="formControls col-10">
                         {$reInfo['amount']}
                    </div>        
            </div>
            <div class="row cl">
                <label class="form-label col-2">凭证： </label>
                <div class="formControls col-10">
                        <img src='{$reInfo['proot']}'>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-2">申请时间：</label>
                <div class="formControls col-10">
                     {$reInfo['create_time']}
                </div>
            </div>
            {if:$reInfo['first_time']!=null}
                <div class="row cl">
                    <label class="form-label col-2">初审时间：</label>
                    <div class="formControls col-10">
                        {$reInfo['first_time']}
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-2">初审意见：</label>
                    <div class="formControls col-10">
                        {$reInfo['first_message']}
                    </div>
                </div>
            {/if}
            {if:$reInfo['final_time']!=null}
                <div class="row cl">
                    <label class="form-label col-2">终审时间：</label>
                    <div class="formControls col-10">
                        {$reInfo['final_time']}
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-2">终审意见：</label>
                    <div class="formControls col-10">
                        {$reInfo['final_message']}
                    </div>
                </div>
            {/if}
        {if:$reInfo['action']!=''}
            <div class="row cl">
                <label class="form-label col-2"><span class="c-red">*</span>状态：</label>
                <div class="formControls col-10">
                    <input type="radio" class="input-text" value="1"   name="status" checked>通过
                    <input type="radio" class="input-text"  value="0" name="status" >驳回
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-2"><span class="c-red">*</span>意见：</label>
                <div class="formControls col-10">
                    <textarea name="message"></textarea>
                </div>
            </div>
            <div class="row cl">
                <div class="col-10 col-offset-2">
                    <button type="submit" class="btn btn-success radius" id="offline-save" name="admin-role-save"><i class="icon-ok"></i> 确定</button>
                </div>
            </div>
        {/if}

        </div>

    </form>
</div>

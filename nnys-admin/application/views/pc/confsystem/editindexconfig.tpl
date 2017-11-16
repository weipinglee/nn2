<!--
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" /> 编辑首页配置
</h1>
                
<div class="bloc">
    <div class="title">
        设置信息
    </div>
    <div class="content dashboard">
        <div>
            <form action="{url:system/Confsystem/editIndexconfig}" method="post" class="form form-horizontal" id="form-scaleoffer-add" auto_submit redirect_url="{url:system/Confsystem/indexconfiglist}">
        <div id="tab-system" class="HuiTab">
            <input type="hidden" name="id" value="{$data['id']}" />
            <div class="tabCon" style="display: block;">
                <div class="row cl">
                    <label class="form-label col-2"><span class="c-red">*</span>类型</label>
                    <div class="formControls col-10">
                        <select name="type" >
                            <option value="产品" {if:$data['type']=="产品"}selected="selected"{/if}>产品</option>
                            <option value="资讯" {if:$data['type']=="资讯"}selected="selected"{/if}>资讯</option>
                        </select>
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-2"><span class="c-red">*</span>用户id</label>
                    <div class="formControls col-10">
                        <input type="text" id="website-title" datatype="s2-30" name='user_id' value=" {$data['user_id']}" class="input-text" />
                    </div>
                </div>

                <div class="row cl">
                    <label class="form-label col-2"><span class="c-red">*</span>副标题</label>
                    <div class="formControls col-10">
                        <input type="text" id="website-title" name='sub_title' value=" {$data['sub_title']}"  class="input-text">
                    </div>
                </div>


            </div>            
        </div>
    

            <div class="cb"></div>

        <div class="row cl">
            <div class="col-10 col-offset-2">
               <button  class="btn btn-primary radius" type="submit"><i class="icon-save fa-save"></i> 保存</button>
                <!-- <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button> -->
            </div>
        </div>
        </form>
        </div>
    </div>
</div>



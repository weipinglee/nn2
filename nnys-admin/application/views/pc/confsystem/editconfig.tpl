<!--
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" /> 编辑配置
</h1>
                
<div class="bloc">
    <div class="title">
        设置信息
    </div>
    <div class="content dashboard">
        <div>
            <form action="{url:system/Confsystem/editConfig}" method="post" class="form form-horizontal" id="form-scaleoffer-add" auto_submit redirect_url="{url:system/Confsystem/generalList}">
        <div id="tab-system" class="HuiTab">
            <input type="hidden" name="id" value="{$data['id']}" />
            <div class="tabCon" style="display: block;">
                <div class="row cl">
                    <label class="form-label col-2"><span class="c-red">*</span>英文名</label>
                    <div class="formControls col-10">
                       {$data['name']}
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-2"><span class="c-red">*</span>中文名</label>
                    <div class="formControls col-10">
                        <input type="text" id="website-title" datatype="s2-30" name='name_zh' value=" {$data['name_zh']}" class="input-text" />
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-2"><span class="c-red">*</span>类型</label>
                    <div class="formControls col-10">
                        {$data['type']}
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-2"><span class="c-red">*</span>值</label>
                    <div class="formControls col-10">
                        <input type="text" id="website-title" name='value' value=" {$data['value']}"  class="input-text">
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


                
       
</form>
</div>

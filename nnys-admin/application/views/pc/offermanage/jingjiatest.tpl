<!--
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" /> 竞价配置
</h1>
                
<div class="bloc">
    <div class="title">
        设置信息
    </div>
    <div class="content dashboard">
        <div>
            <form action="{url:trade/offermanage/jingjiatest}" method="post" class="form form-horizontal" id="form-scaleoffer-add" auto_submit ">
        <div id="tab-system" class="HuiTab">
            
            <div class="tabCon" style="display: block;">

                <div class="row cl">
                    <label class="form-label col-2"><span class="c-red">*</span>报盘id</label>
                    <div class="formControls col-10">
                        <input type="text" id="website-title"  name='offer_id'  class="input-text" />
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-2"><span class="c-red">*</span>用户名</label>
                    <div class="formControls col-10">
                        <input type="text" id="website-title"  name='username'  class="input-text" />
                    </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-2"><span class="c-red">*</span>价格</label>
                    <div class="formControls col-10">
                        <input type="text" id="website-title" name='price'  class="input-text" />
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



</div>

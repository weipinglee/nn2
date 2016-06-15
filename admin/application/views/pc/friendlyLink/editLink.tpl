<script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
<script type="text/javascript" src="{views:js/validform/validform.js}"></script>
<script type="text/javascript" src="{views:js/validform/formacc.js}"></script>
<script type="text/javascript" src="{views:js/layer/layer.js}"></script>
<script type="text/javascript" src="{views:content/settings/main.js}"></script>
<link rel="stylesheet" href="{views:content/settings/style.css}" />
<link rel="stylesheet" type="text/css" href="{views:css/H-ui.admin.css}">
<script type="text/javascript" src="{views:js/My97DatePicker/WdatePicker.js}"></script>
<!--
      CONTENT
                -->
<div id="content" class="white">

    <h1><img src="{views:img/icons/dashboard.png}" alt="" />友情链接管理

    </h1>

    <div class="bloc">
        <div class="title">
            编辑友情链接
        <div class="pd-20">

            <form action="{url:system/friendlyLink/editLink}" method="post" class="form form-horizontal" id="form-member-add" auto_submit redirect_url="{url:system/friendlyLink/frdLinkList}">
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span> 名称：</label>
                    <div class="formControls col-5">
                        <input type="text" name="name" value="{$linkInfo['name']}" >
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>链接：</label>
                    <div class="formControls col-5">
                        <input type="text" name="link"  value="{$linkInfo['link']}" size="80">
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>排序：</label>
                    <div class="formControls col-5">
                        <input type="text" name="order" value="{$linkInfo['order']}">排序字段为数字,越小越靠前
                    </div>
                    <div class="col-4"> </div>
                </div>
                <div class="row cl">
                    <label class="form-label col-3"><span class="c-red">*</span>是否开启：</label>
                    <div class="formControls col-5">

                        <input type="radio" name="status" value='1' {if:$linkInfo['status']==1}checked="checked"{/if} id="">是
                        <input type="radio" name="status" value='0'{if:$linkInfo['status']==0}checked="checked"{/if} id="">否

                    </div>
                    <div class="col-4"> </div>
                </div>

                <div class="row cl">
                    <div class="col-9 col-offset-3">
                        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</div>



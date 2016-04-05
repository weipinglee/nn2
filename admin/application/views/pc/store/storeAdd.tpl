<script type="text/javascript" src="{root:js/area/Area.js}" ></script>
<script type="text/javascript" src="{root:js/area/AreaData_min.js}" ></script>
<script type="text/javascript" src="{root:js/upload/ajaxfileupload.js}"></script>
<script type="text/javascript" src="{root:js/upload/upload.js}"></script>
<div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" />添加仓库
</h1>
                
<div class="bloc">
    <div class="title">
       添加仓库
    </div>
   <div class="pd-20">
  <form action="{url:/store/storeAdd}" method="post" class="form form-horizontal" id="form-member-add">
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>仓库名：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" id="member-name" name="name"  nullmsg="仓库名不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>仓库简称：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" value="" placeholder=""  name="short_name"  >
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>仓库地区：</label>
          <div class="formControls col-5">
             {area:}
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>仓库地址：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" value="" placeholder=""  name="address"  >
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>仓库服务点电话：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" value="" placeholder=""  name="service_phone"  >
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>仓库服务点地址：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" value="" placeholder=""  name="service_address"  >
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>仓库联系人：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" value="" placeholder=""  name="contact"  >
          </div>
          <div class="col-4"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>仓库联系人电话：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" value="" placeholder=""  name="contact_phone"  >
          </div>
          <div class="col-4"> </div>
      </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>类型：</label>
      <div class="formControls col-5 skin-minimal">
        <div class="radio-box">
          <input type="radio"  name="type"  value="0">
          <label >正常仓库</label>

        </div>
        <div class="radio-box">
            <input type="radio"  name="type"  value="1">
            <label >监管仓库</label>
        </div>
      </div>
      <div class="col-4"> </div>
    </div>
      <div class="row cl">
          <label class="form-label col-3"><span class="c-red">*</span>是否开启：</label>
          <div class="formControls col-5 skin-minimal">
              <div class="radio-box">
                  <input type="radio"  name="status"  value="1">
                  <label >开启</label>

              </div>
              <div class="radio-box">
                  <input type="radio"  name="status"  value="0">
                  <label >关闭</label>
              </div>
          </div>
          <div class="col-4"> </div>
      </div>


    <div class="row cl">
      <label class="form-label col-3">上传图片：</label>
      <div class="formControls col-5">
          <span class="btn-upload form-group">
            <input type="file" name="file1" id="file1"  onchange="javascript:uploadImg(this,'{url:/index/upload}');" />
        </span>
          <div  class="up_img">
              <img name="file1" src=""/>
              <input type="hidden"  name="imgfile1"   />
          </div>
      </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-3">备注：</label>
      <div class="formControls col-5">
        <textarea name="note" cols="" rows="" class="textarea"  onKeyUp="textarealength(this,1000)"></textarea>
        <p class="textarea-numberbar"><em class="textarea-length">0</em>/1000</p>
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

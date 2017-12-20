<script type="text/javascript" src="{views:content/settings/main.js}"></script>
<script type="text/javascript" src="{views:js/libs/jquery/1.11/jquery.min.js}"></script>
<script type="text/javascript" src="{views:js/validform/validform.js}"></script>
<script type="text/javascript" src="{views:js/product/cate.js}"></script>
<script type="text/javascript" src='{root:js/upload/ajaxfileupload.js}'></script>
<script type="text/javascript" src='{root:js/upload/upload.js}'></script>
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" /> 添加商品类型
</h1>
                
<div class="bloc">
    <div class="title">
     类型基本信息
    </div>
 <div class="pd-20">
  <form action="{url:trade/product/categoryAdd}" method="post" class="form form-horizontal" id="form-user-add"  auto_submit redirect_url="{url:trade/product/categoryList}">
      <input type="hidden" name="id" value="{if:isset($cate)}{$cate['id']}{/if}" />
    <div class="row cl">
      <label class="form-label col-2"><span class="c-red">*</span>分类名称：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="{if:isset($cate)}{$cate['name']}{/if}" datatype="*1-20" errormsg="请正确填写分类名称" placeholder="" name="name">
      </div>
      <div class="col-5"> </div>
    </div>
      <div class="row cl">
          <label class="form-label col-2"><span class="c-red">*</span>分类代码：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" value="{if:isset($cate)}{$cate['code']}{/if}" datatype="s2-4" errormsg="请填写2到4位字母" placeholder="" name="code">
          </div>
          <div class="col-5"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-2"><span class="c-red"></span>下级分类统称：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" value="{if:isset($cate)}{$cate['childname']}{else:}商品分类{/if}" datatype="s1-20" errormsg="请正确填写下级分类统称" name="childname">
          </div>
          <div class="col-5"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-2"><span class="c-red"></span>计量单位：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" value="{if:isset($cate)}{$cate['unit']}{/if}" datatype="s1-5" errormsg="请正确填写计量单位" placeholder="子级分类的优先级更高" name="unit">
          </div>
          <div class="col-5"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-2"><span class="c-red"></span>首付款比例：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" value="{if:isset($cate)}{$cate['percent']}{/if}" datatype="/[1-9]\d?/" placeholder="请填写0-100之间的整数， 子级分类的优先级更高"  errormsg="请填写1-100之间数字"  name="percent">
          </div>
          <div class="col-5"></div>
      </div>
      <div class="row cl">
          <label class="form-label col-2"><span class="c-red"></span>父级分类：</label>
          <div class="formControls col-5">
              <select name="pid">
                <option value="0" selected >顶级分类</option>
                {foreach: items=$tree}
                    <option value="{$item['id']}" {if:isset($cate['pid']) && $item['id']==$cate['pid']}selected{/if}>{echo:str_repeat('--',$item['level'])}{$item['name']}</option>

                {/foreach}
              </select>
          </div>
          <div class="col-5"> </div>
      </div>
      <div class="row cl">
           <label class="form-label col-2"><span class="c-red"></span>所选属性：</label>
          <div class="formControls col-5" id="attr_box">
            {if:isset($attr_sel)&&!empty($attr_sel)}
                {foreach:items=$attr_sel}
                    <div ><input type="text"  value="{$item}" readonly="readonly"/> <input type="hidden" value="{$key}" name="attr_id[]"/><a href="javascript:void(0);" >删除</a></div>
                {/foreach}
            {/if}
          </div>
            <div class="col-5"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-2"><span class="c-red"></span>属性：</label>
          <div class="formControls col-5">
             <!-- <input type="hidden" name="attrs[]" value="1"/>
              <input type="hidden" name="attrs[]" value="2"/> -->
              <select id='all_attr'>
                <option value="0">--请选择--</option>
                  {if:!empty($attr)}
                      {foreach: items=$attr}
                          <option value="{$item['id']}">{$item['name']}</option>

                      {/foreach}
                  {/if}

              </select>
              <input type="text" class="js_blur_search">

          </div><a href="javascript:void(0)" onclick="addAttr()">添加</a>
          <div class="col-5"> </div>
      </div>
      <div class="row cl">
                        <label class="form-label col-2">图片：</label>
                        <div class="formControls col-5">
                            <input type='file' name="file2" id="file2"  onchange="javascript:uploadImg(this,'{url:/index/upload}');" />
                        </div>
                        <div>
                            <img name="file2" />
                            <input type="hidden" name="imgfile2"  />

                        </div>
                    </div>
      <div class="row cl">
          <label class="form-label col-2"><span class="c-red"></span>排序：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" value="{if:isset($cate)}{$cate['sort']}{/if}" placeholder="" name="sort">
          </div>
          <div class="col-5"> </div>
      </div>
    <div class="row cl">
      <label class="form-label col-2">备注：</label>
      <div class="formControls col-5">
        <textarea name="note" cols="" rows="" class="textarea"   dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,100)">{if:isset($cate)}{$cate['note']}{/if}</textarea>
      </div>
      <div class="col-5"> </div>
    </div>
    <div class="row cl">
      <div class="col-9 col-offset-2">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
      </div>
    </div>
  </form>
</div>
</div>

</div>

</div>
<div class="attr" style="display:none;"><input type="text"  /> <input type="hidden" /><a href="javascript:void(0);">删除</a></div>
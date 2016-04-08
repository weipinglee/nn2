
        <div id="content" class="white">
            <h1><img src="{views:img/icons/dashboard.png}" alt="" /> 添加商品类型
</h1>
                
<div class="bloc">
    <div class="title">
     类型基本信息
    </div>
 <div class="pd-20">
  <form action="{url:/product/categoryAdd}" method="post" class="form form-horizontal" id="form-user-add">
      <input type="hidden" name="id" value="{if:isset($cate)}{$cate['id']}{/if}" />
    <div class="row cl">
      <label class="form-label col-2"><span class="c-red">*</span>分类名称：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="{if:isset($cate)}{$cate['name']}{/if}" placeholder="" name="name">
      </div>
      <div class="col-5"> </div>
    </div>
      <div class="row cl">
          <label class="form-label col-2"><span class="c-red"></span>下级分类统称：</label>
          <div class="formControls col-5">
              <input type="text" class="input-text" value="{if:isset($cate)}{$cate['childname']}{/if}" placeholder="" name="childname">
          </div>
          <div class="col-5"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-2"><span class="c-red"></span>父级分类：</label>
          <div class="formControls col-5">
              <select name="pid">
                <option value="0" >顶级分类</option>
                {foreach: items=$tree}
                    <option value="{$item['id']}" {if:$item['id']==$cate['pid']}selected{/if}>{echo:str_repeat('--',$item['level'])}{$item['name']}</option>

                {/foreach}
              </select>
          </div>
          <div class="col-5"> </div>
      </div>
      <div class="row cl">
          <label class="form-label col-2"><span class="c-red"></span>属性：</label>
          <div class="formControls col-5">
             <!-- <input type="hidden" name="attrs[]" value="1"/>
              <input type="hidden" name="attrs[]" value="2"/> -->
              <select name="pid">
                  {if:!empty($attr)}
                      {foreach: items=$attr}
                          <option value="{$item['id']}">{$item['name']}</option>

                      {/foreach}
                  {/if}

              </select>
          </div>
          <div class="col-5"> </div>
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
        <textarea name="" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,100)">{if:isset($cate)}{$cate['note']}{/if}</textarea>
        <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
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

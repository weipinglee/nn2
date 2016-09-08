<?php
/**
 * 新增标签
 * author:liweiping
 * Date: 2016/9/8
 * Time: 上午 9:22
 */

/**
 * 注意：area、areatext这种一个包含另一个的方法，长的要放在前面
 */
namespace Library\views;
class tags{

    /**
     * img标签
     * @param array $attr
     * @return string
     */
    public function img($attr=array()){
        if(!isset($attr['thumb'])) $attr['thumb'] = '';
        if(!isset($attr['orig'])) $attr['orig'] = $attr['thumb'];
        if(substr($attr['thumb'],0,1) == '$')
            $attr['thumb'] = '<?php echo '.$attr['thumb'].' ; ?>';
        if(substr($attr['orig'],0,1) == '$')
            $attr['orig'] = '<?php echo '.$attr['orig'].' ; ?>';
        return   <<< OEF
                    <a target="_blank" href="{$attr['orig']}"><img src="{$attr['thumb']}" /></a>
OEF;
    }

    /**
     * 地址显示文本
     * @return string
     */
    public function areatext($attr=array()){
        if(!isset($attr['data'])) $attr['data'] = '';
        if(!isset($attr['id'])) $attr['id'] = '';
        if(!isset($attr['delimiter'])) $attr['delimiter'] = ' ';
        if(substr($attr['data'],0,1) == '$')
            $attr['data'] = '<?php echo '.$attr['data'].' ; ?>';
        if(substr($attr['id'],0,1) == '$')
            $attr['id'] = '<?php echo '.$attr['id'].' ; ?>';

        return   <<< OEF
                    <span id="areatext{$attr['id']}">
                        <script type="text/javascript">
                         ( function(){
                            var areatextObj = new Area();
                            var text = areatextObj.getAreaText('{$attr['data']}','{$attr['delimiter']}');
                            $('#areatext{$attr['id']}').html(text);

                            })()
                        </script>
                     </span>


OEF;
    }
    /**
     * 地址选择框
     * @param array $attr
     * @return string
     */
    public function area($attr=array()){
        if(!isset($attr['data'])) $attr['data'] = '';
        if(!isset($attr['provinceID'])) $attr['provinceID'] = 'seachprov';
        if(!isset($attr['cityID']))$attr['cityID'] = 'seachcity';
        if(!isset($attr['districtID']))$attr['districtID'] = 'seachdistrict';
        if(!isset($attr['inputName'])) $attr['inputName'] = 'area';
        if(substr($attr['data'],0,1) == '$')
            $attr['data'] = '<?php echo '.$attr['data'].' ; ?>';

        return   <<< OEF
                <script type="text/javascript">
                 {$attr['inputName']}Obj = new Area();

                  $(function () {
                     {$attr['inputName']}Obj.initComplexArea('{$attr['provinceID']}', '{$attr['cityID']}', '{$attr['districtID']}', '{$attr['data']}','{$attr['inputName']}');
                  });
                </script>
			 <select  id="{$attr['provinceID']}"  onchange=" {$attr['inputName']}Obj.changeComplexProvince(this.value, '{$attr['cityID']}', '{$attr['districtID']}');">
              </select>&nbsp;&nbsp;
              <select  id="{$attr['cityID']}"  onchange=" {$attr['inputName']}Obj.changeCity(this.value,'{$attr['districtID']}','{$attr['districtID']}');">
              </select>&nbsp;&nbsp;<span id='{$attr['districtID']}_div' >
               <select   id="{$attr['districtID']}"  onchange=" {$attr['inputName']}Obj.changeDistrict(this.value);">
               </select></span>
               <input type="hidden"  name="{$attr['inputName']}" {$attr['pattern']} alt="{$attr['alt']}" value='{$attr['data']}' />
                <span></span>
OEF;
    }






}
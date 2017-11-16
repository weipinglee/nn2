<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/15 0015
 * Time: 上午 9:42
 */

namespace config;
use admintool\adminQuery;
class configsIndexModel extends \baseModel{

    //配置表名
    protected $table = 'configs_indexshow';

    //配置信息规则
    protected $rules = array(
        array('id','number','id错误',0,'regex'),
        array('user_id','number','用户id错误',0,'regex'),
        array('sub_title','s{2,100}','配置项中文名错误',0,'regex'),
    );



    public function getConfigList($page=1){
        $obj = new adminQuery($this->table .' as c');
        $obj->join = 'left join user as u on c.user_id=u.id';
        $obj->fields = 'c.*,u.username,u.mobile';
        $obj->page = $page;
        return $obj->find();

    }









}
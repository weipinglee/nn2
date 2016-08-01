<?php
namespace nainai\user;

use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\url;

/**
 * 用户对应的api
 * @author maoyong.zeng
 * @copyright 2016年05月30日
 */
class User extends \nainai\Abstruct\ModelAbstract {
	
     /**
      * 获取id对应的用户名
      * @param  Array $where  查询条件 
      * @return array    
      */
     public function getNamesList($where){
          $names = array();
          if (!empty($where)) {
               $where = ' id IN (' . implode(',', $where). ')';
               $list = $this->model->where($where)->fields('id, username')->select();
               
               foreach ($list as $key => $value) {
                    $names[$value['id']] = $value['username'];
               }
          }
          return $names;
     }
}
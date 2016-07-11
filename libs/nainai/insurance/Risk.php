<?php

namespace nainai\insurance;

use \Library\M;
use \Library\Query;
use \Library\Tool;

/**
 * 代理商的数据处理
 */
class Risk extends \nainai\Abstruct\ModelAbstract{

     const PICC = 1;

     public function getCompany(){
          return array(self::PICC => '人保');
     }

     protected $Rules = array(
        array('name','/\S{2,20}/i','必须填写保险产品名'),
        array('company','require','必须选择保险公司'),
        array('mode','require','必须选择保额类型'),
        array('code','require','必须填写保险代码')
    );

     public function getRiskList(){
          return $this->model->order('create_time desc')->select();
     }

}
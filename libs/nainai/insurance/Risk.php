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

     public function getRiskList($page=0, $where = array()){
            $query = new Query('risk');
            if ($page >= 0) {
                $query->page = $page;
                $query->pagesize = 10;
            }
            if (! empty($where) && isset($where['status'])) {
                $query->where = 'status = 1';
            }
            $query->order = 'create_time desc';
            $data = $query->find();
            if ($page >= 0) {
                $res = array('lists' => $data, 'bar' => $query->getPageBar());
            }else{
                $res = array('lists' => $data);
            }
            
            return $res;
     }

}
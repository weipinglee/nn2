<?php

namespace nainai\insurance;

use \Library\M;
use \Library\Query;
use \Library\Tool;

/**
 * 保险的数据处理
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

     /**
      * 获取分类对应能够买的保险,能够追溯上级分类
      * @param  Int $cid 分类id
      * @return Array      
      */
     public function getCategoryRisk($cid){
            $insurance = $risk_data = array();
           //获取保险产品信息
           $list = $this->getRiskList(-1, array('status' => 1));
           $company = $this->getCompany();
           foreach ($list['lists'] as $key => $value) {
                $insurance[$value['id']] = array('company' => $company[$value['company']], 'name' => $value['name'], 'mode' => $value['mode']);
           }

           $model = new \nainai\offer\product();
           $cates = $model->getParents($cid);
           if (!empty($cates)) {
                foreach ($cates as $key => $value) {
                     $risk_data = $model->getCateName($value['id'], 'risk_data');
                     $risk_data = unserialize($risk_data);
                     if (!empty($risk_data)) { //如果上一级分类有保险配置，就用这个配置
                          foreach ($risk_data as &$value) {
                               $value['name'] = $insurance[$value['risk_id']]['name'];
                               $value['company'] = $insurance[$value['risk_id']]['company'];
                               $value['mode'] = $insurance[$value['risk_id']]['mode'];
                          }
                          break;
                     }
                }
           }

           return $risk_data;
     }

     /**
      * 获取产品对应的保险产品
      * @param  String $risk 报盘的保险id
      * @param Int $cid 分类id
      * @return Array              
      */
     public function getProductRisk($risk, $cid){
        $riskData = array();

        if (!empty($risk) && intval($cid) > 0 ) {
          $riskData = $this->getCategoryRisk($cid);

          $risk = explode(',', $risk);
            foreach ($riskData as $key => $value) {
              if (!in_array($value['risk_id'], $risk)) {
                unset($riskData[$key]);
              }
            }
        }

        return $riskData;
     }

}
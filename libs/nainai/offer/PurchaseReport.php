<?php
namespace nainai\offer;

use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\url;

/**
 * 采购报价操作对应的api
 * @author maoyong.zeng <zengmaoyong@126.com>
 * @copyright 2016年06月15日
 */
class PurchaseReport extends \nainai\Abstruct\ModelAbstract {
     /**
     * 报盘验证规则
     * @var array
     */
     protected $Rules = array(
          array('offer_id', 'number', '必须有报盘id'),
          array('seller_id','number','报价用户错误'),
          array('attr','require','必须添加报价规格'),
          array('price','number','请填写报价单价')
     );

     /**
      * 定义报价的状态
      */
     const STATUS_APPLY = 0;
     const STATUS_ADOPT = 1;
     const STATUS_REPLUSE = 2;

     /**
      * 获取状态对应的中文
      * @param  [Int] $status 状态值
      * @return String         中文
      */
     public function getStatus($status){
          switch ($status) {
               case self::STATUS_APPLY :
                    return '申请';
                    break;
               case self::STATUS_ADOPT :
                    return '采纳';
                    break;
               case self::STATUS_REPLUSE :
                    return '拒绝';
                    break;
               default:
                   return '未知';
                    break;
          }
     }

     /**
      * 获取状态对应的数组
      */
     public function getStatusArray(){
          return array(
               self::STATUS_APPLY => $this->getStatus(self::STATUS_APPLY),
               self::STATUS_ADOPT => $this->getStatus(self::STATUS_ADOPT),
               self::STATUS_REPLUSE => $this->getStatus(self::STATUS_REPLUSE)
          );
     }

     /**
      * 获取报价列表
      * @param  [Int] $page     [分页]
      * @param  [Int] $pagesize [分页]
      * @param  string $where    [where的条件]
      * @param  array  $bind     [where绑定的参数]
      * @return [Array.list]           [返回的对应的列表数据]
      * @return [Array.pageHtml]           [返回的分页html数据]
      */
     public function getLists($page, $pagesize, $where, $bind){
          $query = new Query('purchase_report as p');
          $query->fields = 'p.*, u.username, b.name as product_name';
          $query->join = ' LEFT JOIN user as u ON seller_id=u.id LEFT JOIN product_offer as a ON offer_id=a.id LEFT JOIN products as b ON a.product_id=b.id';
          $query->page = $page;
          $query->pagesize = $pagesize;
          $query->order = ' create_time desc';

          $query->where = $where;
          $query->bind = $bind;

          $list = $query->find();
          foreach($list as $k=> &$v){
               $v['status_zn'] = $this->getStatus($v['status']);
          }
          return array('list' => $list, 'pageHtml' => $query->getPageBar());
     }

}
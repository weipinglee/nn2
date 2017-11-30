 <?php
/**
 * @name PingController
 * @desc 电子屏控制器
 * @time 2017-11-29
 */
use \nainai\offer\product;
use \Library\url;
use \Library\safe;
use \Library\Payment;
use \Library\json;
use \Library\Query;
use \Library\tool;
class PingController extends \Yaf\Controller_Abstract {



	/** 
     * 
     */
	public function indexAction() {
        
	}
	
	public function getOfferDataAction(){
		$page = safe::filterGet('page','int',1);
		$M = new Query('stat_item_data as d');
		$M->join = 'left join product_offer as o on d.offer_id=o.id
		           left join products as p on o.product_id=p.id
		           left join store_products as sp on sp.product_id=p.id
		           left join store_list as l on sp.store_id=l.id';
		$M->where = 'o.is_del = 0  and o.expire_time>now() ';
		$M->fields = 'd.*,p.name as pro_name,p.quantity-p.freeze-p.sell as last_num,p.id as pro_no,o.accept_area,o.apply_time,o.minimum as mininum,l.name as acc_store';
		$M->page = $page;
		$M->pagesize = 10;
		$data = $M->find();
		if($M->page==0){
			die(json::encode(array()));
		}
		foreach($data as &$val){
			$val['attr_values'] = unserialize($val['attr_values']);
			if(!$val['acc_store'])
				$val['acc_store'] = '-';
		}
		die(json::encode($data));
		
	}
	
	
    
 
}

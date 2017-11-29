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
		$M = new Query('offer_data');
		$M->page = $page;
		$M->pagesize = 10;
		$data = $M->find();
		if($M->page==0){
			die(json::encode(array()));
		}
		die(json::encode($data));
		
	}
	
	
    
 
}

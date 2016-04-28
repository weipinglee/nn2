<?php
/**
 * 卖方合同管理
 * @author: panduo 
 * @Date: 2016-04-28 10:20:57
 */
use \Library\json;
use \Library\url;
use \Library\Safe;
use \Library\Thumb;
use \Library\tool;
class ContractController extends Yaf\Controller_Abstract {

	public function init(){
		$this->deposit = new \nainai\order\DepositOrder();
	}

	public function depositListAction(){
		$user_id = 42;
		$page = safe::filterGet('page');
		$list = $this->deposit->depositContractList($user_id,$page);
		$this->getView()->assign('data',$list);
		var_dump($list);
	}
}
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
class ContractController extends \nainai\Abstruct\UcenterControllerAbstract{

	protected function  getLeftArray(){
        return array(
            array('name' => '交易管理', 'list' => array()),
            array('name' => '销售管理', 'list' => array(
                array('url' => '', 'title' => '销售列表' ),
                array('url' => url::createUrl('/ManagerDeal/indexOffer'), 'title' => '发布产品' ),
            )),
            array('name' => '仓单管理', 'list' => array(
                array('url' => url::createUrl('/ManagerDeal/storeProduct'), 'title' => '申请仓单' ),
                array('url' => '', 'title' => '仓单列表' ),
            )),
            array('name' => '采购管理', 'list' => array(
                array('url' => '', 'title' => '采购列表' ),
                array('url' => '', 'title' => '发布采购' ),
            )),
            array('name' => '合同管理', 'list' => array(
                array('url' => url::createUrl('/Contract/depositList'), 'title' => '销售合同' ),
                array('url' => '', 'title' => '购买合同' ),
            ))
        );
    }

	public function depositListAction(){
		$user_id = 42;
		$deposit = new \nainai\order\DepositOrder();
		// $page = $this->_request->getParam('page');
		$page = safe::filterGet('page','int',1);
		$name = safe::filterPost('name');
		$where = array();
		if(!empty($name)){
			$where []= array(" and p.name = :name ",array('name'=>$name)); 
		}
		$list = $deposit->depositContractList($user_id,$page,$where);
		$this->getView()->assign('data',$list['data']);
		$this->getView()->assign('page',$list['bar']);
	}
}
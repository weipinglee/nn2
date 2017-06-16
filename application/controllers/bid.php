<?php
/**
 * @author weipinglee
 * @desc 招标列表
 * @date 2017-06-15 10:07:47
 */
use \tool\http;
use \Library\url;
use \Library\safe;
use \Library\tool;
use \nainai\order\Order;
use \Library\checkRight;
use \nainai\bid\sellerHandle;

use \nainai\offer\product;

use \Library\JSON;

class bidController extends PublicController {


	public $bidObj = null;

	public function init(){
		parent::init();
		$this->bidObj = new  sellerHandle();
		$this->getView()->setLayout('layout');
	}

	public function tenderhallAction(){

	}

	public function tenderListAction()
	{
		$page = safe::filterGet('page','int');
		$list = $this->bidObj->getBidList($page);
		$this->getView()->assign('list',$list);

	}

	public function tendercontentAction()
	{
		$id = safe::filterGet('id','int');
		$detail = $this->bidObj->getBidDetail($id);
		$this->getView()->assign('detail',$detail);
	}





}
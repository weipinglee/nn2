<?php
/**
 * @author panduo
 * @desc 报盘列表offers
 * @date 2016-05-05 10:07:47
 */
use \tool\http;
use \Library\url;
use \Library\safe;
use \Library\tool;
use \nainai\order\Order;
use \Library\checkRight;


use \nainai\offer\product;

use \Library\JSON;

class BidpriceController extends PublicController {

	public function bidpriceListAction(){
        //获取商品顶级分类
        $productModel = new product();
        $category = $productModel->getTopCate();
        $this->getView()->assign('cate',$category);
		$this->getView()->assign('cur','bidprice');
	}
	public function biddetailsAction(){
		$this->getView()->assign('cur','bidprice');
	}
	public function bidbondAction(){
		$this->getView()->assign('cur','bidprice');
	}
	public function bidContractAction(){
		$this->getView()->setLayout('');
	}
	
}
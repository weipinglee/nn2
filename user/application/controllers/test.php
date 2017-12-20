<?php 

/**
 * 保证金摘牌控制器
 */
use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
use \Library\checkRight;
use \Library\M;

class testController extends  UcenterBaseController{

	public function indexAction(){
		$store = new \nainai\store();

	}


	public function updateProIdAction(){
		$ProObj = new M('products');
		$data = $ProObj->where('create_time>"2017-1-1"')->fields('cate_id,id')->select();
		$product = new \nainai\offer\product();
		$topCate = array();
		foreach($data as $key=>$val){
			if(!isset($topCate[$val['cate_id']])){
				$topCate[$val['cate_id']] = $product->getcateTop($val['cate_id']);
			}
			$ProObj->data(array('market_id'=>$topCate[$val['cate_id']]))->where(array('id'=>$val['id']))->update();

		}
		echo 'success';
	}

}
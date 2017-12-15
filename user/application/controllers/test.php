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

	}


	public function updateProIdAction(){
//		$ProObj = new M('products');
//		$data = $ProObj->where('create_time>"2017-1-1"')->fields('cate_id,id')->select();
//		$product = new \nainai\offer\product();
//		$topCate = array();
//		foreach($data as $key=>$val){
//			if(!isset($topCate[$val['cate_id']])){
//				$topCate[$val['cate_id']] = $product->getcateTop($val['cate_id']);
//			}
//			$ProObj->data(array('market_id'=>$topCate[$val['cate_id']]))->where(array('id'=>$val['id']))->update();
//
//		}
//		echo 'success';
	}

	public function setOfferMaxnumAction()
	{
		$page = safe::filterGet('page','int',1);
		$pagesize = 1000;
		if($page==1){
			$limit = $pagesize;
		}
		else{
			$limit = ($page-1)*$pagesize.','.$pagesize;
		}

		$proObj = new M('products');
		$data = $proObj->order('id desc')->fields('id,quantity,sell,freeze')->limit($limit)->select();
		$offerObj = new M('product_offer');
		foreach($data as $val){
			//$offerObj->table('product_offer');
			$update = array(
				'max_num'=>$val['quantity'],
				'sell_num'=> $val['sell'] + $val['freeze']
			);

			$res = $offerObj->where(array('product_id'=>$val['id'],'max_num'=>0))->data($update)->update();
			echo $res.'</br>';
		}
		echo 'success';
	}

}
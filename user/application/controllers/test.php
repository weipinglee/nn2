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
		$obj = new \nainai\fund\js();
		$user_id = 36;
		$res = $obj->signedStatus($user_id);
		if(is_string($res)){
			echo $res;
		}elseif($res===true){
			echo 'success';
		}
		exit;


	}

	

	/**
	 * 生成旧的报盘的市场大分类id
	 */
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

	/**
	 * 设置旧报盘的product_offer表的max_num值
	 */
	public function setOfferMaxnumAction()
	{
//		$page = safe::filterGet('page','int',1);
//		$pagesize = 1000;
//		if($page==1){
//			$limit = $pagesize;
//		}
//		else{
//			$limit = ($page-1)*$pagesize.','.$pagesize;
//		}
//
//		$proObj = new M('products');
//		$data = $proObj->order('id desc')->fields('id,quantity,sell,freeze')->limit($limit)->select();
//		$offerObj = new M('product_offer');
//		$offerObj->beginTrans();
//		foreach($data as $val){
//			$offerObj->table('product_offer');
//			$update = array(
//				'max_num'=>$val['quantity'],
//				'sell_num'=> $val['sell'] + $val['freeze']
//			);
////print_r($update);
//
//			$res = $offerObj->where('product_id='.$val['id'].' and max_num<=0')->data($update)->update();
//			echo $res.'</br>';
//		}
//		if($offerObj->commit()){
//			echo 'success';
//		}
		
	}

	//生成user表的true_name字段
	public function setUserTrueNameAction()
	{
//		$model = new M('user');
//		$user_id = safe::filterGet('id');
//		$str = 'SELECT createUsertruename('.$user_id.',1000)';
//		if($model->query($str)){
//			echo 'success';
//		}
//		else echo 'error';
	}

	public function setOfferpricevipAction(){
        $page = safe::filterGet('page','int',1);
        $pagesize = 1000;
        if($page==1){
            $limit = $pagesize;
        }
        else{
            $limit = ($page-1)*$pagesize.','.$pagesize;
        }
        $offerObj = new M('product_offer');
        $data = $offerObj->where(array('type'=>1,'price_vip'=>0))->fields('id,price')->limit($limit)->select();
        $offerObj->beginTrans();
        foreach($data as $item){
            $offerObj->data(array('price_vip'=>$item['price']))->where(array('id'=>$item['id']))->update();
        }
        if($offerObj->commit()){
            echo 'success';
        }
        else
            echo 'fail';
        die();
    }
	public function setOrderUnitpriceAction(){
        $page = safe::filterGet('page','int',1);
        $pagesize = 1000;
        if($page==1){
            $limit = $pagesize;
        }
        else{
            $limit = ($page-1)*$pagesize.','.$pagesize;
        }

        $orderObj = new M('order_sell');
        $offerObj = new M('product_offer');
        $orderData = $orderObj->where(array('price_unit'=>0,'mode'=>array('gt',0)))->fields('id,offer_id,price_unit')->limit($limit)->order('id desc')->select();
        $orderObj->beginTrans();
        foreach($orderData as $val){
            $price = $offerObj->where(array('id'=>$val['offer_id']))->getField('price');
            if($price){
                $orderObj->where(array('id'=>$val['id']))->data(array('price_unit'=>$price))->update();
            }
        }
        if($orderObj->commit()){
            echo 'success';
        }
        else
            echo 'error';
    }
	public function setOrderOfferuserAction(){
		$page = safe::filterGet('page','int',1);
		$pagesize = 1000;
		if($page==1){
			$limit = $pagesize;
		}
		else{
			$limit = ($page-1)*$pagesize.','.$pagesize;
		}

		$orderObj = new M('order_sell');
		$offerObj = new M('product_offer');
		$orderData = $orderObj->where(array('offer_user_id'=>0))->fields('id,offer_id')->limit($limit)->order('id desc')->select();
		$orderObj->beginTrans();
		foreach($orderData as $val){
			$user_id = $offerObj->where(array('id'=>$val['offer_id']))->getField('user_id');
			if($user_id){
				$orderObj->where(array('id'=>$val['id']))->data(array('offer_user_id'=>$user_id))->update();
			}
		}
		if($orderObj->commit()){
			echo 'success';
		}
		else
			echo 'error';
	}

	public function createOrderStaticAction(){
	    $start = safe::filterGet('start');//例如2018-03-15
        $end   = safe::filterGet('end');

    }

}
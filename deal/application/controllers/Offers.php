<?php
/**
 * @author panduo
 * @desc 报盘列表offers
 * @date 2016-05-05 10:07:47
 */
use \tool\http;
use \Library\url;
use \Library\safe;
use \Library\json;
use \Library\tool;
use \nainai\order\Order;
use \Library\checkRight;
use \nainai\offer\product;

class OffersController extends \Yaf\Controller_Abstract {

	private $offer;


	public function init(){
		$this->getView()->setLayout('header');
		$this->offer = new OffersModel();
	}


	//列表
	public function offerListAction(){
		$page = safe::filterGet('page','int');
		$category = array();

	        	//获取商品分类信息，默认取第一个分类信息
	        	$productModel = new product();
	        	$category = $productModel->getCategoryLevel();

		$pageData = $this->offer->getList($page);

        		$this->getView()->assign('categorys', $category['cate']);
		$this->getView()->assign('data',$pageData['data']);
		$this->getView()->assign('bar',$pageData['bar']);
	}

	//支付页面
	public function checkAction(){
		$id = safe::filter($this->_request->getParam('id'),'int',1);
		$info = $this->offer->offerDetail($id);

		if(empty($info)){
			return false;
		}
		$info['amount'] = $info['minimum'] * $info['price'];
		$order_mode = new Order($info['mode']);
		$info['pay_deposit'] = $order_mode->payDepositCom($info['id'],$info['amount']);

		$this->getView()->assign('data',$info);
	}

//支付成功页面
	public function paySuccessAction(){
		$order_no = safe::filter($this->_request->getParam('order_no'));
		$amount = safe::filter($this->_request->getParam('amount'));
		$pay_deposit = safe::filter($this->_request->getParam('payed'));

		$this->getView()->assign('order_no',$order_no);
		$this->getView()->assign('amount',$amount);
		$this->getView()->assign('pay_deposit',$pay_deposit);
	}

	 /**
         * AJax获取产品分类信息
         * @return [Json]
         */
        public function ajaxGetCategoryAction(){
            $pid = Safe::filterPost('pid', 'int',0);
            if($pid){
                $productModel = new product();
                $cate = $productModel->getCategoryLevel($pid);

                //获取这个分类下对应的产品信息
                $condition = array(
                	'where' => 'FIND_IN_SET(cate_id, :ids)',
                	'bind' => array('ids' => $pid)
                );
                $cate['product'] = $this->offer->getList($pid, $condition);
                unset($cate['chain']);

                echo json::encode($cate);
            }
            exit();
        }


}
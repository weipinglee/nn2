<?php
/**
 * @name IndexController
 * @author root
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
use \DB\M;
use \tool\http;
//use \common\url;
use \common\tool;
use \nainai\offer\product;
use \Library\url;
use \Library\views\wittyAdapter;
class IndexController extends PublicController {



	/** 
     * 默认动作
     * Yaf支持直接把Yaf_Request_Abstract::getParam()得到的同名参数作为Action的形参
     * 对于如下的例子, 当访问http://yourhost/yar-demo/index/index/index/name/root 的时候, 你就会发现不同
     */
	public function indexAction() {

		//获取所有分类
		$productModel=new product();
		$res=$productModel->getAllCat();
		$this->getView()->assign('catList',$res);

		//获取幻灯片
		$indexSlide=\nainai\system\slide::getIndexSlide();
		foreach($indexSlide as $k=>$v){
			$indexSlide[$k]['img']=\Library\Thumb::get($v['img']);
		}

		//获取统计数据
		$statcModel=new \nainai\statistics();
		$statcCatList=$statcModel->getNewStatcList(1);
		$statcProList=$statcModel->getNewStaticListNocate(2);

		$topCat=$productModel->getTopCate(8);
		$company=\nainai\companyRec::getAllCompany();

		//获取信誉排行企业用户
		$indexModel = new indexModel();
		$creditMember = $indexModel->getCreditMemberList(10);

		//获取首页最新完成的交易
		$order = new \nainai\order\Order();
		$newTrade = $order->getNewComplateTrade(10);

		$offer = new offersModel();
		$offerCateData = array();
		foreach($topCat as $k=>$v){
			$offerCateData[$v['id']] = $offer->getOfferCategoryList($v['id']);
		}

		//获取报盘总数
		$offer_num = $offer->getOfferNum();
		$this->getView()->assign('offer_num',$offer_num['num']);
		//获取企业总数
		$company_num = $indexModel->getTotalCompany();
		$this->getView()->assign('company_num',$company_num['num']);
		//获取当前和昨日成交量
		$order_num = $order->getOrderTotal();
		$order_num_yes = $order->getOrderTotal('yesterday');

		$this->getView()->assign('creditMember',$creditMember);
		$this->getView()->assign('statcCatList',$statcCatList);
		$this->getView()->assign('statcProList',$statcProList);
		$this->getView()->assign('company',$company);
		$this->getView()->assign('topCat',$topCat);
		$this->getView()->assign('indexSlide',$indexSlide);
		$this->getView()->assign('newTrade',$newTrade);
		$this->getView()->assign('offerData',$offerCateData);
		$this->getView()->assign('order_num',$order_num['num']);
		$this->getView()->assign('order_num_yes',$order_num_yes['num']);
	}



}

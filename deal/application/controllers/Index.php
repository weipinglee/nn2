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
		$productModel=new product();
		$res=$productModel->getAllCat();
		$this->getView()->assign('catList',$res);
		$indexSlide=\nainai\system\slide::getIndexSlide();
		foreach($indexSlide as $k=>$v){
			$indexSlide[$k]['img']=\Library\Thumb::get($v['img']);
		}
		$statcModel=new \nainai\statistics();
		$statcCatList=$statcModel->getNewStatcList(1);

		$topCat=$productModel->getTopCate();
		$company=\nainai\companyRec::getAllCompany();
		$this->getView()->assign('statcCatList',$statcCatList);
		$this->getView()->assign('company',$company);
		$this->getView()->assign('topCat',$topCat);
		$this->getView()->assign('indexSlide',$indexSlide);
	}

	public function showAction(){
		
	}
	public function urlAction(){
		$url = '  cli/test/index   name =45   address = shanxi';
		$createUrl = url::createUrl($url);
		echo url::getUri();
		return false;

	}
}

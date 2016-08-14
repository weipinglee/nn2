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

		$this->getView()->assign('index',1);
		//获取所有分类
		$productModel=new product();
		$res=$productModel->getAllCat();
		$res = array_slice($res,0,6);
		$this->getView()->assign('catList',$res);

		$year = date('Y');
		$month = date('m');
		$day = date('d');
		//获取幻灯片
		$indexSlide=\nainai\system\slide::getIndexSlide();
		foreach($indexSlide as $k=>$v){
			$indexSlide[$k]['img']=\Library\Thumb::getOrigImg($v['img']);
		}
		//获取统计数据
		$statcModel=new \nainai\statistics();
		$statcCatList=$statcModel->getNewStatcList(1);
		$statcCatList=$statcModel->getAllStatcList(1);
		$statcTime=$statcModel->getStaticTime(1);
		$this->getView()->assign('statcTime',\Library\json::encode($statcTime));
		$statcProList=$statcModel->getNewStaticListNocate(2);
		$topCat=$productModel->getTopCate(8);
		$company=\nainai\companyRec::getAllCompany();

		//获取信誉排行企业用户
		$indexModel = new indexModel();
		$creditMember = $indexModel->getCreditMemberList(10);

		//获取首页最新完成的交易
		$order = new \nainai\order\Order();
		$newTrade = $order->getNewComplateTrade(20);
		$offer = new OffersModel();
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
		$userNum=$indexModel->getAllUser();
		$this->getView()->assign('all_user_num',$userNum['num']);
		//获取当前和昨日成交量
		$order_num = $order->getOrderTotal();
		$order_num_yes = $order->getOrderTotal('yesterday');
		//获取帮助
		$helpModel=new \nainai\system\help();
		$helpList=$helpModel->getHelplist();
		//获取滚动的图片信息
		$adModel=new \Library\ad();
		$adList=$adModel->getAdListByName('滚动');
		foreach($adList as $k=>$v) {
			if (isset($v['content'])) {
				$adList[$k]['content'] = \Library\Thumb::getOrigImg($v['content']);
			}
		}
		//获取所有的推荐商户信息
		$allCompany=\nainai\companyRec::getAllCompanyOrderByType();
		$this->getView()->assign('allCompany',$allCompany);
		$this->getView()->assign('adList',$adList);
		$this->getView()->assign('helpList',$helpList);
		$this->getView()->assign('creditMember',$creditMember);
		$this->getView()->assign('statcCatList',\Library\json::encode($statcCatList));
		$this->getView()->assign('statcProList',$statcProList);
		$this->getView()->assign('company',$company);
		$this->getView()->assign('topCat',$topCat);
		$this->getView()->assign('indexSlide',$indexSlide);
		$this->getView()->assign('newTrade',$newTrade);
		$this->getView()->assign('offerData',$offerCateData);
		$this->getView()->assign('order_num',$order_num['num']);
		$this->getView()->assign('order_num_yes',$order_num_yes['num']);
		$this->getView()->assign('year',$year);
		$this->getView()->assign('month',$month);
		$this->getView()->assign('day',$day);
	}

	public function foundAction(){

	}



}

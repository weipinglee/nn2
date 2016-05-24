<?php

use \Library\checkRight;
use \Library\PlUpload;
use \Library\photoupload;
use \Library\json;
use \Library\url;
use \Library\Safe;
use \Library\Thumb;
use \Library\tool;

/**
 * 用户中心的抽象基类
 */
class UcenterBaseController extends \nainai\controller\Base{

	/**
	 * 所有的用户中心列表的分页是这个
	 * @var integer
	 */
	protected $pagesize = 10;

	protected $certType = null;

	private static $certPage = array(
		'deal'=>'dealcert',
		'store'=>'storecert'
	);

	/**
	 * 设置对话框中返回的url
	 * @var [type]
	 */
	public $backUrl;
	/**
	 * 设置对话框中继续的url
	 * @var [type]
	 */
	public $goUrl;


	protected function init(){
		// parent::init();//继承父类的方法，检测是否登录和角色
		$this->getView()->setLayout('ucenter');
		$this->user_id = 48;
		$this->username = 'test1';
		$this->cert['deal'] = 1;

		//获取登录信息
		if(isset($this->user_id) && $this->user_id>0){
			$this->getView()->assign('login',1);
			$this->getView()->assign('username',$this->username);
		}

		else $this->getView()->assign('login',0);
		$this->getView()->assign('topArray', $this->getTopArray());
		$this->getView()->assign('leftArray', $this->getLeftArray());
		$action = $this->getRequest()->getActionName();

		//判断该方法买家是否能操作，如果不能，跳转到用户中心首页
		if($this->user_type==0 && isset($this->sellerAction) && in_array($action,$this->sellerAction)){
			$this->redirect(url::createUrl('/ucenter/index'));
		}
		$this->getView()->assign('action', $action);
	}
    	/**
    	 * 获取头菜单的数据
    	 * @return [Array]
    	 */
    	private function getTopArray(){
    		$topArray = array(
				'UcenterIndex'      => array('url' => url::createUrl('/ucenterindex/index'), 'title' => '首页'),
				'Ucenter'  => array('url' => url::createUrl('/ucenter/baseinfo'), 'title' => '账户信息')
    		);
			if($this->cert['deal']==1){
				$topArray['Fund'] = array('url' => url::createUrl('/Fund/index'), 'title' => '资金管理');
				$topArray['Managerdeal'] = array('url' => url::createUrl('/ManagerDeal/storeProductList'), 'title' => '交易管理');
			}

			if($this->cert['store']==1){
				$topArray['Managerstore'] = array('url' => url::createUrl('/ManagerStore/ApplyStoreList'), 'title' => '仓单管理');
			}
			if(isset($this->cert['car'])&& $this->car ==1){
				$topArray['Managercar'] = array('url' => '', 'title' => '车辆管理');
			}

			$topArray['Attentioncenter'] = array('url' => '', 'title' => '关注中心');
    		$controller = $this->getRequest()->getControllerName();
    		if (!empty($topArray[$controller])) {
    			$topArray[$controller]['isSelect'] = 1;
    		}else{
    			$topArray['UcenterIndex']['isSelect'] = 1;
    		}
    		return $topArray;
    	}

    	/**
         * 获取左侧菜单数据
         * @var name [<菜单名称>]
         * @var url   [<菜单url>]
         * @var list [<子菜单的数据，key和父级菜单一致>]
         * @return [Array]
         */
    	protected function getLeftArray(){
    		$left = array();
    		$controller = $this->getRequest()->getControllerName();

    		switch ($controller) {
    			case 'Fund':
    			case 'Managerdeal':
    				$left = array(
					array('name' => '交易管理', 'list' => array()),
					array('name' => '销售管理', 'list' => array(
						array('url' => url::createUrl('/ManagerDeal/productlist'), 'title' => '销售列表','action'=>array('productlist') ),
						array(
							'url' => url::createUrl('/ManagerDeal/indexOffer'),
							'title' => '发布产品' ,
							'action' => array('indexoffer','freeoffer','depositoffer','deputeoffer','storeoffer'),//action都用小写

						),
					)),
					array('name' => '仓单管理', 'list' => array(
						array('url' => url::createUrl('/ManagerDeal/storeProduct'), 'title' => '申请仓单','action'=>array('storeproduct') ),
						array('url' => url::createUrl('/ManagerDeal/storeProductList'), 'title' => '仓单列表','action'=>array('storeproductlist','storeproductdetail') ),
					)),
					array('name' => '采购管理', 'list' => array(
						array('url' => '', 'title' => '采购列表' ),
						array('url' => '', 'title' => '发布采购' ),
					)),
					array('name' => '合同管理', 'list' => array(
						array('url' => url::createUrl('/Contract/depositList'), 'title' => '销售合同' ,'action'=>array('depositlist')),
						array('url' => '', 'title' => '购买合同' ),
					)),
					array('name' => '申述管理', 'list' => array(
						array('url' => url::createUrl('/Contract/complainContract'), 'title' => '申述合同' ,'action'=>array('depositlist')),
						array('url' => url::createUrl('/Contract/complainList'), 'title' => '申述列表' ),
					))
				);
    				break;

    			case 'Managerstore':
    				break;
 
    		}
    		return $left;
    	}

    	/**
    	 * 设置处理成功后返回的结果
    	 * @param [Array] $returnData [返回结果]
    	 * @param string $type       [处理类型]
    	 */
    	public function HandlerHtml( & $returnData, $type='default'){
    		switch ($type) {
    			case 'default':
    				$returnData['url']['backUrl'] = $this->backUrl;
    				$returnData['url']['goUrl'] = $this->goUrl; 

    				$url = url::createUrl('/UcenterBase/defaultHtml') . '?' . http_build_query($returnData);
    				$this->redirect($url);
    				break;
    			
    			case 'json':
    				echo json::encode($returnData);
    				break;
    		}
    		exit();
    	}

    	/**
    	 * 默认的处理返回页面
    	 */
      	public function defaultHtmlAction(){
    		$success = Safe::filterGet('success', 'int');
    		$msg = Safe::filterGet('info');
    		$Url = Safe::filterGet('url');

    		$this->getView()->assign('success', $success);
    		$this->getView()->assign('msg', $msg);
    		$this->getView()->assign('url', $Url);
    	}

}
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
class BaseController extends \Yaf\Controller_Abstract{

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

	 protected function init(){
		$right = new checkRight();
		$right->checkLogin($this);//未登录自动跳到登录页

		 //请求需要认证的页面而没有认证
		 if($this->certType!==null && (!isset($this->cert[$this->certType]) || $this->cert[$this->certType]==0)){
			 $this->redirect(url::createUrl('/ucenter/'.self::$certPage[$this->certType].'@user'));exit;
		 }

		$this->getView()->setLayout('ucenter');
		$this->getView()->assign('topArray', $this->getTopArray());
		$this->getView()->assign('leftArray', $this->getLeftArray());
		$action = $this->getRequest()->getActionName();
		$this->getView()->assign('action', $action);
    }

    	/**
    	 * 获取头菜单的数据
    	 * @return [Array]
    	 */
    	private function getTopArray(){
    		$topArray = array(
				'index'      => array('url' => '', 'title' => '首页'),
				'Ucenter'  => array('url' => url::createUrl('/ucenter/baseinfo'), 'title' => '账户信息')
    		);
			if($this->cert['deal']==1){
				$topArray['Fund'] = array('url' => url::createUrl('/Fund/index'), 'title' => '资金管理');
				$topArray['Managerdeal'] = array('url' => url::createUrl('/ManagerDeal/indexOffer'), 'title' => '交易管理');
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
    		return array();
    	}

}

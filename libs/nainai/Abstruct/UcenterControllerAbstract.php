<?php

namespace nainai\Abstruct;

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
abstract class UcenterControllerAbstract extends BaseControllerAbstract{

        /**
         * 所有的用户中心列表的分页是这个
         * @var integer
         */
        protected $pagesize = 10;

	public function preinit(){

        }

	final private function init(){
		$this->preinit();
	          $right = new checkRight();
	         $right->checkLogin($this);//未登录自动跳到登录页

	        $this->getView()->setLayout('ucenter');
	        $this->getView()->assign('topArray', $this->getTopArray());
	        $this->getView()->assign('leftArray', $this->getLeftArray());
    	}

    	/**
    	 * 获取头菜单的数据
    	 * @return [Array]
    	 */
    	private function getTopArray(){
    		$topArray = array(
				'Ucenterindex'      => array('url' => '', 'title' => '首页'),
				'Ucenteraccount'  => array('url' => '', 'title' => '账户信息'),
				'Managerfund'     => array('url' => '', 'title' => '资金管理'),
				'Managerdeal'     => array('url' => url::createUrl('/ManagerDeal/indexOffer'), 'title' => '交易管理'),
				'Managerstore'    => array('url' => url::createUrl('/ManagerStore/ApplyStoreList'), 'title' => '仓单管理'),
				'Managercar'      => array('url' => '', 'title' => '车辆管理'),
				'Attentioncenter' => array('url' => '', 'title' => '关注中心')
    		);
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
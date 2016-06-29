<?php 

/**
 * 报盘管理控制器
 */
use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
class OffermanageController extends Yaf\Controller_Abstract{

	private $offer;
	public function init(){
		$this->offer = new OfferManageModel();
		$this->getView()->setLayout('admin');
		//echo $this->getViewPath();
	}

	/**
	 * 获取审核通过的报盘列表
	 * @return 
	 */
	public function offerListAction(){
		// $no = $this->_request->getParam('no');
		$page = safe::filterGet('page','int');
		$pageData = $this->offer->getActiveList($page);
		$this->getView()->assign('data',$pageData['data']);
		$this->getView()->assign('bar',$pageData['bar']);
		$this->getView()->assign('count',$pageData['count']);
	}

	//报盘审核
	public function offerReviewAction(){
		$page = safe::filterGet('page','int');
		$pageData = $this->offer->getApplyList($page);

		$this->getView()->assign('data',$pageData['data']);
		$this->getView()->assign('bar',$pageData['bar']);
		$this->getView()->assign('count',$pageData['count']);
	}
	
	/**
	 * 报盘详情
	 */
	public function offerDetailsAction(){
		$id = intval($this->_request->getParam('id'));
		$user = $this->_request->getParam('user');//委托人
		$info = $this->offer->getofferDetail($id);

		$info['user'] = $user;

		//获取客服人员列表
		$kefu = new KefuModel();
		$kefuData = $kefu->getAllkefu();

		$this->getView()->assign('info',$info);
		$this->getView()->assign('kefu',$kefuData);
	}

	/**
	 * 删除
	 */
	public function offerDelAction(){
		$name = $this->_request->getParam('name');
		$res = $this->offer->offerDel($name);
		die(JSON::encode($res));
	}

	/**
	 * 交易费率
	 * @return [type] [description]
	 */
	public function scaleOfferAction(){

	}



	//审核详情
	public function reviewDetailsAction(){
		$id = intval($this->_request->getParam('id'));
		$user = $this->_request->getParam('user');//委托人
		$info = $this->offer->getofferDetail($id);
		$info['user'] = $user;
		$this->getView()->assign('info',$info);
	}

	//设置审核状态
	public function setStatusAction(){
		if(IS_AJAX){
			$id = safe::filterPost("id","int");
			if(!$id) $id = intval($this->_request->getParam('id'));
			$status = safe::filterPost("status","int");
			$res = $this->offer->setStatus($id,$status);
			die(JSON::encode($res));
		}
		return false;
	}


	//回收站
	public function offerRecycleAction(){
		$page = safe::filterGet('page','int');
		$pageData = $this->offer->getDelList($page);
		$this->getView()->assign('data',$pageData['data']);
		$this->getView()->assign('bar',$pageData['bar']);
		$this->getView()->assign('count',$pageData['count']);
	}

	/**
	 * 报盘逻辑删除
	 */
	public function logicDelAction(){
		if(IS_AJAX){
			$id = safe::filterPost("id","int");
			if(!$id) $id = intval($this->_request->getParam('id'));

			$res = $this->offer->logicDel($id);
			die(JSON::encode($res));
		}
		return false;
	}

	/**
	 * 逻辑删除复原
	 */
	public function logicRecAction(){
		if(IS_AJAX){
			$id = safe::filterPost("id","int");
			if(!$id) $id = intval($this->_request->getParam('id'));
			$res = $this->offer->logicDel($id,0);
			die(JSON::encode($res));
		}
		return false;
	}

	/**
	 * 给报盘添加客服
	 */
	public function kefuAddAction(){
		if(IS_POST){
			$offer_id = safe::filterPost('offer_id','int',0);
			$kefu = safe::filterPost('kefu','int',0);
			$res = $this->offer->addKefu($offer_id,$kefu);
			die(json::encode($res));
		}
		return false;
	}

	/**
	 * 获取客服查看的报盘
	 */
	public function kefuOfferListAction(){
		$page = safe::filterGet('page','int',1);
		$list = $this->offer->getKefuOfferList($page);
		$this->getView()->assign('bar',$list['bar']);
		$this->getView()->assign('data',$list['data']);
	}

	/**
	 * 客服查看的报盘详情
	 */
	public function kefuOfferDetailAction(){
		$id = intval($this->_request->getParam('id'));
		$user = $this->_request->getParam('user');//委托人
		$info = $this->offer->getofferDetail($id);

		$info['user'] = $user;


		$this->getView()->assign('info',$info);
	}

	/**
	 * 过期的报盘列表
	 */
	public function expireOfferListAction(){
		$page = safe::filterGet('page','int',1);
		$list = $this->offer->getExpireOfferList($page);

		$this->getView()->assign('bar',$list['bar']);
		$this->getView()->assign('data',$list['data']);
	}

	public function expireOfferDetailsAction(){
		$id = intval($this->_request->getParam('id'));
		$user = $this->_request->getParam('user');//委托人
		$info = $this->offer->getofferDetail($id);

		$info['user'] = $user;


		$this->getView()->assign('info',$info);
	}
}
 ?>
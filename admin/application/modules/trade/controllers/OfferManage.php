<?php 

/**
 * 报盘管理控制器
 */
use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
class OfferManageController extends Yaf\Controller_Abstract{

	private $offer;
	public function init(){
		$this->offer = new OfferManageModel();
		$this->getView()->setLayout('admin');
		//echo $this->getViewPath();
	}

	/**
	 * 获取列表
	 * @return 
	 */
	public function offerListAction(){
		// $no = $this->_request->getParam('no');
		$page = safe::filterGet('page','int');
		$pageData = $this->offer->getList($page,"o.status >= 0 ");
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
		$info = $this->offer->getofferInfo($id);
		$info['user'] = $user;
		$this->getView()->assign('info',$info);
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

	//报盘审核
	public function offerReviewAction(){
		$page = safe::filterGet('page','int');
		$pageData = $this->offer->getList($page,'o.status=1');
		$this->getView()->assign('data',$pageData['data']);
		$this->getView()->assign('bar',$pageData['bar']);
		$this->getView()->assign('count',$pageData['count']);
	}

	//审核详情
	public function reviewDetailsAction(){
		$id = intval($this->_request->getParam('id'));
		$user = $this->_request->getParam('user');//委托人
		$info = $this->offer->getofferInfo($id);
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
		$pageData = $this->offer->getList($page,'o.status=-1');
		$this->getView()->assign('data',$pageData['data']);
		$this->getView()->assign('bar',$pageData['bar']);
		$this->getView()->assign('count',$pageData['count']);
	}
}
 ?>
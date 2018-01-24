<?php
/**
 * @author weipinglee
 * @desc 招标列表
 * @date 2017-06-15 10:07:47
 */
use \tool\http;
use \Library\url;
use \Library\safe;
use \Library\tool;
use \nainai\order\Order;
use \Library\checkRight;
use \nainai\bid\sellerHandle;

use \nainai\offer\product;

use \Library\JSON;

class bidController extends PublicController {


	public $bidObj = null;

	public function init(){
		parent::init();
		$this->bidObj = new  sellerHandle();
		$this->getView()->setLayout('layout');
	}

	public function tenderhallAction(){

	}

	public function tenderListAction()
	{
		$page = safe::filterGet('page','int');
		$cate_id = safe::filterGet('cate_id','int',0);
		if($cate_id!=0)
			$where = array('b.top_cate=:cate_id',array('cate_id'=>$cate_id));
		else $where = array();
		$list = $this->bidObj->getBidList($page,$where);
		$this->getView()->assign('list',$list);
		$this->getView()->assign('cate_id',$cate_id);

		$proObj = new \nainai\offer\product();
		$cates = $proObj->getTopCate();
		//print_r($cates);
		$this->getView()->assign('cates',$cates);

	}

	public function tendercontentAction()
	{
		$id = $this->getRequest()->getParam('id');
		$id = safe::filter($id,'int');
		$detail = $this->bidObj->getBidDetail($id);
		$this->getView()->assign('detail',$detail);

		$notice = $this->bidObj->getBidNotice($id);
		$this->getView()->assign('notice',$notice);

		//获取评论列表
		$commentObj = new \nainai\bid\comment\bidcomment();
		$page = safe::filterGet('page','int',1);
		$list = $commentObj->commentList($id,$page);//print_r($list);

		$this->getView()->assign('comment',$list);

		//获取投标信息
		$tbList = $this->bidObj->getOneBidReplyList($id);
		$this->getView()->assign('tbList',$tbList['list']);
	}

	public function bidIndexAction()
	{
		$this->getView()->assign('cur','bidIndex');
	}
	public function bidHallAction()
	{
		$this->getView()->assign('cur','bidIndex');
	}
	public function bidDetailsAction()
	{
		$this->getView()->assign('cur','bidIndex');
	}









}
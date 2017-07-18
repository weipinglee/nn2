<?php 

/**
 * @brief 后台招标管理
 * @author: weipinglee
 * @Date: 2017/6/12
 */
 use \Library\M;
use \Library\Query;
use \Library\Safe;
use \Library\json;
class BidController extends InitController{

    private $bidObj = null;



    public function init()
    {
        parent::init();
        $this->bidObj = new \nainai\bid\adminHandle($this->admin_id);

    }

    public function bidListAction()
    {
        $page = safe::filterGet('page','int',1);
        $bidObj = $this->bidObj;
        $list = $bidObj->getBidList($page);
        $this->getView()->assign('data',$list);
    }

    public function bidDetailAction()
    {
        $id = safe::filterGet('id','int');
        $detail = $this->bidObj->getBidDetail($id);
        $this->getView()->assign('detail',$detail);
        $notice = $this->bidObj->getBidNotice($id);
        $this->getView()->assign('notice',$notice);
    }

    public function verifyBidAction()
    {
        if(IS_POST){
            $id = safe::filterPost('id','int');
            $status = safe::filterPost('status','int');
            $message = safe::filterPost('message');
            $this->bidObj->setStateObj('bid',$id);
            $res = $this->bidObj->verify($status,$message);
            die(json::encode($res));
        }
    }



}
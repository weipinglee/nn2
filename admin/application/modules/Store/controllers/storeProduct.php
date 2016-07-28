<?php
/**
 * @name storeController
 * @author weipinglee
 * @desc �û����������
 */
use \Library\safe;
use \Library\Thumb;
use \nainai\subRight;
use \Library\tool;
class storeProductController extends Yaf\Controller_Abstract{

    public function init(){
        $this->getView()->setLayout('admin');
        //echo $this->getViewPath();
    }

    /**
     * ��ȡ�ֵ��б�
     */
   public function getListAction(){
       $page = safe::filterGet('page','int',1);
      

        $obj = new storeProductModel();
       $data = $obj->getList($page);
       $this->getView()->assign('list',$data);
    }

    /**
     * ����˲ֵ�
     */
    public function reviewListAction(){
        $page = safe::filterGet('page','int',1);
        $obj = new storeProductModel();
        $data = $obj->getApplyList($page);
        $this->getView()->assign('data',$data);
        $this->getView()->assign('attr',$data['attrs']);
    }

    /**
     * ����˲ֵ�����
     */
    public function reviewDetailsAction(){

        $id = $this->getRequest()->getParam('id');
        $id = safe::filter($id,'int');
        if($id){
            $obj = new storeProductModel();
            $detail = $obj->getUserStoreDetail($id);
            $this->getView()->assign('type',$detail['status']);
            $detail['status'] = $obj->getStatusText($detail['status']);
            $mem = new \nainai\member();
            $userData = $mem->getUserDetail($detail['user_id']);
            $this->getView()->assign('user',$userData);
            $this->getView()->assign('detail',$detail);
            $url=$_SERVER['HTTP_REFERER'];
            $this->getView()->assign('url',$url);

        }
    }

    /**
     * �ֵ�����
     */
    public function detailsAction(){
        $id = $this->getRequest()->getParam('id');
        $id = safe::filter($id,'int');
        if($id){
            $obj = new storeProductModel();
            $detail = $obj->getUserStoreDetail($id);
            $mem = new \nainai\member();
            $userData = $mem->getUserDetail($detail['user_id']);
            $detail['status'] = $obj->getStatusText($detail['status']);

            $this->getView()->assign('detail',$detail);
            $this->getView()->assign('user',$userData);

        }
    }

    public function setStatusAction(){
        if(IS_AJAX){
            $id = safe::filterPost("id","int");
            if(!$id) $id = intval($this->_request->getParam('id'));
            $status = safe::filterPost("status","int");
            $obj = new storeProductModel();
            $res = $obj->marketCheck($id,$status);
            die(\Library\JSON::encode($res));
        }
        return false;
    }






}
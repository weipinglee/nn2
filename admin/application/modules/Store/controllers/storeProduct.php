<?php
/**
 * @name storeController
 * @author weipinglee
 * @desc ï¿½Ã»ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿?
 */
use \Library\safe;
use \Library\Thumb;
use \nainai\subRight;
use \Library\tool;
use \Library\json;
class storeProductController extends Yaf\Controller_Abstract{

    public function init(){
        $this->getView()->setLayout('admin');
        //echo $this->getViewPath();
    }

    /**
     * ï¿½ï¿½È¡ï¿½Öµï¿½ï¿½Ð±ï¿½
     */
   public function getListAction(){
       $page = safe::filterGet('page','int',1);

        $obj = new storeProductModel();
       $data = $obj->getList($page);

       $this->getView()->assign('list',$data);
    }

    /**
     * ï¿½ï¿½ï¿½ï¿½Ë²Öµï¿?
     */
    public function reviewListAction(){
        $page = safe::filterGet('page','int',1);
        $obj = new storeProductModel();
        $data = $obj->getApplyList($page);
        $this->getView()->assign('data',$data);
        $this->getView()->assign('attr',$data['attrs']);
    }

    /**
     * ï¿½ï¿½ï¿½ï¿½Ë²Öµï¿½ï¿½ï¿½ï¿½ï¿?
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
     * ï¿½Öµï¿½ï¿½ï¿½ï¿½ï¿½
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
            $res = $obj->marketCheck($id,$status, safe::filterPost('adminMsg'));
            die(\Library\JSON::encode($res));
        }
        return false;
    }

    public function deleteAction(){
        $id = $this->getRequest()->getParam('id');
        $id = safe::filter($id,'int');

        $obj = new storeProductModel();
        if (intval($id) > 0) {
            $res = $obj->delete($id);
            if ($res == true) {
                exit(json::encode(tool::getSuccInfo(1)));
            }else{
                exit(json::encode(tool::getSuccInfo(0, '操作失败')));
            }
        }

        exit(json::encode(tool::getSuccInfo(0, 'Error id')));
    }






}
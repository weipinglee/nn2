<?php
/**
 * @name storeController
 * @author weipinglee
 * @desc 用户管理控制器
 */
use \Library\safe;
use \Library\Thumb;
use \nainai\subRight;
use \Library\tool;
use \Library\json;
class storeController extends Yaf\Controller_Abstract{

    public function init(){
        $this->getView()->setLayout('admin');
        //echo $this->getViewPath();
    }

    public function storeListAction(){
        $storeModel = new storeModel();
        $page = safe::filterGet('page','int');
        $pageData = $storeModel->getStoreList($page);

        $storeType = $storeModel->getStoreType();
        $this->getView()->assign('data',$pageData);
        $this->getView()->assign('store_type',$storeType);
        $this->getView()->assign('bar',$pageData['bar']);

    }

    /**
     *仓库添加
     */
    public function storeAddAction(){
        $storeModel = new storeModel();
        if(IS_POST){
            $imgfile = safe::filterPost('imgfile1');
            $store['id']              = safe::filterPost('id','int',0);
            $store['name']            = safe::filterPost('name');
            $store['short_name']      = safe::filterPost('short_name');
            $store['area']            = safe::filterPost('area','/^\d{4,6}$/');
            $store['address']         = safe::filterPost('address');
            $store['service_phone']   = safe::filterPost('service_phone','/^[\d\-]{6,15}$/');
            $store['service_address'] = safe::filterPost('service_address');
            $store['contact']         = safe::filterPost('contact');
            $store['contact_phone']   = safe::filterPost('contact_phone','/^[\d\-]{6,15}$/');
            $store['type']            = safe::filterPost('type','/^[01]$/');
            $store['code']            = safe::filterPost('code','/^[A-Za-z0-9]{4,8}$/');
            $store['status']          = safe::filterPost('status','/^[01]$/');
            $store['note']            = safe::filterPost('note');
            if (!empty($imgfile)) {
                $store['img']             = tool::setImgApp($imgfile);
            }

            $existArr = array('code'=>$store['code']);
            if($store['id']>0){
                $existArr['id'] = array('neq',$store['id']);
            }
            if($storeModel->exist($existArr)){
                die(json::encode(tool::getSuccInfo(0,'该仓库代码已经存在')));
            }
            $res = $storeModel->update($store);
            die(json::encode($res));

        }else{
            $store_id  = $this->getRequest()->getParam('id',0);
            $store_id = safe::filter($store_id,'int');
            if($store_id){
                $storeInfo = $storeModel->getStoreInfo($store_id);
                if($storeInfo['img']!='')
                    $storeInfo['img'] = Thumb::get($storeInfo['img'],180,180);

                $this->getView()->assign('store',$storeInfo);
            }
            $allType = $storeModel->getStoreType();
            $this->getView()->assign('alltype',$allType);
        }
    }

    /**
     * 设置仓库状态
     * @return bool
     */
    public function setStatusAction(){
        if(IS_AJAX){
            $data['status'] = intval(safe::filterPost('status'));
            $data['id'] = intval($this->_request->getParam('id'));
            $storeModel = new storeModel();

            $res = $storeModel->update($data);

            die(json::encode($res)) ;

        }
        return false;
    }

    /**
     * 删除仓库
     */
    public function logicDelAction(){
        if(IS_AJAX){
            $data['is_del'] = 1;
            $data['id'] = intval($this->_request->getParam('id'));
            $storeModel = new storeModel();

            $res = $storeModel->update($data);

            echo JSON::encode($res);
            return false;
        }
        return false;
    }

    public function repertoryAction(){
        $model = new OfferManageModel();
        $pageData = $model->getrepertoryList();
        $this->getView()->assign('data',$pageData);
    }




}
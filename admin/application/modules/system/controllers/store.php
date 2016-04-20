<?php
/**
 * @name storeController
 * @author weipinglee
 * @desc 用户管理控制器
 */
use \Library\safe;
use \nainai\certificate;
use \Library\Thumb;
use \nainai\subRight;
use \Library\tool;
class storeController extends Yaf\Controller_Abstract{

    public function init(){
        $this->getView()->setLayout('admin');
        //echo $this->getViewPath();
    }

    public function storeListAction(){
        $storeModel = new storeModel();
        $page = safe::filterGet('page','int');
        $pageData = $storeModel->getStoreList($page);
        $this->getView()->assign('store',$pageData['data']);
        $this->getView()->assign('bar',$pageData['bar']);

    }

    /**
     *仓库添加
     */
    public function storeAddAction(){
        $storeModel = new storeModel();
        if(IS_POST){
            $store['id']              = safe::filterPost('id','int',0);
            $store['name']            = safe::filterPost('name');
            $store['short_name']      = safe::filterPost('short_name');
            $store['area']            = safe::filterPost('area','/^\d{6}$/');
            $store['address']         = safe::filterPost('address');
            $store['service_phone']   = safe::filterPost('service_phone','/^[\d\-]{6,15}$/');
            $store['service_address'] = safe::filterPost('service_address');
            $store['contact']         = safe::filterPost('contact');
            $store['contact_phone']   = safe::filterPost('contact_phone','/^[\d\-]{6,15}$/');
            $store['type']            = safe::filterPost('type','/^[01]$/');
            $store['status']          = safe::filterPost('status','/^[01]$/');
            $store['note']            = safe::filterPost('note');
            $store['img']             = tool::setImgApp(safe::filterPost('imgfile1'));

            $res = $storeModel->storeAdd($store);
            if($res['success']==1){
                $this->redirect('storeList');
            }else{
                echo $res['info'];
            }

        }else{
            $store_id  = $this->getRequest()->getParam('id',0);
            $store_id = safe::filter($store_id,'int');
            if($store_id){
                $storeInfo = $storeModel->getStoreInfo($store_id);
                if($storeInfo['img']!='')
                    $storeInfo['img'] = Thumb::get($storeInfo['img'],180,180);

                $this->getView()->assign('store',$storeInfo);
            }
        }
    }




}
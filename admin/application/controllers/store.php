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
use \Library\url;
class storeController extends Yaf\Controller_Abstract{

    public function init(){
        $this->getView()->setLayout('admin');
        //echo $this->getViewPath();
    }

    public function storeListAction(){

    }

    /**
     *仓库添加
     */
    public function storeAddAction(){
        if(IS_POST){
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
            $store['img']             = safe::filterPost('imgfile1');

            $storeModel = new storeModel();
            $res = $storeModel->storeAdd($store);
            if($res['success']==1){
                $this->redirect('storeList');
            }else{
                echo $res['info'];
            }

        }
    }




}
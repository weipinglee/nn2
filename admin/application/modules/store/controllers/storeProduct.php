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
class storeProductController extends Yaf\Controller_Abstract{

    public function init(){
        $this->getView()->setLayout('admin');
        //echo $this->getViewPath();
    }

    /**
     * 获取仓单列表
     */
   public function getListAction(){
       $page = safe::filterGet('page','int',1);
        $obj = new storeProductModel();
       $data = $obj->getList($page);
       $this->getView()->assign('list',$data['list']);
       $this->getView()->assign('attr',$data['attrs']);
       $this->getView()->assign('bar',$data['pageHtml']);
    }

    /**
     * 待审核仓单
     */
    public function checkListAction(){
        $page = safe::filterGet('page','int',1);
        $obj = new storeProductModel();
        $data = $obj->getApplyList($page);
        $this->getView()->assign('list',$data['list']);
        $this->getView()->assign('attr',$data['attrs']);
        $this->getView()->assign('bar',$data['pageHtml']);
    }




}
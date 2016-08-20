<?php

/**
 * Created by PhpStorm.
 * User: wangzhande
 * Date: 2016/8/3
 * Time: 11:04
 */
use nainai\riskMgt\userRisk;
class RiskmgtController extends Yaf\Controller_Abstract
{
    public function init(){
        $this->getView()->setLayout('admin');
    }
    public function userRiskListAction(){
        $userRiskModel=new userRisk();
        $page=\Library\safe::filterGet('page','int');
        $userRiskList=$userRiskModel->getUserRiskList($page);
        $this->getView()->assign('data',$userRiskList);
    }
    public function adminRiskListAction(){
        $adminRiskModel = new adminRiskModel();
        $page=\Library\safe::filterGet('page','int');
        $res = $adminRiskModel->getAdminRiskList($page);
        $this->getView()->assign('data',$res);
    }
    public function checkUserRiskAction(){
        $id=\Library\safe::filterGet('id','int');
        if(!$id){
            $id=intval($this->_request->getParam('id'));
        }
        $userRiskModel=new userRisk();
        $userDetail=$userRiskModel->getUserRiskDetail($id);
       // var_dump($userDetail);
        $this->getView()->assign('reInfo',$userDetail);
    }
    public function checkAdminRiskAction(){
        $id=\Library\safe::filterGet('id','int');
        if(!$id){
            $id=intval($this->_request->getParam('id'));
        }
        $adminRiskModel=new adminRiskModel();
        $adminDetail=$adminRiskModel->getAdminRiskDetail($id);;
        $this->getView()->assign('reInfo',$adminDetail);
    }
    public function setUserRiskStatusAction(){
        $id=Library\safe::filterPost('id','int');
        if(!$id){
            die(\Library\tool::getSuccInfo(0,'参数不正确'));
        }
        $userRiskModel=new userRisk();
        $res=$userRiskModel->setStatus($id);
        if($res['success']==1) {
            $adminMsg = new \nainai\adminMsg();
            $adminMsg->setStatus($this, $id);
        }die(\Library\json::encode($res));
    }
    public function setAdminRiskStatusAction(){
        $id=Library\safe::filterPost('id','int');
        if(!$id){
            die(\Library\tool::getSuccInfo(0,'参数不正确'));
        }
        $adminRiskModel=new adminRiskModel();
        $res=$adminRiskModel->setStatus($id);
        if($res['success']==1){
            $adminMsg = new \nainai\adminMsg();
            $adminMsg->setStatus($this,$id);
        }
        die(\Library\json::encode($res));
    }
}
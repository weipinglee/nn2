<?php

/**
 * Created by PhpStorm.
 * User: wangzhande
 * Date: 2016/8/3
 * Time: 11:04
 */
use nainai\riskMgt\userRisk;
class riskMgtController extends Yaf\Controller_Abstract
{
    public function init(){
        $this->getView()->setLayout('admin');
    }
    public function userRiskListAction(){
        $userRiskModel=new userRisk();
        $page=\Library\safe::filterGet('page','int');
        $userRiskList=$userRiskModel->getUserRiskList($page);
        $this->getView()->assign('data',$userRiskList[0]);
        $this->getView()->assign('pageBar',$userRiskList[1]);
    }
}
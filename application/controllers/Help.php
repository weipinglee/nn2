<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/15
 * Time: 12:00
 */
class HelpController extends PublicController
{
    public function helpAction(){
        //获取帮助
        $helpModel=new \nainai\system\help();
        $helpModel->helpLimit='';
        $helpModel->helpCatLimit='';
        $helpList=$helpModel->getAllHelplist();
        $this->getView()->assign('helpList',$helpList);
        $cat_id=\Library\safe::filterGet('cat_id');
        $id=\Library\safe::filterGet('id','int');
        $helpModel=new \nainai\SiteHelp();
        $helpCatInfo=$helpModel->checkHelpCatName(['id'=>$cat_id]);
        $helpInfo=$helpModel->checkHelpName(['id'=>$id]);
        $this->getView()->assign('helpInfo',$helpInfo);
        $this->getView()->assign('helpCatInfo',$helpCatInfo);

    }
}
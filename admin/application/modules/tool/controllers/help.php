<?php
/**
 * 帮助管理
 * Created by PhpStorm.
 * User: wangzhande
 * Date: 2016/6/16
 * Time: 14:18
 */
use nainai\siteHelp;
class helpController extends Yaf\Controller_Abstract{

    public function init(){
        $this->getView()->setLayOut('admin');
    }

    /**
     *帮助列表
     */
    public function helpListAction(){
        $helpModel=new siteHelp();
        $page=\Library\safe::filterGet('page','int');
        $res=$helpModel->getHelpList($page);
        $this->getView()->assign('helpList',$res[0]);
        $this->getView()->assign('pageBar',$res[1]);

    }

    /**
     *帮助分类列表
     */
    public function helpCatListAction(){
        $helpModel=new siteHelp();
        $page=\Library\safe::filterGet('page','int');
        $res=$helpModel->getHelpCatList($page);
        $this->getView()->assign('helpCatList',$res[0]);
        $this->getView()->assign('pageBar',$res[1]);
    }

    /**
     *添加帮助
     */
    public function helpAddAction(){
        $helpModel=new siteHelp();
        if(IS_AJAX&&IS_POST){
            $data['name']=\Library\safe::filterPost('name');
            $data['cat_id']=\Library\safe::filterPost('cat_id','int');
            if($data['cat_id']==0){
                die(\Library\json::encode(['success'=>0,'info'=>'请选择分类']));
            }
            $data['time']=date('Y-m-d H:i:s',time());
            $data['sort']=\Library\safe::filterPost('sort','int');
            $data['link']=\Library\safe::filterPost('link');
            $data['content']=\Library\safe::filterPost('content');

            $id=\Library\safe::filterPost('id','int');
            if($id){
                $data['id']=$id;
                $res=$helpModel->helpEdit($data);
                die(\Library\json::encode($res));
            }else{
                $res=$helpModel->addhelp($data);
            }
            die(\Library\json::encode($res));
        }
        $catList=$helpModel->getAllCat();
        $this->getView()->assign('catList',$catList);

    }

    /**
     *添加帮助分类
     */
    public function helpCatAddAction(){
        $helpCatModel=new siteHelp();
        if(IS_AJAX&&IS_POST){
            $data['name']=\Library\safe::filterPost('name');
            $data['sort']=\Library\safe::filterPost('sort','int');
            $data['position_left']=\Library\safe::filterPost('position_left','int');
            $data['position_foot']=\Library\safe::filterPost('position_foot','int');
            $id=\Library\safe::filterPost('id','int');
            if($id){
                $data['id']=$id;
                $res=$helpCatModel->helpCatEdit($data);
            }else{
                $res=$helpCatModel->addhelpCat($data);
            }
            die(\Library\json::encode($res));
        }

    }



    /**
     *编辑帮助分类
     */
    public function helpCatEditAction(){
            $helpCatModel=new siteHelp();
            $id=\Library\safe::filterGet('id','int');
            $res=$helpCatModel->getHelpCatById($id);
            $this->getView()->assign('helpCatInfo',$res);

    }

    /**
     *编辑帮助
     */
    public function helpEditAction(){
        $id=\Library\safe::filterGet('id','int');
        $helpModel=new siteHelp();
        $res=$helpModel->getHelpById($id);
        $catList=$helpModel->getAllCat();
        $this->getView()->assign('catList',$catList);
        $this->getView()->assign('helpInfo',$res);
    }

    /**
     * 删除帮助
     * @return bool
     */
    public function delHelpAction(){
        if(IS_AJAX){
            $id=\Library\safe::filterGet('id','int');
            $helpModel=new siteHelp();
            $res=$helpModel->helpDel($id);
            die(\Library\json::encode($res));
        }
        return false;
    }

    /**
     * 删除帮助分类
     * @return bool
     */
    public function delHelpCatAction(){
        if(IS_AJAX){
            $id=\Library\safe::filterGet('id','int');
            $helpModel=new siteHelp();
            $res=$helpModel->helpCatDel($id);
            die(\Library\json::encode($res));
        }
        return false;
    }
}
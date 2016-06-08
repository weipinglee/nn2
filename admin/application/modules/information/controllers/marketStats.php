<?php
/**
 * 市场统计管理类
 * Created by PhpStorm.
 * User: wangzhande
 * Date: 2016/6/7
 * Time: 10:29
 */
use Library\safe;
use Library\json;
class marketStatsController extends Yaf\Controller_Abstract{
    public function init(){
        $this->getView()->setLayout('admin');
    }

    /**
     *市场统计数据列表
     */
    public function marketStatsListAction(){
        $page=safe::filterGet('paeg','int');
        $res=\nainai\statistics::getMarketStatsList($page);
        $this->getView()->assign('statsList',$res[0]);
        $this->getView()->assign('pageBar',$res[1]);
    }

    /**
     *添加统计分类
     */
    public function addCateStatsAction(){
        if(IS_POST&&IS_AJAX) {
            $cateId=safe::filterPost('cate_id','int');
            $type=safe::filterPost('type','int');
            $statsModel=new \nainai\statistics();
            $res=$statsModel->addCate($cateId,$type);
            die(JSON::encode($res));
        }
        $cateModel = new productModel();
        $cateTree = $cateModel->getCateTree();
        $statsType = \nainai\statistics::getAllType();
        $this->getView()->assign('cateTree', $cateTree);
        $this->getView()->assign('statsType', $statsType);
    }
    public function delAction(){
        if(IS_GET&&IS_AJAX){
           /* $id=safe::filterGet('id','int');
            $res=\nainai\statistics::delStats($id);*/
            die(JSON::encode(array('success'=>0,'info'=>'删除失败')));
        }
        return false;

    }
}
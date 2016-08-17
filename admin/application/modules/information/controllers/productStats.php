<?php
/**
 * 商品指导价管理类
 * User: zyn
 * Date: 2016-8-17 15:04:19
 */
use Library\safe;
use Library\json;
use Library\M;
use Library\tool;
use Library\Query;
class productStatsController extends Yaf\Controller_Abstract{
    public function init(){
        $this->getView()->setLayout('admin');
    }

    /**
     *市场统计数据列表
     */
    public function productStatsListAction(){
        $page=safe::filterGet('page','int', 1);
        $obj = new Query('products_stats');
        $obj->where = 'is_del = 0';
        $obj->page = $page;
        $dataList = $obj->find();
        $pageBar = $obj->getPageBar();
        $this->getView()->assign('data',$dataList);
        $this->getView()->assign('pageBar',$pageBar);
    }

    /**
     *添加统计商品
     */
    public function addproductstatsAction(){
        if(IS_POST&&IS_AJAX) {
            $obj = new M('products_stats');
            $data = array(
                        'name' => safe::filterPost('name'),
                        'status' => safe::filterPost('status', 'int', 1),
                        'is_del' => safe::filterPost('is_del', 'int', 0)
                    );
            if(safe::filterPost('id'))
            {
                $res = $obj->data($data)->where('id = '.safe::filterPost('id'))->update();
            }
            else
            {
                $data['create_time'] = date('Y-m-d H:i:s');
                $res = $obj->data($data)->add();
            }
            
            if($res)
            {
                die(json::encode(tool::getSuccInfo(1,'添加成功')));
            }
            die(json::encode(tool::getSuccInfo(1,'添加失败')));
        }
        $id = safe::filterGet('id');
        if($id)
        {
            $obj = new M('products_stats');
            $detail = $obj->where('id = '.$id)->getObj();
            $this->getView()->assign('detail', $detail);
        }
    }
    
    
    /**
     * 设置数据状态
     */
    public function setStatusAction(){
        if(IS_AJAX){
            $data['status'] = intval(safe::filterPost('status'));
            $id = intval($this->_request->getParam('id'));
            $obj = new M('products_stats');
            $res = $obj->data($data)->where('id = '.$id)->update();
            if($res)
            {
                die(json::encode(tool::getSuccInfo()));
            }
        }
        return false;
    }
    
    //删除统计商品
    public function delProductStatsAction(){
        if(IS_AJAX){
            $id = safe::filterGet('id','int');
            $obj = new M('products_stats');
            $res = $obj->data(array('is_del' => 1))->where('id = '.$id)->update();
            if($res)
            {
                die(json::encode(tool::getSuccInfo()));
            }
        }
        return false;
    }

    /**
     * 统计项列表
     */
    public function statsListAction(){
        $statsModel=new \nainai\statistics();
        $data = $statsModel->getStatCateList();

        $this->getView()->assign('data',$data);
    }
    //删除统计分类
    public function delStatsAction(){
        if(IS_POST&&IS_AJAX){
            $id=safe::filterGet('id','int');
            $res=\nainai\statistics::delStatsCate($id);
            die(json::encode($res));
        }
        return false;

    }

    public function createStaticAction(){
        $statsModel=new \nainai\statistics();
        $data = $statsModel->createStatistics();
        print_r($data);
        return false;
    }
}
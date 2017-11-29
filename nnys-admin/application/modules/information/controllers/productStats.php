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
        $obj = new Query('offer_data');
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
            $obj = new M('offer_data');
            $data = array(
                        'id' => safe::filterPost('id', 'int', 0),
                        'pro_name' => safe::filterPost('pro_name'),
                        'pro_no' => safe::filterPost('pro_no'),
                         'al' => safe::filterPost('al'),
                        'last' => safe::filterPost('last'),
						 'mininum' => safe::filterPost('mininum'),
                        'price' => safe::filterPost('price'),
						'increase' => safe::filterPost('increase'),
						 'inc_perc' => safe::filterPost('inc_perc'),
                        'acc_type' => safe::filterPost('acc_type'),
						'acc_store' => safe::filterPost('acc_store'),
                    );
            $temp = $obj->where('pro_name="'.$data['pro_name'].'" and id <>'.$data['id'])->getObj();
            if($temp)
            {
                die(json::encode(tool::getSuccInfo(0,'商品名称不能重复')));
            }        
            if($data['id'])
            {
                $res = $obj->data($data)->where('id = '.safe::filterPost('id'))->update();
            }
            else
            {
                $data['add_time'] = date('Y-m-d H:i:s');
                $res = $obj->data($data)->add();
            }
            
            if($res)
            {
                die(json::encode(tool::getSuccInfo()));
            }
            die(json::encode(tool::getSuccInfo(1,'添加失败')));
        }
        $id = safe::filterGet('id');
        if($id)
        {
            $obj = new M('offer_data');
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
            $obj = new M('offer_data');
            $res = $obj->where('id = '.$id)->delete();
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
        $page=safe::filterGet('page','int', 1);
        $obj = new Query('products_stats_data as psd');
        $obj->join = "LEFT JOIN products_stats as ps on psd.products_stats_id = ps.id";
        $obj->fields = 'psd.*, ps.name';
        $obj->where = 'ps.is_del = 0';
        $obj->page = $page;
        $dataList = $obj->find();
        $pageBar = $obj->getPageBar();
        $this->getView()->assign('data',$dataList);
        $this->getView()->assign('pageBar',$pageBar);
    }
    //删除统计分类
    public function delStatsAction(){
        if(IS_AJAX){
            $id = safe::filterGet('id','int');
            $obj = new M('products_stats_data');
            $res = $obj->where('id = '.$id)->delete();
            if($res)
            {
                die(json::encode(tool::getSuccInfo()));
            }
        }
        return false;
    }

    public function addStatsAction(){
        if(IS_POST&&IS_AJAX) {
            $obj = new M('products_stats_data');
            $data = array(
                        'id' => safe::filterPost('id'),
                        'products_stats_id' => safe::filterPost('products_stats_id'),
                        'price' => safe::filterPost('price', 'float')
                    );
            if($data['id'])
            {
                //计算价格变化幅度
                $price = $obj->where('id < '.$data['id'].' and products_stats_id = '.$data['products_stats_id'])->order('id DESC')->getObj();
                if(empty($price))
                {
                    $data['change_range'] = 0;
                }
                else
                {
                    $data['change_range'] = round(($data['price'] - $price['price'])/$price['price'], 2) * 100;
                }
                
                //改变基于该数据的下一条统计数据的价格变化幅度
                $temp = $obj->where('id > '.$data['id'].' and products_stats_id = '.$data['products_stats_id'])->order('id ASC')->limit(1)->getObj();
                if($temp)
                {
                    $temp_range = round(($temp['price'] - $data['price'])/$data['price'], 2) * 100;
                    $obj->data(array('change_range' => $temp_range))->where('id = '.$temp['id'])->update();
                }
                $res = $obj->data($data)->where('id = '.$data['id'])->update();
            }
            else
            {
                //计算价格变化幅度
                $price = $obj->where('products_stats_id = '.$data['products_stats_id']. ' and create_time < now()')->order('id DESC')->getObj();
                if(empty($price))
                {
                    $data['change_range'] = 0;
                }
                else
                {
                    $data['change_range'] = round(($data['price'] - $price['price'])/$price['price'], 2) * 100;
                }
                $data['create_time'] = date('Y-m-d H:i:s');
                $res = $obj->data($data)->add();
            }
            
            if($res)
            {
                die(json::encode(tool::getSuccInfo()));
            }
            die(json::encode(tool::getSuccInfo(1,'添加失败')));
        }
        $id = safe::filterGet('id');
        if($id)
        {
            $obj = new Query('products_stats_data as psd');
            $obj->join = "LEFT JOIN products_stats as ps on psd.products_stats_id = ps.id";
            $obj->fields = 'psd.*, ps.name';
            $obj->where = 'psd.id = '.$id;
            $detail = $obj->getObj();
        }
        else
        {
            $pro_id = safe::filterGet('pro_id');
            $obj = new M('products_stats');
            $detail['products_stats_id'] = $pro_id;
            $detail['name'] = $obj->where('id='.$pro_id)->getField('name');
        }
        $this->getView()->assign('detail', $detail);
    }
}
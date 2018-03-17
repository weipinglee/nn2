<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/25
 * Time: 13:58
 */
use \Library\safe;
use \Library\json;
use \Library\tool;
class statsMarketController extends Yaf\Controller_Abstract
{
    public function init(){
        $this->getView()->setLayout('admin');
    }
    //添加市场统计
    public function addStatsMarketAction(){
        if(IS_POST&&IS_AJAX){
            $data['name']=\Library\safe::filterPost('name');
            $data['cate_id']=\Library\safe::filterPost('cate_id','int');
            $data['status']=\Library\safe::filterPost('status','int');
            $data['is_del']=\Library\safe::filterPost('is_del','int');
            $data['create_time']=date('Y-m-d H:i:s',time());
            $id=\Library\safe::filterPost('id','int');
            $stataModel=new \nainai\statsMarket();
            if(!$id){
                $res=$stataModel->addStatsMarket($data);
                die(\Library\json::encode($res));
            }else{
                $data['id']=$id;
                $res=$stataModel->editStatsMarket($data);
                die(\Library\json::encode($res));
            }
            return false;

        }
        $id=\Library\safe::filterGet('id','int');
        if($id){
            $statsModel=new \nainai\statsMarket();
            $info=$statsModel->getStatsMarketInfo($id);
            $this->getView()->assign('detail',$info);
        }
        $cateModel=new \nainai\offer\product();
        $topCate=$cateModel->getTopCate();
        $this->getView()->assign('topCate',$topCate);

    }
    public function statsMarketListAction(){
        $page=\Library\safe::filterGet('page','int');
        $statsModel=new \nainai\statsMarket();
        $data=$statsModel->getStatsMarketList($page);
        $this->getView()->assign('data',$data[0]);
        $this->getView()->assign('pageBar',$data[1]);
    }
    public function setStatusAction(){
        if(IS_AJAX){
        $status=\Library\safe::filterPost('status','int');
        $id=\Library\safe::filterGet('id','int');
            if(!$id) $id = intval($this->_request->getParam('id'));
            if(!$id){
                return false;
            }
        $statsObj=new \Library\M('market_stats');
        $statsObj->where(['id'=>$id])->data(['status'=>$status])->update();
        die(\Library\json::encode(\Library\tool::getSuccInfo(1,'修改成功')));
        }
        return false;
    }
    public function delStatsMarketAction(){
        if(IS_AJAX){
            $is_del=1;
            $id=Library\safe::filterGet('id','int');
            if(!$id) $id = intval($this->_request->getParam('id'));
            if(!$id){
                return false;
            }
            $statsObj=new \Library\M('market_stats');
            $statsObj->where(['id'=>$id])->data(['is_del'=>$is_del])->update();
            die(\Library\json::encode(\Library\tool::getSuccInfo(1,'删除成功')));
        }
        return false;
    }
    public function addStatsAction(){
        if(IS_POST){
            $id=\Library\safe::filterPost('id','int');
            $data['market_stats_id']=\Library\safe::filterPost('market_stats_id','int');
            $data['price']=\Library\safe::filterPost('price');
            $data['create_time']=\Library\safe::filterPost('create_time');
            $statsModel=new \nainai\statsMarket();
            if($id){
                $data['id']=$id;
                $res=$statsModel->editStats($data);
                die(\Library\json::encode($res));
            }else{
                $res=$statsModel->addStats($data);
                die(\Library\json::encode($res));
            }
        }
        $statsModel=new \nainai\statsMarket();
        $pro_id=Library\safe::filterGet('pro_id','int');
        if(!$pro_id)$pro_id=intval($this->_request->getParam('pro_id'));
        if($pro_id){

            $detail=$statsModel->getStatsMarketInfo($pro_id);
            $detail['market_stats_id']=$detail['id'];
            unset($detail['id']);
            $this->getView()->assign('detail',$detail);
        }else{
            $id=Library\safe::filterGet('id','int');
            if(!$id)$id=intval($this->_request->getParam('id'));
            $detail=$statsModel->getStatsInfo($id);
            $this->getView()->assign('detail',$detail);
        }
    }
    public function statsListAction(){
        $page=\Library\safe::filterGet('page','int');
        $statsModel=new \nainai\statsMarket();
        $res=$statsModel->getStatsList($page);
        $this->getView()->assign('data',$res[0]);
        $this->getView()->assign('pageBar',$res[1]);
    }
    public function  delStatsAction(){
        $id=Library\safe::filterGet('id','int');
        if(!$id)$id=intval($this->_request->getParam('id'));
        $statsModel=new \nainai\statsMarket();
        $res=$statsModel->delStats($id);
        die(\Library\json::encode($res));
    }

    public function statsUserListAction(){
        $page=\Library\safe::filterGet('page','int');
        $obj = new \Library\Query('stat_user');
        $obj->page=$page;
        $data = $obj->find();
        $bar = $obj->getPageBar();
        $this->getView()->assign('data',$data);
        $this->getView()->assign('pageBar',$bar);
    }

    public function statsUserDetailAction(){
        $statsModel=new \nainai\statsMarket();
       $data = $statsModel->userStatData();
        die(\Library\json::encode($data));

    }

    public function statsList2Action(){
         $orderStaticObj = new \orderStaticModel();
//         $start = '20180201';
//         $end = '20180314';
//        // $orderStaticObj->createStaticDataDay($start,$end);
//
//         $startMonth = '201802';
//         $endMonth = '201802';
//         $orderStaticObj->createStaticDataMonth($startMonth,$endMonth);



    }

    public function tradeStatisticDataAction(){
        $type = safe::filterGet('time');
        $username = safe::filterGet('user_name');
        $obj = new \Library\M('user');
        $user_id=0;
        if($username!=''){
            $user_id = $obj->where(array('username'=>$username))->getField('id');
            if(!$user_id)
                die(\Library\json::encode(\Library\tool::getSuccInfo(0,'用户不存在')));
        }
        $num = 6;
        if($type=='week'){
            $type='day';
        }
        else{
            $type='month';
        }
        try{
            $orderStaticObj = new \orderStaticModel();
            $data = $orderStaticObj->getStatisticData($type,$user_id,$num);
            die(json::encode($data));
        }catch (\Exception $e){
            die(\Library\json::encode(\Library\tool::getSuccInfo(0,$e->getMessage())));
        }



    }

    public function offerStatisticDataAction(){
        $username = safe::filterGet('user_name');
        $proname = safe::filterGet('pro_name');
        $status = safe::filterGet('status');//1代表已成交，0未成交
        $start_time = safe::filterGet('start');
        $end_time = safe::filterGet('end');
        if($start_time==''&& $end_time==''){
            $time_type = safe::filterGet('type');
            $timeObj = new \DateTime();
            if($time_type=='week'){
                $week = date('N',strtotime(time()))-1;
                $timeObj->modify('-'.$week.' day');
                $start_time = $timeObj->format('Y-m-d');
            }
            elseif($time_type=='month'){
                $days = intval($timeObj->format('d'))-1;
                $timeObj->modify('-'.$days.' day');
                $start_time = $timeObj->format('Y-m-d');
            }
            else{
                $months = intval($timeObj->format('m'));
                $sub = 0;
                if($months%3==0){
                    $sub = 2;
                }
                elseif($months%3==1){
                    $sub  = 0;
                }
                elseif($months%3==2){
                    $sub = 1;
                }
                $timeObj->modify('-'.$sub.' month');
                $start_time = $timeObj->format('Y-m').'-01';
            }
            $user_id = 0;
            if($username!=''){
                $obj = new \Library\M('user');
                $user_id = $obj->where(array('username'=>$username))->getField('id');
                if(!$user_id)
                    die(\Library\json::encode(\Library\tool::getSuccInfo(0,'用户不存在')));
            }
            $orderStaticObj = new \orderStaticModel();
            $data = $orderStaticObj->getOfferStatisticData($user_id,$proname,$status,$start_time,$end_time);
            die(json::encode($data));

        }
    }
}
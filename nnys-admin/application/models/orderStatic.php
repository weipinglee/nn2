<?php
/**
 * 订单统计管理
 * User: weipinglee
 * Date: 2018/3/14
 */
use \Library\Query;
use \Library\M;
use \Library\tool;
use \Library\safe;
class orderStaticModel {

    public function createStaticDataDay($startDate,$endDate=''){
       if($endDate==''){
           $endDate = $startDate;
       }
        $startDate = new \DateTime($startDate);
        $endDate   = new \DateTime($endDate);
        $dataInterValObj = new \DateInterval('P1D');
        do{
            //生成startDate当天的统计
            $this->createStaticDataOneDay($startDate);
            //开始数据递增一天
            $startDate->add($dataInterValObj);
            $interDaysObj = $startDate->diff($endDate);
            $interDays = $interDaysObj->format('%R%a');
        }while($interDays>=0);

    }

    /**
     * 在统计表中生成给定日期的统计数据
     * @param object $date date对象
     */
    private function createStaticDataOneDay(\DateTime $date){
        $dbObj = new M('static_order');
        $date_str = $date->format('Ymd');
        $res = $dbObj->query('CALL orderStaticDay('.$date_str.')');
        return $res;
    }

    /**
     * @param string $startMonth 6位字符 201803
     * @param string $endMonth 201804
     */
    public function createStaticDataMonth( $startMonth, $endMonth=''){
        if($endMonth==''){
            $endMonth=$startMonth;
        }

        $startMonth = substr($startMonth,0,6);
        $endMonth   = substr($endMonth,0,6);
        $startDateObj = new \DateTime($startMonth.'01');
        $endDateObj   = new \DateTime($endMonth.'01');
        $monthInterValObj = new \DateInterval('P1M');
        $dbObj = new M('static_order');
        do{

            $date_str = $startDateObj->format('Ymd');

            $dbObj->query('CALL orderStaticMonth('.$date_str.')');

            $startDateObj->add($monthInterValObj);
            $interDaysObj = $startDateObj->diff($endDateObj);
            $intervalMonths = $interDaysObj->format('%R%m');
        }while($intervalMonths>=0);

    }

    /**
     * 获取不同类型的统计数据
     * @param string $type 类型，day为按日统计的类型，month是按月统计
     * @param int  $user_id 用户id
     * @param int $num 获取的记录条数
     * @return array static data
     * @throws Exception
     */
    public function getStatisticData($type,$user_id=0,$num=7){
        //根据类型和用户id获取查询条件
        $currDate = new \DateTime();
        $data = array();
        if($type=='day'){
            $currDate->modify('-1 day');

            //获取过去几天的统计
            $data = $this->dateIntervalStaticData($user_id,$currDate->format('Y-m-d'),$num);
            //获取当天的统计
            $data[date('Y-m-d')] = $this->todayStaticData($user_id);
            foreach($data as &$val){
                if(!empty($val)){
                    $val['week'] = date('N',strtotime($val['date']));
                }

            }
        }
        elseif($type=='month'){
            $currDate->modify('-1 month');
            //获取过去几个月的统计
            $data = $this->monthIntervalStaticData($user_id,$currDate->format('Y-m-d'),$num);
            //获取当前月的统计
            $data[date('Y-m')] = $this->currMonthStaticData($user_id);
            foreach($data as &$val){
                $val['month'] = date('n',strtotime(substr($val['date'],0,-2).'01'));
            }
        }
        return $data;

    }

    /**
     * 获取从endDate（包括）开始往前数days天的统计数据
     * @param int $user_id
     * @param string $endDate
     * @param int $days
     * @return mixed
     */
    private function dateIntervalStaticData($user_id=0,$endDate='',$days=1){
            $dbObj = new M('static_order');
            $dateObj = new \DateTime($endDate);
            $date_arr = array();
            $days = intval($days);
            while($days>0){
                array_unshift($date_arr,$dateObj->format('Y-m-d'));
                $dateObj->modify('-1 day');
                $days--;
            }
            $where = array('user_id'=>$user_id,'date'=>array('in',join(',',$date_arr)));
            $data = $dbObj->where($where)->order('date asc')->select();
            foreach($data as $key=>$val){
                $data[$val['date']] = $val;
                unset($data[$key]);
            }
            $resData = array();
            foreach($date_arr as $val){
                $resData[$val] = isset($data[$val]) ? $data[$val] : array('date'=>$val,'user_id'=>$user_id,'num'=>0,'amount'=>0);
            }
        return $resData;
    }

    /**
     * 获取从endMonth月（包括）向前数months个月的统计数据
     * @param int $user_id
     * @param string $endMonth
     * @param int $months
     * @return mixed
     */
    private function monthIntervalStaticData($user_id=0,$endMonth='',$months=1){
        $dbObj = new M('static_order');
        $startDate = new \DateTime($endMonth);
        $date_arr = array();
        while($months>0){
            array_unshift($date_arr,$startDate->format('Y-m').'-99') ;
            $startDate->modify('-1 month');
            $months--;
        }
        $where = array('user_id'=>$user_id,'date'=>array('in',join(',',$date_arr)));
        $data = $dbObj->where($where)->order('date asc')->select();
        foreach($data as $key=>$val){
            $data[substr($val['date'],0,-3)] = $val;
            unset($data[$key]);
        }
        $resData = array();
        foreach($date_arr as $val){
            $temp = substr($val,0,-3);
            $resData[$temp] = isset($data[$temp]) ? $data[$temp] : array('date'=>$val,'user_id'=>$user_id,'num'=>0,'amount'=>0);
        }
        return $resData;
    }

    /**
     * 当月的统计等于从当月1日到昨天的统计数据，再加上今天的数据
     * @param string $user_id
     */
    public function currMonthStaticData($user_id=0){
       $dateObj = new \DateTime();
       $currDay = intval($dateObj->format('d'));
       $data = array();
       $data['user_id'] = $user_id;
       $data['num'] = 0;
       $data['amount'] = 0;
       $data['date'] = $dateObj->format('Y-m-').'99';
       $res = array();
       if($currDay>1){
           $dateObj->modify('-1 day');
           $res = $this->dateIntervalStaticData($user_id,$dateObj->format('Y-m-d'),$currDay-1);
       }
        $res[] = $this->todayStaticData($user_id);
       foreach($res as &$val){
           $data['num'] += $val['num'];
           $data['amount'] += $val['amount'];
       }

       return $data;
    }

    /**
     * 获取当天的统计数据，从订单表查询
     * @param int $user_id
     * @return mixed
     */
    private function todayStaticData($user_id=0){
        $orderObj = new M('order_sell');
        $where = 'left(create_time,10)="'.date('Y-m-d').'"';
        if($user_id!=''){
            $where .= ' AND offer_user_id='.$user_id;
        }
        $data = $orderObj->where($where)->fields('sum(num) as num,sum(amount) as amount')->getObj();
        $data['user_id']=$user_id;
        $data['date'] = date('Y-m-d');
        $data['num'] = $data['num']==null ? 0 : $data['num'];
        $data['amount'] = $data['amount']==null ? 0 : $data['amount'];
        return $data;
    }

    public function getOfferStatisticData($user_id=0,$pro_name='',$status=0,$start_time='',$end_time=''){
        $where = array();
        $where['type'] = 1;
        if($user_id>0){
            $where['user_id'] = $user_id;
        }
        if($pro_name!=''){
            $where['pro_name'] = $pro_name;
        }

        if($start_time!=''){
            $where['_string'] = ' apply_time > "'.$start_time.'"';
        }
        if($end_time!=''){
            $where['_string'] .= ' AND apply_time <"'.$end_time.'"';
        }

        $offerObj = new M('product_offer');
        $res = $offerObj->where($where)->fields('count(id) as total_times,sum(max_num) as total_num,
        sum(sell_num) as complate_num,sum(max_num*price) as total_money,sum(sell_num*price) as complate_money')->
            getObj();
        $where['status'] = 6;
        $res1 = $offerObj->where($where)->fields('count(id) as complate_times')->getObj();//已成交的报盘数
        $res = array_merge($res,$res1);

        if($status!=0){
            $where['status'] = 6;//6是报盘已成交状态
        }
        else{
            $where['status'] = array('neq',6);
        }

        //获取报盘数据
        $offerObj->table('product_offer');
        $data = $offerObj->where($where)->fields('id,user_id,pro_name,max_num,price,status')->select();
        $resData = array();
        if(!empty($data)){
            $user_ids = array();
            foreach($data as $key=>$val){
                if(!in_array($val['user_id'],$user_ids)){
                    $user_ids[] = $val['user_id'];
                }
                $data[$key]['status_text'] = $val['status']==6 ? '已成交' : '未成交';
            }
            //获取用户数据
            $userObj = new M('user');
            $userData = $userObj->where('id in ('.join(',',$user_ids).')')->fields('id,username,true_name')->select();
            $user = array();

            foreach($userData as $val){
                $user[$val['id']] = array();
                $user[$val['id']]['username'] = $val['username'];
                $user[$val['id']]['true_name'] = $val['true_name'];
            }
            unset($userData);
            foreach($data as $key=>&$val){

                if(isset($user[$val['user_id']])){
                    $val = array_merge($val,$user[$val['user_id']]);
                }
                else{
                    $val = array_merge($val,array('username'=>'','true_name'=>''));
                }
                $resData[intval($key/20)+1][] = $val;

            }
        }
        //$res是报盘统计数据，$data是具体报盘列表
        return array('chart'=>$res,'offerlist'=>$resData);

    }

}
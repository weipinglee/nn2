<?php
/**
 * 用户中心首页
 * User: weipinglee
 * Date: 2016/5/18 0004
 * Time: 上午 9:35
 */
class UcenterIndexController extends UcenterBaseController {


    /**
     * 个人中心首页
     */
    public function indexAction(){

        // $a = new \nainai\fund\zx();
        // $res = $a->freezeRelease(53,0.1,'2016000003752');
        // $res = $a->freezeTrans(53,'20160727');
        // // $res = $a->attachBalance(array('no'=>'3110710003081042796'));
        // // $res = $a->acountInit(53,2000,'测试初始化赵六2');
        // $res = $a->freeze(53,0.01);
        // echo '<pre>';var_dump($res);exit;
        // exit;

        $group = new \nainai\member();

        $groupData = $group->getUserGroup($this->user_id);//会员分组数据
        $creditGap = $group->getGroupCreditGap($this->user_id);//与更高等级的分组的差值

        $this->getView()->assign('username',$this->username);

        $this->getView()->assign('group',$groupData);
        $this->getView()->assign('creditGap',$creditGap);

        $this->getView()->assign('cert',$this->cert);

        //获取代理账户金额
        $fundObj = \nainai\fund::createFund(1);
        $active = $fundObj->getActive($this->user_id);
        $freeze = $fundObj->getFreeze($this->user_id);
        $total = $active + $freeze;
        $this->getView()->assign('count',$total);

        //获取销售合同
        $order = new \nainai\order\Order();
        $where = array();
        $list = $order->sellerContractList($this->user_id,1,$where);

        if(isset($list['data'][0]))
            $contract1 = $list['data'][0];
        else $contract1 = array();
        $this->getView()->assign('contract1',$contract1);

        //获取购买合同
        $list = $order->buyerContractList($this->user_id,1,$where);

        if(isset($list['data'][0]))
            $contract2 = $list['data'][0];
        else $contract2 = array();

        $this->getView()->assign('contract2',$contract2);


    }






}
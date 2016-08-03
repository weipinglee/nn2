<?php
/**
 * 用户中心首页
 * User: weipinglee
 * Date: 2016/5/18 0004
 * Time: 上午 9:35
 */
use \nainai\fund\zx;
class UcenterIndexController extends UcenterBaseController {


    /**
     * 个人中心首页
     */
    public function indexAction(){
        // error_reporting(E_ALL);
        // $a = new zx();
        // $res = $a->bankTransfer('0.01','53',0,'freeze');
        // $res = $a->attachBalance('3110710003081042640');
        // $res = $a->acountInit('3110710003081042640','赵六','100.00');
        
        // $res = $a->geneAttachAccount(array('name'=>'王五','contact_name'=>'王五','contact_phone'=>'18623252212','mail_address'=>'2132132@qq.com','id_card'=>'210522199092281128','user_id'=>54));//$this->user_id));
        // $aa = (array)$res['list'];
        // $bb = (array)$aa['row'];

        // echo '<pre>';var_dump($res);exit;

       // $groupData = $group->getUserGroup($this->user_id);//会员分组数据
        //$creditGap = $group->getGroupCreditGap($this->user_id);//与更高等级的分组的差值

        $this->getView()->assign('username',$this->username);

        //$this->getView()->assign('group',$groupData);
        //$this->getView()->assign('creditGap',$creditGap);

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
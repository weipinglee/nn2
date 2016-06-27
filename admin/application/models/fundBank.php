<?php
/**
 * 用户开户信息管理
 * author: weipinglee
 * Date: 2016/6/21 0005
 * Time: 下午
 */

use \Library\M;
use \Library\Query;
use \nainai\fund;
use \Library\tool;
class fundBankModel extends \nainai\user\UserBank{

    public function getBankList($page,$where){
        $reModel = new Query($this->table.' as b');
        //线上
        $reModel->join = 'left join user as u on b.user_id = u.id';
        $reModel->where = $where;
        $reModel->page = $page;
        $onlineInfo = $reModel->find();
        $reBar = $reModel->getPageBar();
        return array($onlineInfo,$reBar);
    }

    /**
     * 获取开户详情和企业/个人信息
     * @param $user_id
     * @return array
     */
    public function getBankDetail($user_id){
        $bankObj = new M($this->table);
        $bankData = $bankObj->where(array('user_id'=>$user_id))->getObj();
        $bankData['thumb'] = \Library\thumb::get($bankData['proof'],300,200);
        $bankData['status_text'] = self::$status_text[$bankData['status']];
        $bankData['card_type_text'] = $this->getCardType()[$bankData['card_type']];
        if(!empty($bankData)){
            $userObj = new \nainai\member();
            $userData = $userObj->getUserDetail($bankData['user_id']);
            return array($bankData,$userData);
        }

        return array();
    }

    /**
     * 开户审核
     * @param $user_id
     * @param $status
     */
    public function bankVerify($user_id,$status){
        $log = new \Library\log();
        $bankObj = new M($this->table);
        $data = $bankObj->where(array('user_id'=>$user_id))->getObj();
        $updateData = array();
        if(!empty($data)){
            $bankObj->beginTrans();
            $admin_data = \Library\session::get('admin');
            $updateData['check_admin'] = $admin_data['id'];
            $updateData['check_time'] = \Library\time::getDateTime();
            if($status==1){
                $updateData['status'] = self::BANK_OK;
            }
            else{
                $updateData['status'] = self::BANK_NG;
            }
            $bankObj->data($updateData)->where(array('user_id'=>$user_id))->update();
            $log->addLog(array('type'=>'check','check_text'=>self::$status_text[$updateData['status']],'id'=>$user_id,'pk'=>'user_id','table'=>$this->table));
            $res = $bankObj->commit();
            if($res){
                return tool::getSuccInfo();
            }

            return tool::getSuccInfo(0,'操作失败');
        }
        return tool::getSuccInfo(0,'开户信息不存在');
    }

}
<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/15
 * Time: 12:00
 */
use \nainai\oldData;
use \Library\M;
class DaoruController extends \Yaf\Controller_Abstract
{

    /**
     * get oracle and mysql database tb_cus_firm table data
     */
    public function getDataAction(){
        $model = new M('user');
        $model->beginTrans();
       $this->createOracleData(1);//生成基本的user表
        $this->getMysqlData();//mysql数据表写进去
        $this->createOracleData(2); //更新oracle的数据


        $res = $model->commit();
        if($res){
            echo 'ok';
        }
        else{
            echo 'ng';
        }




    }

    /**
     * 生产账户余额
     */
    public function createAccDataAction(){
        //获取账户金额
        $rijieObj = new M('tb_cus_account_his');
        $accObj = new M('user_account');
        $accData = $rijieObj->select();
        $accObj->beginTrans();
        foreach($accData as $key=>$val){
            if($val['ACCOUNT_TYPE']=='F1' && $val['CURRENCY_TYPE']=='A'){//现金人民币的账户
                $data = array('fund'=>$val['CANOUT_MONEY'],'freeze'=>$val['CUR_FREEZE']);
                $where = array('user_id'=>$val['CUSTOMER_KEY']);

            }
            elseif($val['ACCOUNT_TYPE']=='F5' && $val['CURRENCY_TYPE']=='A'){//票据账户 人民币
                $data = array('ticket'=>$val['CANOUT_MONEY'],'ticket_freeze'=>$val['CUR_FREEZE']);
                $where = array('user_id'=>$val['CUSTOMER_KEY']);
            }
            $accObj->where($where)->data($data)->update();

        }
        $res = $accObj->commit();
        if($res){
            echo 'ok';
        }
        else echo 'ng';

    }

    /**
     * 生成代理账户流水
     */
    public function createFlowAction(){
        $flow = new M('user_fund_flow');
        $flow_old = new M('tb_fnd_dtl_his');

        $flowData = $flow_old->order('time asc')->select();
        $flow_old->beginTrans();

        foreach($flowData as $key=>$val){
            $user_id = $val['CUSTOMER_KEY'];
            $newData = array(
                'user_id'=>$user_id,
                'acc_type'=>1,
                'time' => $val['time'],
                'note' => $val['FND_DTL'],
                'flow_no'=>$val['FND_DTL_KEY']

            );

            $lastFlow = $flow->where(array('user_id'=>$user_id))->order('id DESC')->getObj();
            if(empty($lastFlow)){
                $newData['total'] = 0;
                $newData['active'] = 0;
            }
            else{
                $newData['total'] = $lastFlow['total'];
                $newData['active'] = $lastFlow['active'];
            }

            switch($val['SUBJECT_ID']){
                case 'A001':
                case 'C001':
                case 'D002'://入金
                        $newData['fund_in'] = $val['FUND_MONEY'];
                        $newData['active'] += $val['FUND_MONEY'];
                        $newData['total'] += $val['FUND_MONEY'];
                    break;
                case 'A002':
                case 'C002':
                case 'D001':
                case 'D003'://非冻结出金
                $newData['fund_out'] = $val['FUND_MONEY'];
                        $newData['active'] -= $val['FUND_MONEY'];
                        $newData['total'] -= $val['FUND_MONEY'];
                    break;
                case 'E002':
                case 'E003'://冻结
                        $newData['freeze'] = $val['FUND_MONEY'];
                        $newData['active'] -= $val['FUND_MONEY'];
                break;
                case 'F002':
                case 'F003'://释放冻结
                $newData['freeze'] = -$val['FUND_MONEY'];
                $newData['active'] += $val['FUND_MONEY'];
                break;

            }
            $flow->data($newData)->add();


        }
        if($flow_old->commit()){
            echo 'ok';
        }
        else echo 'ng';
    }

    /**
     * 生成出入金数据
     */
    public function createChuruAction(){
        $ru = new M('recharge_order');
        $chu = new M('withdraw_request');
        $churuOld = new M('tb_fnd_mkt_iao');
        $data = $churuOld->select();
        $churuOld->beginTrans();
        foreach($data as $k=>$v){
            if($v['SUBJECT_ID']=='A001'){//入金
                $addData = array(
                    'user_id'=>$v['CUSTOMER_KEY'],
                    'order_no'=>$v['MKT_IAO_ID'],
                    'amount' => $v['OCR_MONEY'],
                    'pay_type' => 1,
                    'create_time' => $this->getTime($v['ADD_TIME']),
                    'first_time' => $this->getTime($v['LAB_TIME']),
                    'first_message'=>$v['LAB_MSG'],
                    'final_time' => $this->getTime($v['CHK_TIME']),

                );
                $addData['status'] = $v['CUR_STA'] == 'B' ?  3 : 1;
                $ru->data($addData)->add();
            }
            elseif($v['SUBJECT_ID']=='A002'){//出金
                $addData = array(
                    'user_id'=>$v['CUSTOMER_KEY'],
                    'request_no'=>$v['MKT_IAO_ID'],
                    'amount' => $v['OCR_MONEY'],
                    'note'   => $v['note'],
                    'create_time' => $this->getTime($v['ADD_TIME']),
                    'first_time' => $this->getTime($v['LAB_TIME']),
                    'first_message'=>$v['LAB_MSG'],
                    'final_time' => $this->getTime($v['CHK_TIME']),

                );
                $addData['status'] = $v['CUR_STA'] == 'B' ?  3 : 1;
                $chu->data($addData)->add();
            }

        }
        if($churuOld->commit()){
            echo 'ok';
        }
        else
            echo 'ng';

    }

    /**
     * @param $type int 1:生成基本数据，2：更新tb_cus_firm的数据
     */
    public function createOracleData($type){
        $dataModel = new \nainai\oldData();
        $string = $dataModel->getData();
        $data_arr = explode(');',$string);
        $fields = explode(', ','CUSTOMER_KEY, MARKET_KEY, CONT_MARKET_KEY, CUSTOMER_ID, CUSTOMER_NAME, CUSTOMER_CUTNAME, ACCOUNT_PASSWD, PRINT_ACC_STATUS, PRINT_STATUS, IS_DELETE, CUSTOMER_STATUS, CREDIT_GRADE, TRADE_PERIOD, TRADE_MAXNUM, PACT_NUM, REGISTER_DATE, LAST_LOGIN_DATE, LAST_LOGIN_TIME, CERTIFICATE_VALID_DATE, CERTIFICATE_ANNUL_DATE, MARKET_VALID_DATE, MARKET_ANNUL_DATE, MARKET_CHECK_TYPE, COMPANY_KIND, CERTIFICATE, REGISTER_ADDRESS, CUSTOMER_SEX, OPEN_BANK_NAME, OPEN_BANK_NUMBER, LEGAL_MAN_NAME, LEGAL_MAN_IDENTITY, LEGAL_MAN_PHONE, LEGAL_MAN_MOBILE, LEGAL_MAN_FAX, LEGAL_MAN_EMAIL, TRADE_MAN_NAME, TRADE_MAN_IDENTITY, TRADE_MAN_PHONE, TRADE_MAN_MOBILE, TRADE_MAN_EMAIL, FAX, PROVINCE_AREA_KEY, CITY_AREA_KEY, COUNTY_AREA_KEY, COMMUNICATE_ADDRESS, ZIP_CODE, BUSINESS_RANGE, NO_TRADE_TYPE, NO_TRADE_BED, HAND_INFO, ONLINE_MARK, ONLINE_IP, SESSIONID, CERTIFICATE_CODE, BUS_ADMIN_NAME, ENROLL_MONEY, PROPERTY_SCALE, DEVELOP_STAGE, CUS_TRADE_KIND, COMPANY_REG_DATE, COMPANY_TYPE, ORDER_NUM, IS_BID_PUBLISH, IS_BID_PARTAKE, IS_REC_SMS, KF_CUSTOMER_KEY, CUS_RANK_NUM, TRADE_RANK_NUM, FINANCE_RANK_NUM, CREDIT_RANK_NUM, QQ, BORNDATE, WEB_USERID, JOIN_TYPE, CUS_NOTE_GROUP, IS_RET_MONEY, MY_ROLE, SELF_CARS_NUM, CAR_ID, CONTROL_CARS_NUM, MAIN_CAR_TYPE, RIPE_LINE, DPT_KEY, DPT_NAMES, BANK_NO, OPEN_ACCOUNT_BANK, AUTHENTICATE_STA, REC_NAME, REC_ADDRESS, REC_TEL, PICTURE1, PICTURE2, PICTURE3, BACK_CAUSE, TAXPAYER_NUM, IS_INTERIOR, OPEN_BANK_USERNAME, SIGN_CARD_TYPE, SIGN_CARD_NUM, USER_TYPE, PLACE_AREA, CUSTOMER_NAME_SPELL, ENTERPRISE_BRIEF, OFFICE_WORK_PHONE, PROFESSION, OFFICE_WORK_ADDRESS, OFFICE_WORK_MOBILE, PICTURE0, TAX_REG_CERTIFICATE, ENTERPRISE_WEB_URL');
        $userObj = new M('user');
        $dealObj = new M('dealer');

        array_pop($data_arr);
        foreach($data_arr as $key=>$val){
            $data_arr[$key] = preg_replace('/[\s\S]*insert into [\s\S]*values \(/','',$val);

            $data_arr[$key] = preg_replace('/to_date[\s\S]*ss\\\'\)/','',$data_arr[$key]);
            $temp = explode(', ',$data_arr[$key]);
            $temp1 = array();
            foreach($temp as $k=>$v){
                $temp1[$fields[$k]] = str_replace('\'','',$v);
            }

            if($type==1){
                $this->createUser($temp1,$userObj);
                $this->createCert($temp1,$dealObj);
            }
            elseif($type==2){
                $this->updateTbCus($temp1,$userObj);

            }

        }

    }

    /**
     * 更新个人用户身份证图片
     */
    public function updatePersonAction(){
        $obj = new \Library\Query('ask_identity_certificate as a');
        $obj->join = 'left join csm_member as m on a.MEMBERID = m.USERCODE
                          left join user as u on m.TRADECODE = u.user_no ';
        $obj->where = 'u.type = 0 and a.IDCARDFRONT != "null" and a.IDCARDFRONT != ""';
        $obj->fields = 'u.id,u.type,a.idcardfront,a.idcardback';
        $data = $obj->find();

        $model = new M('person_info');
        $model->beginTrans();
        foreach($data as $key=>$val){
            $model->data(array('identify_front'=>'upload/zhengda/'.$data[$key]['idcardfront'].'@user','identify_back'=>'upload/zhengda/'.$data[$key]['idcardback'].'@user'))
                ->where(array('user_id'=>$data[$key]['id']))->update();

        }
        $model->commit();

    }
    /**
     * 生成 初始化的user表数据
     * @param array tb_cus_firm的一条数据
     */
    public function createUser($arr,$user){
        if(!empty($arr)){
            $data = array('id'=>$arr['CUSTOMER_KEY'],'username'=>$arr['CUSTOMER_CUTNAME'],'user_no'=>$arr['CUSTOMER_ID']);
            $user->data($data)->add();



        }
    }
    //生成认证交易商的数据
    public function createCert($arr,$deal){
        if(!empty($arr)){
            if($arr['AUTHENTICATE_STA']=='N'){//N代表申请待审核
                $status  = 1;
            }
            elseif($arr['AUTHENTICATE_STA']=='B'){//被驳回
                $status  = 3;
            }
            elseif($arr['AUTHENTICATE_STA']=='Y'){
                $status  = 2;
            }
            else{
                return false;
            }

            $data = array('user_id'=>$arr['CUSTOMER_KEY'],'status'=>$status,'message'=>$arr['BACK_CAUSE']);
            $deal->data($data)->add();
        }
    }

    /**
     * 更新企业数据
     * @param array tb_cus_firm的一条数据
     */
    public function updateTbCus($arr,$user){
        if(!empty($arr)){
            $user->table('company_info');
            $companyData = array(
                'legal_person'=>$arr['LEGAL_MAN_NAME'],
                'cert_oc' => $arr['PICTURE1']!='null' ? 'upload/zhengda/upload'.$arr['PICTURE1'].'@user' : '',
                'cert_bl' => $arr['PICTURE1']!='null' ? 'upload/zhengda/upload'.$arr['PICTURE2'].'@user' : '',
                'cert_tax' => $arr['PICTURE1']!='null' ? 'upload/zhengda/upload'.$arr['PICTURE3'].'@user' : '',
            );
            $user->data($companyData)->where(array('user_id'=>$arr['CUSTOMER_KEY']))->update();

            $bankData = array(
                'bank_name' => $arr['OPEN_ACCOUNT_BANK'],
                'card_no'   => $arr['BANK_NO'],
                'status'   => 0,
            );

            $user->table('user_bank')->data($bankData)->where(array('user_id'=>$arr['CUSTOMER_KEY']))->update();

            $invioceData = array(
                'tax_no' => $arr['TAXPAYER_NUM'],
                'phone'  => $arr['REC_TEL'],
                'bank_name'  => $arr['OPEN_ACCOUNT_BANK'],
                'bank_no'  => $arr['BANK_NO'],

            );

            $user->table('user_invoice')->data($invioceData)->where(array('user_id'=>$arr['CUSTOMER_KEY']))->update();

        }
    }



    /**
     * get mysql database csm_member table data
     */
    public function getMysqlData(){
        $obj = new \Library\M('csm_member');
        $data = $obj->limit(2000)->select();
        $userObj = new M('user');
        $companyObj = new M('company_info');
        $personObj = new M('person_info');
        $bankObj = new M('user_bank');
        $invoiceObj = new M('user_invoice');
        $accountObj = new M('user_account');
       // print_r($data);exit;

        foreach($data as $key=>$val){
            $user_id = $userObj->where(array('user_no'=>$data[$key]['TRADECODE']))->getField('id');

            if(!$user_id)
                continue;
            $userUpdate = array(
                'mobile'=> $data[$key]['MOBILE'],
                'email' => $data[$key]['EMAIL'],
                'create_time' => $data[$key]['REGTIME'],
                'password' => $data[$key]['PASSWORD'],

            );
            $userUpdate['type'] = $data[$key]['MEBERTYPE']==2 ? 0 : 1;
            $userObj->where(array('id'=>$user_id))->data($userUpdate)->update();


            $accountObj->data(array('user_id'=>$user_id))->add();
            $bankObj->data(array('user_id'=>$user_id,'card_type'=>1))->add();
            $invoiceObj->data(array('user_id'=>$user_id,'address'=>$data[$key]['address']))->add();
            if($data[$key]['MEBERTYPE']==2){//个人
                $personData = array(
                    'user_id'=>$user_id,
                    'true_name'=>$data[$key]['USERNAME'],
                    'address' => $data[$key]['ADDRESS'],
                    'identify_no' => $data[$key]['CARDID'],
                    'qq' => $data[$key]['QQ'],
                    'sex' => $data[$key]['SEX']

                );
                $personObj->data($personData)->add();
            }
            else{
                $companyData = array(
                    'user_id'=>$user_id,
                    'address' => $data[$key]['ADDRESS'],
                    'company_name' => $data[$key]['COMPANYNAME'],
                    'business' => $data[$key]['FAREPZ'],
                    'contact' =>$data[$key]['LINKMAN'],
                    'contact_phone' => $data[$key]['COMPANYLINKTEL'],

                );
                $companyObj->data($companyData)->add();
            }
        }

    }


    public function clearDataAction(){
        $model = new M('user');
        $model->beginTrans();

        $model->query('truncate table user');
        $model->query('truncate table company_info');
        $model->query('truncate table person_info');
        $model->query('truncate table user_account');
        $model->query('truncate table user_bank');
        $model->query('truncate table user_invoice');

        if($model->commit()){
            echo 'ok';
        }
        else echo 'ng';

    }

    /**
     * 更新tb_fnd_dl_his的时间形式
     * @return string
     */
    public function updateFndHisAction(){
        $obj = new M('tb_fnd_dtl_his');
        $data = $obj->select();
        $obj->beginTrans();
        foreach($data as $k=>$v){
            $format = $this->getTime($v['OPER_TIME']);
            $obj->where(array('FND_DTL_KEY'=>$v['FND_DTL_KEY']))->data(array('time'=>$format))->update();
        }

        if($obj->commit())
            echo 'ok';
        else echo 'ng';
    }

    /**
     * 28-2月 -16 12.30.53.000000 下午 这样的时间转换格式
     * @param $time
     * @return string
     */
    protected function getTime($time){
        $y = '20'.mb_substr($time,9,2);
        $m = mb_substr($time,3,1);
        $d = mb_substr($time,0,2);
        $h = intval(mb_substr($time,12,2));
        $min = mb_substr($time,15,2);
        $sen = mb_substr($time,18,2);
        $shangwu = mb_substr($time,28,6);
        if($shangwu=='下午'){
            if($h!=12) $h = $h +12;
        }

        $format = $y.'-'.$m.'-'.$d.' '.$h.':'.$min.':'.$sen;
        return $format;
    }


}
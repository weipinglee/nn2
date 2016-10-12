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
     * get oracle database tb_cus_firm table data
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


}
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
        $model->query('truncate table dealer');
        $model->query('truncate table company_info');
        $model->query('truncate table person_info');
        $model->query('truncate table user_account');
        $model->query('truncate table user_bank');
        $model->query('truncate table user_invoice');
        $model->query('truncate table withdraw_request');
        $model->query('truncate table recharge_order');
        $model->query('truncate table user_fund_flow');
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
    protected function getTime($time,$type='1'){
        $y = '20'.mb_substr($time,9,2);
        $pos = mb_substr($time,5,3);
        if($pos=='月')
            $m = mb_substr($time,3,2);
        else $m = mb_substr($time,3,1);
        $d = mb_substr($time,0,2);
        $h = intval(mb_substr($time,12,2));
        $min = mb_substr($time,15,2);
        $sen = mb_substr($time,18,2);
        $shangwu = mb_substr($time,28,6);
        if($shangwu=='下午'){
            if($h!=12) $h = $h +12;
        }

        $format = $y.'-'.$m.'-'.$d.' '.$h.':'.$min.':'.$sen;
		if($type==2)
			$format = $y.'-'.$m.'-'.$d;
        return $format;
    }
	
	//生成报盘数据
	public function createBaopanAction(){
		$product = new M('tb_con_obj');
		$productObj = new M('products');
			$offerObj = new M('product_offer');
		$data = $product->select();
		//print_r($data);exit;
		//新旧状态对应关系
		$sta = array(
				'A'=> 0,
				'B' => 0,
				'C' => 1,
				'E' => 4,
				'F' => 4
				
		);
		
		//记重方式
		$weightType = array(
				'A'=> '过磅',
				'B' => '轨道衡',
				'C' => '吃水',
				'D' => '理论记值'
		);
		$productObj->beginTrans();
		foreach($data as $key=>$val){
			$proData = array();
			$offerData = array();
			if($val['bail_type']=='B'){//保证金报盘
				$proData = array(//商品数据
							'id'=>$val['conobj_key'],
							'user_id'=> $val['customer_key'],
							'unit' => $val['num_unit'],
							'currency' => 1,
							'quantity' => $val['goods_num'],
							'sell' => $val['contrade_num'],
							'create_time' => $val['apply_time'] == NULL ? $val['add_time'] : $val['apply_time'],
							'note' => $val['quality_standard'],
							'name' => $val['pinzhong']
							
				);
				
				$offerData = array(
							'user_id'=> $val['customer_key'],
							'type' => substr($val['conobj_id'],0,2) == 'GP' ? 1 : 2 ,
							'mode' => 2,
							'product_id' => $val['conobj_key'],
							'price' => substr($val['conobj_id'],0,2) == 'GP' ? $val['order_price'] : 0,
							'price_l' => substr($val['conobj_id'],0,2) == 'DG' ? $val['order_price'] : 0,
							'divide' => $val['is_numsplit']=='Y' ? 1 : 0,
							'minimum' => $val['min_obj_num'],
							'minstep' => $val['min_obj_num_range'],
							'accept_day' => $val['end_tran_date'],
							'status' => isset($sta[$val['conobj_status']]) ? $sta[$val['conobj_status']] : 0,
							'is_del' => $val['conobj_status']=='F' ? 1 : 0,
							'apply_time' =>$val['apply_time'] == NULL ? $val['add_time'] : $val['apply_time'],
							'expire_time' => $this->getTime($val['limit_date'],2),
							'finish_time' => $val['check_time'],
							'admin_msg' => $val['back_cause'],
							'other' => $val['conobj_comment'],
							'weight_type' => $weightType[$val['weight_type']],
							
							
							
							
				);
				
				if($val['is_appoint']=='N'){//非指定仓库
					$offerData['accept_area'] = $val['obj_address']=='无' ? '' : $val['obj_address'];
					$offerData['accept_area'] .= $val['obj_dpt_name']=='无' ? '' : $val['obj_dpt_name'];
				}
				else{//指定仓库，还需找到仓库表
					
				}
				if($val['is_back']=='Y'){
					$offerData['status'] = 2;
				}
				$productObj->data($proData)->add();
				$offerObj->data($offerData)->add();
				
				
				
				
				
			}
			
		}
		if($productObj->commit()){
			echo 'ok';
		}
		else echo 'ng';
	}
	
	/**
	*生成报盘图片
	*/
	public function createOfferPicAction(){
		$picObj = new M('tb_bas_affix');
		$proObj = new M('products');
		$photoObj = new M('product_photos');
		$picData = $picObj->where(array('table_name'=>'TB_CON_OBJ'))->select();
		$proObj->beginTrans();
		foreach($picData as $key=>$val){
			$product_id = $val['table_key'];
			$picUrl = 'upload/zhengda/upload'.$val['affix_path'].'@user';
			$img = $proObj->where(array('id'=>$product_id))->getField('img');
			if($img==''){
				$proObj->data(array('img'=>$picUrl))->update();
			
			}
			$photoObj->data(array('products_id'=>$product_id,'img'=>$picUrl))->add();
			
		}
		if($proObj->commit()){
			echo 'ok';
		}
		else echo 'ng';
	}
	
	
	/**
	*生成报盘数据的分类数据
	*/
	public function createOfferCateAction(){
		$proObj = new M('products');
		$oldOffer = new M('tb_con_obj');
		$cateObj = new M('product_category');
		//$yiji = $cateObj->where(array('pid'=>0))->select();print_r($yiji);
		$oldData = $oldOffer->select();
		
		$proObj->beginTrans();
		foreach($oldData as $key=>$val){
			$cateOld = $val['spmc'];
			$conobj_key = $val['conobj_key'];
			$newProduct = $proObj->where(array('id'=>$conobj_key))->getObj();
			if(!empty($newProduct)){
				$cateOld = explode('/',$cateOld);
				
				$firstID = $cateObj->where(array('name'=>$cateOld[0],'pid'=>0,'status'=>1,'is_del'=>0))->getField('id');//顶级分类的id
				
				if($firstID){
					$secondID = $cateObj->where(array('pid'=>$firstID,'name'=>$cateOld[1]))->getField('id');
					
					if($secondID){
						$thirdID = $this->getChildCate($secondID,$cateOld[2]);
						
						if($thirdID){
							$newCateId = $thirdID;
						}
						else{
							$newCateId = $secondID;
						}
					}
					else{
						$newCateId = $firstID;
					}
					
					
				}
				else{
					$newCateId = 0;
				}
				
		
				$proObj->where(array('id'=>$conobj_key))->data(array('cate_id'=>$newCateId))->update();
			}
		}
		if($proObj->commit()){
			echo 'ok';
		}
		else echo 'ng';
	}
	
	 /**
     * 生成商品属性
     */
	 public function createOfferAttrAction(){
		$proObj = new M('products');
		$oldOffer = new M('tb_con_obj');
		$attrOld = new M('tb_bas_kc_spsx');
		
		$attrnew = new M('product_attribute');
		$attrNewData = $attrnew->where(array('status'=>1))->select();
		
		$attrOldData = $attrOld->select();
		$attrOldSim = array();//旧的属性数据，array(代码=>属性，代码=>属性)
		$attrNewSim = array();//新的属性数据，array(属性=>新代码，属性=>新代码)
		foreach($attrOldData as $key => $val){
			$attrTemp = str_replace('<sub>','',$val['spsx_name']);
			$attrTemp = str_replace('</sub>','',$attrTemp);
			$attrOldSim['p'.$val['spsx_key']] = $attrTemp;
			
		}
		
		foreach($attrNewData as $key=>$val){
			if(isset($attrNewSim[$val['name']]))
				continue;
			$attrNewSim[$val['name']] = $val['id'];
		}
		
		$tables = array('tb_data_001','tb_data_002','tb_data_003',
		'tb_data_005','tb_data_006','tb_data_007',
		'tb_data_001001','tb_data_001002','tb_data_001003','tb_data_001004','tb_data_001005','tb_data_001006','tb_data_001007'
		);
		$proObj->beginTrans();
		$attrDataObj = new M('tb_data_001');
		foreach($tables as $t){
			$attrDataObj->table($t);
			$attrData = $attrDataObj->select();
		
			foreach($attrData as $key=>$val){
				$proId = $val['linkkey'];
				if(empty($proObj->where(array('id'=>$proId))->getObj())){
					continue;
				}
				$attrArr = array();
				foreach($val as $k=>$v){
					if($k=='linkkey' || $k == 'linktype' || $v== NULL || $v==''){
						continue;
					}
					$attrText = $attrOldSim[$k];
					$newKey = isset($attrNewSim[$attrText]) ? $attrNewSim[$attrText] : 0;
					if($newKey==0){
						continue;
					}
					$attrArr[$newKey] = $v;
					
				}
				if(!empty($attrArr)){//print_r($attrArr);
					$attrSer = $proObj->where(array('id'=>$proId))->getField('attribute');
					if($attrSer!=''){
						$attrArr = array_merge($attrArr,unserialize($attrSer));
					}
					$proObj->data(array('attribute'=>serialize($attrArr)))->where(array('id'=>$proId))->update();
				}
			}
		}
		
		if($proObj->commit()){
			echo 'ok';
		}
		else echo 'ng';
		
	 }
	
	
	  /**
     * 获取某一个分类名为$name的下级分类，优先获取高层级的分类
     * @param array
     */
    private function getChildCate($cate_id,$name){
        $cateObj = new M('product_category');
		$cates = $cateObj->where(array('pid'=>$cate_id,'status'=>1,'is_del'=>0))->select();
		static $cateID = 0;
		foreach($cates as $key=>$val){
			if($val['name']==$name){
				$cateID = $val['id'];
				break;
			}
			else{
				$this->getChildCate($val['id'],$name);
			}
				
			
		}
	
		return $cateID;
    }
	
	//转换报盘数据表sql
	public function getBaopanSqlAction(){
		$sql = <<< OEF
		
		
OEF;
		$sql = str_replace('to_date(','str_to_date(',$sql);
		$sql = str_replace('dd-mm-yyyy hh24:mi:ss','%d-%m-%Y %H:%i:%s</br>',$sql);
		echo $sql;
	}
	
	
	




}
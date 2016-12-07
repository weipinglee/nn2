<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/15
 * Time: 12:00
 */
use \nainai\oldData;
use \Library\M;
use \Library\safe;
class DaoruController extends \Yaf\Controller_Abstract
{

    public function getZXAction(){
		if(IS_POST){
			$user_no = safe::filterPost('user_id');
			$acc_id = safe::filterPost('acc_id');
			$userObj = new M('user');
			$user_id = $userObj->where(array('user_no'=>$user_no))->getField('id');echo $user_id;
			$m = new M('user_attach');
			$res = $m->data(array('user_id'=>$user_id,'no'=>$acc_id,'bank'=>'zx'))->add();
			if($res){
				echo 'ok';
			}
			else echo 'ng';
			exit;
		}
		
	}

    /**
	*判断用户是否已注册，返回已注册的用户号等信息
	*/
	public function checkUserExistAction(){
	    $csm_member = new M('csm_member');
		$tb_cus_firm = new M('tb_cus_firm');
		
		$userObj = new M('user_new');
		$mysqlUserData = $csm_member->select();
		$oracleUserData = $tb_cus_firm->select();
		$existUserDatas = array();
		foreach($mysqlUserData as $key=>$val){
			$existUser = $userObj->where(array('mobile'=>$val['MOBILE']))->getObj();
			if(!empty($existUser)){
				$existUserDatas[] = array(
						'user_no'=>$val['TRADECODE'],
						'type' => 'mobile',
						'mobile'=>$val['MOBILE']
				);
				
			}
			$existUser = $userObj->where(array('username'=>$val['mobile']))->getObj();
			if(!empty($existUser)){
				$existUserDatas[] = array(
						'user_no'=>$val['TRADECODE'],
						'type' => 'username',
						'mobile'=>$val['MOBILE']
				);
				
			}
		}
		
		foreach($oracleUserData as $key=>$val){
			$existUser = $userObj->where(array('mobile'=>$val['customer_cutname']))->getObj();
			if(!empty($existUser)){
				$existUserDatas[] = array(
						'user_no'=>$val['customer_id'],
						'type' => 'mobile',
						'username'=>$val['customer_cutname']
				);
				
			}
			$existUser = $userObj->where(array('username'=>$val['customer_cutname']))->getObj();
			if(!empty($existUser)){
				$existUserDatas[] = array(
						'user_no'=>$val['customer_id'],
						'type' => 'username',
						'username'=>$val['customer_cutname']
				);
				
			}
		}
		
		print_r($existUserDatas);
	}
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
         $userObj = new M('user');
        $dealObj = new M('dealer');
		$userOldObj = new M('tb_cus_firm');
		$data_arr = $userOldObj->select();
        foreach($data_arr as $key=>$val){
           

            if($type==1){
                $this->createUser($val,$userObj);
                $this->createCert($val,$dealObj);
            }
            elseif($type==2){
                $this->updateTbCus($val,$userObj);

            }

        }

    }
	
	public function updateBankAction(){
		$userOldObj = new M('tb_cus_firm');
		$data_arr = $userOldObj->select();
		$bankObj = new M('user_bank');
		$bankObj->beginTrans();
        foreach($data_arr as $key=>$val){
           if($val['authenticate_sta']=='Y'){
			   $bankObj->where(array('user_id'=>$val['customer_key']))->data(array('status'=>1))->update();
		   }
			

        }
		if($bankObj->commit()){
			echo 'ok';
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
            $data = array('id'=>$arr['customer_key'],'username'=>$arr['customer_cutname'],'user_no'=>$arr['customer_id']);
            $user->data($data)->add();



        }
    }
    //生成认证交易商的数据
    public function createCert($arr,$deal){
        if(!empty($arr)){
            if($arr['authenticate_sta']=='N'){//N代表申请待审核
                $status  = 1;
            }
            elseif($arr['authenticate_sta']=='B'){//被驳回
                $status  = 3;
            }
            elseif($arr['authenticate_sta']=='Y'){
                $status  = 2;
            }
            else{
                return false;
            }

            $data = array('user_id'=>$arr['customer_key'],'status'=>$status,'message'=>$arr['back_cause']);
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
                'legal_person'=>$arr['legal_man_name'],
                'cert_oc' => $arr['picture1']!='null' ? 'upload/zhengda/upload'.$arr['picture1'].'@user' : '',
                'cert_bl' => $arr['picture1']!='null' ? 'upload/zhengda/upload'.$arr['picture2'].'@user' : '',
                'cert_tax' => $arr['picture1']!='null' ? 'upload/zhengda/upload'.$arr['picture3'].'@user' : '',
            );
            $user->data($companyData)->where(array('user_id'=>$arr['customer_key']))->update();

            $bankData = array(
                'bank_name' => $arr['open_account_bank'],
                'card_no'   => $arr['bank_no'],
                'status'   => 0,
            );

            $user->table('user_bank')->data($bankData)->where(array('user_id'=>$arr['customer_key']))->update();

            $invioceData = array(
                'tax_no' => $arr['taxpayer_num'],
                'phone'  => $arr['rec_tel'],
                'bank_name'  => $arr['open_account_bank'],
                'bank_no'  => $arr['bank_no'],

            );

            $user->table('user_invoice')->data($invioceData)->where(array('user_id'=>$arr['customer_key']))->update();

        }
    }



    /**
     * get mysql database csm_member table data
     */
    public function getMysqlData(){
        $obj = new \Library\M('csm_member');
        $data = $obj->select();
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
	
	public function testAction(){
		echo '333';
	}
	public function updateBaopanAction(){
		$product = new M('tb_con_obj');
		$productObj = new M('products');
			$offerObj = new M('product_offer');
		$data = $product->select();
		
		$product->beginTrans();
		foreach($data as $key =>$val){
			if($val['conobj_status']=='C' && substr($val['conobj_id'],0,2) == 'DG'){
				$offerObj->data(array('status'=>1))->where(array('id'=>$val['conobj_key']))->update();
			}
		}
		if($product->commit()){
			echo 'ok';
		}
		else echo 'ng';
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
							'id' => $val['conobj_key'],
							'offer_no' => $val['conobj_id'],
							'user_id'=> $val['customer_key'],
							'type' => substr($val['conobj_id'],0,2) == 'GP' ? 1 : 2 ,
							'product_id' => $val['conobj_key'],
							'price' => substr($val['conobj_id'],0,2) == 'GP' ? $val['order_price'] : 0,
							'price_r' => substr($val['conobj_id'],0,2) == 'DG' ? $val['order_price'] : 0,
							'divide' => $val['is_numsplit']=='Y' ? 1 : 0,
							'minimum' => $val['min_obj_num'],
							'minstep' => $val['min_obj_num_range'],
							'accept_day' => $val['end_tran_date'],
							'status' =>  4,//所有报盘状态改为已取消
							'is_del' => $val['conobj_status']=='F' ? 1 : 0,
							'apply_time' =>$val['apply_time'] == NULL ? $val['add_time'] : $val['apply_time'],
							'expire_time' => $this->getTime($val['limit_date'],2),
							'finish_time' => $val['check_time'],
							'admin_msg' => $val['back_cause'],
							'other' => $val['conobj_comment'],
							'weight_type' => $weightType[$val['weight_type']],
							
							
							
							
				);
				if($offerData['type']==2){
					$offerData['mode'] = 0;
				}
				else{//仓单报盘外的报盘都是保证金
					$offerData['mode'] = $val['bail_type']=='A' ? 4 : 2;
				}
				
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
	
	public function getOrderAction(){
		$orderObj = new M('tb_con_ord');
		$orderOldData = $orderObj->select();
		$offerNewObj = new M('product_offer');
		$ordeObjNew = new M('order_sell');
		$ordeObjNew->beginTrans();
		foreach($orderOldData as $key=>$val){
			$mode = $offerNewObj->where(array('id'=>$val['conobj_key']))->getField('mode');
			$pay_deposit = $val['pay_money_type'] == 'A' ? $val['should_pay_bail'] : $val['should_pay_money'];
			$data = array(
						'offer_id'=>$val['conobj_key'],
						'mode' => $mode,
						'num' => $val['order_num'],
						'amount' =>  $val['order_price'] * $val['order_num'],
						'order_no' => $val['cnt_id'],
						'user_id' =>  $val['customer_key'],
						'create_time' => $val['order_time'],
						'pay_deposit' =>$pay_deposit,
						'buyer_deposit_payment' => 1,
						'contract_status' => $val['order_status']=='C' ? 5 : 2,
						
			);
			$ordeObjNew->data($data)->add();
			
			
			
			
		}
		if($ordeObjNew->commit()){
			echo 'ok';
		}
		else{
			echo 'ng';
		}
	}
	
	//转换报盘数据表sql
	public function getInsertSqlAction(){
		$sql = <<< OEF
		
OEF;
		$sql = str_replace('to_date(','str_to_date(',$sql);
		$sql = str_replace('dd-mm-yyyy hh24:mi:ss','%d-%m-%Y %H:%i:%s</br>',$sql);
		echo $sql;
	}
	
	/**
	*创建数据表转换
	*/
	public function createTableSqlAction(){
		$sql = <<< OEF
		
OEF;
  
  $sql = str_replace('NUMBER','decimal',$sql);
  $sql = str_replace('DATE','DATETIME',$sql);
  $sql = str_replace('VARCHAR2','VARCHAR',$sql);
  $sql = str_replace('INTEGER','int(11)',$sql);
  echo $sql;
  
	}
	

	
	
	




}
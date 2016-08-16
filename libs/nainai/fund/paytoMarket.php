<?php
/**
 * 支付到市场
 * author: panduo
 * Date: 2016/8/16
 */

namespace nainai\fund;
use \Library\M;
use \Library\Time;
use \Library\tool;
use \Library\Safe;
use \Library\Query;
class paytoMarket{

	const STORE_FEE = 1;
	const OFFER_FEE = 2;

	public function __construct(){
		$this->table = new M('payto_market');
	}

	public function paytoMarket($username,$offer_type,$charge_type,$offer_id,$num,$remark='',$order_no=''){
		// $payData['username'] = Safe::filter($data['username']);
		// $payData['offer_type'] = Safe::filter($data['offer_type'],'int');
		// $payData['charge_type'] = Safe::filter($data['charge_type'],'int');
		// $payData['offer_id'] = Safe::filter($data['offer_id'],'int');
		// $payData['num'] = Safe::filter($data['num'],'floatval');
		// $payData['remark'] = Safe::filter($data['remark']);
		// $payData['order_no'] = Safe::filter($data['order_no']);
		// $payData['create_time'] = date('Y-m-d H:i:s',time());

		
		$payData['username'] = $username;
		$payData['offer_type'] = $offer_type;
		$payData['charge_type'] = $charge_type;
		$payData['offer_id'] = $offer_id;
		$payData['num'] = $num;
		$payData['remark'] = $remark;
		$payData['order_no'] = $order_no;
		$payData['create_time'] = date('Y-m-d H:i:s',time());

		$res = $this->table->data($payData)->add();
		return $res ? true : $this->table->getError();
	}

	public function paylist($page=1,$where){
		$query = new Query('payto_market as p');
		$query->page = $page;
		$where && $query->where = $where;
		$query->order = 'create_time desc';
		$res = $query->find();

		return array('data'=>$res,'page'=>$query->getPageBar());
	}

	public function detail($id){
		$res = $this->table->where(array('id'=>$id))->getObj();
		$res['charge_type_text'] = $this->getCharge($res['charge_type']);
		return $res;
	}

	public function getCharge($charge_type){
		switch ($charge_type) {
			case self::STORE_FEE:
				$txt = '仓库管理费';
				break;
			case self::OFFER_FEE:
				$txt = '报盘费用';
				break;
			default:
				$txt = '未知';
				break;
		}
		return $txt;
	}
}
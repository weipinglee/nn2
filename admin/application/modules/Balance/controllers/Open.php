<?php

use Library\Query;
use Library\Safe;
use Library\json;


class OpenController extends InitController {

	public function dayAction(){
		$model = new \nainai\system\DealSetting();

		if (IS_AJAX) {
			$type = Safe::filterPost('type');
			$detail = $model->getsetting();
			switch ($type) {
				case 'submit':
					$data = array(
 						'daily' => Safe::filterPost('nexttime'),
 						'last_daily' => Safe::filterPost('daily'),
					);

					if (empty($data['daily'])) {
						$res = \Library\Tool::getSuccInfo(0, '请选择下次日结时间！');
					}else{
						
						if (!empty($detail['daily']) && $detail['daily'] != 0 && strtotime(date('Y-m-d')) < strtotime($detail['daily'])) {
							$res = \Library\Tool::getSuccInfo(0, '今天不是日结时间，不能日结！');
							exit(json::encode($res));
						}

						if (time() < strtotime(date('Y-m-d') . $detail['end_time'])) {
							$res = \Library\Tool::getSuccInfo(0, '还没有闭市，不能日结！');
							exit(json::encode($res));
						}

						$fundObj = \nainai\fund::createFund(1);
						if (empty($data['last_daily']) || $data['last_daily'] == 0) {
							$data['last_daily'] = \Library\Time::getDateTime();
						}else{
							$data['last_daily'] .= ' ' . date('H:i:s');
						}
						//统计上次日结到这次日结的交易流水
						$condition = array('end' => $data['last_daily'], 'begin' => $detail['last_daily']);
						
						$flowData = $fundObj->getFundFlow(0, $condition);
						$fundData = array();
						foreach ($flowData as $key => $value) {
							if ( empty( $fundData[$value['user_id']] ) ){
								$fundData[$value['user_id']]['user_id'] = $value['user_id'];
								$fundData[$value['user_id']]['use_fund'] = $value['active'];
								$fundData[$value['user_id']]['create_time'] = $data['last_daily'];
								$fundData[$value['user_id']]['today_in'] = 0;
								$fundData[$value['user_id']]['today_out'] = 0;
								$fundData[$value['user_id']]['freeze_fund'] = 0;
								$fundData[$value['user_id']]['thaw_fund'] = 0;
							}

							$fundData[$value['user_id']]['today_in'] += $value['fund_in'];
							$fundData[$value['user_id']]['today_out'] += $value['fund_out'];

							if (bccomp($value['freeze'], 0) == 1) {
								$fundData[$value['user_id']]['freeze_fund'] += $value['freeze'];
							}elseif (bccomp($value['freeze'], 0) == -1) {
								$fundData[$value['user_id']]['thaw_fund'] += abs($value['freeze']);
							}
						}
						$deal = new \nainai\fund\DealTotal();
						$preData = $deal->getLastList();//获取上次日结数据
						foreach ($fundData as $key => &$value) {
							if ( ! empty($preData[$value['user_id']])) {
								//期初资金：前一个交易日的期末资金
								$value['begin_fund'] = $preData[$value['user_id']]['end_fund'];
								//期初冻结资金,前一个交易日的期末冻结资金
								$value['begin_freeze_fund'] = abs($preData[$value['user_id']]['end_freeze_fund']);
								//期末冻结资金：是指到当天交易日为止的冻结资金，获取上次统计的期末冻结资金
								$value['end_freeze_fund'] = abs($preData[$value['user_id']]['end_freeze_fund']);
							}else{
								//如果第一次统计，没有以前的数据
								$value['begin_fund'] = 0;
								$value['begin_freeze_fund'] = 0;
								$value['end_freeze_fund'] = 0;
							}
							//期末冻结资金：上次统计的期末冻结资 + 这次日结的冻结金额 - 解冻金额
							$value['end_freeze_fund'] = ($value['end_freeze_fund'] + $value['freeze_fund']) - $value['thaw_fund'];
							$value['end_fund'] = $value['use_fund'] + $value['end_freeze_fund'];
						}
						$res = $deal->addsDealTotal($fundData);
						$res = $model->updateDealSetting($data, 1);
					}
					break;
				case 'daily':
					if (time() < strtotime(date('Y-m-d') . $detail['end_time'])) {
						$res = \Library\Tool::getSuccInfo(0, '还没有闭市，不能手工开市！');
						exit(json::encode($res));
					}
					$data = array(
 						'is_operate' => 1,
 						'operate_time' => date('w')
					);
					$res = $model->updateDealSetting($data, 1);

					if ($res['success'] == 1) {
						$admin_info = admintool\admin::sessionInfo();

						$userLog=new \Library\log();
						$userLog->addLog(['action'=>'手工开市','content'=>$admin_info['name'] . '进行了手工开市']);
					}
					break;
				
				default:
					$res = \Library\Tool::getSuccInfo(0, '错误的操作！');
					break;
			}
			exit(json::encode($res));
		}

		$detail = $model->getsetting();
		$detail['weeks'] = explode(',', $detail['weeks']);
		$week = date('w');
	        	$start = strtotime(date('Y-m-d',time()).' '. $detail['start_time']);
	        	$end   = strtotime(date('Y-m-d',time()).' '.$detail['end_time']);

	        	if( ( in_array($week, $detail['weeks']) && (time() >= $start && time() <= $end) ) || $detail['is_operate'] == 1) {
		         $detail['status'] = '交易状态';
		}else{
			$detail['status'] = '闭市状态';
		}

		$date = date('Ymd', time());
		$deal = new \nainai\fund\DealTotal();
		$data = $deal->getDealTotal(array('create_time' => $date), 'id');
		if ( ! empty($data)) {
			$detail['status'] = '日结完状态';
			$detail['is_show'] = 0;
		}else{
			$detail['is_show'] = 1;
		}
		$this->getView()->assign('detail', $detail);
	}

	public function calendarAction(){
		$model = new \nainai\system\DealSetting();

		if (IS_AJAX) {
			$weeks = Safe::filterPost('weeks');
			$date = date('Y-m-d', strtotime('+1days'));

			$data = array(
				'weeks' => implode(',', $weeks),
				'start_time' => Safe::filterPost('start_time'),
				'end_time' => Safe::filterPost('end_time'),
			);
			//判断是否已经添加
			
			$info = $model->getDealSetting(array('date' => $date), 'date');
			if  ( ! empty($info) ){
				$res = $model->updateDealSetting($data, $date);
			}else{
				$info = $model->getDealSetting(array('date' => Safe::filterPost('date')), 'daily, last_daily');
				$data['daily'] = $info['daily'];
				$data['last_daily'] = $info['last_daily'];
				$data['date'] = $date;
				$res = $model->addDealSetting($data);
			}
			
			if ($res['success'] == 1) {
				$admin_info = admintool\admin::sessionInfo();

				$userLog=new \Library\log();
				$userLog->addLog(['action'=>'开闭市操作','content'=>$admin_info['name'] . '设置了开市时间为：' .$data['start_time']. '闭市时间为：' . $data['end_time']]);
			}
			exit(json::encode($res));
		}
		
		$deal = $model->getsetting();
		if (empty($deal)) {
			$deal = array(
				'date' => date('Y-m-d', time()),
				'weeks' => '1, 2, 3, 4, 5',
				'start_time' => '09:00:00',
				'end_time' => '17:30:00'
			);
			$res = $model->addDealSetting($deal);
		}

		$deal['weeks'] = explode(',', $deal['weeks']);

		$this->getView()->assign('deal', $deal);
	}
}
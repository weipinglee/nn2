<?php

use Library\Query;
use Library\Safe;
use Library\json;


class OpenController extends InitController {

	public function dayAction(){
		$model = new \nainai\system\DealSetting();

		if (IS_AJAX) {
			$type = Safe::filterPost('type');

			switch ($type) {
				case 'submit':
					$data = array(
 						'daily' => Safe::filterPost('nexttime'),
 						'last_daily' => Safe::filterPost('daily'),
					);
					if (empty($data['daily'])) {
						$res = \Library\Tool::getSuccInfo(0, '请选择下次日结时间！');
					}else{
						$res = $model->updateDealSetting($data, 1);
					}
					break;
				case 'daily':
					$data = array(
 						'is_operate' => 1,
 						'operate_time' => date('w')
					);
					$res = $model->updateDealSetting($data, 1);
					break;
				
				default:
					$res = \Library\Tool::getSuccInfo(0, '错误的操作！');
					break;
			}
			exit(json::encode($res));
		}

		$detail = $model->getDealSetting(1);
		$detail['weeks'] = explode(',', $detail['weeks']);

		$week = date('w');
	        	$start = strtotime(date('Y-m-d',time()).' '. $detail['start_time']);
	        	$end   = strtotime(date('Y-m-d',time()).' '.$detail['end_time']);

	        	if( in_array($week, $detail['weeks']) && (time() >= $start && time() <= $end)) {
		         $detail['status'] = '交易状态';
		}else{
			$detail['status'] = '闭市状态';
		}
		$this->getView()->assign('detail', $detail);
	}

	public function calendarAction(){
		$model = new \nainai\system\DealSetting();

		if (IS_AJAX) {
			$weeks = Safe::filterPost('weeks');
			$data = array(
				'weeks' => implode(',', $weeks),
				'start_time' => Safe::filterPost('start_time'),
				'end_time' => Safe::filterPost('end_time'),
			);
			$res = $model->updateDealSetting($data, 1);
			exit(json::encode($res));
		}
		
		$deal = $model->getDealSetting(1);

		$deal['weeks'] = explode(',', $deal['weeks']);

		$this->getView()->assign('deal', $deal);
	}
}
<?php

namespace nainai\fund;

use \Library\M;
use \Library\searchQuery;
use \Library\Tool;

class DealTotal extends \nainai\Abstruct\ModelAbstract{

	/**
	 * 获取那次日结的统计数据
	 * @param  date $date 日期
	 * @return array
	 */
	public function getLastList($date){
		$lists = array();
		$list = $this->model->where(array('create_time' => $date))->select();
		if ( ! empty($list)) {
			foreach ($list as $key => $value) {
				$lists[$value['user_id']] = $value;
			}
		}
		return $lists;
	}

	public function getList(){
		$Q = new searchQuery($this->tableName . ' as a');
		$Q->fields = 'a.*, u.username,u.type, b.bank_name';
		$Q->join = 'LEFT JOIN user as u ON a.user_id=u.id LEFT JOIN user_bank as b ON u.id=b.user_id';

		return $Q->find();
	}

}
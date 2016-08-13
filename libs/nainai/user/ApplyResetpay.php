<?php
namespace nainai\user;

use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\url;
use Library\searchQuery;

/**
 * 菜单操作对应的api
 * @author maoyong.zeng <zengmaoyong@126.com>
 * @copyright 2016年08月13日
 */
class ApplyResetpay extends \nainai\Abstruct\ModelAbstract {

	const APPLY = 0;
	const APPLY_OK = 1;
	const APPLY_NO = 2;

	protected $Rules = array(
	    array('mobile','require','必须输入手机号')
	);

	public function getStatusTxt($status){
		switch ($status) {
			case self::APPLY:
				return '申请';
			case self::APPLY_OK:
				return '审核通过';
			case self::APPLY_OK:
				return '审核驳回';
			default:
				return '未知';
		}
	}

	public function getList($condition=array()){
		$Q = new searchQuery($this->tableName . ' as r');
		$Q->join = ' LEFT JOIN user as u ON r.uid=u.id';
		$Q->fields = 'r.*, u.username';

		$Q->where = ' r.status IN ('. $condition['status'] .')';

		$data = $Q->find();

		foreach ($data['list'] as $key => &$value) {
			$value['status_txt'] = $this->getStatusTxt($value['status']);
		}
		return $data;
	}

}
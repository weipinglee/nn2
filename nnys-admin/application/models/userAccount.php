<?php
/**
 * 仓单管理
 * User: panduo
 * Date: 2016-06-28
 */
use \Library\Query;
use \Library\M;
use \Library\tool;
use \admintool\adminQuery;
class userAccountModel {

	/**
	 * 信誉值账户列表
	 * @param  int $page 当前页
	 * @return array   列表数组
	 */
	public function userCreditList($condition=array()){
		$query = new adminQuery('user_account as a');
		$query->join = 'left join user as u on a.user_id = u.id';
		$query->fields = 'a.*,u.username,u.user_no,u.mobile,u.create_time, a.credit,u.id';
		
		if (isset($condition['types']) && $condition['types'] == 1) {
			$query->where = 'u.type=1';
		}
		$accInfo = $query->find();
		foreach ($accInfo['list'] as $k => $v) {
			$accInfo['list'][$k]['amount'] = $v['fund']+$v['freeze'];
		}

		$query->downExcel($accInfo['list'],$condition['type']);
		return $accInfo;
	}

	/**
	 * 获取某用户信誉保证金相关详情
	 * @param  int $user_id 用户id
	 * @return array  详情数组
	 */
	public function userCreditDetail($user_id){
		$member = new \nainai\member();
		$detail = $member->getUserDetail($user_id);
		return $detail;
	}

	/**
	 * @return array
	 */
	public function userZxList($page=1){
		$query = new adminQuery('user_attach as ua');
		$query->join = 'left join user as u on ua.user_id = u.id';
		$query->fields = 'ua.*,u.username,u.user_no,u.mobile';
		$query->page = $page;
		$list = $query->find();
		return $list;
	}

	/**
	 *
	 */
	public function userZxDetail($user_id){
		if($user_id){
			$attach = new \nainai\fund\attachAccount();
			$attachData = $attach->attachInfo($user_id);

			return $attachData;
		}
		else
			return array();
	}
}

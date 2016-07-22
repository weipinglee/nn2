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
	public function userCreditList($page){
		$query = new adminQuery('user_account as a');
		$query->join = 'left join user as u on a.user_id = u.id';
		$query->fields = 'u.username,a.credit,u.mobile,u.id';
		$query->where = 'u.type=1';
		$query->page = $page;
		$query->pagesize = 20;

		$res = $query->find();
		return $res;
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
}

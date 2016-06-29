<?php
/**
 * 仓单管理
 * User: panduo
 * Date: 2016-06-28
 */
use \Library\Query;
use \Library\M;
use \Library\tool;
class userAccountModel {

	/**
	 * 信誉值账户列表
	 * @param  int $page 当前页
	 * @return array   列表数组
	 */
	public function userCreditList($page){
		$query = new Query('user_account as ua');
		$query->join = 'left join user as u on ua.user_id = u.id';
		$query->fields = 'u.username,ua.credit,u.mobile,u.id';
		$query->where = 'u.type=1';
		$query->page = $page;
		$query->pagesize = 5;

		$res = $query->find();
		return array('data'=>$res,'bar'=>$query->getPageBar());
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

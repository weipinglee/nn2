<?php
/**
 * @date 2016-3-21
 * 后台会员管理
 *
 */
use \Library\M;
use \Library\Query;
use \Library\tool;
class MemberModel{

	/**
	 *获取用户列表
     */
	public function getList($page){
		$Q = new \admintool\adminQuery('user as u');
		$Q->join = 'left join agent as a on u.agent = a.id left join admin_yewu as ye on u.yewu = ye.admin_id';
		$Q->fields = 'u.*,a.username as agent_name,ye.ser_name';
		$Q->order = 'u.id asc';
		$Q->page = $page;
		$Q->pagesize = 20;
		$data = $Q->find();
		return $data;
	}

	/**
	 *
	 * @param $offer_id
	 * @param $kefu_id
	 */
	public function addYewu($offer_id,$kefu_id){
		if($offer_id && $kefu_id){
			$mem = new M('user');
			$mem->beginTrans();
			$mem->where(array('id'=>$offer_id))->data(array('yewu'=>$kefu_id))->update();
			$log  = new \Library\log();
			$log->addLog(array('content'=>'为用户'.$offer_id.'绑定业务员'.$kefu_id));
			$res = $mem->commit();
			if($res===true){
				return tool::getSuccInfo();
			}
			return tool::getSuccInfo(0,'绑定失败');
		}
		else{
			return tool::getSuccInfo(0,'操作错误');
		}
	}

}
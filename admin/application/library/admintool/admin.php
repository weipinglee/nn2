<?php 

/**
 * 管理员常用方法
 */
namespace admintool;
use \Library\safe;
class admin{

	/**
	 * 判断是否为超级管理员
	 * @param  integer $id [description]
	 * @return boolean     [description]
	 */
	public static function is_admin($id = 0){
		$super_admin = \Library\tool::getConfig('rbac')['super_admin'];
		if($id){
			$adminModel = new \Library\M('admin');
			$name = $adminModel->where(array('id'=>$id))->getField('name');
		}else{
			$name = \Library\Session::get(\Library\tool::getConfig('rbac')['user_session'])['name'];
		}
		return $name == $super_admin ? true : false;
	}

	/**
	 * 取出当前session中的用户信息
	 * @return array
	 */
	public static function sessionInfo(){
		return \Library\Session::get(isset(\Library\tool::getConfig('rbac')['user_session']) ? \Library\tool::getConfig('rbac')['user_session'] : '');
	}

	/**
	 * 获取搜索条件
	 * @param $condArr
	 *  array(
			'time'=>'b.apply_time',
			'like' => 'u.username,b.identify_no',
			'status' => 'b.status'
		);
	 * @$query 查询的对象
	 * @param string $where 字符串条件，直接拼接
	 * @return array
	 */
	public static function getWhereCond($condArr=array(),$query=null,$where=''){
		$begin = safe::filterGet('begin');
		$end = safe::filterGet('end');
		$name = safe::filterGet('like');
		$status = safe::filterGet('status');
		$cond  = array();
		$cond['where'] =  $temp = '';$cond['bind'] = array();
		if($where)
			$cond['where'] = $where;
		if($begin && isset($condArr['time'])){
			if($cond['where']!='')
				$temp = ' AND ';
			$cond['where'] .= $temp."  {$condArr['time']} >= :begin";
			$cond['bind']['begin'] = $begin;
		}
		if($end && isset($condArr['time'])){
			if($cond['where']!='')
				$temp = ' AND ';
			$cond['where'] .= $temp." {$condArr['time']} <= :end";
			$cond['bind']['end'] = $end;
		}
		if($status && isset($condArr['status'])){
			if($cond['where']!='')
				$temp = ' AND ';
			$cond['where'] .= $temp." {$condArr['status']} = :status";
			$cond['bind']['status'] = $status;
		}
		if($name && isset($condArr['like']) && count($condArr['like'])>0){
			$like = explode(',',$condArr['like']);
			if($cond['where']!='')
				$temp = ' AND ';
			$likeWhere = '';
			foreach($like as $l){
				$likeWhere .= '  '.$l .' like :like OR ';
			}
			$likeWhere = substr($likeWhere,0,-3);
			$cond['where'] .= $temp." ( {$likeWhere} )";
			$cond['bind']['like'] = "%{$name}%";
		}

		if($query){
			$query->where = $cond['where'];
			$query->bind = $cond['bind'];
		}
		else
			return $cond;
	}

}
 ?>

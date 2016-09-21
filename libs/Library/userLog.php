<?php
/**
 * @class log
 * @brief 日志记录类
 */
namespace Library;
class userLog  extends \Library\log\baselog

{
	protected $tableName = 'user_log';

	public function getAuthor(){
		$userData = session::get('login');//获取管理员信息
		if(isset($userData['user_id'])){
			return $userData['user_id'];
		}
		return false;
	}



	public function getList($condition = array()){
	       $reModel = new searchQuery($this->tableName . ' as r');
	        //线上
	        $reModel->join = 'left join user as u on r.author = u.id';
	        $reModel->fields = 'r.*, u.username';

	        $onlineInfo = $reModel->find();

	        $reModel->downExcel($onlineInfo['list'], 'user_log', '用户操作日志');

	        return $onlineInfo;
	}



}
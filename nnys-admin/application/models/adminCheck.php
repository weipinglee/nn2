<?php
/**
 * @date 2018-5-25
 * 管理员审核通知
 *
 */

use \Library\M;
use \Library\Query;
use \Library\searchQuery;
use \Library\tool;
class adminCheckModel{

	//模型对象实例
	protected $adminObj;
	protected $table = '';
	public function __construct(){
        $this->table = 'admin_check';
		$this->adminObj = new M($this->table);

	}
	/**
	 * 管理员账户规则
	 * @var array
	 */
	protected $adminRules = array(
	);

	/**
	 * 获取管理员通知列表
	 * @param  int $page 当前页index
	 * @return array
	 */
	public function getList($where=''){
		$Q = new Query($this->table.' as ac');
		//$Q->join = 'left join admin as a on find_in_set(a.name,ac.admin_names)!=0 ';
		$Q->fields = 'ac.*';
		if($where!=''){
            $Q->where = $where;
        }
		$data = $Q->find();
		return $data;
	}

	public function getOne($id){
        $Q = new Query($this->table.' as ac');
        //$Q->join = 'left join admin as a on find_in_set(a.name,ac.admin_names)!=0 ';
        $Q->fields = 'ac.*';

         $Q->where = 'id='.$id;
        $data = $Q->getObj();
        return $data;
    }

	public function editCheck($checkID,$names=''){
	    //TODO:
         $checkID = intval($checkID);
         if($checkID<=0){
             tool::setHttpResponse('404');
             return tool::getSuccInfo(0,'项目不存在');
         }
          $this->adminObj->data(array('admin_names'=>$names))->where(array('id'=>$checkID))->update();

         tool::setHttpResponse('204');
         return tool::getSuccInfo();

    }



	


}
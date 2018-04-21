<?php

namespace member;

use \Library\M;
use \Library\Query;
use \Library\Tool;

/**
 * 代理商的数据处理
 */
class vipModel extends \baseModel{

    const CERT_SUCCESS =   2; //后台确认认证通过
    const CERT_FAIL    =   3; //后台拒绝认证

    protected $table = 'user_vip';

    public function __construct(){
        parent::__construct();
    	$this->model = new M($this->table);
    }

   /**
     * 获取代理商列表
     * @param  [Int]  $page     [分页]
     * @param  [String] $where [<查询的where条件>]
     * @param  [Array] $bind [<查询的where条件绑定的数据>]
     * @return [Array.list]            [代理商列表数据]
     * @return [Array.pageHtml]            [代理商分页数据]
     */
    public function getList($page, $where='', $bind=array()){
    	$query = new Query($this->table . ' as v');
    	$query->join = 'left join user as u on v.user_id=u.id';
    	$query->fields = 'v.*,u.username,u.mobile';
    	$query->page = $page;
    	$query->pagesize = 20;
    	$query->where = $where;
    	$query->bind = $bind;
    	$query->order = 'v.user_id desc';
    	$guideList = $query->find();
    	
    	return array('list' => $guideList, 'bar' => $query->getPageBar());
    }


       /**
     * 获取代理商详情数据
     * @param  [Int] $id [id]
     * @return [Array]    
     */
    public function getDetail($id){
    	if (intval($id) > 0) {
            $query = new Query($this->table . ' as v');
            $query->join = 'left join user as u on v.user_id=u.id';
            $query->fields = 'v.*,u.username,u.mobile';
            $query->where = 'v.user_id=:id';
            $query->bind = array('id'=>$id);
            return $query->getObj();

    	}
    	return array();
    }

    public function setStatus($user_id,$status){
        $obj = new M($this->table);
        $status = $status==1 ? self::CERT_SUCCESS : self::CERT_FAIL;
        return $obj->where(array('user_id'=>$user_id))->data(array('status'=>$status))->update();
    }



}
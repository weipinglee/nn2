<?php

namespace nainai;

use \Library\M;
use \Library\Query;
use \Library\Tool;

/**
 * 代理商的数据处理
 */
class Agent{

     /**
     * 添加代理商验证规程
     * @var array
     */
    protected $agentRules = array(
        array('username','require','必须填写代理商用户名'),
        array('mobile','require','必须填写代理商联系方式'),
        array('company_name','require','必须填写代理商公司名称'),
        array('contact','require','必须填写代理人联系人名称'),
        array('contact_phone','require','必须填写代理人联系人联系方式'),
        array('address','require','必须填写代理人联系人地址'),
        array('status','int','必须选择状态')
    );

    /**
     * 代理商的数据处理对象
     * @var [Object]
     */
    private $_agentModel;

    public function __construct(){
    	$this->_agentModel = new M('agent');
    }

   /**
     * 获取代理商列表
     * @param  [Int]  $page     [分页]
     * @param  [Int]  $pagesize [分页]
     * @param  [String] $where [<查询的where条件>]
     * @param  [Array] $bind [<查询的where条件绑定的数据>]
     * @return [Array.list]            [代理商列表数据]
     * @return [Array.pageHtml]            [代理商分页数据]
     */
    public function getAgentList($page, $pagesize, $where='', $bind=array()){
    	$query = new Query('agent');
    	$query->fields = '*';
    	$query->page = $page;
    	$query->pagesize = $pagesize;
    	$query->where = $where;
    	$query->bind = $bind;
    	$query->order = 'create_time desc';
    	$guideList = $query->find();
    	
    	return array('list' => $guideList, 'pageHtml' => $query->getPageBar());
    }

   /**
     * 添加代理商处理
     * @param [Array] $guideData [需要添加代理商的数据]
     */
    public function addAgent( & $agentData ){
    	$res = null;
    	if ($this->_agentModel->validate($this->agentRules, $agentData)) {
    		$res = $this->_agentModel->data($agentData)->add(0);
    	}else{
    		$res = $this->_agentModel->getError();
    	}

    	if(intval($res) > 0){
          	return Tool::getSuccInfo();
         }
        else{
            	return Tool::getSuccInfo(0,is_string($res) ? $res : '系统繁忙，请稍后再试');
         }
    }

       /**
     * 获取代理商详情数据
     * @param  [Int] $id [id]
     * @return [Array]    
     */
    public function getAgentDetail($id){
    	if (intval($id) > 0) {
    		return $this->_agentModel->where('id=:id')->bind(array('id'=>$id))->getObj();
    	}
    	return array();
    }

       /**
     * 修改代理商数据
     * @param  [Array] &$guideData [修改的导航栏数据]
     * @param  [Int] $id         [Id]
     * @return [Boolean]   
     */
    public function updateAgent(&$agentData, $id){
    	if (intval($id) > 0) {
    		return (bool)$this->_agentModel->data($agentData)->where('id=:id')->bind(array('id'=>$id))->update();
    	}
    	return false;
    }

   /**
     * 删除代理商数据
     * @param  [Int] $id [id]
     * @return [Boolean] 
     */
    public function deleteAgent($id){
    	if (intval($id) > 0) {
    		return (bool)$this->_agentModel->where('id=:id')->bind(array('id'=>$id))->delete(0);
    	}
    	return false;
    }

}
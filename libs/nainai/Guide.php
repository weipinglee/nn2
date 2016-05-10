<?php

namespace nainai;

use \Library\M;
use \Library\Query;
use \Library\Tool;

class Guide{
	
   /**
     * 添加导航验证规程
     * @var array
     */
    protected $guideRules = array(
        array('name','require','必须填写导航名'),
        array('type','int','请选择导航类型'),
        array('pid','int','请选择上级分类'),
    );

    /**
     * 导航栏分类的
     * @var string
     */
    public $category = null;

    /**
     * 分类的修饰图形
     * @var array
     */
    private $_icon = array('│','├','└');

    /**
     * 持有的的数据对象
     * @var [Object]
     */
    private $_guideModel;

    public function __construct(){
    	$this->_guideModel = new M('guide');
    }

    /**
     * 添加导航栏处理
     * @param [Array] $guideData [需要添加导航栏的数据]
     */
    public function addGuide( & $guideData ){
    	$res = null;
    	if ($this->_guideModel->validate($this->guideRules, $guideData)) {
    		$res = $this->_guideModel->data($guideData)->add(0);
    	}else{
    		$res = $this->_guideModel->getError();
    	}

    	if(intval($res) > 0){
          	return Tool::getSuccInfo();
         }
        else{
            	return Tool::getSuccInfo(0,is_string($res) ? $res : '系统繁忙，请稍后再试');
         }
    }

    /**
     * 获取导航栏列表
     * @param  [Int]  $page     [分页]
     * @param  [Int]  $pagesize [分页]
     * @param  integer $type     [导航栏类型]
     * @return [Array.list]            [导航栏列表数据]
     * @return [Array.pageHtml]            [导航栏分页数据]
     */
    public function getGuideList($page, $pagesize, $type=0){
    	$query = new Query('guide');
    	$query->fields = 'id, name, link, sort';
    	$query->page = $page;
    	$query->pagesize = $pagesize;
    	$query->order = 'sort desc';
    	$query->where = 'type=:type';
    	$query->bind = array('type' => $type);
    	$guideList = $query->find();
    	
    	return array('list' => $guideList, 'pageHtml' => $query->getPageBar());
    }

    /**
     * 获取导航栏详情数据
     * @param  [Int] $id [id]
     * @return [Array]    
     */
    public function getGuideDetail($id){
    	if (intval($id) > 0) {
    		return $this->_guideModel->where('id=:id')->bind(array('id'=>$id))->getObj();
    	}
    	return array();
    }

    /**
     * 修改导航栏数据
     * @param  [Array] &$guideData [修改的导航栏数据]
     * @param  [Int] $id         [Id]
     * @return [Boolean]   
     */
    public function updateGuide(&$guideData, $id){
    	if (intval($id) > 0) {
    		return (bool)$this->_guideModel->data($guideData)->where('id=:id')->bind(array('id'=>$id))->update();
    	}
    	return false;
    }

    /**
     * 删除导航栏数据
     * @param  [Int] $id [id]
     * @return [Boolean] 
     */
    public function deleteGuide($id){
    	if (intval($id) > 0) {
    		return (bool)$this->_guideModel->where('id=:id')->bind(array('id'=>$id))->delete(0);
    	}
    	return false;
    }

    /**
     * 获取导航栏分类的option数据
     * @param  integer $selectId [默认选择的导航栏id]
     * @param  integer $type     [导航栏类型]
     * @param  integer $pid       [导航栏父类id]
     * @param  integer $level    [分类的等级，根据等级从分类修饰图形获取图形]
     * @return Boolean 是否获取成功
     */
    public function getGuideCategoryOption($selectId = 0, $type=0, $pid = 0, $level=0){
    	$list = $this->_guideModel->fields('id, name, pid')->where('type=:type AND pid=:id')->bind(array('type'=>$type, 'id'=>$pid))->select();
    	if (empty($list)) {
    		return false;
    	}
   	$level ++;
    	foreach ($list as $array) {
    		$this->category .= '<option value="'.$array['id'].'"';
    		if (intval($selectId) >0 && $array['id'] == $selectId) {
    			$this->category .= 'SELECTED="SELECTED"';
    		}
    		$this->category .=  '>' . str_repeat('&nbsp;&nbsp;', $level) .  $this->_icon[$level] . $array['name'] . '</option>';
    		$this->getGuideCategoryOption($selectId, $type, $array['id'], $level);
    	}

    	return true;
    }

}
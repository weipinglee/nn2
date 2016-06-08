<?php
namespace nainai\user;

use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\url;

/**
 * 菜单操作对应的api
 * @author maoyong.zeng <zengmaoyong@126.com>
 * @copyright 2016年05月30日
 */
class Menu extends \nainai\Abstruct\ModelAbstract {

	protected $menuTable = 'menu';
	protected $menuRoleTable = 'menu_role';
	/**
	 * 添加菜单验证规程
	 * @var array
	 */
	protected $Rules = array(
	    array('menu_zn','require','必须菜单的中文名称'),
	    array('menu_url','require','请正确填写url', 2)
	);

	protected $publicRole = 'public';

	/**
	 * 菜单的列表
	 * @var array
	 */
	static public $treeList = array(); 

	/**
	 * 导航栏分类的
	 * @var string
	 */
	public $category = null;

	/**
	* 分类的修饰图形
	* @var array
	*/
	private $_icon = array( 1=>'│', 2=>'├', 3=>'└');

	public function getIcon(){
		return $this->_icon;
	}

	/**
	 * 获取菜单列表
	 * @return [Array] 
	 */
	public function getMenuList(){
		return $this->model->fields('id, menu_zn, pid')->order('pid asc, sort asc')->select();
	}
	

	/**
	 * 无限级分类
	 * @access public 
	 * @param Array $data     //数据库里获取的结果集 
	 * @param Int $pid             
	 * @param Int $level       //第几级分类
	 * @return Array $treeList   
	 */
	static public function getTreeList(&$data,$pid = 0,$level = 0) {
	    foreach ($data as $key => $value){
	        if($value['pid']==$pid){
	            $value['level'] = $level;
	            self::$treeList []=$value;
	            unset($data[$key]);
	            self::getTreeList($data,$value['id'],$level+1);
	        } 
	    }
	    return self::$treeList ;
	}

	/**
	 * 获取菜单分类的option数据
	 * @access public
	 * @param  integer $selectId [默认选择的导航栏id]
	 * @param  integer $pid       [导航栏父类id]
	 * @param  integer $level    [分类的等级，根据等级从分类修饰图形获取图形]
	 * @return Boolean 是否获取成功
	 */
	public function getGuideCategoryOption($selectId = 0, $pid = 0, $level=0){
		$list = $this->model->fields('id, menu_zn, pid')->where('pid=:id')->bind(array('id'=>$pid))->order('pid asc, sort desc')->limit('100')->select();
		if (empty($list)) {
			return false;
		}

		$level ++;
		foreach ($list as $array) {
			$this->category .= '<option value="'.$array['id'].'"';
			if (intval($selectId) >0 && $array['id'] == $selectId) {
				$this->category .= 'SELECTED="SELECTED"';
			}
			$this->category .=  '>' . str_repeat('&nbsp;&nbsp;', $level) .  $this->_icon[$level] . $array['menu_zn'] . '</option>';
			$this->getGuideCategoryOption($selectId, $array['id'], $level);
		}

		return true;
	}

	/**
	 * 获取用户的菜单数据列表
	 * @param  [Int] $uid [用户id]
	 * @param array 用户认证数据
	 * @return [Array]      [菜单数据列表]
	 */
	public function getUserMenuList($uid,$cert=array()){
		$menuList = array();

		if (intval($uid) > 0) {

			//获取各个认证角色的角色id
			$roleIds = array();
			if(!empty($cert)){
				$roleIds['public'] = $this->publicRole;
				$where = 'cert in (:public';
				foreach($cert as $key=>$val){
					if($val==1){
						$roleIds[$key] = $key;
						$where .= ',:'.$key;
					}

				}
				$where .= ')';

				$right = $this->model->table($this->menuRoleTable)->where($where)->bind($roleIds)->getFields('purview');
				$userPur = array();
				foreach($right as $k=>$v){
					$userPur = array_merge($userPur,unserialize($v));
				}

			}

			
			$menuList = $this->model->table('menu')->fields('id, menu_zn, pid, menu_url')->where('FIND_IN_SET(id, :ids)')->bind(array('ids' => implode(',', $userPur)))->order('pid asc, sort asc')->select();
			foreach($menuList as $k=>$v){
				$menuList[$k]['menu_url'] = \Library\url::createUrl($menuList[$k]['menu_url']);
			}
		}

		return $menuList;
	}


}
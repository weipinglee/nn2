<?php
/**
 * 子账户权限
 */
namespace nainai;
use \Library\M;
use \Library\tool;
use \Library\Query;
use \Library\Session;
class subAccount{

	/**
	 * 权限认证
	 * @param string $module     模块名
	 * @param string $controller 控制器名
	 * @param string $action     动作名
	 */
	public static function AccessDecision($module = '',$controller = '',$action = ''){

		$user = session::get('login');
		$MenuModel = new \nainai\user\Menu();
    	$menuList = $MenuModel->getUserMenuList(45);
    	return $menuList;
	}

}
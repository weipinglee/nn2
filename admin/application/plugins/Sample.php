<?php
/**
 * @name SamplePlugin
 * @desc Yaf定义了如下的6个Hook,插件之间的执行顺序是先进先Call
 * @see http://www.php.net/manual/en/class.yaf-plugin-abstract.php
 * @author root
 */
use \Library\url;
use \Library\adminrbac\rbac;
use \Library\session;
use \Library\tool;
class SamplePlugin extends Yaf\Plugin_Abstract {

	public function routerStartup(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {
		
	}

	public function routerShutdown(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {
		//RBAC权限控制
		$user_info = session::get(tool::getConfig('rbac')['user_session']);
		if((!isset($user_info) || !$user_info) && (strtolower($request->controller) != 'login')){
			$response->setRedirect(url::createUrl("/login/login"));
		}
		$rbac = new rbac($request);
		$auth = rbac::AccessDecision('admin',$request->controller,$request->action);
		if($auth === false){
			$response->setRedirect(url::createUrl("/index/index/noaccess"));
		}
	}

	public function dispatchLoopStartup(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {
		
	}	

	public function preDispatch(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {
	}

	public function postDispatch(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {

	}

	public function dispatchLoopShutdown(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {
		//echo $request->getActionName();
	}
}

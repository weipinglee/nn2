<?php

use \Library\checkRight;
use \Library\PlUpload;
use \Library\photoupload;
use \Library\json;
use \Library\url;
use \Library\Safe;
use \Library\Thumb;
use \Library\tool;

/**
 * 用户中心的抽象基类
 */
class UcenterBaseController extends \nainai\controller\Base{

	/**
	 * 所有的用户中心列表的分页是这个
	 * @var integer
	 */
	protected $pagesize = 10;

	protected $certType = null;

	private static $certPage = array(
		'deal'=>'dealcert',
		'store'=>'storecert'
	);

	/**
	 * 设置对话框中返回的url
	 * @var [type]
	 */
	public $backUrl;
	/**
	 * 设置对话框中继续的url
	 * @var [type]
	 */
	public $goUrl;


	protected function init(){
		parent::init();//继承父类的方法，检测是否登录和角色
        $controllerName = $this->_request->getControllerName();
        $actionName = $this->_request->getActionName();
        $a = new \nainai\subAccount();
        $res = $a->AccessDecision($controllerName,$actionName);
        if(!$res){
            //子账户无权限则跳转到首页
            $this->error('无权限',url::createUrl('/Ucenter/index'));
        }

        $user = new \nainai\member();
        $secret_url = $user->getSecretUrl();

        //判断是否需要支付密码
        if(IS_POST && in_array(strtolower($controllerName).'/'.strtolower($actionName),$secret_url)){
            $pay_secret = safe::filterPost('pay_secret') ? safe::filterPost('pay_secret') : safe::filter($this->_request->getParam('pay_secret'));
            if(!$pay_secret){
                IS_AJAX ? die(json::encode(tool::getSuccInfo(0,'请输入支付密码'))) : $this->error('请输入支付密码');die;
            }
            $sec = $user->validPaymentPassword($pay_secret);
            if(!$sec){
				IS_AJAX ? die(json::encode(tool::getSuccInfo(0,'支付密码错误'))) : $this->error('支付密码错误'); die;
            }
        }

        //确认操作
		$action_confirm = $this->_request->getParam('action_confirm');
		if(isset($action_confirm)){
			$info = safe::filter($this->_request->getParam('info'));
			$redirect = safe::filter($this->_request->getParam('redirect'));
			$redirect = $redirect ? $redirect : str_replace('/action_confirm/1','','http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
			$this->confirm($info ? $info : '确认此项操作？',$redirect);
			exit;
		}

		$this->getView()->setLayout('ucenter');

		//获取菜单数据
		$MenuModel = new \nainai\user\Menu();

    		$menuList = $MenuModel->getUserMenuList($this->user_id,$this->cert,$this->user_type);

    		$this->createTreeMenu($menuList);
    		$menu = $this->createHtmlMenu();

		$this->getView()->assign('topArray', $menu['top']);
		$this->getView()->assign('leftArray', $menu['left']);
		$action = strtolower($this->getRequest()->getActionName());
        
		// 判断该方法买家是否能操作，如果不能，跳转到用户中心首页
		 if($this->user_type==0 && isset($this->sellerAction) && in_array($action,$this->sellerAction)){
		 	$this->redirect(url::createUrl('/ucenter/index'));
		 }

		$this->getView()->assign('action', $action);
		$mess=new \nainai\message($this->user_id);
		$countNeedMess=$mess->getCountMessage();
		$this->getView()->assign('mess',$countNeedMess);
	}

	/**
         * 生成的菜单数据格式
         * @var name [<菜单名称>]
         * @var url   [<菜单url>]
         * @var controller 控制器名称
         * @var list [<子菜单的数据，key和父级菜单一致>]
         */
	public $menu = array();

	/**
	 * 生成菜单数据格式
	 * @param  [Array]  &$menuList 菜单数据列表
	 * @param  integer $pid       [上级菜单id]
	 * @return [Array]             菜单格式数据
	 */
	public function createTreeMenu(&$menuList, $pid=0){
		$menu = array($pid => array());
		foreach ($menuList as $key => $list) {
			$id = $list['id'];
    			$urlpath = parse_url($list['menu_url']);
			$urlpath = array_reverse(explode('/', $urlpath['path']));

    			if (count($urlpath) > 1) {
    				$controllerName = strtolower($urlpath[1]);
    			}else{
    				$controllerName = $list['id'];
    			}

    			//生成头菜单对应的子菜单数据格式
    			if ($list['pid'] == $pid && $pid > 0) {
    				$menu[$id] = array('url' => $list['menu_url'], 'title' => $list['menu_zn'], 'id'=>$list['id'], 'action'=>strtolower($urlpath[0]), 'list' => '');
    				unset($menuList[$key]);
    				//获取菜单对应的子菜单数据列表
    				$menu[$id]['list'] = $this->createTreeMenu($menuList, $id);

    				if (!empty($menu[$id]['list'][$id])) {
    					$menu[$pid] = array_merge($menu[$pid], $menu[$id]['list'][$id]);
    				}
    				array_push($menu[$pid], $controllerName);
    				unset($menu[$id]['list'][$id]);
    			}

    			//头部菜单加入到菜单格式中
    			if ($pid == 0 && $list['pid'] == $pid) {
    				$menu = array('url' => $list['menu_url'], 'title' => $list['menu_zn'], 'id'=>$list['id'], 'action'=>strtolower($urlpath[0]), 'list' => array(), 'controller' => array());
    				
    				unset($menuList[$key]);
    				//获取菜单对应的子菜单数据列表
    				$menu['list'] = $this->createTreeMenu($menuList, $menu['id']);
    				if (!empty($menu['list'][$id])) { //将子菜单的控制器名统一加入到头菜单中，以作标示是否被选中
    					$menu['controller'] = array_merge($menu['controller'], $menu['list'][$id]);
    				}
    				array_push($menu['controller'], $controllerName);
    				$menu['controller'] = array_unique($menu['controller']);		
    				unset($menu['list'][$id]);
    				$this->menu[$controllerName] = $menu;
    			}
    		}

    		if ($pid > 0 && !empty($menu)) { //如果是子菜单数据，就返回到上级菜单中
    			return $menu;
    		}
	}

	/**
	 * 将菜单格式数据，生成HTML中展示的菜单数据
	 * @return [Array.top] [头菜单数据]
	 * @return [Array.left] [左侧菜单数据]
	 */
	public function createHtmlMenu(){
		$menu = array('top' => array(), 'left' => array());
		$controllerName = $this->getRequest()->getControllerName();
		$controllerName = strtolower($controllerName);

		foreach ($this->menu as $controller => $list) {
                         $list['isSelect'] = 0;
			//判断当前访问的控制器是否是这个头菜单，或者对应的子菜单的链接
			if (!empty($list['controller']) && in_array($controllerName, $list['controller'])) {
				$list['isSelect'] = 1;
				array_unshift($list['list'], array('title' => $list['title']));
				$menu['left'] = $list['list'];
			}

			unset($list['list']);
			$menu['top'][$controller] = $list; 
		}
		return $menu;
	}


    	/**
    	 * 设置处理成功后返回的结果
    	 * @param [Array] $returnData [返回结果]
    	 * @param string $type       [处理类型]
    	 */
    	public function HandlerHtml( & $returnData, $type='default'){
    		switch ($type) {
    			case 'default':
    				$returnData['url']['backUrl'] = $this->backUrl;
    				$returnData['url']['goUrl'] = $this->goUrl; 

    				$url = url::createUrl('/UcenterBase/defaultHtml') . '?' . http_build_query($returnData);
    				$this->redirect($url);
    				break;
    			
    			case 'json':
    				echo json::encode($returnData);
    				break;
    		}
    		exit();
    	}

    	/**
    	 * 默认的处理返回页面
    	 */
      	public function defaultHtmlAction(){
    		$success = Safe::filterGet('success', 'int');
    		$msg = Safe::filterGet('info');
    		$Url = Safe::filterGet('url');

    		$this->getView()->assign('success', $success);
    		$this->getView()->assign('msg', $msg);
    		$this->getView()->assign('url', $Url);
    	}



    	protected function success($info = '操作成功！',$redirect = ''){
    		if(isset($redirect)){
    			$redirect = str_replace('%','||',urlencode($redirect));
    		}
    		
    		$this->redirect(url::createUrl("/Oper/success?info={$info}&redirect={$redirect}"));
    	}

    	protected function error($info = '操作失败！',$redirect = ''){

    		if(isset($redirect)){
    			$redirect = str_replace('%','||',urlencode($redirect));
    		}
    		$this->redirect(url::createUrl("/Oper/error?info={$info}&redirect={$redirect}"));
    	}

    	protected function confirm($info = '确认此项操作？',$redirect = ''){

    		if(isset($redirect)){
    			$redirect = str_replace('%','||',urlencode($redirect));
    		}
    		$this->redirect(url::createUrl("/Oper/confirm?info={$info}&redirect={$redirect}"));
    	}

        /**
         * 验证用户支付密码
         */
        public function validPaymentPasswordAction(){
            $pay_secret = safe::filterPost('pay_secret');
			if(!$pay_secret)
				$pay_secret = safe::filterGet('pay_secret');
			if(!$pay_secret)
				$pay_secret = $this->getRequst()->getParam('pay_secret');

            $user = new \nainai\user\User();
            $valid = $user->validPaymentPassword($pay_secret);
            $res = $valid === true ? tool::getSuccInfo() : tool::getSuccInfo(0,'支付密码错误');

            echo JSON::encode($res);
            return false;
        }

}


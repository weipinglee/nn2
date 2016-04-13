<?php
/**
 * @date 2015-9-13 
 * @author zhengyin <zhengyin.name@gmail.com>
 * @blog http://izhengyin.com
 *
 */

class ApiController extends yaf\Controller_Abstract{
	
	//用户接口
	public function userAction(){
		$apiServer = new Yar_Server(new api\User());
		$apiServer->handle();
		return false;
	}
	
	
	
}

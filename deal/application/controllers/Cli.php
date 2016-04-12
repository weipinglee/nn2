<?php
/**
 *  @date 2015-7-7
 *  @author zhengyin <zhengyin@kongfz.com>
 *  @desc 
 *  	Cli 父类控制器
 */

class CliController extends Yaf\Controller_Abstract{
	
	
	protected $logFile=null;
	
	protected $execTime = 0;
	
	public function init(){
		if(!$this->getRequest()->isCli()){
			exit('forbid accessing!');
		}
		$this->execTime = time();
	}
	
	/**
	 * 显示错误
	 */
	protected  function displayError(){
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
	}
	/**
	 * 设置内存使用限制
	 * @param  $size
	 */
	protected function setMemoryLimit($size){
		ini_set('memory_limit', $size);
	}
	/**
	 * 设置运行时间限制
	 * @param  $seconds
	 */
	protected function setTimeLimt($seconds){
		set_time_limit($seconds);
	}
	

}
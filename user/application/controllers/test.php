<?php 

/**
 * 保证金摘牌控制器
 */
use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
use \Library\checkRight;
use \Library\M;

class testController extends  UcenterBaseController{

	public function indexAction(){

	}

	public function uploadAction(){

	}

	public function formAction(){
		if(IS_POST){
			die(json::encode(tool::getSuccInfo()));
		}
		else{

		}

	}

}
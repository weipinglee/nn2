<?php
/*
 *充值类
 * author：wzd
 * Date:2016/4/30
 */

//use Library\payments\payment;
use \Library\M;
use \Library\Payment;
use \Library\safe;
use \Library\JSON;
use \Library\Session;
use \Library\url;
use \Library\tool;

class TuijianController extends UcenterBaseController {

	protected  $certType = array('vip','vip_temp');

	public function recommendAction(){
        if(IS_POST){
            die(json::encode(tool::getSuccInfo(1,'设置成功')));
        }
    }

    public function pushListAction(){

    }


}
?>
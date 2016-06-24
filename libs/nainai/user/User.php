<?php
namespace nainai\user;

use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\url;

/**
 * 用户对应的api
 * @author maoyong.zeng
 * @copyright 2016年05月30日
 */
class User extends \nainai\Abstruct\ModelAbstract {
	
	/**
	 * 验证支付密码
	 * @param  string $password 支付密码
	 * @return boolean    true:通过 false:未通过
	 */
	public function validPaymentPassword($password,$user_id = 0){
		if(!$password) return false;
		if(!($user_id = intval($user_id))){
			$user_session = \Library\session::get('login');
			$user_id = $user_session['user_id'];
		}
		$user = new M('user');
		$pay_secret = $user->where(array('id'=>$user_id))->getField('pay_secret');
		if(md5($password) == $pay_secret){
			return true;
		}else{
			return false;
		}
	}

	/**
	 * 获取需要认证支付密码的路径集合
	 */
	public function getSecretUrl(){
		return $secret_url = array(
            'ucenter/ind1ex','ucenter/xxxx','order/buyerRetainage'
        );
	}

}
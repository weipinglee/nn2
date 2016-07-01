<?php

namespace nainai\user;

use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\url;


/**
 * 开票信息的api
 * @author zengmaoyong <zengmaoyong@126.com>
 * @copyright 2016-05-27
 * @package  user
 */

class UserInvoice extends \nainai\Abstruct\ModelAbstract {

	public $pk = 'user_id';

	/**
	 * 添加开票验证规程
	 * @var array
	 */
	protected $Rules = array(	

	    array('title','s{2,30}','必须填写发票抬头'),
	    array('tax_no','/^[a-zA-Z0-9_]{6,40}$/','必须填写纳税人识别号'),
	    array('address','/^[\S]{2,40}$/','必须填写地址'),
	    array('phone','/^[0-9\-]{6,15}$/','必须填写电话'),
	    array('bank_name','s{2,20}','必须填写银行名称'),
	    array('bank_no','s{6,20}','必须填写银行卡号')
	);

	public function __construct(){
		$this->user_invoice = new M('user_invoice');
		$this->order_invoice = new M('order_invoice');
	}
	/**
	 * 根据用户id获取相应发票信息
	 * @param  int $user_id 用户id
	 */
	public function userInvoiceInfo($user_id){
		
		return $this->user_invoice->where(array('user_id'=>$user_id))->getObj();
	}

	/**
	 * 获取订单发票
	 * @param  int  $order_id 订单id
	 */
	public function orderInvoiceInfo($order_id){
		$res = $this->order_invoice->where(array('order_id'=>$order_id))->getObj();
		if($res){
			$res['image'] = \Library\Thumb::get($res['image'],180,180);
		}
		return $res;
	}

	/**
	 * 生成发票信息
	 * @param  array $data 发票信息数组
	 */
	public function geneInvoice($data){
		return $this->order_invoice->data($data)->add() ? true : false;
	}



}
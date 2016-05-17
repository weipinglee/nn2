<?php

namespace nainai\user;

use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\url;

class UserInvoice extends \nainai\Abstruct\ModelAbstract {

	public $pk = 'user_id';

	/**
	 * 添加开票验证规程
	 * @var array
	 */
	protected $Rules = array(
	    array('title','require','必须填写发票抬头'),
	    array('tax_no','require','必须填写纳税人识别号'),
	    array('address','require','必须填写地址'),
	    array('phone','require','必须填写电话'),
	    array('bank_name','require','必须填写银行名称'),
	    array('bank_no','require','必须填写银行卡号')
	);

}
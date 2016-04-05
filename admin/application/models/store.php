<?php
/**
 * @date 2016-4-5
 * 后台仓库管理
 *
 */
use \Library\M;
use \Library\Query;
use \Library\tool;
class StoreModel{

	/**
	 * 验证规则：
	 * array(字段，规则，错误信息，条件，附加规则，时间）
	 * 条件：0：存在字段则验证 1：必须验证 2：不为空时验证
	 *
	 */
	/**
	 * @var
	 */
	protected $storeRules = array(
		array('id','number','id错误',0,'regex'),
		array('name','require','仓库名必填'),
		array('area','number','地区错误'),
		array('address','require','填写详细地址'),
		array('service_phone','/[\d\-]{6,15}/','电话号码错误'),
		array('service_address','require','请填写服务点地址'),
		array('contact','require','请填写联系人'),
		array('contact_phone','/[\d\-]{6,15}/','请填写联系人电话'),
		array('type',array(0,1),'请正确选择仓库类型',0,'in'),
		array('status',array(0,1),'请正确选择仓库类型',0,'in'),
		array('img','/^[a-zA-Z0-9_@\.\/]+$/','请上传图片',2),
	);


	/**
	 * 仓库添加
	 */
	public function storeAdd($data){
		$storeObj = new M('store_list');
		if($storeObj->data($data)->validate($this->storeRules)){
			$res = $storeObj->add() ? 1 : 0;
			$info = '';
		}
		else{
			$res = 0;
			$info = $storeObj->getError();
			$info = $info=='' ? '系统繁忙' : $info;
		}
		return tool::getSuccInfo($res,$info);

	}

}
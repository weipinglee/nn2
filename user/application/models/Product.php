<?php

use \Library\M;
use \Library\tool;

/**
 * 商品模型
 * @author zengmaoyong 
 */
class ProductModel{

	/**
	 * 商品验证规则
	 * @var array
	 */
	protected $productRules = array(
		array('name','require','商品名称必须填写'),
		// array('cate_id','number','商品类型id错误'),
		array('price','double','商品价格必须是数字'),
		array('quantity','number','供货总量必须是整数'),
		array('attribute', 'require', '请选择商品属性'),
		array('note', 'require', '商品描述必须填写')
	);

	/**
	 * 报盘验证规则
	 * @var array
	 */
	protected $productOfferRules = array(
		array('product_id', 'number', '必须有商品id'),
		array('mode', 'number', '必须有报盘类型'),
		array('divide', 'number','是否可拆分的id错误'),
		array('accept_area', 'require', '交收地点必须填写'),
		array('accept_day', 'number', '交收时间必须填写')
	);

	/**
	 * pdo的对象
	 * @var [Obj]
	 */
	private $_productObj;

	public function __construct(){
		$this->_productObj = new M('products');
	}

	public function getProductCategory($gid = 0){
		$where  = array('status' => 1);
		return $this->_productObj->table('product_category')->fields('id,pid, name, unit, childname, attrs')->where($where)->select();
	}

	/**
	 *获取所有分类的属性，去除重复
	 * @param array $cates 分类数组,array(2,3)
	 * @return mixed
	 */
	public function getProductAttr($cates=array()){
		$attrs = $this->_productObj->table('product_category')->fields('attrs')->where('id in ('.join(',',$cates).')')->select();

		$attr_arr = array();
		foreach($attrs as $v){
			if($v['attrs']!='')
				$attr_arr = array_merge($attr_arr,explode(',',$v['attrs']));
		}
		return $this->_productObj->table('product_attribute')->where('id in ('.join(',',$attr_arr).')')->select();
	}	

	/**
	 * 添加商品数据
	 * @param  [Array] &$productData [提交的商品数据]
	 * @param  [Array] &$imgData     [提交的商品图片地址数据]
	 * @param  [Array] &$productOffer[提交的报盘数据]
	 * @return [Array]               [添加是否成功，及失败信息]
	 */
	public function insertProduct(&$productData, &$imgData, &$productOffer){
		if ($this->_productObj->validate($this->productRules,$productData)){

			$this->_productObj->beginTrans();
			$pId = $this->_productObj->data($productData)->add(1);
			$productOffer['product_id'] = $pId;

			if ($this->_productObj->validate($this->productOfferRules, $productOffer)) {
				$this->_productObj->table('product_offer')->data($productOffer)->add(1);

				if (!empty($imgData)) {
					foreach ($imgData as $key => $imgUrl) {
						$imgData[$key]['products_id'] = $pId;
					}
					$this->_productObj->table('product_photos')->data($imgData)->adds(1);
				}
				$res = $this->_productObj->commit();
			}else{
				$res = $this->_productObj->getError();
			}

		}else{
			$res = $this->_productObj->getError();
		}

		if ($res === TRUE) {
			return tool::getSuccInfo(1, 'add Success');
		}else{
			return tool::getSuccInfo(0, $res);
		}

	}


}
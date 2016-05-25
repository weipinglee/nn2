<?php
namespace nainai\order;

use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\url;
use \Library\Thumb;

class OrderComplain extends \nainai\Abstruct\ModelAbstract{

	const BUYCOMPLAIN = 1; 
	const SELLCOMPLAIN = 2;
	/**
	 * 申述角色
	 * @var array
	 */
	protected $complainType = array(
		self::BUYCOMPLAIN => '买方申述',
		self::SELLCOMPLAIN => '卖方申述'
	);

	/**
	 * 申述状态
	 */
	const APPLYCOMPLAIN = 1; //申请
	const DONTCOMPLAIN = 2; //不处理
	const INTERVENECOMPLAIN = 3; //介入处理
	const CONFERCOMPLAIN = 4; //介入处理完成
	const BUYBREAKCOMPLAIN = 5; //买方违约
	const SELLBREAKCOMPLAIN = 6; //卖方违约

	protected $complainStatus = array(
		self::APPLYCOMPLAIN => '申请',
		self::DONTCOMPLAIN => '不处理申述',
		self::INTERVENECOMPLAIN => '介入处理申述',
		self::CONFERCOMPLAIN => '介入处理申述协商通过',
		self::BUYBREAKCOMPLAIN => '处理完成(买方违约)',
		self::SELLBREAKCOMPLAIN => '处理完成(卖方违约)'
	);
	
	/**
	 * 验证申述规则
	 * @var array
	 */
	protected $Rules = array(
		array('order_id', 'number', '必须选择合同!'),
		array('title', 'require', '请填写申述标题'),
		array('detail', 'require','请填写申述内容!'),
		array('proof', 'require','请上传申述凭证!')
	);

	/**
	 * 获取申述角色
	 * @return [Array] 
	 */
	public function getComplainType(){
		return $this->complainType;
	}

	/**
	 * 获取申述状态
	 * @return [Array] 
	 */
	public function getComplainStatus(){
		return $this->complainStatus;
	}

	/**
	 * 获取申述列表
	 * @param  [Int] $page   
	 * @param  [Int] $pagesize  
	 * @param  array  $condition [查询条件]
	 * @return [Array]            
	 */
	public function getComplainList($page, $pagesize, $condition = array()){
		$query = new Query('order_complain as a');
		$query->fields = 'a.id, a.title, a.type, a.proof, a.status, a.apply_time, b.order_no, b.id as oid, c.username';
		$query->join = 'LEFT JOIN order_sell as b ON a.order_id=b.id LEFT JOIN user as c ON a.user_id=c.id';
		$query->order = 'apply_time desc';

		if (!empty($condition)) {
			$query->where = $condition['where'];
			$query->bind = $condition['bind'];
		}

		$query->page = $page;
        		$query->pagesize = $pagesize;

        		$lists = $query->find();
        		$types = $this->getComplainType();
        		$status = $this->getComplainStatus();

        		foreach ($lists as $k => &$list) {
        			$list['type'] = $types[$list['type']];
        			$list['status'] = $status[$list['status']];
        			$list['proof'] = unserialize($list['proof']);
        			if (!empty($list['proof'])) {
        				foreach ($list['proof'] as  $key => $value) {
	        				$list['proof'][$key] = Thumb::get($value,100,100);
	        			}
        			}
        		}

        		return array('list' => $lists, 'pageHtml' => $query->getPageBar());
	}

	/**
	 * 获取申述详情
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getComplainDetail($id){
		if (intval($id) > 0) {
			$query = new Query('order_complain as a');
			$query->fields = 'a.*, b.order_no, b.id as oid, c.username';
			$query->join = 'LEFT JOIN order_sell as b ON a.order_id=b.id LEFT JOIN user as c ON a.user_id=c.id';
			$query->where = 'a.id=:id';
			$query->bind = array('id' => $id);

			$detail = $query->getObj();
	        		$types = $this->getComplainType();
	        		$status = $this->getComplainStatus();

	        		$detail['type'] = $types[$detail['type']];
        			$detail['statuscn'] = $status[$detail['status']];
        			$detail['proof'] = unserialize($detail['proof']);

        			if (!empty($detail['proof'])) {
        				foreach ($detail['proof'] as  $key => $value) {
	        				$detail['proof'][$key] = Thumb::get($value,100,100);
	        			}
        			}
        			
        			return $detail;
		}

		return array();
	}

	/**
	 * 获取合同信息
	 * @param  [Int] $orderId [合同id]
	 * @return [Array] 
	 */
	public function getContract($orderId, $type=1){
		$detail = array();
		if (intval($orderId) > 0) {
			$query = new  Query('order_sell as a ');
			switch ($type) {
				case 1:
					$query->fields = 'a.id, a.order_no, a.user_id, a.amount, c.name as pname, c.attribute, c.quantity, c.user_id as sell_user, d.name as cname, b.product_id';
					break;
				case 2:
					$query->fields = 'a.id, a.user_id, c.user_id as sell_user';
					break;
			}
			
			$query->join = 'LEFT JOIN product_offer as b ON a.offer_id=b.id LEFT JOIN products as c ON b.product_id=c.id LEFT JOIN product_category as d ON c.cate_id=d.id';
			$query->where = 'a.id = :id';
			$query->bind = array('id' => $orderId);
			$detail = $query->getObj();

			$detail['attribute'] = unserialize($detail['attribute']);
			$attrIds = array_keys($detail['attribute']);

			$productModel = new \nainai\offer\product();
			$detail['photos'] = $productModel->getProductPhoto($detail['product_id']);
			$detail['attrs'] = $productModel->getHTMLProductAttr($attrIds);

			return $detail;
		}

		return $detail;
	}

}

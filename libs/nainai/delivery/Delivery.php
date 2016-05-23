<?php
/**
 * @author panduo
 * @date 2016-05-12 15:41:58
 * @brief 提货基类
 *
 */
namespace nainai\delivery;
use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\url;
use nainai\order;
class Delivery{

	//提货状态常量
	const DELIVERY_APPLY = 0;//买方申请提货
	const DELIVERY_BUYER_CONFIRM = 1;//卖方已发货，等待买方确认 （保证金）
	const DELIVERY_MANAGER_CHECKOUT = 2;//卖方支付仓库费,等待仓库管理员确认出库（仓单）
	const DELIVERY_ADMIN_CHECK = 3;//等待后台管理员审核（仓单）
	const DELIVERY_AGAIN = 4;//余量大于20% 需再次提货
	const DELIVERY_COMPLETE = 5;//余量小于20%，提货结束，等待买方确认质量
	
	protected $delivery;//提货表M对象
	protected $order;//订单表M对象
	protected $order_type;//订单类型
	protected $offer;//报盘表
	protected $account;//用户资金类
	protected $paylog;//日志

	/**
	 * 规则
	 */
	protected $deliveryRules = array(
		array('id','number','id错误',0,'regex'),
		array('offer_id','number','报盘id错误',0,'regex'),
		array('delivery_id','number','订单id错误',0,'regex'),
	);


	public function __construct($order_type){
		$this->order = new M('product_order');
		$this->order_type = $order_type;
		$this->delivery = new M('product_delivery');
		$this->offer = new M('product_offer');
		$this->account = new \nainai\fund\agentAccount();
	}	

	/**
	 * 根据提货表id获取相应记录信息		
	 * @param  int $delivery_id 提货表id	
	 * @return array $res  信息数组
	 */
	public function deliveryInfo($delivery_id){
		return empty($delivery_id) ? array() : $this->delivery->where(array('id'=>$delivery_id))->getObj();
	}
	
	/**
	 * 新增或更新提货数据	
	 * @param  array $data 数据
	 * @return array $res  返回结果信息
	 */
	final protected function deliveryUpdate($data){
		$delivery = $this->delivery;
		if($delivery->data($data)->validate($this->deliveryRules)){
			if(isset($data['id']) && $data['id']>0){
				$id = $data['id'];
				//编辑
				unset($data['id']);
				$res = $delivery->where(array('id'=>$id))->data($data)->update();
				$res = $res>0 ? true : ($delivery->getError() ? $delivery->getError() : '数据未修改');
			}else{
				try {
					$delivery->beginTrans();
					$delivery_id = $delivery->data($data)->add();
					
					$res = $delivery->commit();	
				} catch (PDOException $e) {
					$delivery->rollBack();
					$res = $e->getMessage();
				}
			}
		}else{
			$res = $delivery->getError();
		}
		
		if($res === true){
			$resInfo = tool::getSuccInfo();
			if(isset($delivery_id)){
				$resInfo['delivery_id'] = $delivery_id;
			}
		}else{
			$resInfo = tool::getSuccInfo(0,is_string($res) ? $res : '系统繁忙，请稍后再试');
		}
		return $resInfo;
	}

	/**
	 * 验证提货数据是否已存在
	 * @param object $delivery 提货表对象
	 * @param array $deliveryData 提货数据
	 * @return bool  存在 true 否则 false
     */
	private function existdeliveryData($delivery,$deliveryData){
		$data = $delivery->fields('id')->where($deliveryData)->getObj();
		if(empty($data))
			return false;
		return true;
	}

	//处理买方提货申请，生成提货记录
	public function geneDelivery($deliveryData){
		$deliveryData['status'] = self::DELIVERY_APPLY;
		$order_info = $this->order->where(array('id'=>$deliveryData['order_id']))->fields('contract_status,offer_type,user_id,offer_id')->getObj();
		if($order_info['user_id'] == $deliveryData['user_id']){
			$contract_status = $order_info['contract_status'];
			//订单合同状态须为已生效,订单类型须为保证金或者仓单
			if(isset($contract_status) && $contract_status == order\Order::CONTRACT_EFFECT && in_array($order_info['offer_type'],array(order\Order::ORDER_DEPOSIT,order\Order::ORDER_STORE))){
				$product_valid = $this->orderNumValid($deliveryData['order_id'],$deliveryData['num']);
				if($product_valid !== true){
					$error = '提货数量有误';
				}else{
					unset($deliveryData['user_id']);
					$deliveryData['offer_id'] = $order_info['offer_id'];
					$deliveryData['create_time'] = date('Y-m-d H:i:s',time());
					$res = $this->deliveryUpdate($deliveryData);
				}
			}else{
				$error = '无效订单';
			}
		}else{
			$error = '操作用户错误';
		}
		return isset($res) ? $res : tool::getSuccInfo(0,$error);
	}

	/**
	 * 检验当前提货申请货物数量是否合法		
	 * @param  int $order_id 待提货订单id
	 * @param  float $num    申请提货数量
	 * @return bool  $res    true:合法 false:不合法
	 */
	public function orderNumValid($order_id,$num){
		$num = floatval($num);
		if(empty(intval($order_id)) || $num <= 0) return false;

		//查询订单商品总数
		$total_num = $this->order->where(array('id'=>$order_id))->getfield('num');
		if(empty(floatval($total_num))) return false;

		//查询对应订单id所有提货记录
		$record = $this->delivery->where(array('order_id'=>$order_id))->select();
		if(empty($record)){
			return $num <= $total_num ? true : false;
		}else{
			$record_num = 0;
			foreach ($record as $key => $value) {
				$record_num += $value['num'];
			}
			return $total_num - $record_num < 0 ? false : ($num <= ($total_num - $record_num) ? true : false);
		}
	}

	/**
	 * 检验订单未提货物百分比	
	 * @param  int $order_id 订单id
	 * @return mix $res      float:百分比 string:错误信息
	 */
	public function orderNumLeft($order_id){
		if(empty(intval($order_id))) return '参数错误';

		//查询订单商品总数
		$total_num = $this->order->where(array('id'=>$order_id))->getfield('num');
		if(empty(floatval($total_num))) return '无效订单';

		//查询对应订单id所有提货记录
		$record = $this->delivery->where(array('order_id'=>$order_id))->select();

		if(empty($record)){
			return 1.0;
		}else{
			$record_num = 0;
			foreach ($record as $key => $value) {
				switch ($value['status']) {
					case self::DELIVERY_AGAIN:
						$record_num += $value['num'];
						break;
					case self::DELIVERY_COMPLETE:
						return '此订单已提货完毕';
					default:
						continue;
						break;
				}
			}
			return (floatval($total_num) - floatval($record_num)) / floatval($total_num);
		}
	}


}
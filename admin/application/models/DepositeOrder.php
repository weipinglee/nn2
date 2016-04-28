<?php
/**
 * @date 2016-4-25
 * 保证金订单表 暂只支持余额支付
 *
 */
use \Library\M;
use \Library\Query;
use \Library\tool;
use nainai;
class DepositeOrderModel{

	//合同制状态常量
	const CONTRACT_NOTFORM = 0;//合同未形成
	const CONTRACT_SELLER_DEPOSITE = 1;//合同等待卖家缴纳保证金
	const CONTRACT_CANCEL = 2;//卖家未按时支付保证金合同作废
	const CONTRACT_EFFECT = 3;//支付完成合同生效
	const CONTRACT_BUYER_RETAINAGE = 4;//卖家支付保证金后等待接受尾款
	const CONTRACT_COMPLETE = 5;//提货完成 合同完成

	private $order;//订单表
	private $offer;//报盘表

	public function __construct(){
		$this->order = new M('deposite_order');
		$this->offer = new M('product_offer');
	}

	/**
	 * 规则
	 */
	protected $ordeRules = array(
		array('id','number','id错误',0,'regex'),
		array('offer_id','number','报盘id错误',0,'regex'),
		array('user_id','number','买方id错误',0,'regex'),
	);


	/**
	 * 新增或编辑保证金订单
	 * @param  array 操作数据数组
	 * @return mixed
	 */
	public function orderUpdate($data){
		$order = $this->order;
		if($order->data($data)->validate($this->orderRules)){
			if(isset($data['id']) && $data['id']>0){
				$id = $data['id'];
				//编辑
				unset($data['id']);
				$res = $order->where(array('id'=>$id))->data($data)->update();
				$res = is_int($res) && $res>0 ? true : ($order->getError() ? $order->getError() : '数据未修改');
			}else{
				while($this->existOrderData(array('order_no'=>$data['order_no']))){
					$data['order_no'] = create_uuid();
				}
				
				$order->beginTrans();
				$aid = $order->add();
				//TODO
				$res = $order->commit();
			}
		}else{
			$res = $order->getError();
		}
	
		
		if($res===true){
			$resInfo = tool::getSuccInfo();
		}
		else{
			$resInfo = tool::getSuccInfo(0,is_string($res) ? $res : '系统繁忙，请稍后再试');
		}
		return $resInfo;
	}

	/**
	 * 验证订单数据是否已存在
	 * @param array $orderData 订单数据
	 * @return bool  存在 true 否则 false
     */
	public function existOrderData($orderData){
		$data = $this->order->fields('id')->where($orderData)->getObj();
		if(empty($data))
			return false;
		return true;
	}


	//生成保证金摘牌订单
	public function geneOrder($orderData){
		$orderData['contract_status'] = self::CONTRACT_NOTFORM;
		$offer_info = $this->offerInfo($orderData['offer_id']);
		if(is_array($offer_info) && $offer_info['price']>0){
			$orderData['amount'] = $offer_info['price'] * $orderData['num'];
			return $this->orderUpdate($orderData);
		}else{
			$res = tool::getSuccInfo(0,'无效报盘');
		}
	}

	//买方预付定金(全款或定金)
	public function buyerDeposite($orderData){
		if(isset($orderData) && isset($orderData['id'])){
			//获取报盘信息 计算总金额
			$orderData['contract_status'] = self::CONTRACT_SELLER_DEPOSITE;//合同状态置为等待卖方保证金支付
			$orderData['pay_deposite'] = 1;//买方支付定金  通过设置比率
			$res = $this->orderUpdate($orderData);//TODO此处单独写进事务
			if($res['success'] == 1){
				$info = $this->orderInfo($orderData['id']);
				//根据订单金额冻结用户余额
				return tool::getSuccInfo();
			}else{
				return $res;
			}
		}else{
			return tool::getSuccInfo(0,'未指定订单id');
		}
	}

	//卖方支付保证金
	public function sellerDeposite($order_id,$pay = true){
		if(($order_id = intval($order_id)) > 0 ){
			$account = new agentAccount();
			if($pay === false){
				//未支付 合同取消
				$orderData['contract_status'] = self::CONTRACT_CANCEL;
			}elseif($pay === true){
				//卖方支付保证金
				
				//判断此订单是否支付全款
				$info = $this->orderInfo($order_id);
				if($info['payment'] === 0){
					//定金 等待支付尾款
					$orderData['contract_status'] = self::CONTRACT_BUYER_RETAINAGE;
				}else{
					//全款 合同生效 等待提货 生成提货表
					$orderData['contract_status'] = self::CONTRACT_EFFECT;
				}
			}else{
				return tool::getSuccInfo(0,'参数错误');
			}

			try {
				$this->order->beginTrans();
				if($pay === true){
					//冻结卖方帐户保证金
					$account->freeze();
				}else{
					//扣除信誉值
				}
				$this->orderUpdate($orderData);	
				$res = $this->order->commit();
			} catch (PDOException $e) {
				$res = $e->getMessage();
				$this->order->rollBack();
			}

			return $res === true ? tool::getSuccInfo() : tool::getSuccInfo(0,$res ? $res : '未知错误');
		}else{
			return tool::getSuccInfo(0,'参数错误');
		}
	}


	//买家支付尾款
	public function buyerRetainage($order_id,$payment='online'){
		$info = $this->orderInfo($order_id);
		if(is_array($info) && isset($info['contract_status'])){
			if($info['contract_status'] == 4){
				$amount = $info['amount'];
				$buyerDeposite = $info['pay_deposite'];
				$retainage = $amount - $buyerDeposite;

				if($retainage>0){
					if($payment == 'online'){
						//冻结买家帐户余额
						//支付到平台
					}elseif($payment == 'offline'){
						//买方上传支付凭证
					}else{
						$res = tool::getSuccInfo(0,'无效支付方式');
					}
				}
			}
		}else{
			$res = tool::getSuccInfo(0,'无效保证金订单');
		}

		return $res;
	}

	//根据订单id获取订单内容	
	public function orderInfo($order_id){
		return $this->deposite->where(array('id'=>$order_id))->getObj();
	}


	//根据报盘id获取相应信息
	public function offerInfo($offer_id){
		$query = new Query('product_offer as po');
		$query->join = 'left join user as u on po.user_id = u.id';
		$query->where = " po.id = :id";
		$query->bind(array('id'=>$offer_id));
		$query->fields = "po.*,u.username";
		$res = $query->getObj();
		return $res ? $res : array();
	}

}





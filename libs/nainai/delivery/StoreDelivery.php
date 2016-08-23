<?php
/**
 * @author panduo
 * @date 2016-05-13 10:42:05
 * @brief 仓单提货
 *
 */
namespace nainai\delivery;
use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\url;
use \Library\time;

use nainai\order;
class StoreDelivery extends Delivery{
	
	public function __construct(){
		parent::__construct(order\Order::ORDER_STORE);
		$this->orderObj = new order\Order();
	}

	/**
	 * 获取卖方支付仓库管理费时的相关详情
	 * @param  int $delivery_id 提货表id
	 * @return array 结果
	 */
	public function storeFees($delivery_id){
		$query = new Query('product_delivery as pd');
		$query->join = 'left join product_offer as po on pd.offer_id = po.id left join store_products as sp on sp.product_id = po.product_id left join store_list as sl on sp.store_id = sl.id left join products as p on po.product_id = p.id left join order_sell as o on pd.order_id = o.id';
		$query->fields = 'p.img,pd.num as delivery_num,sp.store_price,sp.store_unit,sp.in_time,sp.rent_time,pd.id,sl.name as store_name,p.name,p.unit,o.amount,po.price,o.num, po.product_id';
		$query->where = 'pd.id=:id';
		$query->bind = array('id'=>$delivery_id);
		$res = $query->getObj();
		$pro = new \nainai\offer\product();
		$photos = $pro->getProductPhoto($res['product_id']);
		$res['photos'] = $photos[1];
		$res['origphotos'] = $photos[0];
		$res['img_thumb'] = $res['photos'][0];
		$days = 1;
		switch ($res['store_unit']) {

			case 'd':
				break;
			case 'm':
				$days = 30;
				break;
			case 'y':
				$days = 365;
				break;
			default:
				# code...
				break;
		}
		$tmp_time = strtotime($res['in_time']);
		$next_day = strtotime(date('Y-m-d',strtotime('next day',$tmp_time)));

		$total_days = $next_day < time() ? ceil((time()-$next_day)/86400)+1 : 1.0;
		$res['store_fee'] = number_format($res['store_price'] * $res['delivery_num'] * $total_days/$days ,2);
		$res['now_time'] = time::getDateTime();
		return $res;
	}

	/**
	 * 卖方支付仓库管理费用
	 * @param  int $delivery_id 提货表id	
	 * @param  int $user_id     当前操作用户id
	 * @return array $res       返回信息数组
	 */
	public function payStoreFees($delivery_id,$seller_id){
		//获取提货id对应报盘信息
		$query = new Query('product_delivery as pd');
		$query->join = 'left join product_offer as po on pd.offer_id = po.id left join order_sell as o on o.id=pd.order_id';
		$query->fields = 'pd.*,po.id as offer_id,po.user_id,po.mode,po.type,o.order_no';
		$query->where = 'pd.id=:id';
		$query->bind = array('id'=>$delivery_id);
		$res = $query->getObj();

		if($res['user_id'] != $seller_id) $error = '当前操作用户有误';

		if($res['mode'] != order\Order::ORDER_STORE) $error = '订单类型须为仓单订单';

		if($res['status'] != parent::DELIVERY_APPLY) $error =  '提货状态错误';

		if(!isset($error)){
			$deliveryData['id'] = $delivery_id;
			$deliveryData['status'] = parent::DELIVERY_MANAGER_CHECKOUT;//提货状态置为等待仓库管理员确认出库
			try {
				$this->delivery->beginTrans();
				$upd_res = $this->deliveryUpdate($deliveryData);
				if($upd_res['success'] == 1){
					//卖方支付仓库费 TODO计算仓库费用
					$storeFees = $this->storeFees($delivery_id);
					$store_fee = floatval($storeFees['store_fee']);
					if($store_fee < 0){
						$error = '仓库费用计算错误';
					}else{
						$note = '支付提单'.$delivery_id.'仓库费用';
						$acc_res = $this->account->payMarket($res['user_id'],$store_fee,$note);//?支付到市场？
						if($acc_res === true){
							$pay_detail = new \nainai\fund\paytoMarket();
							$pay_detail->paytoMarket($seller_id,$res['type'],1,$res['offer_id'],$store_fee,$note,$res['order_no']);
							$this->delivery->commit();
							return tool::getSuccInfo();
						}else{
							$error = $acc_res['info'];
						}
					}
				}else{
					$error = $upd_res['info'];
				}
			} catch (PDOException $e) {
				$error = $e->getMessage();
				$this->delivery->rollBack();
			}
		}

		return tool::getSuccInfo(0,$error);
		
	}

	/**
	 * 获取仓库管理员所有待审核提货订单
	 * @param  int $page    当前页
	 * @param  int $user_id 管理员id
	 * @return array    列表
	 */
	public function storeCheckList($page,$user_id){
		$query = new Query('product_delivery as pd');
		$query->join = 'left join order_sell as o on pd.order_id = o.id left join product_offer as po on pd.offer_id = po.id left join store_products as sp on sp.product_id = po.product_id left join store_manager as sm on sm.store_id = sp.store_id left join store_list as sl on sl.id = sp.store_id';
		$query->where = 'sm.user_id=:user_id and pd.status = '.\nainai\delivery\Delivery::DELIVERY_MANAGER_CHECKOUT.' and po.mode='.\nainai\order\Order::ORDER_STORE;
		$query->fields = 'pd.id,o.order_no,pd.num as delivery_num,sl.name as store_name';
		$query->bind = array('user_id'=>$user_id);
		$query->order = 'pd.create_time desc';
		$query->page = $page;
		$query->pagesize = 10;
		$res = $query->find();
		$pageBar =  $query->getPageBar();
		return array('data'=>$res,'bar'=>$pageBar);
	}

	/**
	 * 仓库管理员确认出库
	 * @param  int $delivery_id 提货表Id
	 * @return array $res  返回结果信息
	 */
	public function managerCheckout($delivery_id){
		$delivery = $this->deliveryInfo($delivery_id);
		if($delivery && $delivery['status'] == parent::DELIVERY_MANAGER_CHECKOUT){
			$deliveryData['id'] = $delivery_id;
			$deliveryData['status'] = parent::DELIVERY_ADMIN_CHECK;//等待后台管理员进行审核
			return $this->deliveryUpdate($deliveryData);
		}else{
			return tool::getSuccInfo(0,'无效订单');
		}
	}



	/**
	 * 后台管理员审核仓单摘牌订单列表
	 * @param int $page 当前页
	 * @param string $where 条件字符串
	 * @param int $is_checked 0:未审核 1:已审核
	 */
	public function storeOrderList($page = 1,$where = '',$is_checked = 0){
		$query = new Query('order_sell as o');
		$query->join = 'left join product_offer as po on o.offer_id = po.id left join products as p on po.product_id = p.id left join product_category as pc on p.cate_id = pc.id left join product_delivery as pd on pd.order_id = o.id left join store_products as sp on p.id = sp.product_id left join store_list as sl on sp.store_id = sl.id';
		$query->fields = 'o.*,p.name as product_name,pc.name as cate_name,sl.name as store_name,pd.create_time as delivery_time,p.unit,pd.num as delivery_num,pd.id as delivery_id';
		$relation = $is_checked ? '> ' : '= ';
		$sql_where = 'o.mode='.\nainai\order\Order::ORDER_STORE.' and pd.status '.$relation.\nainai\delivery\Delivery::DELIVERY_ADMIN_CHECK;
		if($where) $sql_where .= ' and '.$where;
		$query->where = $sql_where;
		$query->order = 'pd.create_time desc';
		$query->page = $page;
		$query->pagesize = 5;
		$list = $query->find();
		return array('data'=>$list,'bar'=>$query->getPageBar());
	}	

	/**
	 * 获取后台审核订单详细信息
	 * @param  int $delivery_id 提货单号
	 * @return array  结果
	 */
	public function storeOrderDetail($delivery_id,$is_checked = 0){
		$info = $this->storeOrderList(NULL,'pd.id='.$delivery_id,$is_checked);
		return $info['data'][0];
	}

	/**
	 * 后台管理员进行审核
	 * @param  int $delivery_id 提货表Id
	 * @return array $res  返回结果信息
	 */
	public function adminCheck($delivery_id){
		//获取对应订单信息
		$query = new Query('product_delivery as pd');
		$query->join = 'left join order_sell as po on pd.order_id = po.id';
		$query->fields = 'pd.*,po.user_id,po.mode,po.id as order_id,po.num as total_num';
		$query->where = 'pd.id=:id';
		$query->bind = array('id'=>$delivery_id);

		$delivery = $query->getObj();
		if($delivery && $delivery['status'] == parent::DELIVERY_ADMIN_CHECK && $delivery['mode'] == order\Order::ORDER_STORE){
			//计算货物余量
			$left = $this->orderNumLeft($delivery['order_id'],true,true);
			if(is_float($left)){
				$left -= floatval($delivery['num']) / floatval($delivery['total_num']);
				$deliveryData['id'] = $delivery_id;
				if($left > 0.20){
					//货物余量大于20% 本次提货结束 等待买家进行第二次提货
					$deliveryData['status'] = parent::DELIVERY_AGAIN;
				}else{
					//货物余量小于等于20% 提货流程结束 
					$deliveryData['status'] = parent::DELIVERY_COMPLETE;
				}
				try {
					$order = new M('order_sell');
					$order->beginTrans();
					$this->deliveryUpdate($deliveryData);
					$this->orderObj->orderUpdate(array('id'=>$delivery['order_id'],'contract_status'=>order\Order::CONTRACT_DELIVERY_COMPLETE));
					$order->commit();	
				} catch (\PDOException $e) {
					$order->rollBack();
					$error = $e->getMessage();
				}
				
			}else{
				$error = $left;
			}
		}else{
			$error = '订单状态有误';
		}

		return isset($error) ? tool::getSuccInfo(0,$error) : tool::getSuccInfo();
	}
}
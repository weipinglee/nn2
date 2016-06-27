<?php
/**
 * 报盘模型
 */

use \Library\M;
use \Library\Query;
use \Library\tool;
use \Library\Thumb;
class OfferManageModel extends \nainai\offer\product{

	//模型对象实例
	private $offer;

	public function __construct(){
		parent::__construct();
		$this->offer = new M('product_offer');
	}
	

	/**
	 * 获取列表
	 * @param  int $page 当前页index
	 * @return array
	 */
	private function getList($page,$where =''){
		$Q = new Query('product_offer as o');
		$Q->join = "left join products as p on o.product_id = p.id left join user as u on o.user_id = u.id";
		$Q->fields = "o.*,u.username,p.quantity,p.unit";
		if($where) $Q->where = $where;
		$Q->page = $page;
		$Q->pagesize = 20;
		// $Q->order = "sort";
		$sql = 'select count(*) as count from product_offer as o '.($where ? ' where '.$where : '');
		$count = $this->offer->query($sql);
		$data = $Q->find();

		foreach ($data as $key => &$value){
			$value['quantity'] = $this->floatForm($value['quantity']);
			$value['mode_txt'] = $this->getMode($value['mode']);
			$value['mode_txt'] = $value['mode_txt']=='未知' ? '--' : $value['mode_txt'];
			$value['status_txt'] = $this->getStatus($value['status']);

				$value['type_txt'] = $this->getType($value['type']);
		}

		$pageBar =  $Q->getPageBar();
		return array('data'=>$data,'bar'=>$pageBar,'count'=>$count[0]['count']);
	}

	/**
	 * 获取正常的报盘信息
	 * @param $page
	 * @return array
	 */
	public function  getActiveList($page){
		return $this->getList($page,'o.is_del = 0 and o.status = '.self::OFFER_OK);
	}

	/**
	 * 获取待审核的报盘
	 *
	 */
	public function getApplyList($page){
		return $this->getList($page,'o.is_del = 0 and o.status = '.self::OFFER_APPLY);
	}

	/**
	 * 获取已删除的报盘
	 *
	 */
	public function getDelList($page){
		return $this->getList($page,'o.is_del = 1 ');
	}


	/**
	 * 获取信息
	 * 
	 * @param  int $id 
	 * @return array  信息
	 */
	public function getofferDetail($id){
		$obj = new M('product_offer');
		$info = $obj->where(array('id'=>$id))->getObj();
		if(!empty($info)){
			$info['type'] = $this->getType($info['type']);
			$info['mode_txt'] = $this->getMode($info['mode']);
			$info['mode_txt'] = $info['mode_txt'] == '未知' ? '--' : $info['mode_txt'];
			$info['status_txt'] = $this->getStatus($info['status']);
			$product = $this->getProductDetails($info['product_id']);
			$info = array_merge($info,$product);


		}
		return $info ? $info : array();
	}


	/**
	 * 更新审核状态
	 * @param int $id 报盘id
	 * @param int $status
	 */
	public function setStatus($id,$status){
		if(!($id = intval($id))) return tool::getSuccInfo(0,'参数错误');
		$status = isset($status) ? intval($status) : 1;

		$offerData = $this->offer->where(array('id'=>$id))->fields('user_id,acc_type,mode,offer_fee,status')->getObj();

		if($offerData['status']!=self::OFFER_APPLY){
			return tool::getSuccInfo(0,'该报盘已审核');
		}

		try {
			$this->offer->beginTrans();
			$status = $status==1 ? self::OFFER_OK : self::OFFER_NG;

			$res=true;
			//如果是自由报盘，扣费或释放资金
			if($offerData['mode'] == self::FREE_OFFER){
				$fund = \nainai\fund::createFund($offerData['acc_type']);
				if($status==self::OFFER_OK){//通过扣费
					$note = '扣除id为'.$id.'的自由报盘报盘费用';
					$res = $fund->freezePay($offerData['user_id'],0,floatval($offerData['offer_fee']),$note);
				}
				else{
					$note = '释放id为'.$id.'自由报盘报盘费用';
					$res = $fund->freezeRelease($offerData['user_id'],floatval($offerData['offer_fee']),$note);
				}
			}

			if($res===true){
				$base = new baseModel($this->offer);
				$base->where(array('id'=>$id))->update(array('status'=>$status));
				$log = new \Library\log();
				$log->addLog(array('table'=>'报盘','type'=>'check','id'=>$id,'check_text'=>$this->getStatus($status)));

				if($status==1){//审核通过增加信誉值
					$credit = new \nainai\CreditConfig();
					$credit->changeUserCredit($offerData['user_id'],'product');
				}
			}
			else{//付款发生错误
				$this->offer->rollBack();
				return tool::getSuccInfo(0,isset($res['info'])?$res['info'] : '系统错误');
			}

			$res = $this->offer->commit();
		} catch (PDOException $e) {
			$this->offer->rollBack();
			$res = $e->getMessage();
		}
		return $res == true ? tool::getSuccInfo() : tool::getSuccInfo(0,(is_string($res) && $res) ? $res : '未知错误');
	}





	/**
	 * 删除
	 * @param  int $id 
	 */
	public function offerDel($id){
		$offer = $this->offer;
		if(($id = trim($id))){
			try {
				$offer->beginTrans();

				$offer->where(array('id'=>$id))->delete();

				$res = $offer->commit();
			} catch (PDOException $e) {
				$offer->rollBack();
				$res = $e->getMessage();
			}
			
		}else{
			$res = '参数错误';
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
	 * 逻辑删除报盘
	 * @param int  $id 报盘id
	 * @param int $direct 1:删除，0：复原
	 */
	public function logicDel($id,$direct=1){
		$offer = $this->offer;
		$direct = $direct==1 ? 1 : 0;
		if($id = trim($id)){
			try {
				$offer->beginTrans();
				$this->offer->where(array('id'=>$id))->data(array('is_del'=>$direct))->update();
				$res = $offer->commit();
			} catch (PDOException $e) {
				$offer->rollBack();
				$res = $e->getMessage();
			}

		}else{
			$res = '参数错误';
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
	 *
	 * @param $offer_id
	 * @param $kefu_id
	 */
	public function addKefu($offer_id,$kefu_id){
		if($offer_id && $kefu_id){
			$this->offer->beginTrans();
			$this->offer->where(array('id'=>$offer_id))->data(array('kefu'=>$kefu_id))->update();
			$log  = new \Library\log();
			$log->addLog(array('content'=>'为报盘'.$offer_id.'绑定客服'.$kefu_id));
			$res = $this->offer->commit();
			if($res===true){
				return tool::getSuccInfo();
			}
			return tool::getSuccInfo(0,'绑定失败');
		}
		else{
			return tool::getSuccInfo(0,'操作错误');
		}
	}

	/**
	 * 获取当前登录客服的报盘
	 * @param $page
	 * @return array
	 */
	public function getKefuOfferList($page){
		$admin = \Library\session::get('admin');
		$admin_id = $admin['id'];
		if($admin_id>0){
			$data = $this->getList($page,'o.kefu='.$admin_id);
			return $data;
		}
		return array();
	}

	
}
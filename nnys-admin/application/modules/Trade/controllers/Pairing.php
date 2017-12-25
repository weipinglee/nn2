<?php 

/**
 * 合同撮合人管理
 */
use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
use \Library\session;
class PairingController extends Yaf\Controller_Abstract{

	private $pairing;
	private $order;
	public function init(){
		$this->pairing = new pairingModel();
		$this->order = new \nainai\order\Order();
		$this->getView()->setLayout('admin');
		//echo $this->getViewPath();
	}

	public function allContractListAction(){
		$page = safe::filterGet('page','int',1);
		$name = safe::filter($this->_request->getParam('name'));

		$list = $this->order->memberContractList($page,$name ? 'do.order_no like "%'.$name.'%"' : '');
		// var_dump($list);
		$this->getView()->assign('data',$list);
	}

	//获取所有状态为已生效及之后（不为已完成）状态的合同
	public function contractListAction(){
		$page = safe::filterGet('page','int',1);
		$name = safe::filter($this->_request->getParam('name'));

		$list = $this->pairing->contractList($page,$name ? 'o.order_no like "%'.$name.'%"' : '');

		$this->getView()->assign('list',$list['data']);
		$this->getView()->assign('name',$name);
		$this->getView()->assign('page',$list['bar']);
	}


	//详情
	public function contractDetailAction(){
		$id = safe::filter($this->_request->getParam('id'));
		$pairing_id = safe::filter($this->_request->getParam('pairing_id'));
		$info = $this->pairing->contractDetail($id);
		$info['pairing_id'] = $pairing_id;
		$admin_list = $this->pairing->managerList($info['admin_id']);
		$this->getView()->assign('admin_list',$admin_list);
		$this->getView()->assign('info',$info);
		
	}

	//添加撮合人员
	public function addPairingAction(){
		$pairing_id = safe::filterPost('pairing_id','int');
		$data['order_id'] = safe::filterPost('order_id','int');
		$data['admin_id'] = safe::filterPost('admin_id','int');
		if($pairing_id) $data['id'] = $pairing_id;
		if($data['admin_id'] < 0) die(JSON::encode(tool::getSuccInfo(0,'未选择撮合人员')));
		$res = $this->pairing->pairingUpdate($data);
		die(JSON::encode($res));
	}

	//撮合人员未完成合同列表
	public function pairingContractListAction(){
		$admin = session::get('admin');
		$page = safe::filterGet('page','int',1);
		$name = safe::filter($this->_request->getParam('name'));

		$where = 'o.contract_status!='.\nainai\order\Order::CONTRACT_COMPLETE;
		if($name){
			$where .= 'o.order_no like "%'.$name.'%"';
		}
		$list = $this->pairing->contractList($page,$where,$admin['id']);
		$this->getView()->assign('data',$list);
	}

	//撮合人员已完成合同列表
	public function pairingContractComListAction(){
		$admin = session::get('admin');
		$page = safe::filterGet('page','int',1);
		$name = safe::filter($this->_request->getParam('name'));
		$where = 'o.contract_status='.\nainai\order\Order::CONTRACT_COMPLETE;
		if($name){
			$where .= 'o.order_no like "%'.$name.'%"';
		}
		$list = $this->pairing->contractList($page,$where,$admin['id']);
		$this->getView()->assign('data',$list);
	}

	//交易完结待确认的合同列表
	public function tradeComplateListAction(){
		$page = safe::filterGet('page','int',1);
		$name = safe::filter($this->_request->getParam('name'));
		$where = 'o.contract_status='.\nainai\order\Order::CONTRACT_ADMIN_CHECK;
		if($name){
			$where .= 'o.order_no like "%'.$name.'%"';
		}

		$list = $this->pairing->contractList($page,$where);

		$this->getView()->assign('data',$list);
	}

	public function tradeComplateDetailAction(){
		$id = safe::filter($this->_request->getParam('id'));

		$info = $this->pairing->contractDetail($id);

		//TODO:获取最后一笔提货单信息
		$this->getView()->assign('info',$info);
	}

	/**
	 * 交易完结确认单提交处理
	 */
	public function doTradeComplateAction(){
		if(IS_POST){
            $order_id = safe::filterPost('order_id','int');
			$status = safe::filterPost('status','int',1);

			$res = $this->order->doTradeComplate($order_id,$status);
			die(json::encode($res));
		}
	}

}
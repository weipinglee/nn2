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
	public function init(){
		$this->pairing = new pairingModel();
		$this->getView()->setLayout('admin');
		//echo $this->getViewPath();
	}

	//获取所有状态为已生效及之后状态的合同
	public function contractListAction(){
		$page = safe::filterGet('id','int',1);
		$name = safe::filter($this->_request->getParam('name'));
		$list = $this->pairing->contractList($page,$name ? 'o.order_no like "%'.$name.'%"' : '');
		$this->getView()->assign('list',$list['data']);
		$this->getView()->assign('name',$name);
		$this->getView()->assign('page',$list['bar']);
	}

	//详情
	public function contractDetailAction(){
		$id = safe::filter($this->_request->getParam('id'));
		$info = $this->pairing->contractDetail($id);
		if(!isset($info['admin_id'])){
			$admin_list = $this->pairing->managerList();
			$this->getView()->assign('admin_list',$admin_list);
		}
		$this->getView()->assign('info',$info);
		
	}

	//添加撮合人员
	public function addPairingAction(){
		$data['order_id'] = safe::filterPost('order_id','int');
		$data['admin_id'] = safe::filterPost('admin_id','int');
		if($data['admin_id'] < 0) die(JSON::encode(tool::getSuccInfo(0,'未选择撮合人员')));
		$res = $this->pairing->pairingUpdate($data);
		die(JSON::encode($res));
	}

	//撮合人员合同列表
	public function pairingContractListAction(){
		$admin = session::get('admin');
		$page = safe::filterGet('id','int',1);
		$name = safe::filter($this->_request->getParam('name'));
		$list = $this->pairing->contractList($page,$name ? 'o.order_no like "%'.$name.'%"' : '',1);//$admin['id']);
		$this->getView()->assign('list',$list['data']);
		$this->getView()->assign('name',$name);
		$this->getView()->assign('page',$list['bar']);
	}
}
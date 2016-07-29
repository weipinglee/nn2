<?php 

/**
 * 合同撮合人管理
 */
use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
use \Library\session;
class PairingController extends InitController{

	private $pairing;
	public function init(){
		$this->pairing = new pairingModel();
		$this->getView()->setLayout('admin');
		//echo $this->getViewPath();
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

	/**
	 * 合同查询信息列表
	 */
	public function contractInfoListAction(){
		$page = safe::filterGet('page','int',1);
		$begin = Safe::filterGet('begin');
		$end = Safe::filterGet('end');
		$down = Safe::filterGet('down', 'int', 0);
		$condition = array();
		$condition['down'] = $down;
		$condition['name'] = '合同查询信息列表';

		if (empty($begin)) {
			$begin = \Library\Time::getDateTime('Y-m-d');
		}

		if (empty($end)) {
			$end = \Library\Time::getDateTime('Y-m-d');
		}
		$_GET['begin'] =  $begin . ' 00:00:00';
		$_GET['end'] = $end . ' 23:59:59';

		$list = $this->pairing->contractList($page, '', 0, false, $this->pagesize, $condition);
		$ids = array();
		foreach ($list['list'] as $key => $value) {
			if (!empty($value['user_id']) && !in_array($value['user_id'], $ids)) {
				$ids[] = $value['user_id'];
			}

			if (!empty($value['sell_uid']) && !in_array($value['sell_uid'], $ids)) {
				$ids[] = $value['sell_uid'];
			}
		}
		$product = new \nainai\offer\product();
		$modeArray = $product->getModelArray();
		$user = new \nainai\user\User();
		if (!empty($ids)) {
			$names = $user->getNamesList($ids);
			$this->getView()->assign('names',$names);
		}
		if ($down == 1) {
			$excel = array(0 => array('合同编号', '合同开始日期',  '商品名称', '买方名称', '卖方名称', '报盘类型', '成交数量', '合同金额', '合同状态'));
			
			foreach ($list['list'] as $key => $value) {
				$item = array();
				$item['order_no'] = $value['order_no'];
				$item['create_time'] = $value['create_time'];
				$item['product_name'] = $value['product_name'];
				$item['buy_name'] = $names[$value['user_id']];
				$item['sell_name'] = $names[$value['sell_uid']];
				$item['mode'] = $modeArray[$value['mode']];
				$item['num'] = $value['num'] .'(' .$value['unit']. ')';
				$item['amount'] = $value['amount'];
				$item['title'] = $value['title'];
				array_push($excel, $item);
			}
			$obj = new \Library\Excel\ExcelHtml();
			$obj->createExecl($excel, count($excel[0]), "{$begin}至{$end}{$condition['name']}信息报表");
			exit();
		}

		$this->getView()->assign('begin', $begin);
		$this->getView()->assign('end', $end);
		$this->getView()->assign('isDown', 1);
		$this->getView()->assign('data',$list);
		$this->getView()->assign('modeArray',$modeArray);
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
		$list = $this->pairing->contractList($page,$name ? 'o.order_no like "%'.$name.'%"' : '',$admin['id']);
		$this->getView()->assign('list',$list['data']);
		$this->getView()->assign('name',$name);
		$this->getView()->assign('page',$list['bar']);
	}

	//撮合人员已完成合同列表
	public function pairingContractComListAction(){
		$admin = session::get('admin');
		$page = safe::filterGet('page','int',1);
		$name = safe::filter($this->_request->getParam('name'));
		$list = $this->pairing->contractList($page,$name ? 'o.order_no like "%'.$name.'%"' : '',$admin['id'],true);
		$this->getView()->assign('list',$list['data']);
		$this->getView()->assign('name',$name);
		$this->getView()->assign('page',$list['bar']);
	}
}
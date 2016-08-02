<?php 

/**
 * 系统配置项控制器
 */
use \Library\safe;
use \Library\tool;
use \Library\JSON;
use \Library\url;
class ConfsystemController extends Yaf\Controller_Abstract{

	private $confcredit;
	public function init(){
		$this->confcredit = new \config\confcreditModel();
		$this->confscaleOffer = new \config\confscaleOfferModel();
		$this->getView()->setLayout('admin');
		//echo $this->getViewPath();
	}

	/**
	 * 获取信誉值配置列表
	 * @return 
	 */
	public function creditListAction(){
		$page = safe::filterGet('page','int');
		$pageData = $this->confcredit->getList($page);
		$this->getView()->assign('data',$pageData['data']);
		$this->getView()->assign('bar',$pageData['bar']);
	}
	
	/**
	 * 新增或修改信誉值配置
	 */

	public function creditOperAction(){
		if(IS_AJAX){
			$oper_type = safe::filterPost("oper_type","int");
			$confcreditData['name'] 	= safe::filterPost('name');
			$confcreditData['name_zh']  = safe::filterPost('name_zh');
			$confcreditData['type']     = safe::filterPost('type','int');
			$confcreditData['sign']     = safe::filterPost('sign','int');
			$confcreditData['value']    = safe::filterPost('value','float');
			$confcreditData['sort']     = safe::filterPost('sort','int');
			$confcreditData['note']     = safe::filterPost('note');
			if($oper_type == 1){
				//新增
				$confcreditData['time']    = date("Y-m-d H:i:s",time());
			}else{
				//更新
				$confcreditData['ori_name'] = safe::filterPost('ori_name');
			}
			$res = $this->confcredit->confcreditUpdate($confcreditData);
			echo JSON::encode($res);
			return false;
		}else{
			$oper_type = intval($this->_request->getParam('oper_type'));
			if($oper_type == 2){
				$oper = "编辑";
				$name = $this->_request->getParam('name');
				$confcreditInfo = $this->confcredit->getconfcreditInfo($name);
				$this->getView()->assign('info',$confcreditInfo);
			}else{
				$oper = "新增";
			}
			$this->getView()->assign('oper',$oper);
			$this->getView()->assign('oper_type',$oper_type);
		}
	}

	/**
	 * 删除信誉值
	 */
	public function creditDelAction(){
		$name = $this->_request->getParam('name');
		$res = $this->confcredit->creditDel($name);
		die(JSON::encode($res));
	}


	/**
	 * 修改交易费率配置
	 */

	public function scaleOfferOperAction(){
		if(IS_AJAX){
			$confscaleOfferData['free'] 	= safe::filterPost('free');
			$confscaleOfferData['deposite'] = safe::filterPost('deposite');
			$confscaleOfferData['fee']      = safe::filterPost('fee');
			$confscaleOfferData['id']		= 1;
			$res = $this->confscaleOffer->confscaleOfferUpdate($confscaleOfferData);
			echo JSON::encode($res);
			return false;
		}else{
			$confscaleOfferInfo = $this->confscaleOffer->getconfscaleOfferInfo(1);
			$this->getView()->assign('info',$confscaleOfferInfo);
		}
	}


	/**
	 * 配置项的添加
	 */
	public function addConfigAction(){
		$configObj = new \config\configsModel();
		if(IS_POST){
			$config = array();
			$config['name'] = safe::filterPost('name');
			$config['name_zh'] = safe::filterPost('name_zh');
			$config['type'] = safe::filterPost('type');
			$config['value'] = safe::filterPost('value');

			$res = $configObj->add($config);

			die(json::encode($res));


		}
		else{
			//获取配置类型
			$types = $configObj->getType();
			$this->getView()->assign('type',$types);
		}
	}

	/**
	 * 配置项列表
	 */
	public function generalListAction(){
		$configObj = new \config\configsModel();
		$data = $configObj->getConfigList();
		$this->getView()->assign('data',$data);
	}

	/**
	 * 配置项的编辑
	 */
	public function editConfigAction(){
		$configObj = new \config\configsModel();
		if(IS_POST){
			$config = array();
			$config['id'] = safe::filterPost('id','int');
			$config['name_zh'] = safe::filterPost('name_zh');
			$config['value'] = safe::filterPost('value');

			$res = $configObj->update($config);

			die(json::encode($res));


		}
		else{
			$id = $this->getRequest()->getParam('id');
			$id = safe::filter($id,'int');
			if($id){
				$data = $configObj->get($id);
				if(!empty($data)){
					$data['type'] = $configObj->getType($data['type']);
				}

				$this->getView()->assign('data',$data);
			}
		}
	}

	/**
	 * 删除配置项
	 */
	public function delConfigAction(){
		if(IS_POST){
			$configObj = new \config\configsModel();
			$id = $this->getRequest()->getParam('id');
			$id = safe::filter($id,'int');

			if($id){
				$res = $configObj->delete($id);
				die(json::encode($res)) ;
			}
		}

	}




}
 ?>
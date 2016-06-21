<?php

use \Library\json;
use \Library\url;
use \Library\Safe;
use \Library\Thumb;
use \Library\tool;
use \Library\PlUpload;
use \nainai\offer\product;
use \nainai\offer\PurchaseOffer;
class PurchaseController extends UcenterBaseController{

	/**
	 * 发布采购
	 */
	public function issueAction(){
		if (IS_POST) {
			$offerData = array(
			        'apply_time'  => \Library\Time::getDateTime(),
			        'accept_area' => Safe::filterPost('accept_area'),
			        'accept_day' => Safe::filterPost('accept_day', 'int'),
			        'price'        => Safe::filterPost('price'),
					'price_r'        => Safe::filterPost('price_r'),
			        'user_id' => $this->user_id,
			        'status' => product::OFFER_APPLY,
					'divide' => 1//默认不可拆分
			);
			$productData = $this->getProductData();

			$PurchaseOfferModel = new \nainai\offer\PurchaseOffer();
			$res = $PurchaseOfferModel->doOffer($productData,$offerData);
			echo json::encode($res);
			exit;
		}
		 //获取商品分类信息，默认取第一个分类信息
	        $productModel = new product();
	        $category = $productModel->getCategoryLevel();

	        $attr = $productModel->getProductAttr($category['chain']);
	        //上传图片插件
	        $plupload = new PlUpload(url::createUrl('/ManagerDeal/swfupload'));

	        //注意，js要放到html的最后面，否则会无效
	        $this->getView()->assign('plupload',$plupload->show());
	        $this->getView()->assign('categorys', $category['cate']);
	        $this->getView()->assign('attrs', $attr);
	        $this->getView()->assign('unit', $category['unit']);
	        $this->getView()->assign('cate_id', $category['default']);
	}

	/**
	 * 获取POST提交上来的商品数据,报盘处理和申请仓单处理都会用到
	 * @return array 商品数据数组
	 */
	private function getProductData(){
	    $attrs = Safe::filterPost('attribute');
	    foreach($attrs as $k=>$v){
	        if(!is_numeric($k)){
	            echo JSON::encode(tool::getSuccInfo(0,'属性错误'));
	            exit;
	        }
	    }

	    $detail = array(
	        'name'         => Safe::filterPost('warename'),
	        'cate_id'      => Safe::filterPost('cate_id', 'int'),
	        'price'        => Safe::filterPost('price'),
	        'quantity'     => Safe::filterPost('quantity', 'int'),
	        'attribute'    => empty($attrs) ? '' : serialize($attrs),
	        'note'         => Safe::filterPost('note'),
	        'produce_area' => Safe::filterPost('area'),
	        'create_time'  => \Library\Time::getDateTime(),
	        //'unit'         => Safe::filterPost('unit'),
	        'user_id' => $this->user_id
	    );

	    //图片数据
	    $imgData = Safe::filterPost('imgData');

	    $resImg = array();
	    if(!empty($imgData)){
	        foreach ($imgData as $imgUrl) {
	            if (!empty($imgUrl) && is_string($imgUrl)) {
	                array_push($resImg, array('img' => tool::setImgApp($imgUrl)));
	            }
	        }
	    }

	    return array($detail,$resImg);
	}

	/**
	 * 采购列表
	 */
	public function listsAction(){
		$page = Safe::filterGet('page', 'int', 0);
		$name = Safe::filterGet('name');
		$beginDate = Safe::filterGet('beginDate');
		$endDate = Safe::filterGet('endDate');

		//查询组装条件
		$where = 'type=:type AND c.user_id=:uid';
		$bind = array('type'=>PurchaseOffer::OFFER_TYPE, 'uid' => $this->user_id);

		if (!empty($name)) {
		    $where .= ' AND a.name like"%'.$name.'%"';
		    $this->getView()->assign('name', $name);
		}

		if (!empty($beginDate)) {
		    $where .= ' AND apply_time>=:beginDate';
		    $bind['beginDate'] = $beginDate;
		    $this->getView()->assign('beginDate', $beginDate);
		}

		if (!empty($endDate)) {
		    $where .= ' AND apply_time<=:endDate';
		    $bind['endDate'] = $endDate;
		    $this->getView()->assign('endDate', $endDate);
		}

		$PurchaseOfferModel = new \nainai\offer\PurchaseOffer();
		$productList = $PurchaseOfferModel->getOfferProductList($page, $this->pagesize,  $where, $bind);

		$this->getView()->assign('productList', $productList['list']);
		$this->getView()->assign('pageHtml', $productList['pageHtml']);
	}

	/**
	 * 产品详情
	 * @return [type] [description]
	 */
	public function detailAction(){
		$id = $this->getRequest()->getParam('id');
		$id = Safe::filter($id, 'int', 0);

		if (intval($id) > 0) {
			$PurchaseOfferModel = new \nainai\offer\PurchaseOffer();
			$offerDetail = $PurchaseOfferModel->getOfferProductDetail($id,$this->user_id);
			
			$this->getView()->assign('offer', $offerDetail[0]);
			$this->getView()->assign('product', $offerDetail[1]);
		}else{
			$this->redirect('lists');
		}

	}

	/**
	 * 处理审核
	 */
	public function doApplyAction(){
		if (IS_POST) {
			$id = Safe::filterPost('id', 'int', 0);
			$apply = array();
			$PurchaseOfferModel = new \nainai\offer\PurchaseOffer();
			$apply['status'] = (Safe::filterPost('apply', 'int', 0) == 1) ? $PurchaseOfferModel::OFFER_OK : $PurchaseOfferModel::OFFER_NG;//获取审核状态

			$res = $PurchaseOfferModel->updatePurchaseOffer($apply, $id);
			die(json::encode($res)) ;
		}

		$id = $this->getRequest()->getParam('id');
		$id = Safe::filter($id, 'int', 0);

		if (intval($id) > 0) {
			$PurchaseOfferModel = new \nainai\offer\PurchaseOffer();
			$offerDetail = $PurchaseOfferModel->getOfferProductDetail($id,$this->user_id);

			$this->getView()->assign('detail', $offerDetail[0]);
			$this->getView()->assign('product', $offerDetail[1]);
		}else{
			$this->redirect('lists');
		}

	}

	/**
	 * 报价列表
	 */
	public function reportlistsAction(){
		$page = Safe::filterGet('page', 'int', 0);

		$name = Safe::filterGet('name');
		$status = Safe::filterGet('status', 'int', 9);
		$beginDate = Safe::filterGet('beginDate');
		$endDate = Safe::filterGet('endDate');
		//查询组装条件
		$where = ' 1 ';

		if (!empty($name)) {
		    $where .= ' AND u.username like"%'.$name.'%"';
		    $this->getView()->assign('name', $name);
		}

		if (!empty($status) && $status != 9) {
		    $where .= ' AND p.status=:status';
		    $bind['status'] = $status;
		    $this->getView()->assign('s', $status);
		}

		if (!empty($beginDate)) {
		    $where .= ' AND p.create_time>=:beginDate';
		    $bind['beginDate'] = $beginDate;
		    $this->getView()->assign('beginDate', $beginDate);
		}

		if (!empty($endDate)) {
		    $where .= ' AND p.create_time<=:endDate';
		    $bind['endDate'] = $endDate;
		    $this->getView()->assign('endDate', $endDate);
		}

		$Model = new \nainai\offer\PurchaseReport();
		$reportLists = $Model->getLists($page, $this->pagesize, $where, $bind);
		
		$this->getView()->assign('status', $Model->getStatusArray());
		$this->getView()->assign('reportLists', $reportLists['list']);
		$this->getView()->assign('pageHtml', $reportLists['pageHtml']);
	}

		/**
	 * 处理审核
	 */
	public function doApplyReportAction(){
		if (IS_POST) {
			$id = Safe::filterPost('id', 'int', 0);
			$status = Safe::filterPost('apply', 'int', 0) ;

			if ($status == 1) {
				$buyData = array(
					'offer_id' => Safe::filterPost('offer_id', 'int', 0),
					'seller_id' => Safe::filterPost('seller_id', 'int', 0),
					'buyer_id' => Safe::filterPost('buy_id', 'int', 0),
					'price' => Safe::filterPost('price', 'double', 0),
					'num' => Safe::filterPost('num', 'double', 0),
					'create_time' => \Library\Time::getDateTime()
				);
				//先创建报价订单，后更改报价状态
				$buyData['amount'] = round($buyData['price'] * $buyData['num'], 2);
				$buyData['order_no'] = tool::create_uuid();
				$Model = new \nainai\order\OrderBuy();
				$res = $Model->addOrderBuy($buyData);
			}else{
				$res = array('success' => 1); //如果是拒绝，模拟成功创建
			}

			if ($res['success'] == 1) {
				$apply = array();
				$Model = new \nainai\offer\PurchaseReport();
				$apply['status'] = ($status== 1) ? $Model::STATUS_ADOPT : $Model::STATUS_REPLUSE;//获取审核状态
				$apply['handle_time'] = \Library\Time::getDateTime();
				$res = $Model->updatePurchaseReport($apply, $id);
			}
			die(json::encode($res)) ;
		}

		$id = $this->getRequest()->getParam('id');
		$id = Safe::filter($id, 'int', 0);

		if (intval($id) > 0) {
			$Model = new \nainai\offer\PurchaseReport();
			$data = $Model->getPurchaseReport($id);

			$PurchaseOfferModel = new \nainai\offer\PurchaseOffer();
			$offerDetail = $PurchaseOfferModel->getOfferProductDetail($data['offer_id']);
			$user = new \nainai\user\User();
			$data['username'] = $user->getUser((int)$data['seller_id'], 'username');

			$this->getView()->assign('report', $data);
			$this->getView()->assign('detail', $offerDetail[0]);
			$this->getView()->assign('product', $offerDetail[1]);
		}else{
			$this->redirect('lists');
		}

	}

}
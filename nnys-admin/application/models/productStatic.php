<?php
/**
 * @date 2017-11-30
 * 后台商品统计管理
 *
 */
use \Library\M;
use \Library\Query;
use \Library\tool;
class productStaticModel {

	protected $itemTable = 'stat_item';
	protected $dataTable = 'stat_item_data';
	/**
	 * 验证规则：
	 * array(字段，规则，错误信息，条件，附加规则，时间）
	 * 条件：0：存在字段则验证 1：必须验证 2：不为空时验证
	 *
	 */
	/**
	 * @var
	 */
	protected $rules = array(

	);

	public function getStatitem($cate_id)
	{
		$obj = new M($this->itemTable);
		$res = $obj->where(array('cate_id'=>$cate_id))->getObj();
		if(!empty($res)){
			$res['attr_ids'] = unserialize($res['attr_ids']);
		}
		return $res;
	}


	/**
	 * 根据报盘id生成新的价格统计
	 * @param $offer_id
	 * @return bool
	 */

	public function createStaticData($offer_id){
		$offerObj = new OfferManageModel();
		$detail = $offerObj->getofferDetail($offer_id);
		$statData=$this->getStatitem($detail['cate_id']);
		$statDataObj = new M($this->dataTable);
		if($statDataObj->where(array('offer_id'=>$offer_id))->getField('id'))//已生成统计数据的报盘返回
			return false;
		if(isset($detail['cate_id']) && !empty($statData) ){
			$data = array(
				'cate_id'=>$detail['cate_id'],
				'offer_id'=>$offer_id,
				'stat_time' => \Library\time::getDateTime(),
					'inc_num' => '+0.00',
					'inc_perc'=> '+0.00%',
					'price' => $detail['price']

			);
			foreach($statData['attr_ids'] as $key=>$item){
				$data['attr'][$item] = trim($detail['attribute'][$key]);
			}
			$data['attr_values'] = serialize($data['attr']);
			unset($data['attr']);


			$where = array(
				'cate_id' => $data['cate_id'],
				'attr_values' => $data['attr_values']
			);
			if($statData['check_name']){
				$where['pro_name'] = $detail['product_name'];
			}
			$oldStatData = $statDataObj->where($where)->order('id desc')->getObj();
			if(!empty($oldStatData)){
				$data['inc_num'] = number_format($detail['price'] - $oldStatData['price'],2);
				$data['inc_perc'] = number_format(100*$data['inc_num']/$oldStatData['price'],2);
				if($data['inc_num']>0){
					$data['inc_num'] = '+'.$data['inc_num'];
					$data['inc_perc'] = '+'.$data['inc_perc'];
				}
				$data['inc_perc'] .= '%';
			}

			if($statDataObj->data($data)->add()){
				return true;
			}

		}

		return false;

	}




}
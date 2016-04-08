<?php
/**
 * @date 2016-4-5
 * 后台仓库管理
 *
 */
use \Library\M;
use \Library\Query;
use \Library\tool;
class ProductModel{

	/**
	 * 验证规则：
	 * array(字段，规则，错误信息，条件，附加规则，时间）
	 * 条件：0：存在字段则验证 1：必须验证 2：不为空时验证
	 *
	 */
	/**
	 * @var
	 */
	protected $cateRules = array(
		array('id','number','id错误',0,'regex'),
		array('name','require','分类名名必填'),
		array('pid','number','pid错误'),
		array('sort','number','排序请填写一个数字'),
	);

	/**
	 * 属性规则
	 */
	protected $attrRules = array(
		array('id','number','id错误',0,'regex'),
		array('name','require','属性名必填'),
		array('type',array(1,2,3),'类型错误',0,'in'),
		array('sort','number','必须是一个整数')
	);

	/**
	 * 添加商品分类
	 * @param $data
	 */
	public function cateAdd($data){
		$m = new M('product_category');
		if($m->data($data)->validate($this->cateRules)){
			if($data['id']){
				$id = $data['id'];
				unset($m->id);
				$res = $m->where(array('id'=>$id))->update() ? 1 : 0;
			}else{
				$res = $m->add() ? 1 : 0;
			}

			$info = '';
		}
		else{
			$res = 0;
			$info = $m->getError();
			$info = $info=='' ? '系统繁忙' : $info;
		}
		return tool::getSuccInfo($res,$info);
	}

	/**
	 * 获取一条分类数据
	 * @param $id 分类id
	 */
	public function getCateInfo($id){
		$m = new M('product_category');
		return $m->where(array('id'=>$id))->getObj();

	}
	/**
	 * 获取所有分类树
	 */
	public function getCateTree(){
		$m = new M('product_category');
		$data = $m->select();
		if($data){
			return $this->generateTree($data);
		}
		return array();
	}

	/**
	 * 获取递归数组
	 * @param array $items
	 * @param int $pid 父类id
	 * @param int $level 分类层级，顶级分类为0
	 * @return array
	 */
	private  function generateTree(&$items,$pid=0,$level=0){
		static $tree = array();
		foreach($items as $key=>$item){
			if($item['pid']==$pid){
				$v = $items[$key];
				$v['level'] = $level;
				$tree[] = $v;
				unset($items[$key]);
				$this->generateTree($items,$item['id'],$level+1);
			}
		}
		return $tree;
	}

	/**
	 * 属性添加
	 * @param array $data 添加的数据
	 */
	public function attrAdd($data){
		$m = new M('product_attribute');
		if($m->data($data)->validate($this->attrRules)){
			if($data['id']){
				$id = $data['id'];
				unset($m->id);
				$res = $m->where(array('id'=>$id))->update() ? 1 : 0;
			}else{
				$res = $m->add() ? 1 : 0;
			}

			$info = '';
		}
		else{
			$res = 0;
			$info = $m->getError();
			$info = $info=='' ? '系统繁忙' : $info;
		}
		return tool::getSuccInfo($res,$info);
	}

	/**
	 * 获取一条属性信息
	 * @param int $id 属性id
	 *
	 */
	public function getAttrInfo($id){
		$m = new M('product_attribute');
		return $m->where(array('id'=>$id))->getObj();
	}

	/**
	 * 获取所有属性
	 */
	public function getAttr(){
		$m = new M('product_attribute');
		return $m->select();
	}



}
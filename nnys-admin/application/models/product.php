<?php
/**
 * @date 2016-4-5
 * 后台仓库管理
 *
 */
use \Library\M;
use \Library\Query;
use \Library\tool;
class productModel extends baseModel{

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
		array('percent',array(0,100),'首付比例错误',0,'between'),
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


	public $table = array(
		'cate'=>'product_category',
		'attr'=>'product_attribute'
	);


	/**
	 *获取规则
	 * @param string $table 表
	 */
	public function getRules($table=''){
		switch(strtolower($table)){
			case 'cate' : {
				return $this->cateRules;
			}
			break;
			case 'attr' : {
				return $this->attrRules;
			}
			break;
		}
		return array();
	}

	/**
	 * 属性类型
	 */
	public function getAttrType($type){
		switch($type){
			case 1 : return '输入框';
			case 2 : return '单选';
			case 3 : return '日期控件';
			default : return '输入框';
		}
	}

	public function getTypeArray(){
		return array(
			1 => '输入框',
			2 => '单选',
			3 => '日期控件',
		);
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
		$data = $m->where(array('is_del'=>0))->select();
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
			if($item['pid']==$pid && !isset($items[$key]['del'])){
				$v = $items[$key];
				$v['level'] = $level;
				$tree[] = $v;
				$items[$key]['del']=1;
				$this->generateTree($items,$item['id'],$level+1);
			}
		}
		return $tree;
	}

	/**
	 * 判断市场代码是否已经存在
	 * @param $code
	 * @return bool
	 */
	public function isExistCatecode($code){
		$m = new M('product_category');
		$id = $m->where(array('code'=>$code))->getField('id');
		if($id)
			return true;
		return false;
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
	 * @param int $page 页码 0表示获取全部
	 */
	public function getAttr($page=0){
		$m = new \Library\searchQuery('product_attribute');
		if($page!=0){
			$m->page = $page;
		}
		else{
			$m->where = 'status=1';
		}

		$attr = $m->find($this->getTypeArray());
		$res = array();
		foreach($attr['list'] as $k=>&$v){
			$v['type_txt'] = $this->getAttrType($v['type']);
		}
		return $attr;

	}

	public function getAllAttr(){
		$obj = new M('product_attribute');
		return $obj->where(array('status'=>1))->select();

	}

}
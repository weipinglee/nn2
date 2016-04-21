<?php
/**
 * 商品管理类
 * author: weipinglee
 * Date: 2016/4/19
 * Time: 13:31
 */
namespace nainai;
use \Library\M;
use \Library\Time;
use \Library\Query;
use \Library\Thumb;
use \Library\log;
use \Library\tool;
class product{

    private $product_limit = 5;

    private $_errorInfo = '';
    /**
     * 商品验证规则
     * @var array
     */
    protected $productRules = array(
        array('name','require','商品名称必须填写'),
        // array('cate_id','number','商品类型id错误'),
        array('price','double','商品价格必须是数字'),
        array('quantity','number','供货总量必须是整数'),
        array('attribute', 'require', '请选择商品属性'),
        array('note', 'require', '商品描述必须填写')
    );

    /**
     * 报盘验证规则
     * @var array
     */
    protected $offerRules = array(
        array('product_id', 'number', '必须有商品id'),
        array('mode', 'number', '必须有报盘类型'),
        array('divide', 'number','是否可拆分的id错误'),
        array('accept_area', 'require', '交收地点必须填写'),
        array('accept_day', 'number', '交收时间必须填写')
    );



    /**
     * pdo的对象
     * @var [Obj]
     */
    private $_productObj;

    public function __construct(){
        $this->_productObj = new M('products');
    }

    public function getErrorMessage(){
        return $this->_errorInfo;
    }

    public function setErrorMessage($mess){
        $this->_errorInfo = $mess;
    }

    /**
     * 获取分级的分类
     * @param int $gid
     * @return array array('chain'=>,'default'=>,1=>,2=>);
     */
    public function getCategoryLevel($pid = 0){
        $where  = array('status' => 1);
        $categorys=array();
        $category = $this->_productObj->table('product_category')->fields('id,pid, name, unit, childname, attrs')->where($where)->select();
        foreach ($category as $key => $cate) {
            $categorys[$cate['pid']][] = $cate;
        }
        $pid_chain = array();//父级分类的链，包含自身

        if($pid!=0){
            $pid_chain[] = $pid;
            $parent_id = $pid;
            while($parent_id!=0){
                $parent_id = $this->getParentCateId($parent_id);
                $pid_chain[] = $parent_id;
            }
        }

        return $this->getTree($categorys,$pid,1,$pid_chain);
    }

    /**
     * 找出父级分类id
     * @param $id
     */
    private function getParentCateId($id){
        return $this->_productObj->table('product_category')->where(array('id'=>$id))->getField('pid');
    }




    /**
     * [getTree 获取分类信息树,默认获取第一个父类的子类属性]
     * @param  [type]  $list [分类信息]
     * @param  integer $pid  [pid]
     * @param array $chain 父级分类链
     * @return [type]        [description]
     */
    private function getTree(& $list,  $pid=0, $level=1,$chain=array()){
        $last = 0;
        static $category = array();
        if(!empty($chain))
            $category['chain'] = $chain;
        if(isset($list[$pid])){
            foreach ($list as $p => $cate) {//$p是父类的id
                if ($p == $pid) {
                    if ($last == 0) {
                        $last = $cate[0]['id'];
                        $category['chain'][] = $last;
                        $category['default'] = $last;
                    }
                    foreach($cate as $k=>$v){
                        $m = new M('product_category');
                        $childname = $m->where(array('id'=>$pid))->getField('childname');
                        $category['cate'][$level]['childname'] = $childname ? $childname : '';
                        if($k+1<=$this->product_limit){
                            $category['cate'][$level]['show'][] = $v;
                        }
                        else
                            $category['cate'][$level]['hide'][] = $v;
                    }

                }
            }
            if ($last == 0) {
                return array();
            }else{
                $level++;
                $this->getTree($list, $last, $level);
            }
        }
        else{
            $category['default'] = $pid;
        }

        return $category;
    }
    /**
     *获取所有分类的属性，去除重复
     * @param array $cates 分类数组,array(2,3)
     * @return mixed
     */
    public function getProductAttr($cates=array()){
        if(empty($cates))
            return array();
        $attrs = $this->_productObj->table('product_category')->fields('attrs')->where('id in ('.join(',',$cates).')')->select();

        $attr_arr = array();
        foreach($attrs as $v){
            if($v['attrs']!='')
                $attr_arr = array_merge($attr_arr,explode(',',$v['attrs']));
        }
        if(empty($attr_arr))
            return array();
        return $this->_productObj->table('product_attribute')->where('id in ('.join(',',$attr_arr).')')->select();
    }

    /**
     * 验证商品数据是否正确
     * @param array $productData 商品数据
     * @return bool
     */
    public function proValidate($productData){
        if($this->_productObj->validate($this->productRules,$productData)){
            return true;
        }

        return false;

    }



    /**
     * 插入报盘数据
     * @param  array $productData 商品数据
     * @param array $productOffer 报盘数据
     * @return [Boolean]
     */
    public function insertOffer(&$productData,&$productOffer){
        if($this->_productObj->validate($this->offerRules, $productOffer) && $this->proValidate($productData)){
            $this->_productObj->beginTrans();
            $pId = $this->_productObj->data($productData[0])->add(1);
            $imgData = $productData[1];
            if (intval($pId) > 0) {
                //插入图片数据
                if (!empty($imgData)) {
                    foreach ($imgData as $key => $imgUrl) {
                        $imgData[$key]['products_id'] = $pId;
                    }
                    $this->_productObj->table('product_photos')->data($imgData)->adds(1);

                }
                //插入报盘数据
                $this->_productObj->table('product_offer')->data($productOffer)->add(1);
            }
            $res = $this->_productObj->commit();

        }
        else{
            $this->setErrorMessage($this->_productObj->getError());
            $res = $this->_errorInfo;
        }

        if($res===true){
            $resInfo = Tool::getSuccInfo();
        }
        else{
            $resInfo = Tool::getSuccInfo(0,is_string($res) ? $res : '系统繁忙，请稍后再试');
        }
        return $resInfo;
    }




}
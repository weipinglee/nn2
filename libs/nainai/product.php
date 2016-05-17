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
        array('cate_id','number','商品类型id错误'),
        array('price','double','商品价格必须是数字'),
        array('quantity','double','供货总量必须是整数'),
        array('attribute', 'require', '请选择商品属性'),
        array('note', 'require', '商品描述必须填写')
    );

    /**
     * 报盘验证规则
     * @var array
     */
    protected $productOfferRules = array(
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
     * 获取报盘的状态
     * @return [Array]
     */
    public function getStatus(){
        return array(
            0 => '审核中',
            1 => '发布成功',
            2 => '被驳回',
            3 => '已过期'
        );
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
     * 获取产品的属性值，对应的属性id
     * @param  array  $attr_id [属性id]
     * @return [Array]   
     */
    public function getHTMLProductAttr($attr_id = array()){
        $attrs = array();
        if (!empty($attr_id)) {
            $attrObj = new M('product_attribute');
            $attr_id = $attrObj->fields('id, name')->where('id IN (' . implode(',', $attr_id) . ')')->select();
            foreach ($attr_id as $value) {
               $attrs[$value['id']] = $value['name']; 
            }
        }

        return $attrs;
    }

        /**
         * 根据产品id获取图片
         * @param  [type] $pid [description]
         * @return [type]      [description]
         */
        public function getProductPhoto($pid = 0){
            $photos = array();
            if (intval($pid) > 0) {
                $imgObj = new M('product_photos');
                $photos = $imgObj->fields('id, img')->where('products_id = ' .  $pid)->select();

                foreach ($photos as $key => $value) {
                    $photos[$key] = Thumb::get($value['img'],180,180);
                }

            }

            return $photos;
        }

        /**
         * 添加商品数据
         * @param  [Array] &$productData [提交的商品数据]
         * @param  [Array] &$productOffer[提交的报盘数据]
         * @return [Array]               [添加是否成功，及失败信息]
         */
        public function insertOffer(&$productData, &$productOffer){
            if ($this->_productObj->validate($this->productRules,$productData)){

                $this->_productObj->beginTrans();
                $pId = $this->_productObj->data($productData[0])->add(1);
                $productOffer['product_id'] = $pId;

                if ($this->_productObj->validate($this->productOfferRules, $productOffer)) {
                    $this->_productObj->table('product_offer')->data($productOffer)->add(1);
                    $imgData = $productData[1];
                    if (!empty($imgData)) {
                        foreach ($imgData as $key => $imgUrl) {
                            $imgData[$key]['products_id'] = $pId;
                        }
                        $this->_productObj->table('product_photos')->data($imgData)->adds(1);
                    }
                    $res = $this->_productObj->commit();
                }else{
                    $res = $this->_productObj->getError();
                }

            }else{
                $res = $this->_productObj->getError();
            }

            if ($res === TRUE) {
                return Tool::getSuccInfo(1, 'add Success');
            }else{
                $resInfo = Tool::getSuccInfo(0,is_string($res) ? $res : '系统繁忙，请稍后再试');
            }

        return $resInfo;
    }

    /**
     * 仓单报盘数据添加
     * @param  [Array] $productOffer [报盘的数据]
     * @return [Array]      
     */
    public function insertStoreOffer( & $productOffer){
        if ($this->_productObj->validate($this->productOfferRules, $productOffer)) {
            $res = (int)$this->_productObj->table('product_offer')->data($productOffer)->add(0);
        }else{
            $res = $this->_productObj->getError();
        }

        if (is_int($res)) {
            return Tool::getSuccInfo(1, 'add Success');
        }else{
            return Tool::getSuccInfo(0,is_string($res) ? $res : '系统繁忙，请稍后再试');
        }
    }

    /**
     * 获取报盘对应的产品列表
     * @param  [Int] $page     [分页]
     * @param  [Int] $pagesize [分页]
     * @param  string $where    [where的条件]
     * @param  array  $bind     [where绑定的参数]
     * @return [Array.list]           [返回的对应的列表数据]
     * @return [Array.pageHtml]           [返回的分页html数据]
     */
    public function getOfferProductList($page, $pagesize, $where='', $bind=array()){
        $query = new Query('product_offer as c');
        $query->fields = 'c.id, a.name, b.name as cname, a.quantity, a.price, a.expire_time, c.status, c.type, a.user_id, c.apply_time';
        $query->join = '  LEFT JOIN products as a ON c.product_id=a.id LEFT JOIN product_category as b ON a.cate_id=b.id ';
        $query->page = $page;
        $query->pagesize = $pagesize;
        $query->order = ' a.create_time desc';

        if (empty($where)) {
            $where = ' c.type IN (1, 2, 4) ';
        }else{
            $where .= ' AND c.type IN (1, 2, 4) ';
            $query->bind = $bind;
        }

        $query->where = $where;

        $list = $query->find();
        return array('list' => $list, 'pageHtml' => $query->getPageBar());
    }

    /**
     * 获取对应id的报盘和产品详情数据
     * @param  [Int] $id [报盘id]
     * @return [Array]     [报盘和产品数据]
     */
    public function getOfferProductDetail($id){
        $query = new Query('product_offer as a');
        $query->fields = 'a.id, a.type, a.mode, a.divide, a.minimum, a.price, a.accept_area, b.name as pname, b.id as pid, b.attribute, b.create_time, b.produce_area, b.quantity, b.note, c.name as cname';
        $query->join = 'LEFT JOIN products as b ON a.product_id=b.id LEFT JOIN product_category as c ON b.cate_id=c.id';
        $query->where = 'a.id=:id';
        $query->bind = array('id' => $id);

        return $query->getObj();
    }

    /**
     * 获取产品对应分类下的的报盘信息列表
     * @param  [Int] $cateId [分类id]
     * @return [Array] 
     */
    public function getOfferCategoryList($cateId){
        $query = new Query('product_offer as a');
        $query->fields = 'a.id, accept_area, a.price, b.cate_id, b.name as pname, b.quantity, b.produce_area, c.name as cname';
        $query->join = 'LEFT JOIN products as b ON a.product_id=b.id LEFT JOIN product_category as c ON b.cate_id=c.id';
        $query->where = ' find_in_set(b.cate_id, getChildLists(:cid))';
        $query->bind = array('cid' => $cateId);
        $query->order = 'a.apply_time desc';
        $query->limit = 5;

        return $query->find();
    }



}

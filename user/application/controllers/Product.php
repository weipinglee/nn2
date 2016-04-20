<?php
/**
 * 用户中心
 * User: weipinglee
 * Date: 2016/3/4 0004
 * Time: 上午 9:35
 */
use \Library\checkRight;
use \Library\PlUpload;
use \Library\photoupload;
use \Library\json;
use \Library\url;
use \Library\Safe;
use \Library\Thumb;
use \Library\tool;
class ProductController extends Yaf\Controller_Abstract {


    /**
     * 设置分类多少以后有展开
     * @var integer
     */
    private $_limiteProduct = 2;

    /**
     * 提示mode对应的类型
     * @var array
     */
    private $_mode = array(
        1 => '保证金报盘',
        2 => '自由报盘',
        3 => '申请仓单'
    );

    public function init(){
       //  $right = new checkRight();
       // $right->checkLogin($this);//未登录自动跳到登录页
       
       $this->getView()->assign('leftArray', $this->getLeftArray());
        $this->getView()->setLayout('ucenter');

    }

    private function  getLeftArray(){
        return array(
            array('name' => '交易管理', 'list' => array()),
            array('name' => '销售管理', 'list' => array(
                array('url' => '', 'title' => '销售列表' ),
                array('url' => url::createUrl('/product/offerIndex'), 'title' => '发布产品' ),
            )),
            array('name' => '仓单管理', 'list' => array(
                array('url' => '', 'title' => '申请仓单' ),
                array('url' => '', 'title' => '仓单列表' ),
            )),
            array('name' => '采购管理', 'list' => array(
                array('url' => '', 'title' => '采购列表' ),
                array('url' => '', 'title' => '发布采购' ),
            )),
            array('name' => '合同管理', 'list' => array(
                array('url' => '', 'title' => '销售合同' ),
                array('url' => '', 'title' => '购买合同' ),
            ))
        );
    }
    /**
     * 个人中心首页
     */
    public function indexAction(){

    }

    /**
     * 产品发布页面展示
     * @return 
     */
    public function offerIndexAction(){}

   /**
     * 商品添加页面展示
     */
    public function productAddAction(){
        $category = array();
        $mode = $this->getRequest()->getParam('mode');

        //获取商品分类信息，默认取第一个分类信息
        $productModel = new \nainai\product();
        $category = $productModel->getCategoryLevel();
        $attr = $productModel->getProductAttr($category['chain']);
        //上传图片插件
        $plupload = new PlUpload(url::createUrl('/product/swfupload'));

        //如果mode==3,为申请仓单
        if ($mode == 3) {
            $this->getView()->assign('storeList', $productModel->getStoretList());
        }

        //注意，js要放到html的最后面，否则会无效
        $this->getView()->assign('plupload',$plupload->show()); 
        $this->getView()->assign('categorys', $category['cate']);
        $this->getView()->assign('attrs', $attr);
        $this->getView()->assign('mode',  $mode);
        $this->getView()->assign('cate_id', $category['default']);
    }

    /**
     * AJax获取产品分类信息
     * @return [Json] 
     */
    public function ajaxGetCategoryAction(){

        $pid = Safe::filterPost('pid', 'int',0);
        if($pid){
            $productModel = new \nainai\product();
            $cate = $productModel->getCategoryLevel($pid);
            $cate['attr'] = $productModel->getProductAttr($cate['chain']);
            unset($cate['chain']);
            echo JSON::encode($cate);
        }
        return false;

    }


    /**
     * 处理添加商品
     */
    public function WithAddProductAction(){
       if (IS_POST) {
            $attrs = array();
            $attrs = Safe::filterPost('attribute');
            foreach($attrs as $k=>$v){
                if(!is_numeric($k)){
                    echo JSON::encode(tool::getSuccInfo(0,'属性错误'));
                    exit;
                }
            }
            $time = date('Y-m-d H:i:s', time());
            $mode = Safe::filterPost('mode', 'int');
            if (empty($this->_mode($mode))) {
                throw new Exception("Error Mode", 1);
            }
  
            $productData = array(
                'name'         => Safe::filterPost('warename'),
                'cate_id'      => Safe::filterPost('cate_id', 'int'),
                'price'        => Safe::filterPost('price', 'float'),
                'quantity'     => Safe::filterPost('quantity', 'int'),
                'attribute'    => serialize($attrs),
                'note'         => Safe::filterPost('note'),
                'produce_area' => $this->getRequest()->getPost('area'),
                'create_time'  => $time
            );

            //图片数据
            $imgData = array();
            foreach ($this->getRequest()->getPost('imgData') as $imgUrl) {
                if (!empty($imgUrl) && is_string($imgUrl)) {
                    array_push($imgData, array('img' => tool::setImgApp($imgUrl)));
                }
            }

            $productModel = new \nainai\product();
            $pid = $productModel->insertProduct($productData, $imgData);

            if ($mode == 1 || $mode == 2) {
                // 报盘数据
                $productOffer = array(
                    'mode'          => $mode,
                    'apply_time'  => $time,
                    'divide'      => Safe::filterPost('divide', 'int'),
                    'minimum'     => ($this->getRequest()->getPost('divide') == 0) ? Safe::filterPost('minimum', 'int') : 0,
                    'status'      => 0,
                    'accept_area' => Safe::filterPost('accept_area'),
                    'accept_day' => Safe::filterPost('accept_day', 'int'),
                    'price'        => Safe::filterPost('price', 'float'),
                    'product_id' => $pid
                );
                $productModel->insertOffer($productOffer);
            }else{
                $storeList = array(
                    'store_id' => Safe::filterPost('store_id', 'int'),
                    'product_id' => $pid,
                    'apply_time' => $time,
                    'satus' => 0
                );
            }
           
           //空为成功，没有错误信息就是成功
             echo $productModel->getErrorMessage(); exit();
        }else{
            $this->redirect('productAdd');
        }
    }

    public function swfuploadAction(){
        //调用文件上传类
        $photoObj = new photoupload();
        $photoObj->setThumbParams(array(180,180));
        $photo = current($photoObj->uploadPhoto());

        if($photo['flag'] == 1)
        {
            $result = array(
                'flag'=> 1,
                'img' => $photo['img'],
                'thumb'=> $photo['thumb'][1]
            );
        }
        else
        {
            $result = array('flag'=> $photo['flag'],'error'=>$photo['errInfo']);
        }
        echo JSON::encode($result);

        return false;
    }







}

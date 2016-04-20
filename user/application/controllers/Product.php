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
    protected $category=array();


    public function init(){
        //$right = new checkRight();
       // $right->checkLogin($this);//未登录自动跳到登录页
        $this->getView()->setLayout('ucenter');

        $productLeftLayout = APPLICATION_PATH . '/application/views/pc/layout/productleft.tpl';
        $this->getView()->assign('productLeftLayout',  file_get_contents($productLeftLayout));
    }
    /**
     * 个人中心首页
     */
    public function indexAction(){

    }

   /**
     * 商品添加页面展示
     */
    public function productAddAction(){
        $category = array();
        //获取商品分类信息，默认取第一个分类信息
        $productModel = new \nainai\product();
        $category = $productModel->getCategoryLevel();

        $attr = $productModel->getProductAttr($category['chain']);

        $plupload = new PlUpload(url::createUrl('/product/swfupload'));
        //注意，js要放到html的最后面，否则会无效
        $this->getView()->assign('plupload',$plupload->show()); 
        $this->getView()->assign('categorys', $category['cate']);
        $this->getView()->assign('attrs', $attr);
        $this->getView()->assign('mode', 1);
        $this->getView()->assign('cate_id', $category['default']);
       // $this->getView()->assign('max', count($this->category['cateList']));
    }

    /**
     * AJax获取产品分类信息
     * @return [Json] 
     */
    public function ajaxGetCategoryAction(){

        $pid = safe::filterPost('pid', 'int',0);
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
            $attrs = safe::filterPost('attribute');
            foreach($attrs as $k=>$v){
                if(!is_numeric($k)){
                    echo JSON::encode(tool::getSuccInfo(0,'属性错误'));
                    exit;
                }
            }
            
            $productData = array(
                'name'         => safe::filterPost('warename'),
                'cate_id'      => safe::filterPost('cate_id', 'int'),
                'price'        => safe::filterPost('price', 'float'),
                'quantity'     => safe::filterPost('quantity', 'int'),
                'attribute'    => serialize($attrs),
                'note'         => safe::filterPost('note'),
                'produce_area' => $this->getRequest()->getPost('area'),
                'create_time'  => date('Y-m-d H:i:s', time())
            );

            //图片数据
            $imgData = array();
            foreach ($this->getRequest()->getPost('imgData') as $imgUrl) {
                if (!empty($imgUrl) && is_string($imgUrl)) {
                    array_push($imgData, array('img' => tool::setImgApp($imgUrl)));
                }
            }

            // 报盘数据
            $productOffer = array(
                'mode'          => Safe::filterPost('mode', 'int'),
                'apply_time'  => date('Y-m-d H:i:s', time()),
                'divide'      => Safe::filterPost('divide', 'int'),
                'minimum'     => ($this->getRequest()->getPost('divide') == 0) ? Safe::filterPost('minimum', 'int') : 0,
                'status'      => 0,
                'accept_area' => Safe::filterPost('accept_area'),
                'accept_day' => Safe::filterPost('accept_day', 'int'),
                'price'        => safe::filterPost('price', 'float')
            );
            
            $productModel = new ProductModel();
            $result = $productModel->insertProduct($productData, $imgData, $productOffer);

             echo $result['info']; exit();
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

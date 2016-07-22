<?php

use \Library\checkRight;
use \Library\PlUpload;
use \Library\photoupload;
use \Library\json;
use \Library\url;
use \Library\safe;
use \Library\Thumb;
use \Library\tool;
use \nainai\store;
use \nainai\offer\product;
use \nainai\offer\freeOffer;
use \nainai\offer\depositOffer;
use \nainai\offer\deputeOffer;
/**
 * 交易管理的控制器类
 */
class ManagerDealController extends UcenterBaseController {
    /**
     * 设置分类多少以后有展开
     * @var integer
     */
    private $_limiteProduct = 2;


    /**
     * 设置产品过期的天数
     * @var integer
     */
    private $_expireDay = 5;

    /**
     * 提示mode对应的类型
     * @var array
     */
    private $_mode = array(
        1 => '自由报盘',
        2 => '保证金报盘',
        3 => '委托报盘',
        4 => '仓单报盘'
    );


    protected  $certType = 'deal';//需要的认证类型

    //买家不能操作的方法
    protected $sellerAction = array('productlist','indexoffer','freeOffer','dofreeoffer','depositoffer','dodepositoffer',
        'deputeoffer','dodeputeoffer','storeoffer','dostoreoffer');

    /**
     * 个人中心首页
     */
    public function indexAction(){

    }

    /**
     * 产品发布页面展示
     * @return
     */
    public function indexOfferAction(){

    }

    public function addSuccessAction(){

    }

   /**
     * 商品添加页面展示
     */
    private function productAddAction(){
        
        $category = array();

        //获取商品分类信息，默认取第一个分类信息
        $productModel = new product();
        $category = $productModel->getCategoryLevel();

        //获取保险
        $key = count($category['cate']);
        $risk = new \nainai\insurance\Risk();
        $list = $risk->getRiskList(-1, array('status' => 1));
        $company = $risk->getCompany();
         $risk_data = array();
        //获取默认的分类设置的保险， 如果最下级默认没有保险，用父级的。
        do{
            $risk_data = $category['cate'][$key]['show'][0]['risk_data'];
            $risk = array();
            if (!empty($risk_data)) {
                foreach ($risk_data as &$value) {
                    $risk[$value]['risk_id'] = $list[$value]['id'];
                    $risk[$value]['name'] = $list[$value]['name'];
                    $risk[$value]['company'] = $list[$value]['company'];
                    $risk[$value]['mode'] = $list[$value]['mode'];
                    $risk[$value]['fee'] = $list[$value]['fee'];
                }
                break;
            }
            $key --;
        }while($key > 0);

        $attr = $productModel->getProductAttr($category['chain']);
        //注意，js要放到html的最后面，否则会无效
        $this->getView()->assign('categorys', $category['cate']);
        $this->getView()->assign('risk_data', $risk);
        $this->getView()->assign('attrs', $attr);
        $this->getView()->assign('unit', $category['unit']);
        $this->getView()->assign('cate_id', $category['default']);
    }

    /**
     * 自由报盘申请页面
     *
     */
    public function freeOfferAction(){
        $token =  \Library\safe::createToken();
        $this->getView()->assign('token',$token);

        $freeObj = new freeOffer();
        $freeFee = $freeObj->getFee($this->user_id);

        $this->getView()->assign('fee',$freeFee);
        $this->productAddAction();
    }


    /**
     * 自由报盘提交处理
     *
     */
    public function doFreeOfferAction(){
        if(IS_POST){
            $token = safe::filterPost('token');
            if(!safe::checkToken($token))
                die(json::encode(tool::getSuccInfo(0,'请勿重复提交'))) ;
            $offerData = array(
                'apply_time'  => \Library\Time::getDateTime(),
                'divide'      => Safe::filterPost('divide', 'int'),
                'minimum'     => ($this->getRequest()->getPost('divide') == 1) ? Safe::filterPost('minimum', 'int') : 0,

                'accept_area' => Safe::filterPost('accept_area'),
                'accept_day' => Safe::filterPost('accept_day', 'int'),
                'price'        => Safe::filterPost('price', 'float'),
                'acc_type'   => 1,//现在写死了，就是代理账户
                 'insurance' => Safe::filterPost('insurance', 'int'),
               'risk' =>implode(',', Safe::filterPost('risk', 'int'))
            );

            $offerObj = new freeOffer($this->user_id);
            $productData = $this->getProductData();
            $res = $offerObj->doOffer($productData,$offerData);

            echo json::encode($res);
            exit;
        }
        return false;

    }

    /**
     * 保证金报盘申请页面
     *
     */
    public function depositOfferAction(){
        $token =  \Library\safe::createToken();
        $this->getView()->assign('token',$token);

        $depositObj = new \nainai\offer\depositOffer();
        $rate = $depositObj->getDepositRate($this->user_id);
        $this->getView()->assign('rate',$rate);
        $this->productAddAction();
    }

    /**
     * 保证金报盘提交处理
     *
     */
    public function doDepositOfferAction(){
        if(IS_POST){
            $token = safe::filterPost('token');
            if(!safe::checkToken($token))
                die(json::encode(tool::getSuccInfo(0,'请勿重复提交'))) ;

            $offerData = array(
                'apply_time'  => \Library\Time::getDateTime(),
                'divide'      => safe::filterPost('divide', 'int'),
                'minimum'     => ($this->getRequest()->getPost('divide') == 1) ? safe::filterPost('minimum', 'int') : 0,

                'accept_area' => safe::filterPost('accept_area'),
                'accept_day' => safe::filterPost('accept_day', 'int'),
                'price'        => safe::filterPost('price', 'float'),
                 'insurance' => Safe::filterPost('insurance', 'int'),
                 'risk' =>implode(',', Safe::filterPost('risk', 'int'))
               // 'acc_type'   => 1,
            );

            $depositObj = new depositOffer($this->user_id);
            $productData = $this->getProductData();
            $res = $depositObj->doOffer($productData,$offerData);
            
            echo json::encode($res);
            exit;
        }
        else
        echo \Library\json::encode(tool::getSuccInfo(0,'操作失败'));
        exit;

    }



    /**
     * 委托报盘申请页面
     *
     */
    public function deputeOfferAction(){
        $token =  \Library\safe::createToken();
        $this->getView()->assign('token',$token);
        $Obj = new \nainai\offer\deputeOffer();
        $rate = $Obj->getFeeRate($this->user_id);
        $this->getView()->assign('rate',$rate);
        $this->productAddAction();
    }

    /**
     * 保证金报盘提交处理
     *
     */
    public function doDeputeOfferAction(){
        if(IS_POST){
            $token = safe::filterPost('token');
            if(!safe::checkToken($token))
                die(json::encode(tool::getSuccInfo(0,'请勿重复提交'))) ;

            $offerData = array(
                'apply_time'  => \Library\Time::getDateTime(),
                'divide'      => Safe::filterPost('divide', 'int'),
                'minimum'     => ($this->getRequest()->getPost('divide') == 1) ? Safe::filterPost('minimum', 'int') : 0,

                'accept_area' => Safe::filterPost('accept_area'),
                'accept_day' => Safe::filterPost('accept_day', 'int'),
                'price'        => Safe::filterPost('price', 'float'),
                'sign'        => Tool::setImgApp(Safe::filterPost('imgfile1')),//委托书照片
                'insurance' => Safe::filterPost('insurance', 'int'),
               'risk' =>implode(',', Safe::filterPost('risk', 'int'))
                // 'acc_type'   => 1,
            );

            $deputeObj = new deputeOffer($this->user_id);
            $productData = $this->getProductData();
            $res = $deputeObj->doOffer($productData,$offerData);

            echo json::encode($res);
            exit;
        }
        return false;

    }

    /**
     * 仓单报盘
     * @return 
     */
    public function storeOfferAction(){
        $token =  \Library\safe::createToken();
        $this->getView()->assign('token',$token);
        $storeModel = new \nainai\store();

        $storeList = $storeModel->getUserActiveStore($this->user_id);

        $this->getView()->assign('storeList', $storeList['list']);
    }

    /**
     * 申请仓单页面
     */
    public function storeProductAction(){
        $store_list = store::getStoretList();

        $this->getView()->assign('storeList',$store_list);
        $this->productAddAction();

        $token =  \Library\safe::createToken();
        $this->getView()->assign('token',$token);
    }




    /**
     * Ajax获取仓单报盘页面的商品详情
     * @return 
     */
    public function ajaxGetStoreAction(){
        $return_json = array();
        $pid = Safe::filterPost('pid', 'int');
        if (intval($pid) > 0) {
            $storeModel = new \nainai\store();
            $return_json = $storeModel->getUserStoreDetail($pid,$this->user_id);
            //获取保险产品信息
            $risk = new \nainai\insurance\Risk();
            $return_json['risk_data'] = $risk->getCategoryRisk($return_json['cate']);
        }
        echo JSON::encode($return_json);
        return false;
    }

        /**
         * AJax获取产品分类信息
         * @return [Json]
         */
        public function ajaxGetCategoryAction(){
            $pid = Safe::filterPost('pid', 'int',0);
            if($pid){
                $productModel = new product();
                $cate = $productModel->getCategoryLevel($pid);

                $cate['attr'] = $productModel->getProductAttr($cate['chain']);
                 $risk_data = array();
                //获取保险产品信息
                $risk = new \nainai\insurance\Risk();
                $list = $risk->getRiskList(-1, array('status' => 1));

                //获取子类的保险配置
                 if (!empty($cate['cate'])) {
                            $key  = count($cate['cate']);
                            do{
                                $risk_data = $cate['cate'][$key]['show'][0]['risk_data'];
                                if (!empty($risk_data)) {
                                    break;
                                }
                            $key --;
                        }while($key > 0);
                 }

                //当前分类没有配置保险，获取父类的保险配置
                if (empty($risk_data)) {
                    $cates = $productModel->getParents($pid);
                    foreach ($cates as $key => $value) {
                        $risk_data = $productModel->getCateName($value['id'], 'risk_data');
                        if (!empty($risk_data)) { //如果上一级分类有保险配置，就用这个配置
                            $risk_data = explode(',', $risk_data);
                            break;
                        }
                    }
                }
                 //获取分类设置的保险
                if (!empty($risk_data)) {
                    $risk = array();
                    foreach ($risk_data as &$value) {
                        $risk[$value]['risk_id'] = $list[$value]['id'];
                        $risk[$value]['name'] = $list[$value]['name'];
                        $risk[$value]['company'] = $list[$value]['company'];
                        $risk[$value]['mode'] = $list[$value]['mode'];
                        $risk[$value]['fee'] = $list[$value]['fee'];
                    }
                }
                $cate['risk_data'] = $risk;
                unset($cate['chain']);
                echo JSON::encode($cate);
            }
            return false;
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
        $time = date('Y-m-d H:i:s', time());

        $detail = array(
            'name'         => Safe::filterPost('warename'),
            'cate_id'      => Safe::filterPost('cate_id', 'int'),
            'price'        => Safe::filterPost('price', 'float'),
            'quantity'     => Safe::filterPost('quantity', 'float'),
            'attribute'    => empty($attrs) ? '' : serialize($attrs),
            'note'         => Safe::filterPost('note'),
            'produce_area' => Safe::filterPost('area'),
            'create_time'  => $time,
            'unit'         => Safe::filterPost('unit'),
            'user_id' => $this->user_id
        );
        //图片数据
        $imgData = Safe::filterPost('imgData');

        $resImg = array();
        if(!empty($imgData)){
            foreach ($imgData as $imgUrl) {
                if (!empty($imgUrl) && is_string($imgUrl)) {
                    if(!isset($detail['img']) || $detail['img']=='')
                         $detail['img'] = tool::setImgApp($imgUrl);
                    array_push($resImg, array('img' => tool::setImgApp($imgUrl)));
                }
            }
        }

        return array($detail,$resImg);
    }

    /**
     * 处理仓单报盘
     * @return
     */
    public function doStoreOfferAction(){
        if (IS_POST) {

            $token = safe::filterPost('token');
            if(!safe::checkToken($token))
                die(json::encode(tool::getSuccInfo(0,'请勿重复提交'))) ;

            $id = Safe::filterPost('storeproduct', 'int', 0);//仓单id
            $storeObj = new \nainai\store();

            if ($storeObj->judgeIsUserStore($id, $this->user_id)) { //判断是否为用户的仓单
                // 报盘数据
                $offerData = array(
                    'apply_time'  => \Library\Time::getDateTime(),
                    'divide'      => Safe::filterPost('divide', 'int'),
                    'minimum'     => ($this->getRequest()->getPost('divide') == 0) ? Safe::filterPost('minimum', 'int') : 0,
                    'status'      => 0,
                    'accept_area' => Safe::filterPost('accept_area'),
                    'accept_day' => Safe::filterPost('accept_day', 'int'),
                    'price'        => Safe::filterPost('price', 'float'),
                    'user_id'     => $this->user_id,
                    'insurance' => Safe::filterPost('insurance', 'int'),
                    'risk' =>implode(',', Safe::filterPost('risk', 'int'))
                );
                
                $offerObj = new \nainai\offer\storeOffer($this->user_id);
                $offerData['product_id'] = Safe::filterPost('product_id', 'int');
                $res = $offerObj->insertStoreOffer($id,$offerData, $product);
                die(json::encode($res)) ;
            }
            die(json::encode(tool::getSuccInfo(0,'仓单不存在'))) ;
        }

        $this->redirect('indexoffer');
    }


    /**
     * 申请仓单处理
     */
    public function doStoreProductAction(){
        if(IS_POST){
            $token = safe::filterPost('token');
            if(!safe::checkToken($token))
                die(json::encode(tool::getSuccInfo(0,'请勿重复提交'))) ;
            $productData = $this->getProductData();//获取商品数据
            $storeList = array(
                'store_id' => Safe::filterPost('store_id', 'int'),
                'package'  => Safe::filterPost('package','int'),
                'package_num' => Safe::filterPost('packNumber'),
                'package_unit' => Safe::filterPost('packUnit'),
                'package_weight' => Safe::filterPost('packWeight'),
                'apply_time'  => \Library\Time::getDateTime(),
                'user_id' => $this->user_id
            );
            $storeObj = new store();
            $res = $storeObj->createStoreProduct($productData,$storeList);
            echo json::encode($res);

        }
        return false;
    }

    /**
     * 仓单列表
     */
    public function storeProductListAction(){
        $page = Safe::filterGet('page', 'int', 0);
        $store = new store();

        $data = $store->getUserStoreList($page,$this->user_id);

        $this->getView()->assign('statuList', $store->getStatus());
        $this->getView()->assign('storeList', $data['list']);
        $this->getView()->assign('attrs', $data['attrs']);
        $this->getView()->assign('pageHtml', $data['pageHtml']);

    }

    /**
     * 仓单详情
     * @return bool
     */
    public function storeProductDetailAction(){
        $id = $this->getRequest()->getParam('id');
        $id = Safe::filter($id,'int',0);
        if($id){
            $stObj = new store();
            $detail = $stObj->getUserStoreDetail($id,$this->user_id);

            $this->getView()->assign('detail', $detail);
        }

        else
        return false;
    }

    /**
     * 仓单确认
     */
    public function userMakeSureAction(){
        if(IS_POST){
            $storeProductID = safe::filterPost('id','int',0);
            $status = safe::filterPost('status','int',0);
            $store = new store();
           $res = $store->userCheck($status,$storeProductID,$this->user_id);
           die(json::encode($res));

        }
        return false;

    }
    //上传接口
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



    /**
     * 产品列表页面
     */
    public function productListAction(){
        $page = Safe::filterGet('page', 'int', 0);
        $name = Safe::filterGet('name');
        $status = Safe::filterGet('status', 'int', 9);
        $beginDate = Safe::filterGet('beginDate');
        $endDate = Safe::filterGet('endDate');

        //查询组装条件
        $where = 'c.user_id=:uid';
        $bind = array('uid' => $this->user_id);

        if (!empty($name)) {
            $where .= ' AND a.name like"%'.$name.'%"';
            $this->getView()->assign('name', $name);
        }

        if (!empty($status) && $status != 9 || $status==0) {
            $where .= ' AND c.status=:status';
            $bind['status'] = $status;

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

        $productModel = new ProductModel();
        $productList = $productModel->getOfferProductList($page, $this->pagesize,  $where, $bind);
        $statusList = $productModel->getStatusArray();
        $this->getView()->assign('statusList', $statusList);
        $this->getView()->assign('status', $status);
        $this->getView()->assign('mode', $this->_mode);
        $this->getView()->assign('productList', $productList['list']);
        $this->getView()->assign('pageHtml', $productList['pageHtml']);
    }


    /**
     * 产品详情页面
     */
    public function productDetailAction(){

        $id = $this->getRequest()->getParam('id');
        $id = Safe::filter($id, 'int', 0);

        if (intval($id) > 0) {
            $productModel = new ProductModel();
            $offerDetail = $productModel->getOfferProductDetail($id,$this->user_id);
            if ($offerDetail[0]['insurance'] == 1) {
                $risk = new \nainai\insurance\Risk();
                $riskData = $risk->getProductRisk($offerDetail[0]['risk'], $offerDetail[1]['cate_id']);
                $this->getView()->assign('riskData',$riskData);
            }

            $this->getView()->assign('offer', $offerDetail[0]);
            $this->getView()->assign('product', $offerDetail[1]);
        }
        else{
            $this->redirect('productList');
        }


    }



}

 <?php
/**
 * @name IndexController
 * @author root
 * @desc 默认控制器
 * @see http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
use \nainai\offer\product;
use \Library\url;
use \Library\safe;
use \Library\Payment;
use \Library\json;
use \Library\M;
use \Library\tool;
class IndexController extends PublicController {



	/** 
     * 默认动作
     * Yaf支持直接把Yaf_Request_Abstract::getParam()得到的同名参数作为Action的形参
     * 对于如下的例子, 当访问http://yourhost/yar-demo/index/index/index/name/root 的时候, 你就会发现不同
     */
	public function indexAction() {
        $this->getView()->assign('cur','index');
		$this->getView()->assign('index',1);

		$productModel=new product();

		//获取幻灯片
		$indexSlide=\nainai\system\slide::getIndexSlide();
		foreach($indexSlide as $k=>$v){
			$indexSlide[$k]['img']=\Library\Thumb::getOrigImg($v['img']);
		}
		

        $topCat=$productModel->getTopCate(5);
		//获取交易市场信息
        $offer = new offersModel();
		$offerList = array();
		foreach($topCat as $key=>$val){
			$offerList[$val['id']] = $offer->getOfferCategoryList($val['id']);
			

		}

        //获取首页配置的板块信息
        $indexConfig = new indexModel();
        $configData = $indexConfig->getIndexconfigCP();


        $this->getView()->assign('productData',$configData);
       // $this->getView()->assign('configData1',$configData1);
		$this->getView()->assign('offerCateList',\Library\json::encode($offerList));
		$this->getView()->assign('topCat',$topCat);
		$this->getView()->assign('indexSlide',$indexSlide);
	}
    
    
    //支付异步回调
    public function serverCallbackAction(){
        //从URL中获取支付方式
        $payment_id      = safe::filterGet('id','int');
        $paymentInstance = Payment::createPaymentInstance($payment_id);


        if(!is_object($paymentInstance))
        {
            die('fail');
        }

        //初始化参数
        $money   = '';
        $message = '支付失败';
        $orderNo = '';

        //执行接口回调函数
        $callbackData = array_merge($_POST,$_GET);
        unset($callbackData['controller']);
        unset($callbackData['action']);
        unset($callbackData['_id']);
        $return = $paymentInstance->serverCallback($callbackData,$payment_id,$money,$message,$orderNo);        
        //支付成功
        if($return)
        {
            //充值方式
            $recharge_no = str_replace('recharge','',$orderNo);
            $rechargeObj = new M('recharge_order');
            $rechargeRow = $rechargeObj->getObj('recharge_no = "'.$recharge_no.'"');
            if(empty($rechargeRow))
            {
                die('fail') ;
            }
            $dataArray = array(
                'status' => 1,
            );

            $rechargeObj->data($dataArray);
            $result = $rechargeObj->data($dataArray)->where('recharge_no = "'.$recharge_no.'"')->update();

            if(!$result)
            {
                die('fail') ;
            }

            $money   = $rechargeRow['account'];
            $user_id = $rechargeRow['user_id'];
            $agenA = new \nainai\fund\agentAccount();
            $res = $agenA->in($user_id, $money);
            if($res)
            {
                $paymentInstance->notifyStop();
                exit;
            }
        }
        //支付失败
        else
        {
            $paymentInstance->notifyStop();
            exit;
        }
    }

	public function foundAction(){
        $this->getView()->assign('cur','found');
    }
    
    public function doFoundAction(){
        if(!$this->login)
        {
            die(json::encode(tool::getSuccInfo(0,'请登录后再操作', url::createUrl('/login/login@user'))));
        }
        else
        {
            $foundObj = new M('found');
            $fData = array(
                'product_name' => safe::filterPost('name'),
                'spec' => safe::filterPost('spec'),
                'num' => safe::filterPost('num'),
                'place' => safe::filterPost('place'),
                'user_name' => safe::filterPost('username'),
                'phone' => safe::filterPost('phone'),
                'area' => safe::filterPost('local'),
                'user_id' => $this->login['user_id'],
                'description' => safe::filterPost('desc'),
                'create_time' => date('Y-m-d H:i:s')
            );

            $f_id = $foundObj->data($fData)->add();
            if($f_id){
                die(json::encode(\Library\tool::getSuccInfo()));
            }
            else
            {
                die(json::encode(\Library\tool::getSuccInfo(0, '服务器错误')));
            }
        }
        
	}


    public function helpAction(){
    }

    public function storageAction(){
        $this->getView()->assign('cur','storage');
    }
    
    //获取首页交易市场数据
    public function getCateOfferListAction()
    {
        $id = safe::filterPost('id', 'int');
        $id = 6;
        $offer = new OffersModel();
        $data = $offer->getOfferCategoryList($id);
        foreach($data as $k => $v)
        {
            $data[$k]['produce_area'] = substr($v['produce_area'],0,2);
        }
        die(json::encode($data));
    }
    public function monitorAction(){
         $this->getView()->assign('cur','storage');
    }
    public function monitorvideoAction(){
         $this->getView()->assign('cur','storage');
    }
    public function monitorvideo2Action(){
         $this->getView()->assign('cur','storage');
    }
}

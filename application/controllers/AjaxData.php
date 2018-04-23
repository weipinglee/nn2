<?php
/**
 * 交易中心不需要登录的控制器公共类
 */
use \Library\url;
use \Library\safe;
use \Library\tool;
class AjaxDataController extends \Yaf\Controller_Abstract{

     public $login;

     private $offer;
     private $order;
     public function init(){
          $this->offer = new offersModel();
          $right = new \Library\checkRight();
          $isLogin = $right->checkLogin();
          if($isLogin){
               $this->login = \Library\session::get('login');
          }
     }

     /**
      * AJax获取产品分类信息
      * @return [Json]
      */
     public function ajaxGetCategoryAction(){
          $pid = safe::filterPost('pid', 'int',0);
          $type = safe::filterPost('type', 'int',0);
          $mode = safe::filterPost('mode', 'int',0);
          $page = safe::filterPost('page','int',1);
          $order = safe::filterPost('sort');
          $area = safe::filterPost('area','int',0);
          $search = safe::filterPost('search');



          //获取这个分类下对应的产品信息
          $condition = array();
          $cate = array();
          if($pid!=0)
               $condition['pid'] = $pid;
          if($type!=0){
               $condition['type'] = $type;
          }
          if($mode!=0){
               if($mode<=4)
                    $condition['mode'] = $mode;
               elseif($mode==5){
                    $condition['sub_mode'] = 1;
               }
               else
                    $condition['sub_mode'] = 2;

          }
          if($area!=0){
               $condition['area'] = $area;
          }
          if($search!=''){
               $condition['search'] = $search;
          }

          if($order!=''){
               $orderArr = explode('_',$order);
               switch($orderArr[0]){
                    case 'price' : {
                         if(isset($orderArr[1]) && $orderArr[1]=='asc')
                              $order = 'price asc';
                         else $order = 'price desc';
                    }
                         break;
                    case 'time' : {
                         if(isset($orderArr[1]) && $orderArr[1]=='asc')
                              $order = 'apply_time asc';
                         else $order = 'apply_time desc';
                    }
                         break;
                    default : {
                         $order = '';
                    }
               }
          }
          else $order = '';
          $data = $this->offer->getList($page, $condition,$order,$this->login['user_id']);
          if ( ! empty($this->login)) {
               $data['login'] = 1;
          }else{
               $data['login'] = 0;
          }

          // var_dump($data);exit;
          echo \Library\json::encode($data);
          exit();
     }

     /**
      * 根据传回的条件参数，查询产品
      */
     public function getIndexProductAction()
     {
          $config_id = safe::filterGet('config_id','int',0);
          $data = $this->offer->getOfferlistByConfig($config_id);
          die(\Library\json::encode($data));

     }

     public function getConfigProductAction()
     {

     }
	 
	 public function zixunDataAction(){
		 $url = 'http://172.16.2.30/interface/tradewebinfo';
		 $ch = curl_init($url);
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST,1);
	 	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	 	//curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
	 	$output = curl_exec($ch);
	 	if(curl_errno($ch)){
	 		die('网络错误');
	 	}
		curl_close($ch);
		//$xml_obj = (array)new \SimpleXMLElement($output);
		die($output);
	 }



     public function healthAction(){
          die(\Library\json::encode(array('status'=>'UP','info'=>'SUCCESS')));
	 }

     /**
      * 报盘热销排行榜
      */
     public function offerRankAction()
     {
          $query = new \Library\Query('product_offer as o');
          $query->join = "left join products as p on o.product_id = p.id  ";
          $query->fields = "o.*,p.img,p.name,p.note,p.unit,p.quantity,p.freeze,p.sell,p.produce_area,IF(p.quantity-p.sell-p.freeze>0,0,1) as jiao";

          $query->where = ' o.status=:status and o.is_del = 0  and o.expire_time > now()';

          $query->bind = array('status'=>1);
          $query->order = 'o.sell_num desc';
          $query->limit = 6;
          $data = $query->find();
          foreach ($data as $key => &$value) {
               $value['img'] = empty($value['img']) ? '' : \Library\thumb::get($value['img'],180,180);//获取缩略图
          }
          die(\Library\json::encode($data));

     }

    public function checkLoginAction(){
        $right = new \Library\checkRight();
        $isLogin = $right->checkLogin();
        if($isLogin){
            $this->login = \Library\session::get('login');
            //获取未读消息
            $messObj=new \nainai\message($this->login['user_id']);
            $mess=$messObj->getCountMessage();
            $jsonArr = array(
                'mess'=>$mess,
                'login'=>1,
                'username'=>$this->login['username'],
                'sess_id' =>session_id(),
                'user_id' => $this->login['user_id'],
                'cert'    => $this->login['cert']
            );
            die(json_encode($jsonArr));

        }
        else
            die(json_encode(array('login'=>0)));
    }

    //计算定金
    public function payDepositComAction(){
        $num = safe::filterPost('num','floatval');
        $id = safe::filterPost('id','int');
        $price = safe::filterPost('price','floatval');
        $order = new \nainai\order\Order();
        $amount = $num * $price;
        $payDeposit = $order->payDepositCom($id,$amount);
        $res = $payDeposit === false ? tool::getSuccInfo(0,'获取定金失败') : tool::getSuccInfo(1,$payDeposit);
        die(json_encode($res));
    }



}
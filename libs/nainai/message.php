<?php 
/**
 * 用户消息通知类
 * author :wangzhande
 * Date :2015/5/12
 */
namespace nainai;
use \Library\M;
use \Library\Query;
class message{
	//用户id 
	private $user_id="";
	//通知类型
	private static $type=array(
		'orderPay',
		'fundOut',
		'depositPay',
		'newbankaccount',
		'breakcontract',
		'fundInOk',
		'fundInFail',
		'fundOutOk',
		'fundOutFail',
		'accountOk',
		'accountFail'
	);
	/**
	 * [__construct 构造方法]
	 * @param     [type]      $user_id 用户id
	 */
	public function __construct($user_id){
		$this->user_id=$user_id;
	}
	private $messCode=array(
		'sendOk'=>array('code'=>1,'info'=>'发送成功'),
		'sendWrong'=>array('code'=>0,'info'=>'发送失败'),
		'typeWrong'=>array('code'=>0,'info'=>'类型不存在')
		);
	/**
	 * [send  发送消息]
	 * @param   $type    通知类型
	 * @param   $param 订单id,
	 * @return    [type]             [description]
	 */
	public function send($type,$param=""){
		if(in_array($type, self::$type)){
			$mess=call_user_func(array(__CLASS__,$type),$param);
			$mess['user_id']=$this->user_id;
			$mess['send_time']= \Library\Time::getDateTime();
			$messObj=new M('message');
			if($messObj->data($mess)->add()){
				return $this->messCode['sendOk'];
			}else{
				return $this->messCode['sendWrong'];
			}


		}else{
			return $this->messCode['typeWrong'];
		}
	}
	/**
	 * [order_pay 支付通知]
	 * @param     [type]      $order_id 
	 * @return    [type]                [内容]
	 */
	public function orderPay($order_id){
		$title='支付通知';
		$message="您的订单".$order_id."已经形成,请在多少时间内支付 <a href='?order_id={$order_id}'></a>";
		return array(
			'title'=>$title,
			'content'=>$message);
	}
	public function breakcontract($order_id){
		$title="违约";
		$message="您的订单".$order_id."已被判为违约";
		return array(
			'title'=>$title,
			'content'=>$message);
	}
	public function depositPay($order_id){
		$title="保证金支付";
		$message="您的订单".$order_id."需支付保证金";
		return array(
			'title'=>$title,
			'content'=>$message);
	}
	public function buyerRetainage($order_id){
		$title="尾款通知";
		$message="您的订单".$order_id."买家已支付尾款";
		return array(
			'title'=>$title,
			'content'=>$message);
	}
	public function buyerProof($order_id){
		$title="请确认支付凭证";
		$message="您的订单".$order_id."买家已上传支付凭证";
		return array(
			'title'=>$title,
			'content'=>$message);
	}
	public function newbankaccount(){
		$title = '开户提醒';
		$message='有买家要通过线下支付货款，请尽快开户';
		return array(
			'title'=>$title,
			'content'=>$message);
	}
	public function fundInOk(){
		$title='入金审核结果';
		$message='您好，你的入金申请已通过审核，请您关注资金动态';
		return array(
			'title'=>$title,
			'content'=>$message
			);
	}
	public function fundInFail(){
		$title='入金审核结果';
		$message='很遗憾，您的入金申请未通过审核';
		return array(
			'title'=>$title,
			'content'=>$message
		);
	}
	public function fundOutOk(){
		$title='出金审核结果';
		$message='审核通过：您好，您的出金申请已通过审核，已向您打款，请您关注资金动态。';
		return array(
			'title'=>$title,
			'content'=>$message
		);
	}
	public function fundOutFail(){
		$title='出金审核结果';
		$message='未通过认证：很遗憾，您的出金申请未通过审核。';
		return array(
			'title'=>$title,
			'content'=>$message
		);
	}
	public function accountOk(){
		$title='开户审核结果';
		$message='审核通过：您好，您的开户申请已通过审核。';
		return array(
			'title'=>$title,
			'content'=>$message
		);
	}
	public function accountFail(){
		$title='开户审核结果';
		$message='通过认证：很遗憾，您的开户申请未通过审核。';
		return array(
			'title'=>$title,
			'content'=>$message
		);
	}
	/**
	 * [fundOut 提现通知]
	 * @param     [type]      $order_id [订单id]
	 * @return    [type]                [通知内容]
	 */
	public function fundOut($order_id){
		$title='提现通知';
		$message='您的提现订单号为：'.$order_id;
		return array(
			'title'=>$title,
			'content'=>$message
			);

	}
	/**
	 * [isReadMessage 获取已读消息]
	 */
	public function isReadMessage(){
		$messObj=new Query('message');
		$messObj->fields='id,title,content,send_time';
		$messObj->where='user_id = :user_id and write_time is NOT NULL';
		$messObj->bind=array('user_id'=>$this->user_id);
		return $messObj->find();

	}
	/**
	 * [getNeedmessage 获取未读信息]
	 * @return    [type]      [description]
	 */
	public function getNeedMessage(){
		$messObj=new Query('message');
		$messObj->fields='id,title,content,send_time';
		$messObj->where='user_id = :user_id and write_time is NULL';
		$messObj->bind=array('user_id'=>$this->user_id);
		return $messObj->find();
	}
	//获取未读消息的总数
	public function getCountMessage(){
		$res=$this->getNeedMessage();
		return count($res);

	}
	/**
	 * [writeMess 写入阅读时间]
	 * @param     [type]      $message_id [消息id]
	 * @return    [type]                  [description]
	 */
	public function writeMess($message_id){
		$messObj=new M('message');
		$where=array('id'=>$message_id);
		$data['write_time']=\Library\Time::getDateTime();
		return $messObj->where($where)->data($data)->update();
	}

	/**
	 * 获得所有消息
	 * @param int $page
	 * @return array
     */
	public function getAllMessage($page=1){
		$messObj=new Query('message');
		$messObj->where='user_id= :user_id';
		$messObj->bind=array('user_id'=>$this->user_id);
		$messObj->order='send_time desc';
		$messObj->page=$page;
		$messInfo=$messObj->find();
		$bar=$messObj->getPageBar();
		return array($messInfo,$bar);
	}

	/**
	 * 批量删除消息
	 * @param $ids
     */
	public function batchDel($ids){
		$messObj=new M('message');
		$where='id in ('.$ids.')';
		return $messObj->where($where)->delete();
	}

	/**
	 * 单个删除消息
	 * @param $id
	 * @return mixed
     */
	public function delMessage($id){
		$messObj=new M('message');
		$where=array('id'=>$id);
		return $messObj->where($where)->delete();

	}
}

?>
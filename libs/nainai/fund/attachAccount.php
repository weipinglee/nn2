<?php 

/**
 * 用户银企直连附属账户操作
 * @author panduo
 * @datetime  2016-07-18 10:35:40
 */

namespace nainai\fund;
use \Library\M;
class attachAccount{

	protected $attachTable;

	public function __construct(){
		$this->attachTable = new M('user_attach');
	}

	/**
	 * 新增一条附属账户信息
	 * @param array $data 账户信息
	 */
	public function addAttach($data){
		$data['time'] = date('Y-m-d H:i:s',time());
		$res = $this->attachTable->data($data)->add();
		return (boolean)$res;
	}

	/**
	 * 获取指定用户与银行的附属账户信息
	 * @param  int $user_id 用户id
	 * @param  string $bank  所属银行
	 * @return array  账户信息数组
	 */
	public function attachInfo($user_id,$bank='zx'){
		return $this->attachTable->where(array('bank'=>$bank,'user_id'=>$user_id))->getObj();
	}

	/**
	 * curl模拟post提交
	 * @param  array  $data 数据
	 */
	public function curl($xml){
		$header []= "Content-type:text/xml";
		$url = 'http://192.168.2.12:6789';
		$ch = curl_init($url);
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST,1);
	 	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	 	curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
	 	curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
	 	curl_setopt($ch,CURLOPT_POSTFIELDS,$xml);
	 	$output = curl_exec($ch);
	 	if(curl_errno($ch)){
	 		print curl_errno($ch);
	 	}
	 	// var_dump($output);
		curl_close($ch);
		$xml_obj = (array)new \SimpleXMLElement($output);
		// var_dump($xml_obj);
		return $xml_obj;
	}
}

?>

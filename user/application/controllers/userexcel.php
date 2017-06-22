<?php
/**
 * 利用excel导入用户数据
 * User: weipinglee
 * Date: 2017/6/22 0022
 * Time: 下午 2:43
 */
use \Library\M;
class userexcelController extends \Yaf\Controller_Abstract
{

    protected  $dir = 'F://user/kefu.xlsx';

    protected $fields = array(
        'H' => 'type',
        'C'=>'company_name',
        'D'=>'address',
        'E'=>'email',
        'F'=>'contact',
        'G'=>'contact_phone',
    );

    public $cates = array(
        111,115,123,159,24,
    );

    public function getDirExcel(){
        $fileList = scandir($this->dir);
        return $fileList;
    }


    public function seetimeAction(){
        $str1 = '1464710400';
        $str2 = '1496246400';
        $timeStr = '14'.rand(64710400,96246400);

        $date = \Library\time::getDateTime('Y-m-d',$timeStr);
        $hour = rand(6,23);
        $min = rand(0,59);
        $sec = rand(0,59);
        return  $date.' '.$hour.':'.$min.':'.$sec;
    }

    public function createUserAction(){
       $max_user_id = $this->getMaxUserId();//插入开始的user_id

        $excelObj = new \Library\excel();
        $data = $excelObj->getExcelData($this->dir,20001,31209,$this->fields);

        $userData = array();
        $companyData = array();
        foreach($data as $key=>$val){
            $userData[$key]['id'] = $max_user_id + $key;
            $num = rand(6,12);
            $userData[$key]['username'] = $this->randCode($num);
            $userData[$key]['email'] = $data[$key]['email'];
            $userData[$key]['mobile'] = str_replace('TEL：','',$data[$key]['contact_phone']);
            $userData[$key]['type'] = 1;
            $userData[$key]['is_false'] = 1;
            $userData[$key]['create_time'] = $this->seetimeAction();

            $companyData[$key]['user_id'] = $userData[$key]['id'];
            $companyData[$key]['company_name'] = $data[$key]['company_name'];
            $companyData[$key]['address'] = str_replace('地址：','',$data[$key]['address']);
            $companyData[$key]['contact'] = $data[$key]['contact'];
            $companyData[$key]['contact_phone'] = str_replace('TEL：','',$data[$key]['contact_phone']);
            $companyData[$key]['is_false'] = 1;
            $companyData[$key]['category'] = $this->cates[rand(0,4)];
        }

        $M = new M('user');
        $M2 = new M('company_info');
        $M->beginTrans();
        $M->data($userData)->adds();
        $M2->data($companyData)->adds();
        if($M->commit()){
            echo '成功';
        }
        else echo '失败';




    }

    public function randCode($length = 5, $type = 2) {
        $arr = array(1 => "0123456789", 2 => "abcdefghijklmnopqrstuvwxyz");
        if ($type == 0) {
            array_pop($arr);
            $string = implode("", $arr);
        } elseif ($type == "-1") {
            $string = implode("", $arr);
        } else {
            $string = $arr[$type];
        }
        $count = strlen($string) - 1;
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $string[rand(0, $count)];
        }
        return $code;
    }

    /**
     * 获取最大用户id
     * @return mixed
     */
    public function getMaxUserId(){
        $M = new M('user');
        $res = $M->order('id desc')->getField('id');
        return $res+1;
    }

    public function addUserAction(){
        $M = new M('user');
        $data = array('username'=>'qwe','mobile'=>'14234343434');
        $M->data($data)->add();
    }

}
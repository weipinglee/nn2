<?php
/**
 * 用户认证处理类
 * User: weipinglee
 * Date: 2016/3/11
 * Time: 22:55
 */
namespace nainai\cert;
use \Library\M;
use \Library\Time;
use \Library\Query;
use \Library\Thumb;
use \Library\log;
class certificate{

    const CERT_BEFORE  =  -1; //表示从未发起认证,不存在认证数据
    const CERT_INIT    =   0; //未发起认证,修改资料后为此状态
    const CERT_APPLY   =   1; //发起申请认证
    const CERT_SUCCESS =   2; //后台确认认证通过
    const CERT_FAIL    =   3; //后台拒绝认证

    protected $certTable = array(
        'deal'=>'dealer',
        'store'=>'store_manager'

    );

    protected $certFields = array();

    /**
     * 获取用户认证状态
     */
    public function getCertStatus($user_id,$cert_type){
        $certM = new M($this->certTable[$cert_type]);
        $status_data = $certM->where(array('user_id'=>$user_id))->getObj();
        $status_data['status'] = empty($status_data) ? self::CERT_BEFORE : $status_data['status'];
        return $status_data;
    }

    /**
     * 获取用户中心认证页面显示内容
     * @param int $user_id
     * @param string $cert_type 认证类型
     * @return array
     */
    public function getCertShow($user_id,$cert_type){
        $status_data = $this->getCertStatus($user_id,$cert_type);
        $certArr = array();
        switch($status_data['status']){
            case self::CERT_BEFORE : {//从未申请
                $certArr['button_show'] = true;
                $certArr['button_text'] = '去认证';
                $certArr['status_text'] = '未认证';

            }
            break;
            case self::CERT_INIT:{//更改资料后
                $certArr['button_show'] = true;
                $certArr['button_text'] = '重新认证';
                $certArr['status_text'] = '认证失效';
            }
            break;
            case self::CERT_APPLY:{//提交申请
                $certArr['button_show'] = false;
                $certArr['button_text'] = '';
                $certArr['status_text'] = '等待审核';
            }
            break;
            case self::CERT_SUCCESS:{//认证成功
                $certArr['button_show'] = false;
                $certArr['button_text'] = '';
                $certArr['status_text'] = '认证成功';
            }
            break;
            case self::CERT_FAIL : {//认证驳回
                $certArr['button_show'] = true;
                $certArr['button_text'] = '重新认证';
                $certArr['status_text'] = '认证被驳回';
                $certArr['err_info']    = $status_data['info'];
            }
            break;
        }
        return $certArr;
    }
    /**
     * 检验用户是否信息填写完整
     * @param int $user_id
     * @param int $type
     */
    public function checkUserInfo($user_id,$type){
        $userModel = new \UserModel();
        return $userModel->checkUserInfo($user_id,$type);
    }
    /**
     * 认证交易商
     * @param int $user_id 用户id
     */
    public function certDealApply($user_id){
        $certModel = new M('dealer');
        $status = self::CERT_APPLY;
        $insert_data = array('user_id'=>$user_id,'status'=>$status,'apply_time'=>Time::getDateTime());
        $update_data = array('status'=>$status,'apply_time'=>Time::getDateTime());
        return $certModel->insertUpdate($insert_data,$update_data);



    }

    /**
     * 认证仓库管理
     * @param int $user_id
     * @param int $store_id
     */
    public function certStoreApply($user_id,$store_id){
        $certModel = new M($this->certTable['store']);
        $status = self::CERT_APPLY;
        $sql = 'INSERT INTO '.$certModel->table().' (`user_id`,`status`,`apply_time`,`store_id`) VALUES ('.$user_id.','.$status.',"'.Time::getDateTime().'",:store_id) ON DUPLICATE KEY UPDATE status ='.$status.' , store_id=:store_id,apply_time = "'.Time::getDateTime().'"';

        return $certModel->bind(array('store_id'=>$store_id))->query($sql);
    }
    /**
     * 后台审核认证
     * @param int $user_id 用户id
     * @param int $result 审核结果 0：驳回 1：通过
     * @param string $info 驳回原因或成功提示信息
     * @param string $type 认证类型
     */
    public function certVerify($user_id,$result=1,$info='',$type='deal'){
        $table = self::getCertTable($type);
        $certModel = new M($table);
        $certModel->beginTrans();
        $status = $result==1 ? self::CERT_SUCCESS : self::CERT_FAIL;
        $certModel->data(array('status'=>$status,'message'=>$info,'verify_time'=>Time::getDateTime()))->where(array('user_id'=>$user_id))->update();

        $log = new log();
        $logs = array('admin','处理了一个申请认证','用户id:'.$user_id);
        $log->write('operation',$logs);

        $certModel->commit();
    }

    /**
     *认证复原，status改为0，需重新认证
     * @param int $user_id
     *
     */
    public function certInit($user_id){
        $tables = $this->certTable;
        $m = '';
        foreach($tables as $val){
            $m = new M($val);
            $res = $m->data(array('status'=>self::CERT_INIT))->where(array('user_id'=>$user_id))->update();
            if($res===false)//更新失败，后续不再更新
                break;
        }
        if(is_object($m))
             $m->commit();


    }

    /**
     * 获取申请认证用户列表
     * @param string $type 认证类型
     * @param int $page 页码
     */
    public function certApplyList($type,$page){
        if(!isset($type))return array();
        $table = self::getCertTable($type);
        $Q = new Query('user as u');
        $Q->join = 'left join '.$table.' as c on u.id = c.user_id';
        $Q->fields = 'u.id,u.type,u.username,u.mobile,u.email,u.status as user_status,u.create_time,c.status ,c.apply_time';
        $Q->page = $page;
        $Q->where = 'c.status='.self::CERT_APPLY;
        $data = $Q->find();
        $pageBar =  $Q->getPageBar();
        return array('data'=>$data,'bar'=>$pageBar);
    }

    /**
     * 获取认证类型相对应的表
     * @param string $type
     */
    private function getCertTable($type){
        $table = '';
        switch($type){
            case 'deal' : $table = 'dealer';
                break;
        }
        return $table;
    }

    /**
     * 获取申请认证的详细信息
     * @param int $id 用户id
     * @param string $certType 认证类型
     */
    protected function getCertDetail($id,$certType){
        $userModel = new M('user');
        $userData = $userModel->fields('username,type,mobile,email')->where(array('id'=>$id,'pid'=>0))->getObj();

        if(!empty($userData)){
            $userDetail = $userData['type']==1 ? $this->getCompanyInfo($id) : $this->getPersonInfo($id);
            $userCert   = $userModel->table($this->getCertTable($certType))->where(array('user_id'=>$id))->getObj();

            return array_merge($userDetail,$userCert,$userData);
        }
        return array();

    }

    /**
     * 获取用户信息(企业或个人）
     * @param $user_id
     */
    private function getPersonInfo($user_id){
        $um = new M('person_info');
        $result = $um->where(array('user_id'=>$user_id))->getObj();
        $result['identify_front_thumb'] = Thumb::get($result['identify_front'],300,200);
        $result['identify_back_thumb'] = Thumb::get($result['identify_back'],300,200);
        return $result;
    }

    /**
     * 获取用户信息(企业或个人）
     * @param $user_id
     */
    private function getCompanyInfo($user_id){
        $um = new M('company_info');
        $result = $um->where(array('user_id'=>$user_id))->getObj();
        $result['cert_oc_thumb'] = Thumb::get($result['cert_oc'],300,200);
        $result['cert_bl_thumb'] = Thumb::get($result['cert_bl'],300,200);
        $result['cert_tax_thumb'] = Thumb::get($result['cert_tax'],300,200);
        return $result;
    }
}
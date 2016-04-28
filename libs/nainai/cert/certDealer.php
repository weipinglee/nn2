<?php
/**
 * 交易商认证管理类
 * author: weipinglee
 * Date: 2016/4/27 0027
 * Time: 下午 3:35
 */

namespace nainai\cert;
use Library\M;

class certDealer extends certificate{


    public static $certType = 'deal';
    //认证需要的字段,0个人用户，1企业用户
    public $certFields = array(

        0=>array(

        ),
        1=>array(
            'company_name',
            'area',
            'address',
            'legal_person',
            'contact',
            'contact_phone',
            'cert_oc',//组织机构代码证
            'cert_bl',
            'cert_tax'
        )
    );

    /**
     *获取认证资料
     * @param $user_id
     */
    public function getCertData($user_id){
        return $this->getCertDetail($user_id,self::$certType);


    }


}
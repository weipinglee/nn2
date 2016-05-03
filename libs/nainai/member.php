<?php
/**
 * 会员操作类
 * author: weipinglee
 * Date: 2016/5/3 0003
 * Time: 下午 5:17
 */
namespace nainai;
class member{

    protected static $userType = array(
        0=>'个人',
        1=>'企业'
    );

    /**
     * 获取会员类型
     * @param $type
     * @return string
     */
    public static function getType($type){
        return isset(self::$userType[$type]) ? self::$userType[$type] : '未知';
    }
}
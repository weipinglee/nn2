<?php
/**
 * User: maoyong
 * Date: 2016/5/17 0017
 * Time: ÏÂÎç 5:05
 */

use \Library\Query;
use \Library\M;
class indexModel {

    /**
     * 获取按信誉排行的企业用户列表
     * @param $num
     */
   public function getCreditMemberList($num){
        $obj = new Query('user as u');
       $obj->join = 'left join company_info as c on u.id=c.user_id ';
       $obj->fields = 'u.id,u.credit,c.company_name';
       $obj->where = 'u.type=1';
       $obj->order = 'u.credit DESC';
       $obj->limit = $num;
       $data = $obj->find();
       $mem = new \nainai\member();
        foreach($data as $k=>$v){
            $group = $mem->getUserGroup($v['id']);
            $data[$k]['group_name'] = $group['group_name'];
            $data[$k]['icon'] = $group['icon'];
        }
       return $data;
   }

    /**
     * 获取注册的企业量
     * @return Array.num 企业量
     */
    public function getTotalCompany(){
        $mem = new M('user');
        return $mem->fields(' COUNT(id) as num')->where(array('type'=>1))->getObj();
    }



}
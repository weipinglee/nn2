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
       $memcache=new \Library\cache\driver\Memcache();
       $creditMemberList=$memcache->get('creditMemberList');
       if($creditMemberList){
           return unserialize($creditMemberList);
       }
        $obj = new Query('user as u');
       $obj->join = 'left join company_info as c on u.id=c.user_id left join user_account as ua on u.id = ua.user_id';
       $obj->fields = 'u.id,u.credit,c.company_name,ua.credit as credit_money';
       $obj->where = 'u.type=1';
       $obj->order = 'u.credit DESC';
       $obj->limit = $num;
	   $obj->cache = 'm';
       $data = $obj->find();
       $mem = new \nainai\member();
       if(!empty($data)){
           foreach($data as $k=>$v){
               $group = $mem->getUserGroup($v['id']);
               $data[$k]['group_name'] = $group['group_name'];
               $data[$k]['icon'] = $group['icon'];
           }
       }
        $memcache->set('creditMemberList',serialize($data));
       return $data;
   }

    /**
     * 获取注册的企业量
     * @return Array.num 企业量
     */
    public function getTotalCompany(){
        $memcache=new \Library\cache\driver\Memcache();
        $totalCompany=$memcache->get('totalCompany');
        if($totalCompany){
            return unserialize($totalCompany);
        }
        $mem = new M('user');
        $totalCompany=$mem->fields(' COUNT(id) as num')->where(array('type'=>1))->getObj();
        $memcache->set('totalCompany',serialize($totalCompany));
        return $totalCompany;
    }
    /*
     * 获取所有用户的数量
     * */

    public function getAllUser(){
        $memcache=new \Library\cache\driver\Memcache();
        $allUser=$memcache->get('allUser');
        if($allUser){
            return unserialize($allUser);
        }
        $userObj=new M('user');
        $allUser=$userObj->fields('count(id) as num')->getObj();
        $memcache->set('allUser',serialize($allUser));
        return $allUser;
    }


    /**
     * 获取首页配置
     * @return mixed
     */
    public function getIndexconfigCP()
    {
        $configObj = new M('configs_indexshow');
        return $configObj->where(array('type'=>'产品'))->limit(5)->order('sort asc')->select();

    }

    public function getIndexConfig($id){
        $configObj = new M('configs_indexshow');
        return $configObj->where(array('id'=>$id))->getObj();
    }

    public function getIndexconfigZX()
    {
        $configObj = new M('configs_indexshow');
        return $configObj->where(array('type'=>'资讯'))->limit(1)->select();

    }

    public function userInfo($mobile){
        $obj = new \Library\Query('user as u');
        $obj->join = 'left join company_info as c on u.id=c.user_id 
                      left join user_bank as b on u.id=b.user_id';
        $obj->fields = ' c.company_name ,c.legal_person,c.contact,c.contact_phone,c.area,c.address,c.business,c.cert_bl as business_licence,
                        b.bank_name,b.card_no as bank_no,b.true_name as name,b.proof as evidence';
        $obj->where = 'u.mobile='.$mobile;
        $data = $obj->getObj();
        if($data['business_licence']){
            $data['business_licence'] = dirname(dirname(__dir__)).'/user/'.$data['business_licence'];
            $data['business_licence'] = substr($data['business_licence'],0,strpos($data['business_licence'],'@'));
            if(file_exists($data['business_licence'])){
                $data['business_licence'] = base64_encode(file_get_contents($data['business_licence']));
            }else{
                $data['business_licence'] = '';
            }


        }

        if($data['evidence']){
            $data['evidence'] = dirname(dirname(__dir__)).'/user/'.$data['evidence'];
            $data['evidence'] = substr($data['evidence'],0,strpos($data['evidence'],'@'));
            if(file_exists($data['evidence'])){
                $data['evidence'] = base64_encode(file_get_contents($data['evidence']));
            }else{
                $data['evidence'] = '';
            }
        }

        return $data;
    }

}
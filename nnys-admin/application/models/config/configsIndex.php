<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/15 0015
 * Time: 上午 9:42
 */

namespace config;
use admintool\adminQuery;
use Library\searchQuery;

class configsIndexModel extends \baseModel{

    //配置表名
    protected $table = 'configs_indexshow';

    //配置信息规则
    protected $rules = array(
        array('id','number','id错误',0,'regex'),
        array('user_id','number','用户id错误',2,'regex'),
        array('sub_title','s{2,100}','配置项中文名错误',0,'regex'),
    );



    public function getConfigList($page=1)
    {
        $obj = new adminQuery($this->table .' as c');
        $obj->join = 'left join user as u on c.user_id=u.id';
        $obj->fields = 'c.*,u.username,u.mobile';
        $obj->page = $page;
        return $obj->find();

    }

    /**
     * 将id组成的数组以逗号相隔放入配置表的proids字段
     * @param $configId int 配置id
     * @param $idArray array 要添加的产品id
     */
    public function addConfigIds($configId,$idArray)
    {
        if(empty($idArray))
            return \Library\tool::getSuccInfo(0,'请选择产品');
        $configObj = new \Library\M($this->table);
        $oldIds = $configObj->where(array('id'=>$configId))->getField('proids');
        if($oldIds!=''){
            $oldIdsArr = explode(',',$oldIds);
            foreach($idArray as $key=>$val){
                if(in_array($idArray[$key],$oldIdsArr)){
                    unset($idArray[$key]);
                }
            }
        }

        if(!empty($idArray)){
            $idStr = $oldIds=='' ? join(',',$idArray) : $oldIds.','.join(',',$idArray);
            $res = $configObj->where(array('id'=>$configId))->data(array('proids'=>$idStr))->update();
            if($res)
                return \Library\tool::getSuccInfo(1);
            else
                return \Library\tool::getSuccInfo(0,'添加失败');
        }
        else{
            return \Library\tool::getSuccInfo(1);
        }

    }

    //获取选中的商品列表
    public function getConfigProducts($configId,$page=1)
    {
        $configObj = new \Library\M($this->table);
        $ids = $configObj->where(array('id'=>$configId))->getField('proids');
        if($ids){

            $where = array('str'=>'o.id in ('.$ids.')');
        }
        else{
            $where = array('str'=>'o.id=0');
        }
        $offerObj = new \OfferManageModel();
        return  $offerObj->getSearchProduct($where,$page);


    }

    public function delConfigProduct($configId,$proId)
    {
        $configObj = new \Library\M($this->table);
        $oldIds = $configObj->where(array('id'=>$configId))->getField('proids');
        if($oldIds){
            $oldIdsArr = explode(',',$oldIds);
            foreach($oldIdsArr as $key=>$val){
                if($val==$proId){
                    unset($oldIdsArr[$key]);
                }
            }
            $newIds = join(',',$oldIdsArr);
            $res = $configObj->where(array('id'=>$configId))->data(array('proids'=>$newIds))->update();
            if($res)
                return \Library\tool::getSuccInfo(1);
            else
                return \Library\tool::getSuccInfo(0,'删除失败');
        }
        return \Library\tool::getSuccInfo(0,'删除失败');

    }












}
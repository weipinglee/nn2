<?php
namespace schema\Data;

use \Library\M;
use \Library\Query;
/**
 * Class DataSource
 *

 */
class JingjiaBaojia extends Template
{

    protected  $except = array('buyer');//排除的字段

    protected  $table = 'product_jingjia';

    protected  $primaryKey = 'id';

    protected  $buffer = array();

    protected  function selectData($args, $context, $ids=array() ,$fields = '*')
    {
        if(!empty($ids)){
            $where = array('id'=>array('in',join(',',$ids)));
        }else{
            $where = array('id'=>$args['id']);
        }
        $obj = new M($this->table);
        $data = $obj->fields($fields)->where($where)->select();
        return $data;
    }

    protected  function getOneBuffer($args){
        $id = $args['id'];
        if(!empty( $this->buffer) && isset($this->$buffer[$id])){
            return $this->buffer[$id];
        }else{
            return array();
        }
    }

    /**
     * 根据参数和字段，从数据库查找一条数据
     * @param $args
     * @param array $fields
     * @return mixed
     */
    protected  function getOneData($args,$fields=array())
    {
        if(isset($args['id']) && $args['id']){
            $where['id'] = $args['id'];
        }

        $obj = new M($this->table);
        if(empty($where)){
            return array();
        }
        $data = $obj->fields($fields)->where($where)->getObj();
        return $data;
    }

    protected  function getMoreData($args, $context, $fields='*'){
        $where = array('offer_id'=>$args['offer_id']);
        $obj = new M($this->table);
        $data = $obj->fields($fields)->where($where)->select();
        return $data;
    }







}

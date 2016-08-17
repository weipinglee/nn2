<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/28
 * Time: 17:07
 */

namespace nainai\system;


use Library\Query;

class help
{
    public $helpLimit=3;
    public $helpCatLimit=3;
    public function getHelplist(){
        $helpCatObj=new Query('help_category');
        $helpCatObj->where="status=:status";
        $helpCatObj->bind=['status'=>1];
        if($this->helpCatLimit!='') {
            $helpCatObj->limit = $this->helpCatLimit;
        }
        $helpCatObj->order=' sort asc';
        $helpCatList=$helpCatObj->find();
        $helpObj=new Query('help');
        if($this->helpLimit!="") {
            $helpObj->limit = $this->helpLimit;
        }
        $helpObj->order=' sort asc';
        $helpList=array();
        foreach($helpCatList as $k=>$v){
            $helpObj->where='cat_id=:cat_id';
            $helpObj->bind=['cat_id'=>$v['id']];
            $helpList[$k]['cat_id']=$v['id'];
            $helpList[$k]['name']=$v['name'];
            $helpList[$k]['data']=$helpObj->find();
        }
        return $helpList;
    }
}
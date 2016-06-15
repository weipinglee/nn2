<?php
/**
 * 友情链接管理类
 * Created by PhpStorm.
 * User: wangzhande
 * Date: 2016/6/15
 * Time: 13:14
 */
namespace nainai\system;
use Library\M;
use Library\tool;

class friendlyLink{

    protected $linkRules=array(
      array('name','require','名称不能为空'),
      array('link','require','链接地址不能为空'),
      array('status','number','状态不能为空'),
    );
    private $frdLinkObj='';
    public function __construct(){
        $this->frdLinkObj=new M('friendly_link');
    }
    public function addLink($params=array()){
        $frdLinkObj=$this->frdLinkObj;
        if($frdLinkObj->data($params)->validate($this->linkRules)){
            if($this->checkName(['name'=>$params['name']])){
                return \Library\tool::getSuccInfo(0,'名称不能重复');
            }
            $res=$frdLinkObj->data($params)->add();
            return  \Library\tool::getSuccInfo(1,'添加成功');
        }else{
            $error=$frdLinkObj->getError();
            return \Library\tool::getSUccInfo(0,'添加失败，原因为:'.$error);
        }
    }
    public function editLink($params=array()){
        $frdLinkObj=$this->frdLinkObj;
        if($frdLinkObj->data($params)->validate($this->linkRules)){
            $where=['name'=>$params['name']];
            unset($params['name']);
            if($frdLinkObj->where($where)->data($params)->update()){
                return \Library\tool::getSuccInfo(1,'修改成功');
            }else{
                return \Library\tool::getSuccInfo(0,'修改失败');
            }
        }else{
            $error=$frdLinkObj->getError();
            return \Library\tool::getSuccInfo(0,'添加失败,原因为:'.$error);
        }

    }
    public function getfrdLinkList($page=1){
        $frdLinkObj=new \Library\Query('friendly_link');
        $frdLinkObj->page=$page;
        $res=$frdLinkObj->find();
        $pageBar=$frdLinkObj->getPageBar();
        return array($res,$pageBar);
    }
    public function setLinkStatus($params=array()){
        $frdLinkObj=$this->frdLinkObj;
        $where=['name'=>$params['name']];
        if($this->checkName($where)){
            $data['status']=$params['status'];
            if($frdLinkObj->where($where)->data($data)->update()){
                return \Library\tool::getSuccInfo(1,'修改成功');
            }else{
                return \Library\tool::getSuccInfo(0,'修改失败');
            }
        }else{
            return \Library\tool::getSuccInfo(0,'要关闭的链接不存在');
        }

    }
    public function checkName($data){
        $frdLinkObj=$this->frdLinkObj;
        $res=$frdLinkObj->where($data)->getObj();
        return $res;
    }
    public function delLink($name){
        $where=['name'=>$name];
        $frdLinkObj=$this->frdLinkObj;
        $res=$frdLinkObj->where($where)->delete();
        return $res ? tool::getSuccInfo(1,'删除成功'):tool::getSuccInfo(0,'删除失败');
    }
}
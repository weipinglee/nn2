<?php
/**
 * 商品收藏管理类
 * Created by PhpStorm.
 * User: wangzhande
 * Date: 2016/6/12
 * Time: 14:20
 */
namespace nainai;
use Library\Query;
use Library\tool;
use Library\M;
class collect{
    const BUY_OFFER=2;//买盘
    const SELL_OFFER=1;//卖盘
    //收藏规则
    protected $collecRules=array(
        array('user_id','number','用户id不能为空'),
        array('offer_type','number','报盘类型不能为空'),
        array('offer_id','number','报盘id不能为空')
    );

    /**
     * 添加收藏
     * @param array $param
     * @return array
     */
    public function addCollec($param=array()){
        $collecObj=new \Library\M('collect');
        if($res=$this->checkCollec($param)){
            if($res['is_del']==1) {
                return tool::getSuccInfo(0, '已经添加收藏了');
            }else{
                $data=array(
                  'time'=>date('Y-m-d,H:i:s',time()),
                  'is_del'=>1
                );
                $collecObj->data($data)->where(array('id'=>$res['id']))->update();
                return tool::getSuccInfo(1,'添加成功');
            }
        }
        $param['time']=date('Y-m-d H:i:s',time());
        if($collecObj->data($param)->validate($this->collecRules)){

            if($collecObj->data($param)->add()){
                return \Library\tool::getSuccInfo(1,'添加成功');
            }
            return \Library\tool::getSuccInfo(0,'添加失败');
        }else{
            $error=$collecObj->getError();
            return \Library\tool::getSuccInfo(0,'原因为:'.$error);
        }

    }

    /**
     * 取消收藏
     * @param $id
     * @return array
     */
    public function cancelCollec($id){
        $collerObj=new M('collect');
        $data=array(
            'is_del'=>0
        );
        $res=$collerObj->where(array('id'=>$id))->data($data)->update();
        return $res?tool::getSuccInfo(1,'取消成功'):tool::getSuccInfo(0,'取消失败');
    }

    /**
     * 获取收藏列表
     * @param $type
     * @param $page
     * @return array
     */
    private function getCollecList($type, $page){
        $collerObj=new Query('collect as c');
        $collerObj->join='left join product_offer as o on c.offer_id=o.id left join products as p on p.id=o.product_id';
        $collerObj->where='c.is_del= :is_del and c.offer_type= :offer_type';
        switch($type) {
            case self::BUY_OFFER:
                $collerObj->bind=array('is_del'=>1,'offer_type'=>self::BUY_OFFER);
                break;
            case self::SELL_OFFER:
                $collerObj->bind=array('is_del'=>1,'offer_type'=>self::SELL_OFFER);
                break;
            default:
                return array();
                break;
        }

        $collerObj->page=$page;
        $collerObj->fields="c.id,c.time,c.offer_type,o.price,p.name,o.sign";
        $res=$collerObj->find();
        $pageBar=$collerObj->getPageBar();
        return array($res,$pageBar);
        }

    /**
     * 获取类型是卖盘的列表
     * @param int $page
     * @return array
     */
    public function getSellList($page=1){
        $res=$this->getCollecList(self::SELL_OFFER,$page);
        return $res;
    }

    /**
     * 获取类型是买盘的列表
     * @param int $page
     * @return array
     */
    public function getBuyList($page=1){
        $res=$this->getCollecList(self::BUY_OFFER,$page);
        return $res;
    }

    /**
     * 检查是否已经添加收藏
     * @param $data
     * @return mixed
     */
    private function checkCollec($data){
        $collecModel=new M('collect');
        $res=$collecModel->where($data)->getObj();
        return $res;
    }
}
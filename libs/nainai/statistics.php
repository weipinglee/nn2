<?php
/**
 * 统计管理类
 * Created by PhpStorm.
 * User: wangzhande
 * Date: 2016/6/6
 * Time: 10:10
 */
namespace nainai;
use Library\M;
use Library\Query;
use Library\tool;

class statistics{
    const MAKET_STATIC=1;//市场统计
    const COMMODITY_STATIC=2;//商品统计
    public $interval=5;//间隔时间
    //统计分类表验证规则
    protected $catStaticRules=array(
        array('cate_id','number','分类id不能为空'),
        array('type','number','类型不能为空')
    );
    //统计表验证规则
    protected  $marketRules=array(
        array('cate_id','number','分类id不能为空'),
        array('type','number','类型不能为空'),
        array('ave_price','double','价格不能为空'),
        array('days','number','统计时间不能为空')

    );
    /**
     * 添加分类
     * @param $cateId 分类id
     * @param $type 类型
     * @return array
     */
    public function addCate($cateId, $type){
        $catObj=new M('static_category');
        $data=array(
            'cate_id'=>$cateId,
            'type'=>$type
        );
        if($catObj->where($data)->getObj()){
            return tool::getSuccInfo(0,'该分类的统计类型已经存在');
        }
        if($catObj->data($data)->validate($this->catStaticRules)){
            if($catObj->data($data)->add()){
                return tool::getSuccInfo(1,'添加成功');
            }else {
                return tool::getSuccInfo(0, '添加失败');
            }
        }
    }
    /**
     * 删除分类
     * @param $cateId 分类id
     * @param $type 类型
     * @return array
     */
    public function delCate($cateId, $type){
        $catObj=new M('static_category');
        $data=array(
            'cate_id'=>$cateId,
            'type'=>$type
        );
        if($catObj->where($data)->delete()){
            return tool::getSuccInfo(1,'删除成功');
        }else{
            return tool::getSuccInfo(0,'分类不存在');
        };
    }
    /**
     * 创建市场指数统计
     * @return array
     */
    public function  createStatistics(){
        $marketObj=new M('static_market as m');
        $marketObj->fields('m.create_time');
        $marketObj->where('datediff(NOW(),m.create_time)>'.$this->interval);
        $marketObj->order('id desc');
        $createTime=$marketObj->getObj();
        //如果最后一条插入数据的时间小于间隔时间
        if(!$createTime){
            return tool::getSuccInfo(0,'统计时间还没到');
        }
        $catList=$this->getAllCat();
        if(!isset($catList[self::MAKET_STATIC])){
            return tool::getSuccInfo(0,'市场统计分类不存在');
        }
        $marketCatList=array();
        foreach($catList[self::MAKET_STATIC] as $k=>$v){
            $marketCatList[]=$v['cate_id'];
        }
        $offerObj=new Query('product_offer as f');
        $offerObj->join='left join products as p on f.product_id=p.id';
        $offerObj->group='p.cate_id';
        $offerObj->where='datediff(NOW(),f.apply_time)<'.$this->interval;
        $offerObj->fields='AVG(f.price) as "平均价",p.cate_id';
        $res=$offerObj->find();
        $data=array(
            'type'=>self::MAKET_STATIC,
            'create_time'=>date('Y-m-d H:i:s',time()),
            'days'=>$this->interval
        );
        $error=array();
        foreach($res as $k=>$v){
            if(in_array($v['cate_id'],$marketCatList)){
                $data['cate_id']=$v['cate_id'];
                $data['ave_price']=$v['平均价'];
                if($marketObj->data($data)->validate($this->marketRules)){
                    $marketObj->data($data)->add();
                }else{
                    $error[]=$marketObj->getError();
                }


            }
        }
        if(empty($error)){
            return tool::getSuccInfo(1,'添加成功');
        }else{
            return tool::getSuccInfo(0,count($error).'条插入失败');
        }
    }
    /**
     * 获取所有的统计分类
     * @return array
     */
    private function getAllCat(){
        //$catObj=new M('static_category');
        $catObj=new Query('static_category');
        $catList=$catObj->find();
        $result=array();
        foreach($catList as $k=>$v){
            $result[$v['type']][]=$v;
        }
        return $result;
    }

    /**
     * 获取最新的统计数据
     * @param $type
     * @return array
     */
    public function getNewStatistics($type){
        if($type==self::COMMODITY_STATIC||$type==self::MAKET_STATIC){
            $marketObj=new Query('static_market as m');
            $marketObj->join='left join product_category as c on m.cate_id=c.id';
            $marketObj->fields='c.name,m.*';
            $marketObj->where='m.type= :type and datediff(NOW(),m.create_time)<'.$this->interval;
            $marketObj->bind=array('type'=>$type);
            $mRes=$marketObj->find();
            $result=array();
            foreach($mRes as $k=>$v){
                $result[$v['cate_id']]['name']=$v['name'];
                unset($v['name']);
                $result[$v['cate_id']]['data']=$v;
            }
            return $result;

        }else{
            return tool::getSuccInfo(0,'要获取的数据类型不存在');
        }
    }

    /**
     * 获取统计数据列表
     * @param int $page
     * @return array
     */
    public static function getMarketStatsList($page=1){
        $marketObj=new Query('static_market as m');
        $marketObj->join='left join product_category as c on m.cate_id=c.id';
        $marketObj->fields='c.name,m.*';
        $marketObj->page=$page;
        $res=$marketObj->find();
        $resPageBar=$marketObj->getPageBar();
        return array($res,$resPageBar);
    }

    /**
     * 根据类型获取统计名称
     * @param $type
     * @return string
     */
    public static function getStatsType($type){
        switch(intval($type)){
            case self::COMMODITY_STATIC:
                return '商品统计';
            break;
            case self::MAKET_STATIC:
                return '市场统计';
            break;
            default:
                return '未知类型';
            break;
        }
    }

    /**
     * 获取所有的统计类型
     * @return array
     */
    public static function getAllType(){
        return array(
            self::MAKET_STATIC=>'市场统计',
            self::COMMODITY_STATIC=>'商品统计'
        );
    }
    //删除统计
    public static function delStats($id){
        $statsModel=new M('static_market');
        $where=array('id'=>$id);
        $res=$statsModel->where($where)->delete();
        return  $res?tool::getSuccInfo(1,'删除成功'):tool::getSuccInfo(0,'删除失败');

    }
}
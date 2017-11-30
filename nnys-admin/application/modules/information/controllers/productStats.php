<?php
/**
 * 商品指导价管理类
 * User: zyn
 * Date: 2016-8-17 15:04:19
 */
use Library\safe;
use Library\json;
use Library\M;
use Library\tool;
use Library\Query;
class productStatsController extends Yaf\Controller_Abstract{
    public function init(){
        $this->getView()->setLayout('admin');
    }

    /**
     *市场统计数据列表
     */
    public function productStatsListAction(){
        $page=safe::filterGet('page','int', 1);
        $obj = new Query('stat_item as s');
        $obj->join = 'left join product_category as c on s.cate_id=c.id';
        $obj->fields = 's.*,c.name as cate_name';
        $obj->page = $page;
        $dataList = $obj->find();
        foreach($dataList as &$val){
            $val['attr'] = unserialize($val['attr_ids']);
        }

        $pageBar = $obj->getPageBar();
        $this->getView()->assign('data',$dataList);
        $this->getView()->assign('pageBar',$pageBar);
    }

    /**
     *添加统计项
     */
    public function addproductstatsAction(){
        if(IS_POST&&IS_AJAX) {

            $data = array(
                'name' => safe::filterPost('name'),
                'cate_id'=>safe::filterPost('cate_id'),
            );
            $attrs = safe::filterPost('attr');
            $attrArr = array();
            foreach($attrs as $val){
                $temp = explode('-',$val);
                if(count($temp)<2)
                    continue;
                $attrArr[$temp[0]] = $temp[1];
            }
            $data['attr_ids'] = serialize($attrArr);
            $statObj = new M('stat_item');
            if($statObj->where(array('cate_id'=>$data['cate_id']))->getField('id')){
                die(json::encode(tool::getSuccInfo(0,'该分类已经添加过了,请勿重复添加')));
            }
            $res = $statObj->data($data)->add();

            if($res)
            {
                die(json::encode(tool::getSuccInfo()));
            }
            die(json::encode(tool::getSuccInfo(0,'添加失败')));
        }
        else{
            $id = safe::filterGet('id');
            if($id)
            {
                $obj = new M('stat_item');
                $detail = $obj->where('id = '.$id)->getObj();
                $this->getView()->assign('detail', $detail);
            }
            //获取所有市场
            $proObj = new \nainai\offer\product();
            $topCate = $proObj->getTopCate();
            $this->getView()->assign('topCate',$topCate);



        }

    }
    

    
    //删除统计商品
    public function delProductStatsAction(){
        if(IS_AJAX){
            $id = safe::filterGet('id','int');
            $obj = new M('stat_item');
            $res = $obj->where('id = '.$id)->delete();
            if($res)
            {
                die(json::encode(tool::getSuccInfo()));
            }
        }
        return false;
    }

    /**
     * 统计项列表
     */
    public function statsDataListAction(){

    }


    /**
     * 获取下级子分类
     */
    public function ajaxnextlevelCateAction(){
        $configObj = new\OfferManageModel();
        $pid = safe::filterGet('pid','int',0);
        if($pid>0){
            $res = $configObj->getNextCate($pid);
            die(JSON::encode($res)) ;
        }
        echo JSON::encode(array());
        exit;
    }

    public function ajaxGetAttrAction()
    {
        $productObj = new \nainai\offer\product();
        $ids = safe::filterGet('cateIds');
        $idArr = explode(',',$ids);
        if(empty($idArr))
            die(JSON::encode(array()));
        $data = $productObj->getProductAttr($idArr);
        die(JSON::encode($data));
    }

    public function testAction()
    {
        $static = new productStaticModel();
        $offer_id = 15184;
        $static->createStaticData($offer_id);

    }
}
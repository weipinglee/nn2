<?php
/**
 * @name storeController
 * @author weipinglee
 * @desc ?û???????????
 */
use \Library\safe;
use \nainai\certificate;
use \Library\Thumb;
use \nainai\subRight;
use \Library\json;
class productController extends InitController{


    /**
     *????????
     */
    public function categoryAddAction(){
        $productModel = new productModel();

        if(IS_POST){//?༭??????
            $cate['id'] = safe::filterPost('id','int',0);
            $cate['name'] = safe::filterPost('name');
            $cate['childname'] = safe::filterPost('childname');
            $cate['unit'] = safe::filterPost('unit');
            $cate['percent'] = safe::filterPost('percent','int',100);
            $cate['pid']       = safe::filterPost('pid','int',0);
            $cate['sort']      = safe::filterPost('sort','int',0);
            $cate['note']      = safe::filterPost('note');
            $cate['img'] = safe::filterPost('imgfile2');

            $attrs = safe::filterPost('attr_id','int','');
            $cate['attrs']     = $attrs=='' ? '' : implode(',',array_unique($attrs));
            
            $res = $productModel->updateCate($cate);
            die(json::encode($res));


        }else{

            $cate_id  = $this->getRequest()->getParam('cid',0);
            $cate_id = safe::filter($cate_id,'int');
            //??ȡ????????
            $attr = $productModel->getAllAttr();
            if($cate_id){
                $temp = array();
                foreach($attr['list'] as $v)
                {
                    $temp[$v['id']] = $v['name'];
                }
                $cateData = $productModel->getCateInfo($cate_id);
                if(!empty($cateData)){
                    $attr_arr = explode(',',$cateData['attrs']);
                    $attr_sel = array();
                    foreach($attr_arr as $v){
                        if($v=='')
                            continue;
                        $attr_sel[$v] = $temp[$v];
                    }
                    $this->getView()->assign('attr_sel',$attr_sel);
                    $this->getView()->assign('cate',$cateData);
                }


            }
            $cateTree = $productModel->getCateTree();//??ȡ??????

            $this->getView()->assign('tree',$cateTree);
            $this->getView()->assign('attr',$attr);
        }
    }

    /**
     * ?????б?
     *
     */
    public function categoryListAction(){
        $productModel = new productModel();
        $cateTree = $productModel->getCateTree();//??ȡ??????
        $attrs    = $productModel->getAttr();//??ȡ????????

        //??????????????idת??Ϊ????????
        foreach($cateTree as $key=>$val){
            $temp = '';
            $attr = explode(',',$val['attrs']);
            foreach($attr as $k=>$v){
                $temp .= isset($attrs['list'][$attr[$k]]['name']) ? $attrs['list'][$attr[$k]]['name'] .',' : '';
            }
            $temp = rtrim($temp,',');
            $cateTree[$key]['attrs'] =$temp;

        }

        $this->getView()->assign('cate',$cateTree);
    }

    /**
     * ????????
     */
    public function attributeAddAction(){
        $productModel = new productModel();
        if(IS_POST){
            $attr['id']    = safe::filterPost('id','int',0);
            $attr['name']  = safe::filterPost('name');
            $attr['value'] = safe::filterPost('value');
            $attr['type']  = safe::filterPost('type','int',1);
            $attr['sort']  = safe::filterPost('sort','int',0);
            $attr['note']  = safe::filterPost('note');
            $attr['status'] = 1;
            $res = $productModel->updateAttr($attr);
            die(json::encode($res));
        }
        else{
            $attr_id  = $this->getRequest()->getParam('aid',0);
            $attr_id = safe::filter($attr_id,'int',0);
            if($attr_id){
                $attrData = $productModel->getAttrInfo($attr_id);
                if(!empty($attrData))
                    $this->getView()->assign('attr',$attrData);


            }
             $this->getView()->assign('select', $productModel->getTypeArray());
        }
    }

    /**
     * ?????б?
     */
    public function attributeListAction(){
        $page = safe::filterGet('page','int',1);
        $productModel = new productModel();
        $attrs    = $productModel->getAttr($page);//??ȡ????????


        $this->getView()->assign('data',$attrs);
    }

    /**
     * ???÷??࿪??
     */
    public function setStatusCateAction(){
        if(IS_AJAX){
            $data['status'] = intval(safe::filterPost('status'));
            $data['id'] = intval($this->_request->getParam('id'));
            $storeModel = new productModel();

            $res = $storeModel->updateCate($data);

            echo JSON::encode($res);
            return false;
        }
        return false;
    }
    /**
     * ???????Կ???
     */
    public function setStatusAttrAction(){
        if(IS_AJAX){
            $data['status'] = intval(safe::filterPost('status'));
            $data['id'] = intval($this->_request->getParam('id'));
            $storeModel = new productModel();

            $res = $storeModel->updateAttr($data);

            echo JSON::encode($res);
            return false;
        }
        return false;
    }

    /**
     * ????ɾ??
     */
    public function logicDelCateAction(){
        if(IS_AJAX){
            $data['is_del'] = 1;
            $data['id'] = intval($this->_request->getParam('id'));
            $storeModel = new productModel();

            $res = $storeModel->updateCate($data);

            echo JSON::encode($res);
            return false;
        }
        return false;
    }

    /**
     * ????ɾ??
     */
    public function delAttrAction(){
        if(IS_AJAX){
            $data['id'] = intval($this->_request->getParam('id'));
            $storeModel = new productModel();

            $res = $storeModel->deleteAttr($data);

            echo JSON::encode($res);
            return false;
        }
        return false;
    }





}
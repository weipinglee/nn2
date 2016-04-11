<?php
/**
 * 用户中心
 * User: weipinglee
 * Date: 2016/3/4 0004
 * Time: 上午 9:35
 */
use \Library\checkRight;
use \Library\swfupload;
use \Library\photoupload;
use \Library\json;
use \Library\url;
use \Library\safe;
use \Library\Thumb;
use \Library\tool;
class ProductController extends Yaf\Controller_Abstract {


    public function init(){
        $right = new checkRight();
        $right->checkLogin($this);//未登录自动跳到登录页
        $this->getView()->setLayout('ucenter');
    }
    /**
     * 个人中心首页
     */
    public function indexAction(){

    }

    /**
     * 商品添加
     */
    public function productAddAction(){
        $swf = new swfupload(array('upload_url'=>'/product/swfupload'));
        $show = $swf->show();
        $this->getView()->assign('swfupload',$show);


    }

    public function swfuploadAction(){
        //调用文件上传类
        $photoObj = new photoupload();
        $photoObj->setThumbParams(array(180,180));
        $photo = current($photoObj->uploadPhoto());

        if($photo['flag'] == 1)
        {
            $result = array(
                'flag'=> 1,
                'img' => $photo['img'],
                'thumb'=> $photo['thumb'][1]
            );
        }
        else
        {
            $result = array('flag'=> $photo['flag'],'error'=>$photo['errInfo']);
        }
        echo JSON::encode($result);

        return false;
    }







}
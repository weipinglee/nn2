<?php
/**
 * 用户中心
 * User: weipinglee
 * Date: 2016/3/4 0004
 * Time: 上午 9:35
 */
use \Library\checkRight;
use \Library\photoupload;
use \Library\json;
use \Library\url;
use \Library\safe;
use \Library\Thumb;
use \Library\tool;
use \Library\PlUpload;
use \Library\Captcha;

class UcenterAppController extends UcenterBaseController {

    //修改资讯app资料
    public function editInfoAction(){
        if(IS_POST){
            $data = array(
                'head_pic'=>tool::setImgApp(safe::filterPost('head')),
                'nick'    => safe::filterPost('nick'),
                'birth'   => safe::filterPost('birth','date'),
                'sign'    => safe::filterPost('sign'),
            );
			$user_id = $this->user_id;
            $M = new \Library\M('person_info');
            if($M->where(array('user_id'=>$user_id))->data($data)->update()){
                die(json::encode(tool::getSuccInfo()));
            }
            else{
                die(json::encode(tool::getSuccInfo(0,'修改失败')));
            }

        }
        die(json::encode(tool::getSuccInfo(0,'修改失败')));
    }
	//获取登陆用户的id/基本信息
	public function getInfoAction(){
		$user_id = $this->user_id;
		$M = new \Library\M('person_info');
		$data = $M->where(array('user_id'=>$user_id))->getObj();
		die(json::encode(tool::getSuccInfo()));
	}



}
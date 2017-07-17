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
				'user_id'=>$this->user_id,
              // 'head_pic'=>tool::setImgApp(safe::filterPost('head')),
                'nick'    => safe::filterPost('nick'),
                'birth'   => safe::filterPost('birth'),
                'sign'    => safe::filterPost('sign'),
            );
            $M = new \Library\M('nn_information.user_info');
            if($M->insertUpdate($data,$data)){
                die(json::encode(tool::getSuccInfo(1,'修改成功','',$this->user_id)));
            }
            else{
                die(json::encode(tool::getSuccInfo(0,'修改失败','',$this->user_id)));
            }

        }
        die(json::encode(tool::getSuccInfo(0,'修改失败')));
    }
	//获取登陆用户的id/基本信息
	public function getInfoAction(){
		$user_id = $this->user_id;
		$M = new \Library\M('nn_information.user_info');
		$data = $M->where(array('user_id'=>$user_id))->getObj();
		$data['head_pic'] = \Library\thumb::get($data['head_pic'],180,180);
		die(json::encode($data));
	}
	
	//上传头像
	public function uploadAction(){
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
				$data['head_pic'] = tool::setImgApp($result['img']);
				$data['user_id'] = $this->user_id;
				$M = new \Library\M('nn_information.user_info');
				if(!$M->insertUPdate($data,$data)){
					$result['flag'] = 0;
				}
				else{
					$result['img'] = $photo['thumb'][1];
					$result['head_pic'] = $result['img'];
				}
            }
            else
            {
                $result = array('flag'=> $photo['flag'],'error'=>$photo['errInfo']);
            }
            echo json::encode($result);

        return false;
	}



}
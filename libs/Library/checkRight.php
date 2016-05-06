<?php
/**
 * User: weipinglee
 * Date: 2016/3/1 0001
 * Time: 下午 3:08
 */
namespace Library;
use \Library\Session\Driver\Db;
use \Library\url;
class checkRight{


    //session操作对象
    static private $sessObj = '';
    /**
     *
     */
    public function __construct(){
        $sess = 'DB';//根据配置文件获取
        $tableName = 'user_session';
        $expireTime = '';
        switch($sess){
            case 'DB' : {
                self::$sessObj = new Db($tableName,$expireTime);
            }
            break;

            default:{
                
            }
        }
    }

    /**
     * 登录后处理
     * @param array $data  用户登录数据
     */
    public function loginAfter($data){
        //设置session
        session_regenerate_id(true);
        session::clear('login');
        Session::merge('login',array('user_id'=>$data['id']));
        Session::merge('login',array('username'=>$data['username']));
        Session::merge('login',array('mobile'=>$data['mobile']));
       // Session::merge('login',array('pwd'=>$data['password']));
        Session::merge('login',array('type'=>$data['type']));

        //session数据计入数据库
        $sessID = session_id();
        $sessData = Session::get('login');
        self::$sessObj->gc();
        self::$sessObj->write($sessID,serialize($sessData));
        $userModel = new M('user');
        $userModel->where(array('id'=>$data['id']))->data(array('session_id'=>$sessID))->update();
        
    }

    /**
     *验证是否登录:判断已登录条件：存在session['login']、session中user_id的用户session_id字段等于session_id()、session_id()未过期
     * @param object $obj 控制器实例
     * @return bool 是否登录
     */
    public function checkLogin($obj=null){
        $sessID = session_id();
        $sessLogin = session::get('login');
        $isLogin = false;

        //判断是否登录以及登录是否超时
        if($sessLogin!=null && isset($sessLogin['user_id']) && $sessID !=''){
            $userModel = new M('user');
            $login_sessID = $userModel->where(array('id'=>$sessLogin['user_id']))->getField('session_id');
            if($sessID == $login_sessID && self::$sessObj->expire($sessID))
                $isLogin = true;
        }
        if($obj!==null){
            if($isLogin == false){//如果未登录或超时，登出操作，跳转到登录页
                //$this->logOut();
                $controller = $obj->getRequest()->getControllerName();
                $action     = $obj->getRequest()->getActionName();
                $callBack = url::createUrl('/'.$controller.'/'.$action);
                $obj->redirect(url::createUrl('/index/login@user').'?callback='.$callBack);
                exit;
            }
            else{//已登录则记录user_id
                $obj->user_id = $sessLogin['user_id'];
                $obj->user_type = $sessLogin['type'];

            }
        }

        return $isLogin;
    }

    

    /**
     * 登出
     */
    public function logOut(){
        $sessID = session_id();
        $sessLogin = session::get('login');

        if(isset($sessLogin['user_id'])){
            $userModel = new M('user');
            $userModel->where(array('id'=>$sessLogin['user_id']))->data(array('session_id'=>''))->update();
        }

         session::clear('login');
         self::$sessObj->destroy($sessID);




    }

}
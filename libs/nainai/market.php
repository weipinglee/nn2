<?php
/**
 * 市场开闭市管理
 * User: weipinglee
 * Date: 2016/8/17
 * Time: 17:00
 */
namespace nainai;
use \Library\tool;
class market{

    /**
     * 受开闭市影响的方法路径
     * @var array
     */
    protected $actions = array(
        'deal' => array(
            'index/trade/report'
        ),
        'user' => array(
            'index/fund/dofundout',
            'index/fund/dofundin',
            'index/managerdeal/dodepositeoffer',
            'index/managerdeal/dofreeoffer',
            'index/managerdeal/dostoreoffer',
            'index/managerdeal/dodeputeoffer',
            'index/managerstore/dostoresign',
            'index/ucenter/dodealcert',
            'index/ucenter/dostorecert',
            'index/managerstore/doupdatestore',

            'post' => array(   //里面的url 闭市时不能通过post请求，可以访问页面
                'index/purchase/issue',
                'index/fund/bank'
            ),

        ),
        'admin' => array(

        ),
    );

    protected $start_time = '09:00:00';//开市时间

    protected $end_time = '19:00:00';//闭市时间

    /**
     * 判断是否处于开市时间
     *
     */
    private function checkTime(){
        $start = strtotime(date('Y-m-d',time()).' '.$this->start_time);
        $end   = strtotime(date('Y-m-d',time()).' '.$this->end_time);

        if(time() >= $start && time() <= $end){
            return true;
        }
        return false;
    }

    /**
     *判断是否可以操作
     * @param obj $request 请求
     * @return bool true:可以操作，false:不可操作
     */
    public function checkCanOper($request){
        if(!$this->checkTime()){//如果已闭市
            $appName = tool::getConfig(array('application','name'));
            if($appName && !empty($this->actions[$appName])){
                $url = $request->getModuleName().'/'.$request->getControllerName().'/'.$request->getActionName();
                $url = strtolower($url);

                if(in_array($url,$this->actions[$appName])){//该动作不能操作
                    return false;
                }

                if(in_array($url,$this->actions[$appName]['post']) && IS_POST){//该url的post请求不能操作
                    return false;
                }

            }
        }
        return true;
    }






}
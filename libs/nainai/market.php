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
            'index/fund/dofundin'
        ),
    );

    protected $start_time = '09:00:00';//开市时间

    protected $end_time = '17:00:00';//闭市时间

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
     */
    public function checkCanOper($request){
        if(!$this->checkTime()){//如果已闭市
            $appName = tool::getConfig(array('application','name'));
            if($appName && isset($this->actions[$appName])){
                $url = $request->getModuleName().'/'.$request->getControllerName().'/'.$request->getActionName();
                $url = strtolower($url);
                if(in_array($url,$this->actions[$appName])){//该动作不能操作
                    if(IS_AJAX || IS_POST){
                        die(\Library\json::encode(tool::getSuccInfo(0,'现在已闭市，无法操作')));
                    }
                    else{
                        die('现在已闭市，无法操作');
                    }
                }
            }
        }
    }






}
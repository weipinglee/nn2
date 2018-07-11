<?php
/**
 * 竞价报盘管理
 * author: weipinglee
 * Date: 2017/12/12
 */

namespace nainai\offer;
use Library\Query;
use \Library\tool;
use \Library\M;
use \Library\time;
class jingjiaOffer extends product{

    protected $limitTimes = 1;//同一个报盘设置竞价交易的限制次数，1表示限制1次，0不限制

    protected $jingjiaMode = 1;//竞价模式代码

    protected $yikoujiaMode = 2;//一口价模式代码

    /**
     * 获取报盘的最大可售数量
     * @param $offer_id int 报盘id
     */
    protected function getActiveNums($offer_id)
    {

    }


    /**
     * 原报盘转竞价
     * @param array $offer_id  原报盘id
     * @param array $offerData 更改的报盘数据
     */
    public function transJingjiaOffer($offer_id,$offerData,$user_id)
    {
        $obj = new \Library\M('product_offer');
        $obj->beginTrans();
        $offer_id = intval($offer_id);
        $query = 'select * from product_offer where id='.$offer_id.' and status='.self::OFFER_OK.' AND user_id='.$user_id.'  FOR UPDATE';
        $newOfferData = $obj->query($query);//从旧的报盘中查询出数据作为新的报盘数据
        $oldOfferData = array();
        if(isset($newOfferData[0])){
            $newOfferData = $newOfferData[0];

            //检验该报盘是否已经超过竞价报盘发布的次数
            $where = array('sub_mode'=>$offerData['submode'],'product_id'=>$newOfferData['product_id'],'status'=>self::OFFER_OK);
            $have = $obj->where($where)->getField('id');
            if($this->limitTimes==1 && !empty($have)){
                return tool::getSuccInfo(0,'该报盘有正在进行的竞价交易，请勿重复提交');
            }

            //获取商品剩余量
            $proObj = new \Library\M('products');
            $proResult = $proObj->where(array('id'=>$newOfferData['product_id']))->fields('quantity,freeze,sell')->getObj();
            $proLeft = $proResult['quantity'] - $proResult['freeze'] - $proResult['sell'];

            //对新报盘数据部分字段进行修改
            $newOfferData['old_offer'] = $newOfferData['id'];
            unset($newOfferData['id']);
            $newOfferData['pro_name'] = $offerData['proname'];
            $newOfferData['sub_mode'] = $offerData['submode'];
            $newOfferData['start_time'] = $offerData['start_time'];

            if(\Library\time::getDiffSec($newOfferData['expire_time'],$offerData['end_time'])<0){
                return tool::getSuccInfo(0,'竞价结束时间不能超过原报盘过期时间');
            }
            $newOfferData['end_time'] = $offerData['end_time'];
           $newOfferData['price_l'] = $offerData['price_l'];
            $newOfferData['price_r'] = $offerData['price_r'];
            $newOfferData['divide'] = 0;
            $newOfferData['price'] = 0;
            $newOfferData['minimum'] = 0;
            $newOfferData['minstep'] = 0;
            $newOfferData['jing_stepprice'] = $offerData['jing_stepprice'];
            $newOfferData['status'] = 0;


            //计算新报盘和旧报盘的最大购买数量
            $max_num = $newOfferData['max_num']-$newOfferData['sell_num'];
			if($offerData['max_num']>$max_num){
                return tool::getSuccInfo(0,'参与活动的商品量不能大于原报盘剩余量');
            }
            if($offerData['max_num'] == $max_num){//如果剩余量等于竞价量，原报盘状态改为成交
				$oldOfferData['status'] = 6;
			}
            
            if(time::getTime()>time::getTime($newOfferData['start_time'])){
                return tool::getSuccInfo(0,'开始时间不能小于当前时间');
            }
            if(time::getTime($newOfferData['end_time'])<=time::getTime($newOfferData['start_time'])){
                return tool::getSuccInfo(0,'结束时间必须大于开始时间');
            }

            $oldOfferData['max_num'] =  $newOfferData['max_num'] - $offerData['max_num'] ;//原报盘最大数量减去竞价报盘的数量
            $newOfferData['max_num'] = $offerData['max_num'];//竞价报盘的数量等于参数传递的数量
            $newOfferData['sell_num'] = 0;//新的竞价报盘的已售数量为0
            
            //场内竞价生成口令
            $newOfferData['jingjia_mode'] = $offerData['jingjia_mode'];
            if($offerData['jingjia_mode']==1){
                $newOfferData['jingjia_pass'] = rand(1000,9999);
            }
            //插入新的报盘和更改旧报盘
            $newOfferId = $obj->data($newOfferData)->add();
            $obj->data($oldOfferData)->where(array('id'=>$offer_id))->update();


        }
        else{
            return tool::getSuccInfo(0,'该报盘不存在');
        }
        //提交事务
        if($obj->commit()){
            $this->createEvent($newOfferId);//创建事件的语句要写在commit之后，因为在mysql中，create语句会暗含事务的提交。
            return tool::getSuccInfo();
        }
        else{
            return tool::getSuccInfo(0,'操作失败');
        }



    }

    /**
     * 从头生成竞价，不是报盘转竞价
     * @param $productData
     * @param $offerData
     */
    public function doOffer($productData,$offerData,$offer_id=0){
        $offerData['mode'] = 1;

        if($offerData['jingjia_mode']==1){
            $offerData['jingjia_pass'] = rand(1000,9999);
        }


        if(time::getTime()>time::getTime($offerData['start_time'])){
            return tool::getSuccInfo(0,'开始时间不能小于当前时间');
        }

        $days = 0;//开始前的预留天数
        if(time::getTime()+$days * 24*3600 > time::getTime($offerData['start_time'])){
            return tool::getSuccInfo(0,'必须要有至少3天的公示时间');
        }

        if(time::getTime($offerData['end_time'])<=time::getTime($offerData['start_time'])){
            return tool::getSuccInfo(0,'结束时间必须大于开始时间');
        }
        $this->_productObj->beginTrans();
        if($offer_id){
            $this->delOffer($offer_id,$this->user_id);

        }

        $offerData['user_id'] = $this->user_id;
//        $dateObj = new \DateTime($offerData['end_time']);
//        $dateObj->add(new \DateInterval('P1D'));
//
        if(isset($offerData['expire_time'])){
            unset($offerData['expire_time']);
        }
        $offerData['sub_mode'] = 1;
        $offerData['status'] = 1;
        $offerData['jingjia_deposit'] = $this->getDeposit($offerData);
        $insert = $this->insertOffer($productData,$offerData);

        if( is_numeric($insert) && $insert>0){
            if($this->_productObj->commit()){
                $returnRes = tool::getSuccInfo();
                $returnRes['id'] = $insert;
                return $returnRes;
            }
            else {
                $this->_productObj->rollBack();
                return tool::getSuccInfo(0,$this->errorCode['server']['info']);
            }
        }
        else{
            $this->_productObj->rollBack();
            $this->errorCode['dataWrong']['info'] = $insert;
            return tool::getSuccInfo(0,$this->errorCode['dataWrong']['info']);
        }


    }


    /**
     * 转竞价的更新
     * @param $offer_id
     * @param $offerData
     * @param $user_id
     * @return array
     */
    public function updateOffer($offer_id,$offerData,$user_id){
        $obj = new \Library\M('product_offer');

        $offer_id = intval($offer_id);

        //查看当前报盘数据
        $currOfferData = $obj->where(array('id'=>$offer_id,'status'=>self::OFFER_NG))->getObj();
        if(empty($currOfferData)){
            return tool::getSuccInfo(0,'报盘不存在');
        }
        $old_offer = $currOfferData['old_offer'];
        //查看原报盘数据
        $query = 'select * from product_offer where id='.$old_offer.' AND user_id='.$user_id.'  FOR UPDATE';
        $oldOfferData = $obj->query($query);//从旧的报盘中查询出数据作为新的报盘数据

        if(!isset($oldOfferData[0])){
            return tool::getSuccInfo(0,'原报盘异常');
        }
        $oldOfferData = $oldOfferData[0];
        if(\Library\time::getDiffSec($oldOfferData['expire_time'],$offerData['end_time'])<0){
            return tool::getSuccInfo(0,'竞价结束时间不能超过原报盘过期时间');
        }

        if(time::getTime()>time::getTime($offerData['start_time'])){
            return tool::getSuccInfo(0,'开始时间不能小于当前时间');
        }
        if(time::getTime($offerData['end_time'])<=time::getTime($offerData['start_time'])){
            return tool::getSuccInfo(0,'结束时间必须大于开始时间');
        }

        //判断竞价报盘的数量是否超过了原报盘，如果未超，原报盘数量是否得修改
        //获取商品剩余量
        $proLeft = $currOfferData['max_num'] + $oldOfferData['max_num'] - $oldOfferData['sell_num'] ;

        if($offerData['max_num']>$proLeft){
            return tool::getSuccInfo(0,'参与活动的商品量不能大于原报盘剩余量');
        }

        $obj->beginTrans();
        //如果竞价的数量改变，需要改变原报盘数量
        if($offerData['max_num'] != $currOfferData['max_num']){
            $diff = $offerData['max_num'] - $currOfferData['max_num'];
            $oldUpdate = array('max_num'=>$oldOfferData['max_num'] - $diff);
            if($oldOfferData['max_num'] - $diff==0){//如果剩余量等于竞价量，原报盘状态改为成交
                $oldUpdate['status'] = 6;
            }

            $obj->data($oldUpdate)->where(array('id'=>$old_offer))->update();
        }

       // $offerData['status'] = 0;
        $obj->data($offerData)->where(array('id'=>$offer_id))->update();
        if($obj->commit()){
             $this->alterEvent($offer_id);
             return tool::getSuccInfo();
        }
        else{
            return tool::getSuccInfo(0,'操作失败');
        }

    }

    /**
     * 竞价交易报价
     * @param $offer_id int 报盘id
     * @param $price float 提报的价格
     * @param $user_id int 报价的用户id
     * @param $pay_way int 支付方式，默认代理账户
     */
    public function baojia($offer_id,$price,$user_id,$pay_way=1)
    {
        $offerObj = new M('product_offer');
        $offerObj->beginTrans();
        //获取符合条件的报盘,对相应的竞价报盘行锁定，同一竞价的多个会话的报价必须串行执行
        $res = $offerObj->where(array('id'=>$offer_id,'sub_mode'=>$this->jingjiaMode))->lock('update')->getObj();
        if(empty($res)){
            return tool::getSuccInfo(0,'该报盘不存在');
        }

        if($res['status']!=1){
            return tool::getSuccInfo(0,'该报盘已成交');
        }
        if($user_id==$res['user_id'])
            return tool::getSuccInfo(0,'不能给自己的报盘报价');

        //判断是否处于交易时间内
        $now = time::getTime();
        if($now<time::getTime($res['start_time']) || $now>time::getTime($res['end_time'])){
            return tool::getSuccInfo(0,'该竞价未开始或已过期');
        }



        //判断价格是否合适
        $baojiaObj = new M('product_jingjia');
        $baojiaData = $baojiaObj->where(array('offer_id'=>$offer_id))->fields('max(price) as max')->getObj();
        //获取报价的基础价
        $minPrice = isset($baojiaData['max']) ? $baojiaData['max'] : $res['price_l'];
        if(!isset($baojiaData['max']) && $price<$res['price_l']){
            return tool::getSuccInfo(0,'您的报价低于卖方设置的最低价，请重新出价');
        }
        if(isset($baojiaData['max']) && $price <=$baojiaData['max']){
            return tool::getSuccInfo(0,'您的报价不能低于当前报价的最高价，请重新出价');
        }
        if($res['jing_stepprice']>0 && ($price-$minPrice)%$res['jing_stepprice']!=0){
            return tool::getSuccInfo(0,'报价必须按照'.$res['jing_stepprice'].'的倍数递增');
        }




        $fund = new \nainai\fund();

        //冻结该用户新的金额
        if(is_object($pay_way)){
            $fundObj = $pay_way;
        }else{
            $fundObj = $fund->createFund($pay_way);
        }

        $amount = bcmul($price,$res['max_num'],2);
        $payRes = $fundObj->freeze($user_id,$amount,'参加竞价交易报价冻结金额');
        if($payRes!==true){
            $offerObj->rollBack();
            return tool::getSuccInfo(0,'账户内资金不足，请充值后再报价');
        }
        //上一个报价冻结的金额进行释放，并将该记录更新为已释放
        $oldBaojia = $baojiaObj->where(array('offer_id'=>$offer_id,'is_freeze'=>0))->fields('*')->lock('update')->order('id desc')->getObj();
        if(isset($oldBaojia['price']) && $oldBaojia['price']>0){
            $oldfundObj = $fund->createFund($oldBaojia['pay_way']);
            $oldfundObj->freezeRelease($oldBaojia['user_id'],$oldBaojia['amount'],'释放参加竞价交易报价的金额');
            $baojiaObj->where(array('id'=>$oldBaojia['id']))->data(array('is_freeze'=>1))->update();
        }
      //插入报价数据
        $insertData = array(
            'user_id'=>$user_id,
            'offer_id'=>$offer_id,
            'price' => $price,
            'time' => time::getDateTime(),
            'is_freeze'=>0,
            'pay_way' => is_scalar($pay_way) ? $pay_way : 0,
            'amount'=>$amount
        );
        $insertRes = $baojiaObj->data($insertData)->add();
        if($insertRes){
            if($res['price_r']>0 && $price>=$res['price_r']){//报价高于设置的最高价，调用用户定义的mysql程序，更改offer状态
                $sql = 'CALL jingjiaHandle('.$offer_id.','.$user_id.','.$price.')';
                $offerObj->query($sql);
                $message = new \nainai\message($user_id);
                $message->jingjiaWin($res['pro_name']);

            }
            if($offerObj->commit()){
                return tool::getSuccInfo();
            }

        }
        $offerObj->rollBack();
        return tool::getSuccInfo(0,'报价失败');



    }


    /**
     * 创建到期自动执行的事件
     * @param $offer_id
     * @param string $end_time
     * @return bool
     */
    protected function createEvent($offer_id,$end_time='')
    {
        $event_name = 'autoStopJingjia_'.$offer_id;
        $jingjiaOffer = new M('product_offer');
        if($end_time==''){
            $end_time = $jingjiaOffer->where(array('id'=>$offer_id))->getField('end_time');
        }

        $sql = 'CREATE  EVENT IF NOT EXISTS `'.$event_name.'`  ON SCHEDULE AT "'.$end_time.'" ON COMPLETION NOT PRESERVE ENABLE DO
        CALL jingjiaHandle('.$offer_id.',0,0);';
        $res = $jingjiaOffer->query($sql);
        if($res){
            return true;
        }
        return false;
    }

    protected function alterEvent($offer_id,$end_time=''){
        $event_name = 'autoStopJingjia_'.$offer_id;
        $jingjiaOffer = new M('product_offer');
        if($end_time==''){
            $end_time = $jingjiaOffer->where(array('id'=>$offer_id))->getField('end_time');
        }

        $sql = 'show events like "autoStopJingjia_'.$offer_id.'";';
            $eventData = $jingjiaOffer->query($sql);
        if(!empty($eventData)){
            $sql = 'ALTER  EVENT  `'.$event_name.'`  ON SCHEDULE AT "'.$end_time.'" ON COMPLETION NOT PRESERVE ENABLE DO
        CALL jingjiaHandle('.$offer_id.',0,0);';
            $res = $jingjiaOffer->query($sql);
        }else{
            $res = $this->createEvent($offer_id,$end_time);
        }

        if($res){
            return true;
        }
        return false;
    }

    /**
     * 生成offer不同竞价阶段的event
     * @param $offer_id
     */
    public function createXinEvent($offer_id){
        $offerObj = new M('product_offer');
        $offerData = $offerObj->where(array('id'=>$offer_id))->getObj();

        $event_name = 'autoStopJingjia_'.$offer_id;
        $sql = 'CREATE  EVENT IF NOT EXISTS `'.$event_name.'`  ON SCHEDULE AT "'.$offerData['end_time'].
            '" ON COMPLETION NOT  PRESERVE ENABLE DO
    CALL xinJingjiaHandle('.$offer_id.',@a);';
        $res = $offerObj->query($sql);
        if(false===$res){//如果创建失败，处理已发出的报盘
            $offerData->data(array('status'=>self::OFFER_NG))->where(array('id'=>$offer_id))->update();
        }
        return $res;
    }


    /**
     * 交易前判断是否满足交易的条件
     * @param $offer_id
     * @param $user_id
     * @return array
     */
    public function beforeTrade($offer_id,$user_id){
        $jingjiaOffer = new M('product_offer');
        $data = $jingjiaOffer->where(array('id'=>$offer_id))->fields('status,sub_mode')->getObj();
        if(empty($data))
            return tool::getSuccInfo(0,'该报盘不存在');
        if($data['status']!=self::OFFER_WAITINGTRADE || $data['sub_mode']!=1){
            return tool::getSuccInfo(0,'该状态不允许交易');
        }
        $baojiaObj = new M('product_jingjia');
        $baojiaData = $baojiaObj->where(array('offer_id'=>$offer_id,'win'=>1))->order('price desc')->getObj();
        if(!isset($baojiaData['user_id'])||$baojiaData['user_id']!=$user_id){
            return tool::getSuccInfo(0,'您不是胜出用户，不能交易');
        }
        return tool::getSuccInfo();

    }

    public function afterTrade($offer_id){

    }

    /**
     * 校验场内竞价的口令是否正确
     * @param int $offer_id
     * @param string $pass 口令
     * @return bool 是否正确
     */
    public function checkPass($offer_id,$pass){
        $jingjiaOffer = new M('product_offer');
        $data = $jingjiaOffer->where(array('id'=>$offer_id))->fields('jingjia_mode,jingjia_pass')->getObj();
        if(empty($data)){
            return false;
        }
        if($data['jingjia_mode']==0 || $data['jingjia_pass']==$pass){
            return true;
        }
        return false;
    }

    /**
     * 卖方发布竞价后给买方发送短信
     */
    public function MessageAfterDeploy($offer_id){

            $obj = new Query('product_offer as po');
            $obj->join = 'left join products as p on po.product_id=p.id 
                          left join user as u on po.user_id=u.id';
            $obj->where = 'po.id='.$offer_id;
            $obj->fields = 'po.*,u.true_name,p.unit';
            $offerData = $obj->getObj();

        $hsms = new \Library\Hsms();
        //竞价模式为1，卖方自行通知,不为 1时，给买家发短信
        if($offerData['jingjia_mode']!=1){
            //获取发送的买用户
            $userObj = new M('user_rec');
            $userData = $userObj->where(array('subject'=>'jingjia','user_id'=>array('neq',$offerData['user_id'])))->getFields('mobile');


            $content = "您好，您关注的商品：".$offerData['pro_name']."已发布竞价。发布企业为：".$offerData['true_name']."，竞价开始时间为：".$offerData['start_time'].".竞价结束时间为：".$offerData['end_time']."。起拍价为".$offerData['price_l']."元/".$offerData['unit']."。递增价为：".$offerData['jing_stepprice']."元/".$offerData['unit']."。竞价数量为".$offerData['max_num'].$offerData['unit']."。请您及时进入耐耐网竞价模块进行查看并参与。";
            $hsms->send($userData,$content);
        }


        //给卖方发短信
        $userObj = new M('user');
        $mobile = $userObj->where(array('id' => $offerData['user_id']))->getField('mobile');
        if($offerData['jingjia_mode']==1) {
            $content = '我是' . $offerData['true_name'] . ',现邀请您参与'.$offerData['start_time'].
                '开始的'.$offerData['pro_name'].'的竞价，竞价口令为'.$offerData['jingjia_pass'].'，请登录耐耐网进行竞价';
            $hsms->send($mobile, $content);
        }else{
            $content = '系统已为您通知匹配的交易商，请关注后续竞价动态信息。';
            $hsms->send($mobile, $content);
        }



    }


    /**
     *
     */
    public function adminMessageAfterDeploy($product){
        $msgObj =  new \nainai\AdminMsg();
        $content = '商品：'.$product['name'].'已发布竞价。请登录网站进行查看。';
        $msgObj->sendShortMessage('jingjia',$content);
    }

    /**
     * 获取竞价保证金数额
     * @param $offerData
     * @return float
     */
    private function getDeposit($offerData){
        $rate = 0.1;
        $amount = round(bcmul($offerData['price_l'],$offerData['max_num'],0)*$rate);

        if($amount>100){
            $amount = round($amount,-2);
        }
        return $amount;
    }

    public function checkDeposit($offerId,$user_id){
        $compareData = array('amount'=>0,'acc_no'=>'');
        //查找报盘保证金数额，报盘申请的时间
        $offerData = $this->offerDetail($offerId);
        if(empty($offerData)){
            return tool::getSuccInfo(0,'竞价不存在');
        }


        $payLogObj = new \nainai\user\UserPaylog();
        $payLogObj->subject = 'jingjia';
        $payLogObj->user_id = $user_id;
        $payLogObj->subject_id = $offerId;

        //比对的金额
        $compareData['amount'] = $offerData['jingjia_deposit'];
        //查询银行流水记录，如果有匹配记录，写入pay_log
        $dateObj = new \DateTime();
        $dateObj->sub(new \DateInterval('P7D'));

        $startDate = $dateObj->format('Y-m-d');

        $res = $payLogObj->createMatchLog($startDate,'',$compareData['amount']);
    }





}
<?php

use \Workerman\Worker;
use Nette\Utils\Json;
require_once __DIR__."/lib/vendor/autoload.php";

$worker = new Worker("websocket://localhost:89");


$worker->onWorkerStart = function ($connection){
    echo "Worker starting...\n";
    //定时检查每个连接发送包的时间，长时间未发送则close
};


$worker->onConnect = function ($conn){
    echo 'IP:'.$conn->getRemoteIp().'已连接';
};

//

$offerData = array(

);//array(offer_id=>array(count=>,baojia=>array(),conns=>array()),...)
$worker->onWorkerStart =function ($worker){
    //
};
$worker->onMessage = function($connection, $data)
{

    try{
        $data = Json::decode($data,true);
        //鉴权，如果未登录或没有offer_id参数，关闭连接，返回json

        //如果已登录，
        $connection->offer_id = $data['offer_id'];
        echo $connection->offer_id;
        global $offerData;
        if(!isset($offerData[$data['offer_id']])){//该报盘初次连接，初始化数据
            $offerData[$data['offer_id']] = array('count'=>0,'baojia'=>array(),'conns'=>array());
        }
        if(!in_array($connection->id,$offerData[$data['offer_id']]['conns'])){
            $offerData[$data['offer_id']]['conns'][] = $connection->id;
        }
        //给买方发送现时的报价数据，之后有变化再发送
        $connection->send(Json::encode($offerData[$data['offer_id']]['baojia']));


    }catch(\Exception $e){
        echo $e->getMessage();
    }

    //$connection->send('123qwe');
    //echo $data;
};

//轮询
if(!empty($offerData)){
    foreach($offerData as $offer_id=>$item){
        $new = baojiaCount($offer_id);
        global $worker;
        global $offerData;
        if($new){//有新报价
            $newBaojia = allBaojia($offer_id);
            $offerData[$offer_id]['baojia']=$newBaojia;
            if(!empty($item['conn'])){
                foreach($item['conn'] as $conn){//给每个连接发送新报价数据
                    $worker->connections[$conn]->send(Json::encode($newBaojia));
                }
            }

        }
    }
}

$db = new \Workerman\MySQL\Connection('localhost', '3306', 'root', '123456', 'nn_dev');

function allBaojia($offer_id){
    global $db;
    $sql = "select j.*,u.true_name from product_jingjia as j left join user as u on j.user_id=u.id where j.offer_id=".$offer_id;
    $data = $db->query($sql);
    return $data;
}

function baojiaCount($offer_id){
    global $db;
    global $offerData;
    $count = $db->select("count(id) as num")->from('product_jingjia')
        ->where('offer_id:offer_id')->bindValues(array('offer_id'=>$offer_id))->single();
    if($count>$offerData[$offer_id]['count']){
        $offerData[$offer_id]['count']=$count;
        return true;
    }else{
        return false;
    }
}
// 运行worker
Worker::runAll();
?>

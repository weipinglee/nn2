<?php

use \Workerman\Worker;
use Nette\Utils\Json;
require_once __DIR__."/lib/vendor/autoload.php";

$worker = new Worker("websocket://localhost:89");


$worker->onWorkerStart = function ($connection){
    echo "Worker starting...\n";
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
        //获取报价数据给买方发送，之后有变化再发送


        $connection->send(Json::encode($baojia));
        print_r($regOffer);
        $connection->send($data['cookie']);
    }catch(\Exception $e){
        echo $e->getMessage();
    }

    //$connection->send('123qwe');
    //echo $data;
};

foreach($regOffer as $offer_id=>$conn){
    if(!empty($conn)){
        //查询offer_id的竞价报价

    }
}

function allBaojia($offer_id){
    $db = new \Workerman\MySQL\Connection('localhost', '3306', 'root', '123456', 'nn_dev');
    $sql = "select j.*,u.true_name from product_jingjia as j left join user as u on j.user_id=u.id where j.offer_id=".$offer_id;
    $data = $db->query($sql);
    return $data;
}

function
// 运行worker
Worker::runAll();
?>

<?php
/**
 * Created by PhpStorm.
 * User: weipinglee
 * Date: 2018/6/22
 * Time: 15:11
 */

namespace tests;


require 'start.php';

use \nainai\offer\jingjiaOffer;
use tests\mock\testAccount;

class jingOfferTest extends base
{


    protected $offerObj = null;
    protected $dbObj = null;
    public function __construct()
    {
        parent::__construct();
        $this->offerObj = new jingjiaOffer();
        $this->dbObj = new \Library\M('');
    }

    private function createJingjiaOffer()
    {

    }














    public static  function tearDownAfterClass(){
        self::clearTable('product_offer');
        self::clearTable('products');
        self::clearTable('product_jingjia_set');
        self::clearTable('product_photos');
        self::clearTable('product_jingjia');
    }

}

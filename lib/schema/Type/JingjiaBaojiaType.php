<?php
namespace schema\Type;

use schema\Types;
use schema\MyTypes;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use schema\Data\Handle;

class JingjiaBaojiaType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'JingjiaBaojia',
            'description' => '竞价报价数据',
            'fields' => function() {
                return [
                    'id'      => Types::id(),
                    'user_id' => Types::id(),//报价的用户id
                    'offer_id' => Types::id(),//报盘id
                    'price' => [
                        'type'=>Types::float(),
                        'description'=>'出价价格'
                    ],
                    'win'   => [
                        'type' => Types::int(),
                        'description'=>'是否胜出，1：胜出'
                    ],
                    'time' => [
                        'type' => Types::string(),
                        'description'=>'出价时间'
                    ],
                    'amount' => [
                        'type' => Types::float(),
                        'description'=>'总价格'
                    ],

                    'buyer'    => [
                        'type'=>MyTypes::User(),
                        'description'=>'报价方信息',
                        'args' => [
                            'id' => Types::id()
                        ],
                        'resolve' => function($val, $args, $context, ResolveInfo $info){
                            $args['id'] = $val['user_id'];
                            $res = Handle::findOne($val, $args, $context, $info);
                            return !empty($res)?$res : null;
                        }
                    ]
                ];
            },




        ];
        parent::__construct($config);
    }





}

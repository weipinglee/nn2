<?php
namespace schema\Type;

use schema\AppContext;
use schema\Data\DataSource;
use schema\Data\Offer;
use schema\Types;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class OfferType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Offer',
            'description' => 'offer data',
            'fields' => function() {
                return [
                    'id' => Types::id(),
                    'offer_no' => Types::string(),
                    'user_id' => Types::int(),
                    'type' => Types::int(),
                    'price' => Types::float(),
                    'pro_name' => Types::string(),
                    'user' => [
                        'type'=>Types::user(),
                        'resolve'=> function($val, $args, $context, ResolveInfo $info){
                            DataSource::addUser($val['user_id']);
                            return new \GraphQL\Deferred(function () use ($val,$info) {
                                DataSource::loadUser($info);
                                return DataSource::findUser($val['user_id']);
                            });
                        //    return DataSource::findUser($val['user_id'],$info);
                        }
                    ]


                ];
            },



        ];
        parent::__construct($config);
    }





}

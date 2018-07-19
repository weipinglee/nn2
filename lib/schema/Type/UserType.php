<?php
namespace schema\Type;

use schema\Data\User;
use schema\Types;
use schema\MyTypes;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use schema\Data\Handle;

class UserType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'User',
            'description' => 'user data',
            'fields' => function() {
                return [
                    'id' => Types::id(),
                    'type' => Types::int(),
                    'username' => ['type'=>Types::string()],
                    'true_name' => Types::string(),
                    'mobile' => Types::string(),
                    'email' => Types::string(),
                    'login_time' => Types::string(),

                    'invoice' => [
                        'type'=>MyTypes::Invoice(),
                        'description'=>'开票信息',
                        'args' => [
                            'user_id' => Types::id()
                        ],
                    ],

                    'company' => [
                        'type'=>MyTypes::Company(),
                        'description'=>'企业信息',
                        'args' => [
                            'user_id' => Types::nonNull(Types::id())
                        ],
                    ],

                    'bank' => [
                        'type' => MyTypes::bank(),
                        'description'=>'开户信息',
                        'args' => [
                            'user_id' => Types::id()
                        ],
                    ]



                ];
            },
            'resolveField' => function($val, $args, $context, ResolveInfo $info) {//var_dump($info);
                // print_r($info->getFieldSelection());
                return Handle::findOne($val, $args, $context, $info);

            }


        ];
        parent::__construct($config);
    }






}

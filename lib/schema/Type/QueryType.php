<?php
namespace schema\Type;

use schema\Data\Handle;
use schema\Types;
use schema\MyTypes;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class QueryType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Query',
            'fields' => [
                'user' => [
                    'type' => MyTypes::user(),
                    'description' => '用户数据',
                    'args' => [
                        'id' => [
                                  'type'=>Types::id(),
                                  'name'=>'id',
                                   'defaultValue'=>0
                                 ],
                        'mobile' => [
                                   'type'=>Types::string(),
                                    'name'=>'mobile',
                                    'defaultValue'=>''
                            ],
                       // 'username' => Types::nonNull(Types::string())
                    ],
                ],
                'jingjia' => [
                    'type' => MyTypes::jingjia(),
                    'description' => '竞价数据',
                    'args' => [
                        'id' => [
                            'type'=>Types::id(),
                            'name'=>'id',
                            'defaultValue'=>0
                        ]

                    ],
                ],


            ],
            'resolveField' => function($val, $args, $context, ResolveInfo $info) {//var_dump($info);
                $res = Handle::findOne($val, $args, $context, $info);
                if(!empty($res)){
                    return $res;
                }
            }
        ];
        parent::__construct($config);

    }





    public function deprecatedField()
    {
        return 'You can request deprecated field, but it is not displayed in auto-generated documentation by default.';
    }
}

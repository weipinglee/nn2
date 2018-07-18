<?php
namespace schema\Type;

use schema\AppContext;
use schema\Data\DataSource;
use schema\Types;
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
                    'type' => Types::user(),
                    'description' => '用户数据',
                    'args' => [
                        'id' => Types::nonNull(Types::id()),
                        'mobile' => Types::nonNull(Types::string()),
                        'username' => Types::nonNull(Types::string())
                    ],
                ]


            ],
            'resolveField' => function($val, $args, $context, ResolveInfo $info) {//var_dump($info);
            // print_r($info->getFieldSelection());
                return $this->{$info->fieldName}($val, $args, $context, $info);
            }
        ];
        parent::__construct($config);

    }

    public function user($rootValue, $args, $context, $info)
    {
         return DataSource::findUser($args,$info);

    }




    public function deprecatedField()
    {
        return 'You can request deprecated field, but it is not displayed in auto-generated documentation by default.';
    }
}

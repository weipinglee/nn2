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
                        'id' => Types::nonNull(Types::id())
                    ],
                ],
                'offer' => [
                    'type' => Types::offer(),
                    'description' => '报盘数据',
                    'args' => [
                        'id' => Types::nonNull(Types::id())
                    ],
                ],
                'offerList' => [
                    'type'=>Types::listOf(Types::offer()),
                    'description' => '报盘列表',
                    'args' => [
                        'page' => Types::int(),
                        'pageSize' => Types::int(),

                    ]
                ],

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
        DataSource::addUser($args['id']);
        return new \GraphQL\Deferred(function () use ($args,$info) {
            DataSource::loadUser($info);
            return DataSource::findUser($args['id']);
        });
    }

    public function offer($rootValue, $args, $context, $info)
    {
        return DataSource::findOffer($args['id'],$info);
    }

    public function offerList($rootValue, $args, $context, $info)
    {

        return DataSource::findOfferlist($args['page'],$args['pageSize'],$info);
    }


    public function deprecatedField()
    {
        return 'You can request deprecated field, but it is not displayed in auto-generated documentation by default.';
    }
}

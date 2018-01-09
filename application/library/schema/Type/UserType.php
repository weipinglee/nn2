<?php
namespace schema\Type;

use schema\AppContext;
use schema\Data\DataSource;
use schema\Data\User;
use schema\Types;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

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
                    'email' => Types::email(),
                    'login_time' => Types::string(),
                    'type_txt' => [
                        'type'=>Types::string(),
                        'resolve'=>function($val, $args, $context, ResolveInfo $info)
                                    {
                                        return DataSource::type_txt($val);
                                    }
                    ]


                ];
            },



        ];
        parent::__construct($config);
    }





}

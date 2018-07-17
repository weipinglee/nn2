<?php
namespace schema\Type;

use schema\AppContext;
use schema\Data\DataSource;
use schema\Data\User;
use schema\Types;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class BankType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Bank',
            'description' => 'bank data',
            'fields' => function() {
                return [
                    'user_id' => Types::id(),
                    'bank_name' => ['type'=>Types::string(),'description'=>'ÒøĞĞÃû³Æ'],




                ];
            },



        ];
        parent::__construct($config);
    }





}

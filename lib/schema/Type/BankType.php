<?php
namespace schema\Type;

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
                    'bank_name' => ['type'=>Types::string(),'description'=>'银行名称'],
                    'card_no'   => ['type'=>Types::string(),'description'=>'卡号'],
                    'true_name' => ['type'=>Types::string(),'description'=>'开户人姓名'],
                    'proof'     => ['type'=>Types::string(),'description'=>'开户证明'],
                    'status'    => ['type'=>Types::int(),'description'=>'状态，1：已通过'],
                ];
            },



        ];
        parent::__construct($config);
    }





}

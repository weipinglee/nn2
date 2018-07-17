<?php
namespace schema\Type;

use schema\AppContext;
use schema\Data\DataSource;
use schema\Data\User;
use schema\Types;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class InvoiceType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Invoice',
            'description' => '用户开票信息',
            'fields' => function() {
                return [
                    'user_id' => Types::id(),
                    'tax_no' => ['type'=>Types::string(),'description'=>'纳税人识别号'],
                    'address' => ['type'=>Types::string(),'description'=>'收票人地址'],
                    'phone' => ['type'=>Types::string(),'description'=>'收票人电话'],
                    'bank_name' => ['type'=>Types::string(),'description'=>'银行名称'],
                    'bank_no' => ['type'=>Types::string(),'description'=>'银行账号'],
                ];
            },



        ];
        parent::__construct($config);
    }





}

<?php
namespace schema\Type;

use schema\AppContext;
use schema\Data\DataSource;
use schema\Data\User;
use schema\Types;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class CompanyType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Company',
            'description' => '企业信息',
            'fields' => function() {
                return [
                    'user_id' => Types::id(),
                    'company_name' => ['type'=>Types::string(),'description'=>'企业名称'],
                    'legal_person' => ['type'=>Types::string(),'description'=>'法人'],
                    'contact' => ['type'=>Types::string(),'description'=>'联系人'],
                    'contact_phone' => ['type'=>Types::string(),'description'=>'联系人电话'],
                    'area' => ['type'=>Types::string(),'description'=>'地区'],
                    'adress' => ['type'=>Types::string(),'description'=>'详细地址'],
                    'business' => ['type'=>Types::string(),'description'=>'主营产品'],
                ];
            },



        ];
        parent::__construct($config);
    }





}

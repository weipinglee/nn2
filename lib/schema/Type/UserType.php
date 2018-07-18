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

                    'invoice' => [
                        'type'=>Types::Invoice(),
                        'description'=>'开票信息',
                        'args' => [
                            'user_id' => Types::id()
                        ],
                    ],

                    'company' => [
                        'type'=>Types::Company(),
                        'description'=>'企业信息',
                        'args' => [
                            'user_id' => Types::nonNull(Types::id())
                        ],
                    ],



                ];
            },
            'resolveField' => function($val, $args, $context, ResolveInfo $info) {//var_dump($info);
                // print_r($info->getFieldSelection());

                if(method_exists($this,$info->fieldName) &&$info->fieldName!='id'){
                    return $this->{$info->fieldName}($val, $args, $context, $info);
                }else{
                    return $val[$info->fieldName];
                }

            }


        ];
        parent::__construct($config);
    }

    public function invoice($rootValue, $args, $context, $info){
        return DataSource::findInvoice($rootValue['id'],$info);
    }

    public function company($rootValue, $args, $context, $info){

    }




}

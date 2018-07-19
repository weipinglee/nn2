<?php
namespace schema;

use schema\Type\QueryType;
use schema\Type\UserType;
use schema\Type\InvoiceType;
use schema\Type\CompanyType;
use schema\Type\BankType;
use schema\Type\JingjiaType;
use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\NonNull;
use GraphQL\Type\Definition\Type;

/**
 * Class Types
 *
 * Acts as a registry and factory for your types.
 *
 * As simplistic as possible for the sake of clarity of this example.
 * Your own may be more dynamic (or even code-generated).
 *
 * @package GraphQL\Examples\Blog
 */
class MyTypes extends Types
{
    // Object types:
    private static $user;
    private static $invoice;
    private static $company;

    private static $bank;//开户信息

    private static $jingjia;

    /**
     * @return UserType
     */
    public static function user()
    {
        return self::$user ?: (self::$user = new UserType());
    }


    public static function invoice(){
        return self::$invoice ?:(self::$invoice = new InvoiceType());
    }

    public static function company(){
        return self::$company ?:(self::$company = new CompanyType());
    }

    public static function bank(){
        return self::$bank ?:(self::$bank = new BankType());
    }

    public static function jingjia(){
        return self::$jingjia ?:(self::$jingjia = new JingjiaType());
    }


}

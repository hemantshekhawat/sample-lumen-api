<?php

namespace App\Helpers;
/**
 * Created by PhpStorm.
 * User: hemant.singh
 * Date: 29/08/19
 * Time: 11:35
 */
Class ErrorCodes
{
    public static $INVALID_PRODUCT_SKU = ["message" => "Invalid Product SKU", "status_code" => 101];
    public static $INVALID_PURCHASE = ["message" => "User has not made a purchase of product SKU", "status_code" => 102];
}

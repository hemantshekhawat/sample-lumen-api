<?php

/**
 * Created by PhpStorm.
 * User: hemant.singh
 * Date: 29/08/19
 * Time: 11:35
 */

namespace App\Helpers;

Class ResponseCodes
{
    public static $INVALID_PRODUCT_SKU = ["message" => "Invalid Product SKU", "status_code" => 151];
    public static $INVALID_PURCHASE = ["message" => "User has not made a purchase of product SKU", "status_code" => 152];
    public static $PRODUCT_DELETED = ["message" => "User product has been removed", "status_code" => 153];
    public static $PRODUCT_DELETED_FAILED = ["message" => "Product could not be deleted from user's purchased list", "status_code" => 154];
    public static $PRODUCT_ALREADY_PURCHASED = ["message" => "Product is already in user's purchased list", "status_code" => 155];
    public static $PRODUCT_ADDED = ["message" => "Product has been added to user's purchased list", "status_code" => 156];
}

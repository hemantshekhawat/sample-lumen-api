<?php
/**
 * Created by PhpStorm.
 * User: hemant.singh
 * Date: 29/08/19
 * Time: 10:05
 */

namespace App;


class Product extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "sku","name"
    ];
}

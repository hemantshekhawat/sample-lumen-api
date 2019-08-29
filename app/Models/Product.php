<?php
/**
 * Created by PhpStorm.
 * User: hemant.singh
 * Date: 29/08/19
 * Time: 10:05
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "sku", "name"
    ];

    public function purchased()
    {
         return $this->belongsToMany(Purchased::class,"product_sku","sku");
    }

}

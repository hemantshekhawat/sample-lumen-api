<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;

class Purchased extends Model
{
    protected $table = "purchased";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "product_sku", "user_id"
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class, "id", "user_id");
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, "sku", "product_sku");
    }


}

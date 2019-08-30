<?php
/**
 * Created by PhpStorm.
 * User: hemant.singh
 * Date: 29/08/19
 * Time: 10:57
 */

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

/**
 * @Resource("Products")
 */

class ProductController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllProducts()
    {
        $allProducts = Product::get();
        return $this->response()->array($allProducts);
    }

}

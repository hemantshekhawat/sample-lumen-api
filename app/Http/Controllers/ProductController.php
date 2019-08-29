<?php
/**
 * Created by PhpStorm.
 * User: hemant.singh
 * Date: 29/08/19
 * Time: 10:57
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @Resource("Products")
 */

class ProductController extends Controller
{
    /**
     * ProductController constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function __toString()
    {
        // TODO: Implement __toString() method.
    }


}

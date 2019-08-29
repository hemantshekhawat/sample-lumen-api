<?php
/**
 * Created by PhpStorm.
 * User: hemant.singh
 * Date: 29/08/19
 * Time: 10:03
 */

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchased;
use App\Models\User;
use Dingo\Api\Routing\Helpers;
use App\Helpers\ErrorCodes;

/**
 * @Resource("Users")
 */
class UserController extends Controller
{
    use Helpers;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('api.auth', ['only' => ['index']]);
    }

    public function getUser()
    {
        return $this->response->array($this->auth->user());
    }

    public function getUserProducts()
    {
        $products = Product::join('purchased', 'products.sku', '=', 'purchased.product_sku')
            ->join('users', 'users.id', '=', 'purchased.user_id')
            ->where("users.id", $this->auth->user()->id)
            ->select(["products.sku", "products.name"])
            ->get();
        return $this->response->array($products);

    }

    public function addUserProducts()
    {
        $products = Product::join('purchased', 'products.sku', '=', 'purchased.product_sku')
            ->join('users', 'users.id', '=', 'purchased.user_id')
            ->where("users.id", $this->auth->user()->id)
            ->select(["products.sku", "products.name"])
            ->get();
        return $this->response->array($products);

    }

    public function removeUserProduct($SKU)
    {

        if (!Product::where("sku", $SKU)->get()->count()) {
            return $this->response->error(ErrorCodes::$INVALID_PRODUCT_SKU["message"],ErrorCodes::$INVALID_PRODUCT_SKU["status_code"]);
        }

        $userProduct = Purchased::join('users', 'users.id', '=', 'purchased.user_id')
            ->where("users.id", $this->auth->user()->id)
            ->where("purchased.product_sku", $SKU);

        if (!$userProduct->count()) {
            return $this->response->error(ErrorCodes::$INVALID_PURCHASE);
        }

        if ($userProduct->delete()) {
            return $this->response->accepted("Product deleted from user's purchased list");
        } else {
            return $this->response->error("Product could not be deleted from user's purchased list");
        }
    }
}

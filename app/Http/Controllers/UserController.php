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
use Dingo\Api\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Helpers\ResponseCodes;

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


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser()
    {
        return $this->response()->array($this->auth->getUser());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserProducts()
    {
        $products = Product::join('purchased', 'products.sku', '=', 'purchased.product_sku')
            ->join('users', 'users.id', '=', 'purchased.user_id')
            ->where("users.id", $this->auth->user()->id)
            ->select(["products.sku", "products.name"])
            ->get();
        return $this->response()->array($products);

    }

    public function addUserProducts(Request $request)
    {
        try {
            if (!Product::where("sku", $request->get("sku"))->get()->count()) {
                return $this->response()->array(ResponseCodes::$INVALID_PRODUCT_SKU);
            }

            $userProduct = Purchased::join('users', 'users.id', '=', 'purchased.user_id')
                ->where("users.id", $this->auth->user()->id)
                ->where("purchased.product_sku", $request->get("sku"));


//            dd($userProduct->get(),$userProduct->count());
            if ($userProduct->count() > 0) {
                return $this->response()->array(ResponseCodes::$PRODUCT_ALREADY_PURCHASED);
            }

            $purchased = new Purchased();
            $purchased->user_id = $this->auth()->user()->id;
            $purchased->product_sku = $request->get("sku");
            $purchased->save();

            return $this->response()->array(ResponseCodes::$PRODUCT_ADDED);
        } catch (\Exception $exception) {
            dd($request,$exception);
            return $this->response()->error("Exception occured: Error:: " . $exception->getMessage(), $exception->getCode());
        }
    }

    public function removeUserProduct($SKU)
    {

        try {
            if (!Product::where("sku", $SKU)->get()->count()) {
                return $this->response()->array(ResponseCodes::$INVALID_PRODUCT_SKU);
            }

            $userProduct = Purchased::join('users', 'users.id', '=', 'purchased.user_id')
                ->where("users.id", $this->auth->user()->id)
                ->where("purchased.product_sku", $SKU);

            if (!$userProduct->count()) {
                return $this->response()->array(ResponseCodes::$INVALID_PURCHASE);
            }

            if ($userProduct->delete()) {
                return $this->response()->array(ResponseCodes::$PRODUCT_DELETED);
            } else {
                return $this->response()->array(ResponseCodes::$PRODUCT_DELETED_FAILED);
            }
        } catch (\Exception $exception) {
            return $this->response()->error("Exception occured: Error:: " . $exception->getMessage(), $exception->getStatusCode());
        }

    }
}

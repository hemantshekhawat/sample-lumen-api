<?php
/**
 * Created by PhpStorm.
 * User: hemant.singh
 * Date: 29/08/19
 * Time: 10:03
 */

namespace App\Http\Controllers;

use Dingo\Api\Routing\Helpers;

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

    public function index()
    {
        return $this->response->array($this->auth->user()->toArray());
    }
}

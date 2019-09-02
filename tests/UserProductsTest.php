<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;

/**
 * Class UserProductsTest
 */
class UserProductsTest extends TestCase
{

    /**
     * /api/products [GET]
     */
    public function testShouldReturnAllProducts()
    {
        $this->get("/api/products", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'products' => ['*' =>
                [
                    'sku',
                    'name',
                ]
            ]
        ]);

    }

    /**
     * /api/user/products [GET]
     */
    public function testShouldReturnUserProducts()
    {
        $header = $this->getTestUserTokenHeader();

        $this->json('get', '/api/user/products', [], $header)
            ->seeStatusCode(200)
            ->seeJsonStructure(
                ['products' =>
                    ["*" =>
                        [
                            'sku',
                            'name',
                        ]
                    ]
                ]
            );
    }

    /**
     * /products [POST]
     */
    public function testShouldCreateProduct()
    {
        $parameters = [
            'sku' => 'traktor-kontrol-s8',
        ];

        $header = $this->getTestUserTokenHeader();

        $this->json("post", "/api/user/products", $parameters, $header);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                "message",
                "status_code"
            ]
        );

    }

    /**
     * /api/user/products/ [DELETE]
     */
    public function testShouldDeleteAUserProduct()
    {
        $header = $this->getTestUserTokenHeader();

        $parameters = [
            'sku' => 'traktor-kontrol-s8',
        ];

        /**
         * Add a Product to User
         */
        $this->json("post", "/api/user/products", $parameters, $header);

        /**
         * Delete the product
         */
        $this->json('delete', "/api/user/products/" . $parameters['sku'], $header);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                "message",
                "status_code"
            ]
        );
    }

    public function getTestUserTokenHeader()
    {
        $this->refreshApplication();
        $user = User::find(1);
        $this->actingAs($user);

        $token = JWTAuth::fromUser($user);
        $header = [
            'HTTP_Authorization' => 'Bearer ' . $token
        ];

        return $header;

    }

}

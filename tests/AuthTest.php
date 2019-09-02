<?php
/**
 * Created by PhpStorm.
 * User: hemant.singh
 * Date: 02/09/19
 * Time: 19:06
 */

namespace tests;

use App\Models\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;

class AuthTest extends TestCase
{
    use DatabaseMigrations;


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLoginWithWrongValidation()
    {
//        $this->artisan('db:seed');
        $this->json('post', 'api/auth', [
            'email' => $this->faker->email,
            'password' => 'asdasd'
        ])->seeJson([
            "error" => "Unauthorizend"
        ])->assertResponseStatus(401);
    }

    /**
     *
     */
    public function testCorrectLogin()
    {
        $email = $this->faker->email;
        $password = str_random(8);
        factory(User::class)->create([
            'email' => $email,
            'password' => app('hash')->make($password)
        ]);
        $this->json('post', 'api/auth', [
            'email' => $email,
            'password' => $password
        ])->seeStatusCode(200)
            ->seeJsonStructure(
                [
                    "access_token",
                    "token_type",
                    "expires_in"
                ]
            )
            ->assertResponseOk();
    }

    public function getTestUser()
    {

        $user = factory(User::class)->make(
            [
                "email" => "fahey.dana@krajcik.com",
                "password" => "secret",
            ]
        );

        return $user;
    }
}

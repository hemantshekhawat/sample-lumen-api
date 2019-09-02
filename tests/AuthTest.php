<?php
/**
 * Created by PhpStorm.
 * User: hemant.singh
 * Date: 02/09/19
 * Time: 19:06
 */

namespace tests;

use App\Models\User;
use TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic test Login example with wrong credentials.
     *
     * @return void
     */
    public function testLoginWithWrongValidation()
    {
        $this->json('post', 'api/auth', [
            'email' => $this->faker->email,
            'password' => $this->faker->password
        ])->seeJson([
            "error" => "Unauthorizend"
        ])->assertResponseStatus(401);
    }

    /**
     * A basic test Login example with right credentials.
     *
     * @return void
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
}

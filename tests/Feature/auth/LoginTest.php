<?php

namespace Tests\Feature\auth;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class LoginTest extends TestCase
{
    const ROUTE = self::BASE_ROUTE . 'auth/login';


    public function testNonexistentEmail()
    {
        $payload = $this->generatePayload();

        $this->json('POST', self::ROUTE, $payload)->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'message',
                'errors' => ['email']
            ])
            ->assertJson([
                'message' => 'User not registered',
                'errors' => [
                    'email' => [
                        'User not registered'
                    ]
                ]
            ]);
    }

    /**
     * @return array{
     *      password: string,
     *      email: string,
     * }
     */
    public function generatePayload(): array
    {
        return [
            'password' => $this->faker->password,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }

    public function testUniquePhone()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $payload = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $this->json('POST', self::ROUTE, $payload)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in'
            ]);
    }
}

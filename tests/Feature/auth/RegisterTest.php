<?php

namespace Tests\Feature\auth;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    const ROUTE = self::BASE_ROUTE . 'auth/register';


    public function testUniqueEmail()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $payload = $this->generatePayload();
        $payload["email"] = $user->email;

        $this->json('POST', self::ROUTE, $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'message',
                'errors' => ['email']
            ])
            ->assertJson([
                'errors' => [
                    'email' => [
                        'Email is already in use'
                    ]
                ]
            ]);

        $this->assertDatabaseCount('users', 1);
    }

    public function testUniquePhone()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $payload = $this->generatePayload();
        $payload["phone"] = $user->phone;

        $this->json('POST', self::ROUTE, $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'message',
                'errors' => ['phone']
            ])
            ->assertJson([
                'errors' => [
                    'phone' => [
                        'Phone number is already in use'
                    ]
                ]
            ]);

        $this->assertDatabaseCount('users', 1);
    }

    public function testRegisterUserSuccess()
    {
        $payload = $this->generatePayload();

        $response = $this->json('POST', self::ROUTE, $payload);

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseHas('users', [
            'email' => $payload['email'],
            'phone' => $payload['phone']
        ]);
    }

    /**
     * @return array{
     *      name: string,
     *      password: string,
     *      email: string,
     *      phone: string
     * }
     */
    public function generatePayload(): array
    {
        return [
            'name' => $this->faker->name,
            'password' => $this->faker->password,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->unique()->e164PhoneNumber,
        ];
    }

}

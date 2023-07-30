<?php

namespace Tests\Feature\auth;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class MeTest extends TestCase
{
    const ROUTE = self::BASE_ROUTE . 'auth/me';

    public function testNonexistentEmail()
    {
        $this->makeUser();
        $this->actingAs($this->user)->json('GET', self::ROUTE)->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'email',
                    'email_verified_at',
                    'phone',
                    'updated_at',
                    'created_at',
                    'id',
                ],
            ])
            ->assertJson([
                'data' => [
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                    'phone' => $this->user->phone,
                    'id' => $this->user->id,
                ],
            ]);
    }
}

<?php

namespace Tests\Feature\post;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class StorePostTest extends TestCase
{
    const ROUTE = self::BASE_ROUTE . 'post';

    public function testUnauthorized(): void
    {
        $this->json(
            'POST',
            self::ROUTE,
            ['asdsa']
        )->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testWithRequiredPayload(): void
    {
        $this->makeUser();
        $payload = $this->getRequiredPayload();
        $response = $this->actingAs($this->user)
            ->json(
            'POST',
            self::ROUTE,
                $payload
        )->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseHas('posts',
            array_merge($payload, ['user_id' => $this->user->id])
        );
    }

    public function testWithFullPayload(): void
    {
        $this->makeUser();
        $payload = $this->getFullPayload();
        $response = $this->actingAs($this->user)
            ->json(
                'POST',
                self::ROUTE,
                $payload
            )->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseHas('posts',
            array_merge($payload, ['user_id' => $this->user->id])
        );
    }


    private function getRequiredPayload()
    {
        return [
            'content' => 'test post',
        ];
    }

    private function getFullPayload()
    {
        return [
            'title' => "title",
            'content' => 'test post',
        ];
    }

}

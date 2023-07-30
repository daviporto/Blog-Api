<?php

namespace Tests\Feature\post;

use App\Models\User;
use Tests\TestCase;

class StorePostTest extends TestCase
{
    const ROUTE = self::BASE_ROUTE . 'post/create';

    public function testStorePostWithRequiredFields(): void
    {
        $this->makeUser();
        $response = $this->json(
            'PUT',
            self::ROUTE,
            $this->getRequiredPayload()
        );

        $response->assertStatus(201);
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

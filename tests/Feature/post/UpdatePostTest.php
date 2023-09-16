<?php

namespace Tests\Feature\post;

use App\Models\Post;
use App\Models\User;
use Str;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdatePostTest extends TestCase
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

    public function testNonExistingPost(): void
    {
        $monExistentId = -1;
        $this->makeUser();
        $this->actingAs($this->user)
            ->json(
                'PUT',
                self::ROUTE . '/' . $monExistentId,
                [
                    'content' => 'asdasd'
                ]
            )->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testAnotherUserPost(): void
    {
        $this->makeUser();

        /** @var Post $post */
        $post = Post::factory()->create(
            [
                'user_id' => User::factory()->create()->id
            ]
        );

        $this->actingAs($this->user)
            ->json(
                'PUT',
                self::ROUTE . '/' . $post->id,
                [
                    'content' => 'asdasd'
                ]
            )->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testWithFullPayload(): void
    {
        $this->makeUser();
        $payload = $this->getFullPayload();
        /** @var Post $post */
        $post = Post::factory()->create(
            [
                'user_id' => $this->user->id
            ]
        );

        $response = $this->actingAs($this->user)
            ->json(
                'PUT',
                self::ROUTE . '/' . $post->id,
                $payload
            )->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseHas(
            'posts',
            $payload + [
                'user_id' => $this->user->id,
                'id'      => $post->id
            ]
        );
    }
    private function getFullPayload(): array
    {
        return [
            'title'   => "title",
            'content' => 'test post',
        ];
    }
    public function testWithRequiredPayload(): void
    {
        $this->makeUser();
        $payload = $this->getRequiredPayload();
        /** @var Post $post */
        $post = Post::factory()->create(
            [
                'user_id' => $this->user->id
            ]
        );

        $response = $this->actingAs($this->user)
            ->json(
                'PUT',
                self::ROUTE . '/' . $post->id,
                $payload
            )->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseHas(
            'posts',
            $payload + [
                'user_id' => $this->user->id,
                'id'      => $post->id
            ]
        );
    }
    private function getRequiredPayload(): array
    {
        return [
            'content' => Str::random(),
        ];
    }

}

<?php

namespace Tests\Feature\post;

use App\Models\Post;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DeletePostTest extends TestCase
{
    const ROUTE = self::BASE_ROUTE . 'post';

    public function testUnauthorized(): void
    {
        $this->json(
            'DELETE',
            self::ROUTE . '/' . 1,
            ['asdsa']
        )->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testNonExistingPost(): void
    {
        $monExistentId = -1;
        $this->makeUser();
        $this->actingAs($this->user)
            ->json(
                'DELETE',
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
                'DELETE',
                self::ROUTE . '/' . $post->id,
                [
                    'content' => 'asdasd'
                ]
            )->assertStatus(Response::HTTP_NOT_FOUND);
    }
    public function testWithDelete(): void
    {
        $this->makeUser();
        /** @var Post $post */
        $post = Post::factory()->create(
            [
                'user_id' => $this->user->id
            ]
        );

        $response = $this->actingAs($this->user)
            ->json(
                'DELETE',
                self::ROUTE . '/' . $post->id,
            )->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing(
            'posts',
            [
                'id' => $post->id
            ]
        );
    }

}

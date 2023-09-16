<?php

namespace Tests\Feature\post;

use App\Models\Post;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class IndexPostTest extends TestCase
{
    const ROUTE = self::BASE_ROUTE . 'post';

    public function testUnauthorized(): void
    {
        $this->json(
            'GET',
            self::ROUTE,
            ['asdsa']
        )->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testEmptyPosts(): void
    {
        $this->makeUser();
        $this->actingAs($this->user)
            ->json(
                'GET',
                self::ROUTE,
            )->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data',
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next'
                ],
                'meta'  => [
                    'current_page',
                    'from',
                    'last_page',
                    'links' => [
                        '*' => [
                            'url',
                            'label',
                            'active'
                        ]
                    ],
                    'path',
                    'per_page',
                    'to',
                    'total'
                ]
            ])
            ->assertJson(
                [
                    'meta' => [
                        'total' => 0
                    ]
                ]
            )
            ->assertJsonCount(0, 'data');
    }

    public function testIndexPosts()
    {
        $this->makeUser();
        Post::factory(3)->create();
        $this->actingAs($this->user)
            ->json(
                'GET',
                self::ROUTE,
            )->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data'  => [
                    '*' => [
                        'id',
                        'content',
                        'edited',
                        'user_id',
                        'created_at',
                        'updated_at',
                        'title'
                    ]
                ],
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next'
                ],
                'meta'  => [
                    'current_page',
                    'from',
                    'last_page',
                    'links' => [
                        '*' => [
                            'url',
                            'label',
                            'active'
                        ]
                    ],
                    'path',
                    'per_page',
                    'to',
                    'total'
                ]
            ])
            ->assertJson(
                [
                    'meta' => [
                        'total' => 3
                    ]
                ]
            )
            ->assertJsonCount(3, 'data');
    }

    public function testPagination()
    {
        $this->makeUser();
        Post::factory(5)->create();
        $response = $this->actingAs($this->user)
            ->json(
                'GET',
                self::ROUTE,
                [
                    'per_page' => 1
                ]
            )->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data'  => [
                    '*' => [
                        'id',
                        'content',
                        'edited',
                        'user_id',
                        'created_at',
                        'updated_at',
                        'title'
                    ]
                ],
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next'
                ],
                'meta'  => [
                    'current_page',
                    'from',
                    'last_page',
                    'links' => [
                        '*' => [
                            'url',
                            'label',
                            'active'
                        ]
                    ],
                    'path',
                    'per_page',
                    'to',
                    'total'
                ]
            ])
            ->assertJson(
                [
                    'meta' => [
                        'per_page'  => 1,
                        'total'     => 5,
                        'last_page' => 5
                    ]
                ]
            )
            ->assertJsonCount(1, 'data');
    }
}

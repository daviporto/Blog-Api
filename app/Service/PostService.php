<?php

namespace App\Service;

use App\Models\Post;
use App\Models\User;
use App\Prototype\DeletePostRequestPrototype;
use App\Prototype\PostRequestPrototype;
use App\Prototype\UpdatePostRequestPrototype;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PostService
{

    public function getUserPosts(User|Authenticatable $user, $perPage = 15): LengthAwarePaginator
    {
        return $user->posts()->orderBy('posts.created_at', 'desc')->paginate($perPage);
    }

    public function storePost(PostRequestPrototype $postPrototype): void
    {
        Post::create(
            [
                'title' => $postPrototype->getTitle(),
                'content' => $postPrototype->getContent(),
                'edited' => false,
                'user_id' => auth()->user()->id,
            ]
        );
    }

    public function updatePost(UpdatePostRequestPrototype $postPrototype): void
    {
        Post::findOrFail($postPrototype->getId())->update(
            [
                'title' => $postPrototype->getTitle(),
                'content' => $postPrototype->getContent(),
                'edited' => true,
            ]
        );
    }

    public function deletePost(DeletePostRequestPrototype $prototype): void
    {
        Post::destroy($prototype->getId());
    }

}

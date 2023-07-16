<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PostService
{

    public function getUserPosts(User|Authenticatable $user, $perPage = 15): LengthAwarePaginator
    {
        return $user->posts()->orderBy('posts.created_at', 'desc')->paginate($perPage);
    }

}

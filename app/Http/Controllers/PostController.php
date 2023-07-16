<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexPostRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Service\PostService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{

    public function index(IndexPostRequest $request): AnonymousResourceCollection
    {
        $posts = app(PostService::class)->getUserPosts(auth()->user(), $request->per_page ?? null);
        return PostResource::collection($posts);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StorePostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = [
            'content' => $request->content, //texto do post
            'edited' => false, //criado agora, portanto não editado
            'user_id' => auth()->user()->id, // user que fez a requisição
        ];
        return Post::create($post); //retorna o post recem criado para tratamento no App
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdatePostRequest $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::find($id);
        $post->content = $request->content; // substitui o texto do post
        $post->edited = true; //true == editado
        $post->save(); //persiste as mudanças
        return $post; // retorna o novo post para tratamento no App.
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Post::destroy($post->id); //deleta o post solicitado
        return response()->json([
            'id' => $post->id, //retorna o id do post deletado para tratamento no App
        ]);
    }
}

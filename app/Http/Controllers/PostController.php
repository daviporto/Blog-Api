<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::select('posts.*', 'users.name')
            ->leftJoin('posts', 'users.id', '=', 'posts.user_id') //Combina o post e nome do usuário que o escreveu
            ->orderBy('posts.created_at', 'desc') //mais novo pro mais antigo 
            ->paginate(15);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
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
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request,  $id)
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
     * @param  \App\Models\Post  $post
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

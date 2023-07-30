<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeletePostRequest;
use App\Http\Requests\IndexPostRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Prototype\DeletePostRequestPrototype;
use App\Prototype\PostRequestPrototype;
use App\Prototype\UpdatePostRequestPrototype;
use App\Service\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response as IluminateResponse;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function index(IndexPostRequest $request): AnonymousResourceCollection
    {
        $posts = app(PostService::class)->getUserPosts(auth()->user(), $request->per_page ?? null);
        return PostResource::collection($posts);
    }


    /**
     *
     * @param StorePostRequest $request
     * @return JsonResponse|IluminateResponse
     */
    public function store(StorePostRequest $request): JsonResponse|IluminateResponse
    {
        try {
            DB::beginTransaction();
            app(PostService::class)->storePost(PostRequestPrototype::fromRequest($request->all()));
            DB::commit();
            return response()->noContent();
        } catch (\Exception $exception) {
            return $this->handleException($exception);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @return JsonResponse|IluminateResponse
     * @throws \Throwable
     */
    public function update(UpdatePostRequest $request):JsonResponse|IluminateResponse
    {
        try {
            DB::beginTransaction();
            app(PostService::class)->updatePost(UpdatePostRequestPrototype::fromRequest($request->all()));
            DB::commit();
            return response()->noContent();
        } catch (\Exception $exception) {
            return $this->handleException($exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeletePostRequest $request
     * @return IluminateResponse|JsonResponse
     * @throws \Throwable
     */
    public function destroy(DeletePostRequest $request):IluminateResponse|JsonResponse
    {
        try {
            DB::beginTransaction();
            app(PostService::class)->deletePost(DeletePostRequestPrototype::fromRequest($request->all()));
            DB::commit();
            return response()->noContent();
        } catch (\Exception $exception) {
            return $this->handleException($exception);
        }
    }

}

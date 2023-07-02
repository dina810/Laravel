<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PostResource;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts=Post::all();
        return  PostResource::collection($posts);

    } 

     public function show($postId)
     {
         $post = Post::find($postId);
        //  return response()->json([
        //     'success' => true,
        //     'data' => $post
        // ]);
      
         return new PostResource($post);
     }
    public function store(Request $request)
     {
       
        $request->validate([
            'title' => ['required' ,'min:5'],
            'description' => ['required' ,'min:10'],
        ]);
        $request= request()->all();
        $post = Post::create($request);
        return new PostResource($post);

     } 
     public function update(Request $request, $id)
{
    $post = Post::findOrFail($id);

    $validatedData = $request->validate([
        'title' => 'required',
        'description' => 'required',
    ]);

    $post->update($validatedData);
    return new PostResource($post);
    }
    public function delete($postId)
    {
        $post = Post::find($postId);
        $post->delete();
        return new PostResource($post);
 
    }
}
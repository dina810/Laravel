<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
class PostController extends Controller
{
    
    public function index(Request $request)
    {
        $posts = Post::all();
        $posts = Post::paginate(5);
        
        return view('posts.index',[
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('posts.create',[
            'users' => User::all(),
        ]);
    }

    //public function store(StorePostRequest $request)
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required' ,'min:5'],
            'description' => ['required' ,'min:10'],
        ]);
        Post::create($request->all());
        return redirect()->route('posts.index');
    }

   
    public function show($postID)
    {
        $post = Post::find($postID);
         $date = Carbon::parse($post->created_at)->format('l jS \of F Y h:i:s A');
        return view('posts.show', [
            'post' => $post,
            'date' => $date,
        ]);
    }

    
    public function edit($postID)
    {
        return view('posts.edit', [
            'post' => Post::find($postID),
            'users' => User::all(),
        ]);
    }

   
    public function update(Request $request, $postID)
    {
        // @dd($request->all());
        Post::where('id', $postID)->update([
            'title' => $request->all()['title'],
            'description' => $request->all()['description'],
            'user_id' => $request->all()['post_creator'],
        ]);
        return redirect()->route('posts.index');
    }

    public function destroy($postID)
    {
        Post::where('id', $postID)->delete();
        return redirect()->route('posts.index');
    }
    // public function getPosts(){

    //     return
    //     [
    //         ['id' => 1, 'title' => 'first post', 'description' => 'first post describtion', 'posted_by' => 'Asmaa', 'email' => 'asmaa11298@mail.com', 'created_at' => '2022-02-19 5:00:00'],
    //         ['id' => 2, 'title' => 'second post', 'description' => 'second post describtion', 'posted_by' => 'Ebrahim', 'email' => 'ebrahim@gmail.com', 'created_at' => '2022-02-19 06:00:30'],
    //     ];
    // }

    // public function getPost($id)
    // {
    //     $posts = $this->getPosts();
    //     foreach ($posts as $post) {
    //         if ($post['id'] == $id) {
    //             return $post;
    //         }
    //     }
    //     return null;
    // }
}

  


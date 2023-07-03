<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(){
        
        $comments =Comment::all();
        return response()->json([
            'success' => true,
            'data' => $comments,
        ]);
        
    }
    public function store(Request $request ,$id){
        $request->validate([
            'comment'=>['required' ,'min:10'],
        ]);
        
        $post = Post::findOrFail($id);
        $comments =new Comment([
            'comment' => $request->input('comment'),
            'user_id' => Auth::id(),
            'post_id' => $post->id
        ]);
        $comments->save();
        
        return response()->json([
            'success' => true,
            'data' => $comments,
        ]);
        
    }
}
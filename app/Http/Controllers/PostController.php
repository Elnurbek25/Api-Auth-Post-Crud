<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->get();
        return response()->json($posts);
    }
    public function store(StorePostRequest $request)
    {   
        $user=auth()->user();
        $post=$user->create([
            'title'=>$request->title,
            'content'=>$request->content,
        ]);
            return response()->json($post,201); 
    }
    public function show(string $id)
    {
        $post=Post::findOrFail($id);
        return response()->json($post);
    }
    public function update(UpdatePostRequest $request, string $id)
    {
        $post=Post::findOrFail($id);
        $post->update([
            'title'=>$request->title,
            'content'=>$request->content,
        ]);
        return response()->json($post);
        
    }
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json([
            'message'=>'Sizning Postingiz muaffaqqiyatli o`chirildi'
        ]);
    }
   
}

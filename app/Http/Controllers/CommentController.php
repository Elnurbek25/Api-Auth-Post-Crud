<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
  
public function addComment(StoreCommentRequest $request){

    $comment = auth()->user()->comments()->create([
        'body' => $request->body,
        'post_id' => $request->post_id,
    ]);
    return response()->json($comment,2011);

}

public function deleteComment($id){
    $comment=Comment::findOrFail($id);
    $comment->delete();
    return response()->json([
        'message'=>'commment ochirildi' 
    ]);
}




    
}

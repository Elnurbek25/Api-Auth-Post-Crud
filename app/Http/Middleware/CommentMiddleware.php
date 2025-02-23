<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CommentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $comment = Comment::findOrFail($request->route('comment'));

        if (Auth::user()->id !== $comment->user_id) {
            return response()->json(['message' => 'Siz bu izohni o\'chira olmaysiz.'], 403); // Forbidden if not the owner
        }

        return $next($request);
    }
}

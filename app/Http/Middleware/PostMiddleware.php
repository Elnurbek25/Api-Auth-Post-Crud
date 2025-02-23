<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PostMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $post = Post::findOrFail($request->route('post'));  
        if (Auth::user()->id !== $post->user_id) {
            return response()->json(['message' => 'Bu Postni boshqaro olmaysiz'], 403); 
        }

        return $next($request); 
    }
}

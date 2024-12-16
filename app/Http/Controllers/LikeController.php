<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like($blogId)
    {
        $blog = Blog::findOrFail($blogId);
        $user = Auth::user();


        $existingLike = Like::where('user_id', $user->id)
            ->where('blog_id', $blog->id)
            ->first();

        if ($existingLike) {

            $existingLike->delete();
            $blog->decrement('likes_count');
        } else {

            Like::create([
                'user_id' => $user->id,
                'blog_id' => $blog->id,
            ]);
            $blog->increment('likes_count');
        }


        return response()->json([
            'likes' => $blog->likes_count,
        ]);
    }
}

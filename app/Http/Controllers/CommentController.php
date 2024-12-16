<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $blogId)
    {

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $blog = Blog::findOrFail($blogId);


        Comment::create([
            'user_id' => Auth::id(),
            'blog_id' => $blog->id,
            'message' => $request->message,
        ]);

        $blog->increment('comments_count');

        return response()->json([
            'success' => true,
            'message' => 'Comment added successfully!',
            'comments_count' => $blog->comments_count,
        ]);
    }

}

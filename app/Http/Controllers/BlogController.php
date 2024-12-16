<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('user')->get();
        return view('user.showPost', compact('blogs'));
    }

    public function addBlog()
    {
        return view('user.add-blogs');
    }

    public function create(BlogRequest $request)
    {
        $user = User::find(Auth::id());

        // Handle image deletion and upload
        $old_picture_path = 'template/img/profile-photo/' . $user->picture;
        if ($user->picture && File::exists(public_path($old_picture_path))) {
            unlink(public_path($old_picture_path));
        }

        $new_file_name = "USER-" . microtime(true) . "." . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('template/img/blogs'), $new_file_name);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'image' => $new_file_name,
            'user_id' => $user->id,
            'category' => $request->category,
        ];

        if (Blog::create($data)) {
            return back()->with(['success' => 'Blog post has been created']);
        } else {
            return back()->with(['error' => 'Something went wrong, please try again']);
        }
    }

    public function myBlogs()
    {
        $blogs = Blog::where('user_id', auth()->id())->get();
        return view('user.edit-blogs', compact('blogs'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($blog->update($validated)) {
            return back()->with(['success' => 'MAGIC HAS BEEN SPELLED']);
        } else {
            return back()->with(['error' => 'Something went wrong, please try again']);
        }
    }

    public function destroy($blogId, $commentId)
    {
        // Find the comment associated with the given blogId and commentId
        $comment = Comment::where('id', $commentId)->where('blog_id', $blogId)->first();

        // If the comment doesn't exist, redirect back with an error
        if (!$comment) {
            return back()->with('error', 'Comment not found');
        }

        // Attempt to delete the comment
        if ($comment->delete()) {
            return back()->with('success', 'Comment deleted successfully');
        } else {
            return back()->with('error', 'Failed to delete the comment');
        }
    }

    public function filterByCategory($category)
    {
        $blogs = Blog::where('category', $category)->with('user')->get();
        return view('user.index', compact('blogs'));
    }

    public function blogDetail($id)
    {
        $blog = Blog::with('user')->findOrFail($id);
        $comments = Comment::where('blog_id', $id)->get();
        return view('user.detail-blog', compact('blog', 'comments'));
    }
}

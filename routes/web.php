<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('auth.register');
});

Route::middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::patch('/update-picture', [ProfileController::class, 'picture'])->name('picture-update');





    Route::controller(BlogController::class)->group(function () {
        Route::get('/showPost', 'index')->name('post.show');
        Route::get('/addBlog', 'addBlog')->name('blog.add');
        Route::post('/createPost', 'create')->name('post.create');
        Route::get('/blogDetail/{id}', 'blogDetail')->name('blog.detail');
        Route::get('myBlogs','myBlogs')->name('blogs.edit');
        Route::put('/blogs/{blog}', 'update')->name('blogs.update');
        Route::delete('/blogs/{blog}','destroy')->name('blogs.destroy');
        Route::get('/category/{category}', 'filterByCategory')->name('category.blogs');

    });

    Route::controller(HomeController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });


    Route::post('/blogs/{blogId}/comment', [CommentController::class, 'store'])->name('comment.create');
    Route::delete('/blogs/{blogId}/comments/{commentId}', [BlogController::class, 'destroy'])->name('comments.destroy');



    Route::post('/blogs/{blog}/like', [LikeController::class, 'like'])->name('blogs.like');
});


require __DIR__ . '/auth.php';

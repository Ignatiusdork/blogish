<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    return view('posts', [
        'posts' => Post::all()
    ]);
});

// using wildcards to navigate to different pages
Route::get('posts/{post:slug}', function (Post $post) {

    //find a post by its slug and pass it to a view called "post"
    //$post = Post::findOrFail($post);

    return view('post', [
        'post' => $post
    ]);
});

<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;

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
Route::get('posts/{post}', function ($slug) {

    //find a post by its slug and pass it to a view called "post"

    return view('post', [
        'post' => Post::find($slug)
    ]);

})->where('post', '[A-z_\-]+');
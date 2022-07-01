<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\ProfileController;

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
    return view('toppage');
})->name('toppage');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

//問合せ
Route::controller(ContactFormController::class)->group(function(){
    // Route::get('contact/index', 'index')->name('contact.index');
    Route::get('contact/create', 'create')->name('contact.create')->middleware('guest');
    Route::post('contact/store', 'store')->name('contact.store')->middleware('guest');
});

//
Route::middleware(['verified'])->group(function(){
    //自分の投稿,コメント
    Route::get('post/mypost', [PostController::class, 'mypost'])->name('post.mypost');
    Route::get('post/mycomment', [PostController::class, 'mycomment'])->name('post.mycomment');
    //投稿
    Route::resource('post', PostController::class);
    //コメント
    Route::resource('comment', CommentController::class);
    
    //ユーザー一覧(管理者用画面)
    Route::middleware(['can:admin'])->group(function(){
        Route::get('profile.index', [ProfileController::class, 'index'])->name('profile.index');
    });
});
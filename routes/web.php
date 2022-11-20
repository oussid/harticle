<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\ReadLaterController;

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

// add to read later
Route::post('/articles/read_later', [ReadLaterController::class, 'store'])->name('readlater.store')->middleware('auth');
// remove from read later
Route::delete('/articles/read_later/{article_id}', [ReadLaterController::class, 'destroy'])->name('readlater.destroy')->middleware('auth');
// show read later articles
Route::get('/articles/read_later', [ReadLaterController::class, 'index'])->name('readlater.index')->middleware('auth');

// home page
Route::get('/', [ArticleController::class, 'index']);
// show form to add new article
Route::get('/articles/create', [ArticleController::class, 'create'])->name('article.create')->middleware('auth');
// store the article in the database 
Route::post('/articles', [ArticleController::class, 'store'])->name('article.store')->middleware('auth');
// article details page
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('article.show');
// show form to edit article
Route::get('/articles/edit/{id}', [ArticleController::class, 'edit'])->name('article.edit')->middleware('auth');
// update form details
Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('article.update')->middleware('auth');
// read article
Route::post('/articles/read/{id}', [ReadController::class, 'store'])->middleware('auth');
// delete article
Route::delete('/articles/{id}', [ArticleController::class, 'delete'])->name('article.delete')->middleware('auth');


// register page
Route::get('/register', [UserController::class, 'create'])->name('user.create')->middleware('guest');
// add user to db
Route::post('/register', [UserController::class, 'store'])->name('user.store')->middleware('guest');
// login page
Route::get('/login', [UserController::class, 'login'])->name('user.login')->middleware('guest');
// authenticate user
Route::post('/login', [UserController::class, 'authenticate'])->name('user.authenticate')->middleware('guest');
// logout user
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout')->middleware('auth');
// user profile
Route::get('/profile/{id}', [UserController::class, 'profile'])->name('user.profile');

// create follower (follow)
Route::post('/follow/{id}', [UserController::class, 'follow'])->name('user.follow')->middleware('auth');
// remove follower (unfollow)
Route::delete('/unfollow/{id}', [UserController::class, 'unfollow'])->name('user.unfollow')->middleware('auth');

// create like (like an article)
Route::post('/like/{id}', [LikeController::class, 'store'])->name('like.store')->middleware('auth');
// remove like (unlike an article)
Route::delete('/unlike/{id}', [LikeController::class, 'destroy'])->name('like.destroy')->middleware('auth');

// create comment
Route::post('/comment/{id}', [CommentController::class, 'store'])->name('comment.store')->middleware('auth');

// create a reply
Route::post('/reply/{id}', [ReplyController::class, 'store'])->name('reply.store')->middleware('auth');


<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\OfflineController;
use App\Http\Controllers\OnlineController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Redirect::route('login');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/search/{nick_name}', [SearchController::class,'search'])->name('search');

    //posts
    Route::post('/create-post', [PostController::class,'createPost'])->name('create-post');
    Route::get('/list-posts', [PostController::class,'getPosts'])->name('list-post');
    Route::post('/like-post', [PostController::class,'likeOrDislike'])->name('like-post');
    Route::post('/comment', [PostController::class,'comment'])->name('comment');
    
    //profile
    Route::get('/profile/{nick_name}', [ProfileController::class,'index'])->name('profile');
    
    //Chats
    Route::get('/chats', [ChatController::class,'index'])->name('chats');
    Route::get('/user/chat/{nick_name}', [SearchController::class,'usersIFollow'])->name('usersIFollow');
    Route::get('/user-chat/{id}', [ChatController::class,'getChat'])->name('get-chat');
    Route::get('/new-chat/{id}', [ChatController::class,'createChatIfNotExists'])->name('get-new-chat');
    Route::post('/chat/send-message', [ChatController::class,'sendMessage'])->name('send-message');
    Route::post('/send-file', [ChatController::class,'sendFile'])->name('send-file');
    Route::get('/direct-message/{id}', [ChatController::class,'directMessage'])->name('direct-message');
    
    //offline and online
    Route::post('/online/{id}', OnlineController::class)->name('online');
    Route::post('/offline/{id}', OfflineController::class)->name('offline');
    
    //follow
    Route::post('/follow-user', [ProfileController::class,'followUser'])->name('follow-user');
    Route::post('/unfollow-user', [ProfileController::class,'unFollow'])->name('unfollow-user');
    Route::get('/exists-follow/{user_id}', [ProfileController::class,'existsFollow'])->name('exists-follow');
    Route::post('/markAsRead', [ProfileController::class,'markAsRead'])->name('markAsRead');
});

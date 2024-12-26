<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookSwapController;
use App\Http\Controllers\SwapRequestController;
use App\Http\Controllers\MessageController;
use Symfony\Component\Mime\Message;



// HOME C.
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// PROFILE C.
Route::get('/profile', [ProfileController::class, 'profileIndex'])->name('profile');
Route::get('/profile/kitaplar', [ProfileController::class, 'profileKitaplar'])->name('kitaplar');

// BOOKS C.
Route::post('/profile/kitaplar', [BookController::class, 'store'])->name('books.store');
Route::post('/books/increase-view', [BookController::class, 'increaseViewCount'])->name('books.increaseView');
Route::post('/books/swap/{id}', [BookController::class, 'swappedCount'])->name('books.swap');

// LOGIN C.
Route::get('/login', [LoginController::class, 'loginView'])->name('loginView');
Route::post('/', [LoginController::class, 'login'])->name('login');
Route::get('/get', [LoginController::class, 'logout'])->name('logout');
Route::get('/signUp', [LoginController::class, 'signIn'])->name('signin');
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::get('/forgot-password', [LoginController::class, 'forgotPassword'])->name('forgotpassword');

// USER C.
Route::post('/password/custom/email', [UserController::class, 'sendPasswordResetLink'])->name('password.custom.email');
Route::get('/password/custom/reset', [UserController::class, 'showResetForm'])->name('password.custom.reset.form');
Route::post('/password/custom/reset', [UserController::class, 'resetPassword'])->name('password.custom.reset');
Route::put('/user/update/image/{id}', [UserController::class, 'updateImage'])->name('user.update.image');
Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::put('/user/extra/update/{id}', [UserController::class, 'updateExtra'])->name('user.extra.update');


// MESSAGE C:
Route::post('/send-message', [MessageController::class, 'sendMessage'])->middleware('auth');
Route::get('/fetch-message/{receiverId}', [MessageController::class, 'fetchMessages'])->middleware('auth');
Route::get('/messages', [MessageController::class, 'index'])->name('mesajlar');
Route::post('/save-user-session', [MessageController::class, 'saveUserSession']);


// BOOK SW. C   .
Route::post('/swap-request', [BookSwapController::class, 'store'])->name('swap.request');
Route::get('/profile/istekler', [BookSwapController::class, 'requests'])->name('istekler');


Route::post('/requests/accept/{id}', [SwapRequestController::class, 'accept'])->name('requests.accept');
Route::post('/requests/reject/{id}', [SwapRequestController::class, 'reject'])->name('requests.reject');
Route::delete('/delete-request/{id}', [SwapRequestController::class, 'deleteRequest'])->name('delete.request');



Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/contact', [ContactController::class, 'contact'])->name('contact');

Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

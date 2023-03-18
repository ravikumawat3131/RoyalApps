<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
})->name('/');

Route::get('/home', function () {
    return view('welcome');
})->name('/home');

Auth::routes();

Route::post('/userlogin', [App\Http\Controllers\HomeController::class, 'userlogin'])->name('userlogin');

Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');

Route::get('/user-logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('user-logout');

Route::get('/authors', [App\Http\Controllers\HomeController::class, 'authors'])->name('authors');

Route::get('/author/view/{id}', [App\Http\Controllers\HomeController::class, 'author_view'])->name('author.view');

Route::get('/author/delete/{id}', [App\Http\Controllers\HomeController::class, 'author_delete'])->name('author.delete');

Route::get('/book/delete/{id}', [App\Http\Controllers\HomeController::class, 'book_delete'])->name('book.delete');

Route::get('/book/create', [App\Http\Controllers\HomeController::class, 'book_create'])->name('book.create');

Route::post('/book/store', [App\Http\Controllers\HomeController::class, 'book_store'])->name('book.store');

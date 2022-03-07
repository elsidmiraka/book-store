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

Route::get('/', [App\Http\Controllers\DisplayController::class, 'index'])->name('index');
Route::get('/author-details/{id}', [App\Http\Controllers\DisplayController::class, 'author_details'])->name('author.details');
Route::get('/book-details/{id}', [App\Http\Controllers\DisplayController::class, 'book_details'])->name('book.details');

//remove ability to register
Auth::routes(['register' => false]);

Route::get('/authors', [App\Http\Controllers\HomeController::class, 'index'])->name('authors.index');
Route::post('/create-author', [App\Http\Controllers\HomeController::class, 'create_author'])->name('author.save');
Route::get('/edit-author/{id}', [App\Http\Controllers\HomeController::class, 'edit_author'])->name('author.edit');
Route::post('/edit-author/{id}', [App\Http\Controllers\HomeController::class, 'update_author'])->name('author.update');
Route::get('/books', [App\Http\Controllers\HomeController::class, 'books'])->name('books.index');
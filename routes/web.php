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

//remove ability to register
Auth::routes(['register' => false]);

Route::controller(App\Http\Controllers\AuthorController::class)->group(function () {
    Route::get('/authors', 'index')->name('authors.index');

    Route::name('author.')->group(function() {
        Route::get('/author-details/{id}', 'author_details')->name('details');
        Route::post('/create-author', 'create_author')->name('save');
        Route::get('/edit-author/{id}', 'edit_author')->name('edit');
        Route::post('/edit-author/{id}', 'update_author')->name('update');

        Route::delete('/author/{id}/delete', 'destroy')->name('delete');
        Route::post('/author/{id}/restore', 'restore')->name('restore');
        Route::post('/author/{id}/force_delete', 'forceDelete')->name('force_delete');
    });
});

Route::controller(App\Http\Controllers\BookController::class)->group(function () {
    Route::get('/books', 'index')->name('books.index');

    Route::name('book.')->group(function() {
        Route::get('/book-details/{id}', 'book_details')->name('details');
        Route::post('/create-book', 'create_book')->name('save');
        Route::get('/edit-book/{id}', 'edit_book')->name('edit');
        Route::post('/edit-book/{id}', 'update_book')->name('update');

        Route::delete('/book/{id}/delete', 'destroy')->name('delete');
        Route::post('/book/{id}/restore', 'restore')->name('restore');
        Route::post('/book/{id}/force_delete', 'forceDelete')->name('force_delete');
    });
});
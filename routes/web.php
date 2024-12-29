<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\BookController;

Route::resource('books', BookController::class);



Route::get('/', [BookController::class, 'index']);


Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::get('/books/{book_id}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::get('/books/{book_id}', [BookController::class, 'show'])->name('books.show');
Route::get('/rentallist', [BookController::class, 'rentallist'])->name('rentallist');


use App\Http\Controllers\BookRentalController;

Route::get('/books/{book}/rent', [BookRentalController::class, 'create'])->name('books.rent');
Route::post('/books/rent/store', [BookRentalController::class, 'store'])->name('books.rent.store');


Route::delete('/rentals/{rental}', [BookRentalController::class, 'destroy'])->name('rentals.destroy');

use App\Http\Controllers\MemberController;

Route::get('/members', [MemberController::class, 'index'])->name('members.index');
Route::get('/members/create', [MemberController::class, 'create'])->name('members.create');
Route::post('/members', [MemberController::class, 'store'])->name('members.store');


use App\Http\Controllers\CategoryController;

Route::resource('categories', CategoryController::class);

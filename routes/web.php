<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InsertController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/forms', [InsertController::class, 'showData']);


Route::delete('/delete/{id}', [InsertController::class, 'destroy'])->name('delete.post');
Route::get('/search', [InsertController::class, 'search'])->name('search');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/edit', [InsertController::class, 'showInsertForm']);
    Route::post('/edit', [InsertController::class, 'storeInsert']);
    Route::post('/comments/{ID}', [InsertController::class, 'addComment']);

    Route::get('comments/{ID}', [InsertController::class, 'show']);
    Route::get('comments/{ID}', [InsertController::class, 'shoComent']);
    Route::get('comments/{ID}', [InsertController::class, 'showComments']);
    Route::get('comments/{ID}', [InsertController::class, 'show'])->name('comments.show');
    Route::post('/comments/{id}/add', [InsertController::class, 'addComment']);
    Route::delete('/comments/{id}/delete', [InsertController::class, 'deleteComment'])->name('delete.comment');
});

require __DIR__ . '/auth.php';

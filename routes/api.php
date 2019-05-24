<?php

use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BooksController;

Route::prefix('/books')->group(function() {
    Route::get('', [BooksController::class, 'index']);
    Route::post('', [BooksController::class, 'store']);
    Route::get('stat', [BooksController::class, 'stat']);
    Route::get('{book}', [BooksController::class, 'show']);
    Route::patch('{book}', [BooksController::class, 'update']);
    Route::delete('{book}', [BooksController::class, 'destroy']);
});

Route::prefix('/authors')->group(function() {
    Route::get('', [AuthorsController::class, 'index']);
    Route::post('', [AuthorsController::class, 'store']);
    Route::get('{author}', [AuthorsController::class, 'show']);
    Route::patch('{author}', [AuthorsController::class, 'update']);
    Route::delete('{author}', [AuthorsController::class, 'destroy']);
});

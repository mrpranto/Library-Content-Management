<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookShelveController;
use Illuminate\Support\Facades\Route;

Route::middleware(['x-auth'])->group(function () {

    /*
     * Bookshelf Api Routes.
     * */
    Route::apiResource('bookshelves', BookShelveController::class);

    /*
     * Book Api Routes.
     *
     * */

    Route::apiResource('books', BookController::class);
});

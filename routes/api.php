<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookShelveController;
use App\Http\Controllers\ChapterController;
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

    /*
     * Chapter Api Routes.
     *
     * */

    Route::apiResource('chapters', ChapterController::class);
});

<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookShelveController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\PageController;
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
    Route::get('search-books', [BookController::class, 'searchBooks']);

    /*
     * Chapter Api Routes.
     *
     * */

    Route::apiResource('chapters', ChapterController::class);
    Route::get('chapters-page-content', [ChapterController::class, 'chapterPageContent']);

    /*
    * Pages Api Routes.
    *
    * */

    Route::apiResource('pages', PageController::class);
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware(['x-auth'])->group(function () {
    Route::get('/get-data', function (){
        return 'Hello World';
    });
});

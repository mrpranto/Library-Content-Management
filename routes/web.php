<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the Library Content Management api'
    ]);
});

Route::view('/api-docs', 'api_docs.api_doc');

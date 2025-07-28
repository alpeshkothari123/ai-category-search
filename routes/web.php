<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/search', [\App\Http\Controllers\SearchController::class, 'index']);
Route::post('/search', [\App\Http\Controllers\SearchController::class, 'search'])->name('search');

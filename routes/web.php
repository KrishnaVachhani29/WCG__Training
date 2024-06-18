<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::controller(PostController::class)->group(function () {
    Route::get('posts', 'index');
    Route::post('posts', 'store')->name('posts.store');
    Route::post('posts/{id}', 'update')->name('posts.update');
    Route::get('posts/delete/{id}', 'destroy')->name('posts.delete');
    Route::get('posts/search', 'search')->name('posts.search');
    Route::get('posts/{id}/edit', 'edit')->name('posts.edit');
});

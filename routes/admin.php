<?php

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::resources([
    'authors' => AuthorController::class,
    'books' => BookController::class,
    'categories' => CategoryController::class,
    'publishers' => PublisherController::class,
    'users' => UserController::class,
]);

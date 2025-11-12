<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::resources([
    'users' => UserController::class,
    'books' => BookController::class,
]);

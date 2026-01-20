<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('User.Main');
});
Route::get('login',[UserController::class, 'loginPage']) -> name('login');

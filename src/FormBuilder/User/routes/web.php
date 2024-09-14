<?php

use Illuminate\Support\Facades\Route;
use FormBuilder\User\Http\Controllers\AuthController;
use FormBuilder\User\Http\Controllers\AccountController;

Route::post('login', [AuthController::class, 'loginStore'])
    ->name('login.store')
    ->middleware('guest');

Route::get('logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('dashboard/account', [AccountController::class, 'index'])
        ->name('dashboard.account');

    Route::put('dashboard/account', [AccountController::class, 'update'])
        ->name('dashboard.account.update');
});

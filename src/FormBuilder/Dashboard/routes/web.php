<?php

use Illuminate\Support\Facades\Route;
use FormBuilder\Dashboard\Http\Controllers\DashboardController;
use FormBuilder\Form\Http\Controllers\FormController;
use FormBuilder\Dashboard\Http\Controllers\HomepageController;

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [HomepageController::class, 'index'])
        ->name('homepage');
});

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
});

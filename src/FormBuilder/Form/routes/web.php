<?php

use Illuminate\Support\Facades\Route;
use FormBuilder\Form\Http\Controllers\FormController;

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('dashboard/forms', [FormController::class, 'index'])
        ->name('forms.index');

    Route::get('dashboard/forms/create', [FormController::class, 'create'])
        ->name('forms.create');

    Route::post('dashboard/forms/create', [FormController::class, 'store'])
        ->name('forms.create.store');

    Route::get('dashboard/forms/{form}', [FormController::class, 'edit'])
        ->name('forms.edit');

    Route::put('dashboard/forms/{form}', [FormController::class, 'update']);
});

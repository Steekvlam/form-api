<?php

use FormBuilder\Form\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

Route::get('/forms/{form}', [FormController::class, 'single']);

Route::post('/forms/{form}', [FormController::class, 'post']);

<?php

use App\Http\Controllers\User\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::post('/user/register', [RegistrationController::class, 'register'])
    ->middleware('guest');

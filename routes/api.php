<?php

use App\Http\Controllers\User\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/user/register', [AuthController::class, 'register'])
    ->middleware('guest');

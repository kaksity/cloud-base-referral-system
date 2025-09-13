<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

require __DIR__.'/auth.php';

// Route::prefix('system-admin')->group(__DIR__.'/Web/SystemAdmin/index.php');

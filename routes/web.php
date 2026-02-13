<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ValentineController;
Route::get('/', function () {
    return view('welcome');
});



Route::get('/valentine', [ValentineController::class, 'index']);
Route::get('/valentine/yes', [ValentineController::class, 'showLetter'])->name('valentine.yes');
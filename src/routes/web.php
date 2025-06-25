<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    GameController,
    MagicLinkController,
    RegisterController
};

Route::view('/', 'welcome');

Route::prefix('register')->controller(RegisterController::class)->group(function () {
    Route::get('/', 'showForm')->name('register.form');
    Route::post('/', 'register')->name('register.submit');
});

Route::prefix('magic-link/{token}')->controller(MagicLinkController::class)->group(function () {
    Route::get('/', 'show')->name('magic.link');
    Route::post('generate', 'generateUniqueUrl')->name('magic.link.generate');
    Route::get('/deactivate', 'deactivateUniqueLink')->name('magic.link.deactivate');
});

Route::prefix('magic/{token}')->controller(GameController::class)->group(function () {
    Route::post('lucky', 'start')->name('game.start');
    Route::get('history', 'history')->name('game.history');
});

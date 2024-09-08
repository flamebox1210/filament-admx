<?php

use App\Http\Controllers\Be\LanguageController as BeLangController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('fe.index');
});

Route::get('/admin/locale/{locale}', [BeLangController::class, 'switch'])
    ->name('filament.admin.language.switch');

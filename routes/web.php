<?php

use App\Http\Controllers\LanguageController;
use App\Http\Middleware\SetLocale;
use App\Livewire\Article;
use App\Livewire\Index;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'web'], function () {
    Route::get('/locale/{locale}', [LanguageController::class, 'index'])->name('fe.locale');
    Route::get('/', Index::class)->name('fe.index');
    Route::get('/{slug}', Index::class)->name('fe.page');
    Route::get('/{parent}/{slug}', Article::class)->name('fe.article');
})->middleware(SetLocale::class);

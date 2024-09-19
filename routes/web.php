<?php

use App\Http\Controllers\LanguageController;
use App\Livewire\Article;
use App\Livewire\Index;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'web'], function () {
    // Route::get('/locale/{locale}', [LanguageController::class, 'index'])->name('fe.locale');
    Route::get('/', Index::class)->name('fe.index');
    Route::get('/{slug}', Index::class)->name('fe.page');
    Route::get('/{slug}/{articleSlug}', Article::class)->name('fe.article');

});

/*Route::get('/admin/locale/{locale}', [BeLangController::class, 'switch'])
    ->name('filament.admin.language.switch');*/

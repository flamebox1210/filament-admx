<?php

use App\Http\Controllers\Be\LanguageController as BeLangController;
use App\Livewire\Index;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('fe.index');

Route::get('/admin/locale/{locale}', [BeLangController::class, 'switch'])
    ->name('filament.admin.language.switch');

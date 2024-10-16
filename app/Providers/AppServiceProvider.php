<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Notifications\Livewire\Notifications;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\VerticalAlignment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        Filament::registerNavigationGroups([
            'Navigations',
            'Pages',
            'Article Management',
            'Partner Management',
            'Data Management',
            'User Management',
        ]);
        Notifications::alignment(Alignment::Center);
        Notifications::verticalAlignment(VerticalAlignment::Start);
    }
}

<?php

namespace App\Providers\Filament;

use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use App\Filament\Resources\CustomMediaResource;
use Awcodes\Curator\CuratorPlugin;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Enums\ThemeMode;
use Filament\FontProviders\GoogleFontProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Njxqlus\FilamentProgressbar\FilamentProgressbarPlugin;
use Rmsramos\Activitylog\ActivitylogPlugin;


class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('administrator')
            ->defaultThemeMode(ThemeMode::Light)
            ->favicon(asset('favicon.svg'))
            ->brandName('Admin Panel')
            ->brandLogo(asset('logo.svg'))
            ->darkModeBrandLogo(asset('logo-dark.svg'))
            ->brandLogoHeight('2rem')
            ->login()
            //->passwordReset()
            //->topNavigation()
            ->sidebarCollapsibleOnDesktop(true)
            ->topbar(true)
            ->profile(isSimple: false)
            ->font('Mulish', provider: GoogleFontProvider::class)
            ->viteTheme('resources/scss/app.scss')
            ->colors([
                'primary' => Color::Blue,
                'gray' => Color::Gray,
                'info' => Color::Sky,
                'success' => Color::Emerald,
                'warning' => Color::Yellow,
                'danger' => Color::Red,
            ])
            ->databaseNotifications()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            /*
            * custom menu
            */
            ->userMenuItems([
                'profile' => MenuItem::make()->label('Edit profile'),
                /* 'language' => MenuItem::make()
                     ->label('Switch language')
                     ->url(fn(): string => route('filament.admin.language.switch',
                         session('locale') ? session('locale') : 'en'
                     )),*/
            ])
            /* ->userMenuItems([
                 MenuItem::make()
                     ->label('Users')
                     ->url('/admin/users')
                     ->icon('heroicon-o-users'),
             ])*/
            /*
            * plugins
            */
            ->plugins([
                FilamentProgressbarPlugin::make()->color('#CA8A04'),
                FilamentShieldPlugin::make()->gridColumns([
                    'default' => 1,
                    'sm' => 2,
                    'lg' => 2
                ])
                    ->sectionColumnSpan(1)
                    ->checkboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                        'lg' => 2,
                    ])
                    ->resourceCheckboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                    ]),
                SpatieLaravelTranslatablePlugin::make()->defaultLocales(config('app.locales')),
                ActivitylogPlugin::make()
                    ->navigationGroup('User Management')
                    ->navigationIcon('heroicon-o-clock')
                    ->navigationSort(3),
                CuratorPlugin::make()
                    ->label('Asset')
                    ->pluralLabel('Assets')
                    ->navigationIcon('heroicon-o-photo')
                    ->navigationGroup('Data Management')
                    ->navigationLabel('Assets')
                    ->defaultListView('grid')
                    ->navigationCountBadge()
            ]);
    }
}

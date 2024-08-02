<?php

namespace App\Providers\Filament;

use App\Filament\Pages\CustomDashboard;
use App\Filament\Pages\MyLogin;
use App\Filament\Pages\Welcome;
use App\Filament\Resources\ConfigResource;
use App\Filament\Resources\DataSecurityGuardShiftResource;
use Filament\FontProviders\GoogleFontProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Hasnayeen\Themes\Http\Middleware\SetTheme;
use Hasnayeen\Themes\ThemesPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Shanerbaner82\PanelRoles\PanelRoles;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(MyLogin::class)
            ->passwordReset()
            ->unsavedChangesAlerts()
            ->brandLogo(asset('imagenes/chekeo/logo_ligth.svg'))
            ->favicon(asset('imagenes/chekeo/icon16.svg'))
            ->darkModeBrandLogo(asset('imagenes/chekeo/logo_dark.svg'))
            ->brandLogoHeight('5rem')
            ->font('Poppins', provider: GoogleFontProvider::class)
            //->colors([
            //    'primary' => Color::Amber,
            //    'info' => Color::Blue,
            //    'danger' => Color::Rose,
            //    'gray' => Color::Gray,
            //    'success' => Color::Emerald,
            //    'warning' => Color::Orange,
            //])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            //->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Welcome::class,
                CustomDashboard::class,
            ])
            ->navigationGroups([
                __('general.menu.security'),
                __('general.menu.my_organization'),
                __('general.menu.settings'),
            ])
            //->topNavigation()
            //->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])
            ->profile()
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
            ->spa()
            ->plugins([
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
                ThemesPlugin::make(),
                \Awcodes\Curator\CuratorPlugin::make()
                ->label('Media')
                ->pluralLabel('Media')
                ->navigationIcon('heroicon-o-photo')
                ->navigationGroup('Content')
                ->navigationSort(3)
                ->navigationCountBadge()
                ->registerNavigation(false)
                ->defaultListView('grid' || 'list')
                ->resource(CustomMediaResource::class),
                PanelRoles::make()
                    ->roleToAssign('super_admin')
                    ->restrictedRoles(['super_admin']),

            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->middleware([
                SetTheme::class
            ])
            ->databaseNotifications()
            ->sidebarCollapsibleOnDesktop()
            ->sidebarFullyCollapsibleOnDesktop();
    }
}

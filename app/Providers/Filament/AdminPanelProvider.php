<?php

namespace App\Providers\Filament;

use App\Filament\Pages\MyLogin;
use App\Filament\Pages\Welcome;
use App\Filament\Resources\BrancheResource;
use App\Filament\Resources\CalendarGuardResource;
use App\Filament\Resources\CalendarResource;
use App\Filament\Resources\ConfigResource;
use App\Filament\Resources\DataSecurityGuardShiftResource;
use App\Filament\Resources\DepartmentResource;
use App\Filament\Resources\EmployeeResource;
use App\Filament\Resources\EnterpriseResource;
use App\Filament\Resources\SecurityGuardShiftResource;
use App\Filament\Resources\Shield\RoleResource;
use App\Filament\Resources\UserResource;
use App\Models\CalendarGuard;
use App\Policies\CalendarPolicy;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Auth;
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
            ->font('Playwrite DE Grund')
            ->colors([
                'primary' => Color::Indigo,
                'info' => Color::Blue,
                'danger' => Color::Rose,
                'gray' => Color::Gray,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            //->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Welcome::class,
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
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
            ->plugins([
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
                PanelRoles::make()
                    ->roleToAssign('super_admin')
                    ->restrictedRoles(['super_admin']),
            ])
            ->authMiddleware([
                Authenticate::class,
            ])

            ->sidebarCollapsibleOnDesktop()
            ->sidebarFullyCollapsibleOnDesktop();
    }
}

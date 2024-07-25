<?php

namespace App\Providers\Filament;

use App\Filament\Resources\BrancheResource;
use App\Filament\Resources\CalendarResource;
use App\Filament\Resources\ConfigResource;
use App\Filament\Resources\DepartmentResource;
use App\Filament\Resources\EnterpriseResource;
use App\Filament\Resources\SecurityGuardShiftResource;
use App\Filament\Resources\Shield\RoleResource;
use App\Filament\Resources\UserResource;
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
            ->login()
            ->brandLogo(asset('imagenes/chekeo/logo_ligth.svg'))
            ->favicon(asset('imagenes/chekeo/icon16.svg'))
            ->darkModeBrandLogo(asset('imagenes/chekeo/logo_dark.svg'))
            ->brandLogoHeight('5rem')
            ->font('Playwrite DE Grund')
            ->colors([
                'primary' => Color::Blue,
                'second' => Color::Red,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
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
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder->groups([
                    NavigationGroup::make(__('general.menu.security'))
                        ->items([
                            NavigationItem::make(__('general.turn'))
                                ->icon('heroicon-o-shield-check')
                                ->isActiveWhen(fn (): bool => request()->routeIs('filament.admin.resources.security-guard-shifts.*'))
                                ->url(fn (): string => SecurityGuardShiftResource::getUrl()),
                        ]),
                    NavigationGroup::make(__('general.menu.my_organization'))
                        ->items([
                            NavigationItem::make(__('general.branches'))
                                ->icon('heroicon-o-building-office-2')
                                ->isActiveWhen(fn (): bool => request()->routeIs('filament.admin.resources.branches.*'))
                                ->url(fn (): string => BrancheResource::getUrl()),
                            NavigationItem::make(__('general.departments'))
                                ->icon('heroicon-o-cube-transparent')
                                ->isActiveWhen(fn (): bool => request()->routeIs('filament.admin.resources.departments.*'))
                                ->url(fn (): string => DepartmentResource::getUrl()),
                            NavigationItem::make(__('general.calendars'))
                                ->icon('heroicon-o-calendar-days')
                                ->isActiveWhen(fn (): bool => request()->routeIs('filament.admin.resources.calendars.*'))
                                ->url(fn (): string => CalendarResource::getUrl()),
                        ]),
                    NavigationGroup::make(__('general.menu.settings'))
                        ->items([
                            NavigationItem::make(__('general.enterprise'))
                                ->icon('heroicon-o-building-office')
                                ->isActiveWhen(fn (): bool => request()->routeIs('filament.admin.resources.enterprises.*'))
                                ->url(fn (): string => EnterpriseResource::getUrl()),
                            NavigationItem::make(__('general.users'))
                                ->icon('heroicon-o-users')
                                ->isActiveWhen(fn (): bool => request()->routeIs('filament.admin.resources.users.*'))
                                ->url(fn (): string => UserResource::getUrl()),
                            NavigationItem::make('Roles')
                                ->icon('heroicon-o-shield-check')
                                ->isActiveWhen(fn (): bool => request()->routeIs('filament.admin.resources.shield.roles.*'))
                                ->url(fn (): string => RoleResource::getUrl()),
                            //...RoleResource::getNavigationItems(),
                            ]),
                ])
                    ->items([
                        NavigationItem::make(__('general.menu.welcome'))
                            ->icon('heroicon-o-home')
                            ->isActiveWhen(fn (): bool => request()->routeIs('filament.admin.pages.dashboard'))
                            ->url(fn (): string => Dashboard::getUrl()),
                        NavigationItem::make(__('general.menu.control_panel'))
                            ->icon('heroicon-o-chart-bar-square')
                            ->isActiveWhen(fn (): bool => request()->routeIs('filament.admin.pages.dashboard'))
                            ->url(fn (): string => Dashboard::getUrl()),
                    ]);
            })

            ->sidebarCollapsibleOnDesktop()
            ->sidebarFullyCollapsibleOnDesktop();
    }
}

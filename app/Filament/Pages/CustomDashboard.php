<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard;
use Filament\Pages\Page;

class CustomDashboard extends Dashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';
    //protected static string $view = 'filament.pages.custom-dashboard';
    protected static ?int $navigationSort = 2;
    protected static ?string $recordTitleAttribute = 'name';
    public static function getModelLabel(): string
    {
        return __('general.dashboard');
    }
    public static function getPluralModelLabel(): string
    {
        return __('general.dashboards');
    }
    public static function getNavigationLabel(): string
    {
        return __('general.dashboards');
    }
}

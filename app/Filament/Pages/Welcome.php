<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class Welcome extends Page
{
    use HasPageShield;

    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.welcome';

    public static function getModelLabel(): string
    {
        return __('general.pages.welcome');
    }
    public static function getPluralModelLabel(): string
    {
        return __('general.pages.welcomes');
    }
    public static function getNavigationLabel(): string
    {
        return __('general.pages.welcomes');
    }

}

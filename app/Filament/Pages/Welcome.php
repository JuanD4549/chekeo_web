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

}

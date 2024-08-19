<?php

namespace App\Filament\Pages;

use App\Models\Access;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class OutAccess extends Page
{
    protected static ?string $navigationIcon = 'icon-access-out';

    protected static string $view = 'filament.pages.out-access';

    protected static ?string $model = Access::class;

    public function getTitle(): string | Htmlable
    {
        return __('general.pages.out_access');
    }
    public static function getModelLabel(): string
    {
        return __('general.pages.out_access');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.pages.out_accesses');
    }

    public static function getNavigationLabel(): string
    {
        return __('general.pages.out_accesses');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('general.menu_category.security');
    }
}

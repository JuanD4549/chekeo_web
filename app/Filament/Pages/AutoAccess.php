<?php

namespace App\Filament\Pages;

use App\Models\Access;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class AutoAccess extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.auto-access';
    protected static ?string $model = Access::class;
    public function getTitle(): string | Htmlable
    {
        return __('general.code_access');
    }
    public static function getModelLabel(): string
    {
        return __('general.code_access');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.code_accesses');
    }

    public static function getNavigationLabel(): string
    {
        return __('general.code_accesses');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('general.menu.security');
    }
}

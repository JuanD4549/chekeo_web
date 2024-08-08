<?php

namespace App\Filament\Pages;

use App\Models\Access;
use Filament\Pages\Page;
use Filament\Pages\SubNavigationPosition;
use Illuminate\Contracts\Support\Htmlable;

class InAccess extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.in-access';
    //protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::End;


    protected static ?string $model = Access::class;
    public function getTitle(): string | Htmlable
    {
        return __('general.in_access');
    }
    public static function getModelLabel(): string
    {
        return __('general.in_access');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.in_accesses');
    }

    public static function getNavigationLabel(): string
    {
        return __('general.in_accesses');
    }
    public static function getNavigationGroup(): ?string
    {
        return __('general.menu.security');
    }
    //public static function getNavigationParentItem(): ?string
    //{
    //    return __('general.access');
    //}

}

<?php

namespace App\Filament\Resources\CatalogNoveltyResource\Pages;

use App\Filament\Resources\CatalogNoveltyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCatalogNovelties extends ListRecords
{
    protected static string $resource = CatalogNoveltyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

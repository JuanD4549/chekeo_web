<?php

namespace App\Filament\Resources\CatalogNoveltyResource\Pages;

use App\Filament\Resources\CatalogNoveltyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCatalogNovelty extends EditRecord
{
    protected static string $resource = CatalogNoveltyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

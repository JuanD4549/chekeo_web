<?php

namespace App\Filament\Resources\PreVisitResource\Pages;

use App\Filament\Resources\PreVisitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPreVisits extends ListRecords
{
    protected static string $resource = PreVisitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

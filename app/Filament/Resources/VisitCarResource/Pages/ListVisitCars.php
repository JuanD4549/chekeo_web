<?php

namespace App\Filament\Resources\VisitCarResource\Pages;

use App\Filament\Resources\VisitCarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVisitCars extends ListRecords
{
    protected static string $resource = VisitCarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

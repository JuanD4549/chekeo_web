<?php

namespace App\Filament\Resources\MaintenanceRoundResource\Pages;

use App\Filament\Resources\MaintenanceRoundResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMaintenanceRounds extends ListRecords
{
    protected static string $resource = MaintenanceRoundResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

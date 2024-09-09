<?php

namespace App\Filament\Resources\MaintenanceRoundResource\Pages;

use App\Filament\Resources\MaintenanceRoundResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMaintenanceRound extends ViewRecord
{
    protected static string $resource = MaintenanceRoundResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

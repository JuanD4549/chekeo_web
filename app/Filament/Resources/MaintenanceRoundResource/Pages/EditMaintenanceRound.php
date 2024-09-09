<?php

namespace App\Filament\Resources\MaintenanceRoundResource\Pages;

use App\Filament\Resources\MaintenanceRoundResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMaintenanceRound extends EditRecord
{
    protected static string $resource = MaintenanceRoundResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

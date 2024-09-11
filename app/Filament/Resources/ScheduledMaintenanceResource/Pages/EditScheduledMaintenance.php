<?php

namespace App\Filament\Resources\ScheduledMaintenanceResource\Pages;

use App\Filament\Resources\ScheduledMaintenanceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditScheduledMaintenance extends EditRecord
{
    protected static string $resource = ScheduledMaintenanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\DeleteAction::make(),
        ];
    }
}

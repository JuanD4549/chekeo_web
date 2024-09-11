<?php

namespace App\Filament\Resources\ScheduledMaintenanceResource\Pages;

use App\Filament\Resources\ScheduledMaintenanceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateScheduledMaintenance extends CreateRecord
{
    protected static string $resource = ScheduledMaintenanceResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        //dd($data);

        return $data;
    }
}

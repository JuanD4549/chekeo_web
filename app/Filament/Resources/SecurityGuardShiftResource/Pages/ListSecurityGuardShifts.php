<?php

namespace App\Filament\Resources\SecurityGuardShiftResource\Pages;

use App\Filament\Resources\SecurityGuardShiftResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSecurityGuardShifts extends ListRecords
{
    protected static string $resource = SecurityGuardShiftResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

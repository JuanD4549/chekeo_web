<?php

namespace App\Filament\Resources\DataSecurityGuardShiftResource\Pages;

use App\Filament\Resources\DataSecurityGuardShiftResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataSecurityGuardShifts extends ListRecords
{
    protected static string $resource = DataSecurityGuardShiftResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

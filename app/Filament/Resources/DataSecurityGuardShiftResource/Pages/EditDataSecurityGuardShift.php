<?php

namespace App\Filament\Resources\DataSecurityGuardShiftResource\Pages;

use App\Filament\Resources\DataSecurityGuardShiftResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataSecurityGuardShift extends EditRecord
{
    protected static string $resource = DataSecurityGuardShiftResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

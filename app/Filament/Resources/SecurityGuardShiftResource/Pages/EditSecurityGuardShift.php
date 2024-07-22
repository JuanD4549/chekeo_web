<?php

namespace App\Filament\Resources\SecurityGuardShiftResource\Pages;

use App\Filament\Resources\SecurityGuardShiftResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSecurityGuardShift extends EditRecord
{
    protected static string $resource = SecurityGuardShiftResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

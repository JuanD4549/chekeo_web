<?php

namespace App\Filament\Resources\SecurityGuardResource\Pages;

use App\Filament\Resources\SecurityGuardResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSecurityGuard extends EditRecord
{
    protected static string $resource = SecurityGuardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

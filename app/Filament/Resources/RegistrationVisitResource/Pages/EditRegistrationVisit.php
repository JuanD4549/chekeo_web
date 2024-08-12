<?php

namespace App\Filament\Resources\RegistrationVisitResource\Pages;

use App\Filament\Resources\RegistrationVisitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRegistrationVisit extends EditRecord
{
    protected static string $resource = RegistrationVisitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

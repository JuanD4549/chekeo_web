<?php

namespace App\Filament\Resources\RegistrationVisitResource\Pages;

use App\Filament\Resources\RegistrationVisitResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRegistrationVisit extends ViewRecord
{
    protected static string $resource = RegistrationVisitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\EditAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\PreVisitResource\Pages;

use App\Filament\Resources\PreVisitResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPreVisit extends ViewRecord
{
    protected static string $resource = PreVisitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\AccessResource\Pages;

use App\Filament\Resources\AccessResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAccess extends ViewRecord
{
    protected static string $resource = AccessResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\EditAction::make(),
        ];
    }
}

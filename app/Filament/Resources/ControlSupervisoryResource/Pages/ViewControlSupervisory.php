<?php

namespace App\Filament\Resources\ControlSupervisoryResource\Pages;

use App\Filament\Resources\ControlSupervisoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewControlSupervisory extends ViewRecord
{
    protected static string $resource = ControlSupervisoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

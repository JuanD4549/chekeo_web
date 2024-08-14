<?php

namespace App\Filament\Resources\ControlSupervisoryResource\Pages;

use App\Filament\Resources\ControlSupervisoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditControlSupervisory extends EditRecord
{
    protected static string $resource = ControlSupervisoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\ControlSupervisoryResource\Pages;

use App\Filament\Resources\ControlSupervisoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListControlSupervisories extends ListRecords
{
    protected static string $resource = ControlSupervisoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\VisitCarResource\Pages;

use App\Filament\Resources\VisitCarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVisitCar extends EditRecord
{
    protected static string $resource = VisitCarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

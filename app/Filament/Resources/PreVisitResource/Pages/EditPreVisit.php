<?php

namespace App\Filament\Resources\PreVisitResource\Pages;

use App\Filament\Resources\PreVisitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPreVisit extends EditRecord
{
    protected static string $resource = PreVisitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

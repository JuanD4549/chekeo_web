<?php

namespace App\Filament\Resources\CheckSupervisoryResource\Pages;

use App\Filament\Resources\CheckSupervisoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCheckSupervisory extends EditRecord
{
    protected static string $resource = CheckSupervisoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

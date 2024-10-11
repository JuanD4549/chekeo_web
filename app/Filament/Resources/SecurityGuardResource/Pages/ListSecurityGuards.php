<?php

namespace App\Filament\Resources\SecurityGuardResource\Pages;

use App\Filament\Resources\SecurityGuardResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSecurityGuards extends ListRecords
{
    protected static string $resource = SecurityGuardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

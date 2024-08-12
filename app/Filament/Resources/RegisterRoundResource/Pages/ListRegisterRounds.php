<?php

namespace App\Filament\Resources\RegisterRoundResource\Pages;

use App\Filament\Resources\RegisterRoundResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRegisterRounds extends ListRecords
{
    protected static string $resource = RegisterRoundResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

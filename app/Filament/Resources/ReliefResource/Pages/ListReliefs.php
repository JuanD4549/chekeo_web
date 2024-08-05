<?php

namespace App\Filament\Resources\ReliefResource\Pages;

use App\Filament\Resources\ReliefResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReliefs extends ListRecords
{
    protected static string $resource = ReliefResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

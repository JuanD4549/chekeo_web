<?php

namespace App\Filament\Resources\NoveltyRegistrationResource\Pages;

use App\Filament\Resources\NoveltyRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNoveltyRegistrations extends ListRecords
{
    protected static string $resource = NoveltyRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

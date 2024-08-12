<?php

namespace App\Filament\Resources\NoveltyRegistrationResource\Pages;

use App\Filament\Resources\NoveltyRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewNoveltyRegistration extends ViewRecord
{
    protected static string $resource = NoveltyRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

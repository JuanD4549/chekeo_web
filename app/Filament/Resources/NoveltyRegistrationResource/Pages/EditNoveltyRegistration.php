<?php

namespace App\Filament\Resources\NoveltyRegistrationResource\Pages;

use App\Filament\Resources\NoveltyRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNoveltyRegistration extends EditRecord
{
    protected static string $resource = NoveltyRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

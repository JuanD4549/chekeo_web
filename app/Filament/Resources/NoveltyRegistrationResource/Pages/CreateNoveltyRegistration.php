<?php

namespace App\Filament\Resources\NoveltyRegistrationResource\Pages;

use App\Filament\Resources\NoveltyRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNoveltyRegistration extends CreateRecord
{
    protected static string $resource = NoveltyRegistrationResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

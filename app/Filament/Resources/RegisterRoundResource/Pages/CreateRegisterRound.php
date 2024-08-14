<?php

namespace App\Filament\Resources\RegisterRoundResource\Pages;

use App\Filament\Resources\RegisterRoundResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRegisterRound extends CreateRecord
{
    protected static string $resource = RegisterRoundResource::class;

    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

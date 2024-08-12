<?php

namespace App\Filament\Resources\RegisterRoundResource\Pages;

use App\Filament\Resources\RegisterRoundResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRegisterRound extends EditRecord
{
    protected static string $resource = RegisterRoundResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            //Actions\DeleteAction::make(),
        ];
    }
}

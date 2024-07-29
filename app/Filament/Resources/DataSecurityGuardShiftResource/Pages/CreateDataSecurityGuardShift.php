<?php

namespace App\Filament\Resources\DataSecurityGuardShiftResource\Pages;

use App\Filament\Resources\DataSecurityGuardShiftResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateDataSecurityGuardShift extends CreateRecord
{
    protected static string $resource = DataSecurityGuardShiftResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::user()->id;

        return $data;
    }
    protected function afterCreate(): void
    {
        // Runs after the form fields are saved to the database.
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

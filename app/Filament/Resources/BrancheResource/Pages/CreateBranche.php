<?php

namespace App\Filament\Resources\BrancheResource\Pages;

use App\Filament\Resources\BrancheResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBranche extends CreateRecord
{
    protected static string $resource = BrancheResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['enterprise_id'] = 1;

        return $data;
    }
}

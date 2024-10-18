<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        //dd($data);
        //$data['user_id'] = auth()->id();

        return $data;
    }
    protected function beforeCreate(): void
    {
        //dd($this);
        // Runs after the form fields are saved to the database.
    }
    protected function handleRecordCreation(array $data): Model
    {
        //dd($data);

        return static::getModel()::create($data);
    }
}

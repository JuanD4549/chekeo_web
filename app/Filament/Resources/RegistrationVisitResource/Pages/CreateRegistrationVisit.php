<?php

namespace App\Filament\Resources\RegistrationVisitResource\Pages;

use App\Filament\Funcions\Logica;
use App\Filament\Resources\RegistrationVisitResource;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRegistrationVisit extends CreateRecord
{
    protected static string $resource = RegistrationVisitResource::class;
    protected static bool $canCreateAnother = false;

    public function mutateFormDataBeforeCreate(array $data): array
    {
        //dd($this->record['id']);
        //Save detail

        $name_foto = (new Logica())->saveFoto($data['img1_url'], 'storage/visit/');
        $data['img1_url'] = "visit/" . $name_foto;
        $data['date_time_in']=Carbon::now();
        return $data;
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

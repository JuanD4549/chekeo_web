<?php

namespace App\Filament\Resources\DataSecurityGuardShiftResource\Pages;

use App\Filament\Funcions\Logica;
use App\Filament\Resources\DataSecurityGuardShiftResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CreateDataSecurityGuardShift extends CreateRecord
{
    protected static string $resource = DataSecurityGuardShiftResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        //dd($data);
        $data['security_guard_shift_id'] = 1;
        $path=(new Logica)->saveFoto($data['img1_url'],'reliefs/');
        $data['img1_url']=$path;
        return $data;
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

<?php

namespace App\Filament\Resources\DataSecurityGuardShiftResource\Pages;

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
        $img = $data['img1_url'];
        $folderPath = "fields/";
        $image_parts = explode(";base64,", $img);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName1 = date("d.m.y") . "." . time() . uniqid() . '.png';
        $file = $folderPath . $fileName1;
        file_put_contents($file, $image_base64);
        $data['img1_url']=$file;
        return $data;
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

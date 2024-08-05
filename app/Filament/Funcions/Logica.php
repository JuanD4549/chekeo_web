<?php

namespace App\Filament\Funcions;

use Illuminate\Support\Facades\Auth;

class Logica
{
    public function getCalendar()
    {
        $branche = Auth::user()['branche'];
        $calendar=null;
        if (count($branche['calendars'])>0 ){
            $calendar=$branche['calendars'];
        }else if(count(Auth::user()['calendars'])>0){
            $calendar=Auth::user()['calendars'];
        }
        return $calendar;
    }
    public function saveFoto($foto, $folder): ?string
    {
        try {
            $img = $foto;
            $folderPath = $folder;
            $image_parts = explode(";base64,", $img);
            $image_base64 = base64_decode($image_parts[1]);
            $fileName1 = date("d.m.y") . "." . time() . uniqid() . '.png';
            $file = $folderPath . $fileName1;
            file_put_contents($file, $image_base64);
            return $fileName1;
        } catch (\Throwable $th) {
            dd($th);
            return null;
        }

        return null;
    }
}

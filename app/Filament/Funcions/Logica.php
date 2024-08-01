<?php

namespace App\Filament\Funcions;

use Illuminate\Support\Facades\Auth;

class Logica
{
    public function getIdSecurityGuardShifts(): ?int
    {
        $security_guard_shifts = Auth::user()->security_guard_shifts;
        //dd($security_guard_shifts[1]->data_security_guard_shifts);
        foreach ($security_guard_shifts as $key => $value) {
            $data_security_guard_shifts = $value->data_security_guard_shifts;
            //dd($count);
            if (count($data_security_guard_shifts) == 0) {
                //dd($data_security_guard_shifts, $value->id);
                return 0;
            } else if (count($data_security_guard_shifts) == 1) {
                return $value->id;
            }
        }
        return null;
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

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
            if (count($data_security_guard_shifts) ==0) {
                //dd($data_security_guard_shifts, $value->id);
                return 0;
            }else if(count($data_security_guard_shifts) ==1){
                return $value->id;
            }
        }
        return null;
    }
}

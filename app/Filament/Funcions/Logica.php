<?php

namespace App\Filament\Funcions;

use App\Models\Access;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

class Logica
{
    public function formateDayJson($day): string
    {
        //dd($day);
        $obj = json_decode($day);
        //dd($obj->time_in);
        return $obj->time_in . ' - ' . $obj->time_out;
    }
    public function saveFoto($foto, $folder): ?string
    {
        try {
            $img = $foto;
            $folderPath = $folder;
            if (!file_exists($folderPath)) {
                mkdir($folderPath);
                //dd($resultado);
            }
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

    public function saveAccessIn(string $brance, User $user,): ?string
    {
        $calendar = (new CalendarFuncion)->getCalendar($user);
        //dd($calendar->monday);
        if ($calendar != null) {
            $day = json_decode($calendar[strtolower(date("l"))], true);
            //dd($day);
            if ($day['time_in'] != null) {
                $horaActual = new DateTime();
                $horaIngreso = new DateTime($day['time_in']);

                $interval = $horaIngreso->diff($horaActual);
                $totalMin = ($interval->h * 60) + $interval->m;
                if ($totalMin <= $calendar->range) {
                    $access = new Access();
                    $access['branche_id'] = $brance;
                    $access['user_id'] = $user->id;
                    $access['date_time_in'] = Carbon::now();
                    $access->save();
                    return 'Ingreso';
                }
                return 'Fuera de horario';
                //dd($totalMin);

            }
        }
        return 'Sin horario Asignado';
    }
}

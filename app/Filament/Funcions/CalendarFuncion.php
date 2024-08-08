<?php

namespace App\Filament\Funcions;

use App\Models\Access;
use App\Models\Calendar;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

class CalendarFuncion
{
    public function getCalendar(User $user): ?Calendar
    {
        $branche = $user->branche;
        //dd($branche);
        $calendar = null;
        if ($branche->calendar_id != null) {
            $calendar = $branche['calendar'];
            //dd($calendar);
        } else if (Auth::user()->calendar_id!=null) {
            $calendar = Auth::user()['calendar'];
        }
        return $calendar;
    }
    public function getStateWork()
    {
    }
}

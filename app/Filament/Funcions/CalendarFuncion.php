<?php

namespace App\Filament\Funcions;

use App\Models\Access;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

class CalendarFuncion
{
    public function getCalendar(User $user)
    {
        $branche = $user->branche;
        $calendar = null;
        if (count($branche['calendars']) > 0) {
            $calendar = $branche['calendars'];
        } else if (count(Auth::user()['calendars']) > 0) {
            $calendar = Auth::user()['calendars'];
        }
        return $calendar;
    }
    public function getStateWork()
    {
    }
}

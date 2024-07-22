<?php

namespace App\Filament\Personal\Widgets;

use App\Models\SecurityGuardShift;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class SecurityGuardShiftWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Security Guard Shift', $this->getNumSecurityGuardShift(Auth::user())),
        ];
    }
    protected  function getNumSecurityGuardShift(User $user): int{
        $totalSecurityGuardShift= SecurityGuardShift::where('user_id',$user->id)->get()->count();
        //dd($totalSecurityGuardShift);
        return $totalSecurityGuardShift;
    }
}

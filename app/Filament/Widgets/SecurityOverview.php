<?php

namespace App\Filament\Widgets;

use App\Models\SecurityGuardShift;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SecurityOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Turns', SecurityGuardShift::whereDate('created_at', Carbon::today())
                ->count())
                ->description('All turnos')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Reliefs', SecurityGuardShift::whereDate('created_at', Carbon::today())
                ->count())
                ->description('All reliefs')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Average time on page', '3:12')
                ->description('3% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}

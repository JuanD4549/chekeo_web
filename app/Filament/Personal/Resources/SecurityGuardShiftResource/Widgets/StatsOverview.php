<?php

namespace App\Filament\Personal\Resources\SecurityGuardShiftResource\Widgets;

use App\Models\SecurityGuardShift;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Turnos', SecurityGuardShift::query()->count())
        ->description('All turns'),
            Stat::make('Bounce rate', '21%'),
            Stat::make('Average time on page', '3:12'),
        ];
    }
}

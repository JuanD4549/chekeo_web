<?php

namespace App\Filament\Resources\CalendarGuardResource\Pages;

use App\Filament\Resources\CalendarGuardResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCalendarGuards extends ListRecords
{
    protected static string $resource = CalendarGuardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

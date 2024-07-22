<?php

namespace App\Filament\Personal\Resources\SecurityGuardShiftResource\Pages;

use App\Filament\Personal\Resources\SecurityGuardShiftResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListSecurityGuardShifts extends ListRecords
{
    protected static string $resource = SecurityGuardShiftResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('inWork')
            ->label('Ingreso')
            ->color('success')
            ->requiresConfirmation(),
            
            Actions\CreateAction::make(),
        ];
    }
}

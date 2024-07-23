<?php

namespace App\Filament\Resources\SecurityGuardShiftResource\Pages;

use App\Filament\Resources\SecurityGuardShiftResource;
use App\Models\SecurityGuardShift;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListSecurityGuardShifts extends ListRecords
{
    protected static string $resource = SecurityGuardShiftResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('inWork')
                ->label('Join Work')
                ->color('success')
                ->requiresConfirmation()
                ->action(function () {
                    $user = Auth::user();
                    $securityGuardShift = new SecurityGuardShift();
                    $securityGuardShift->user_id=$user->id;
                    
                    $securityGuardShift->save();
                }),
            Actions\CreateAction::make(),
        ];
    }
}

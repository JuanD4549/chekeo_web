<?php

namespace App\Filament\Personal\Resources\SecurityGuardShiftResource\Pages;

use App\Filament\Personal\Resources\SecurityGuardShiftResource;
use App\Mail\SecurityGuardShiftStatus;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CreateSecurityGuardShift extends CreateRecord
{
    protected static string $resource = SecurityGuardShiftResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::user()->id;
        //Mail::to(Auth::user())->send(new SecurityGuardShiftStatus($data));
        $recipient=auth()->user();
        Notification::make()
        ->title('Create Security Guard Shift')
        ->sendToDatabase($recipient);
        return $data;
    }
}

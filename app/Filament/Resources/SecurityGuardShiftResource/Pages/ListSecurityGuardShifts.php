<?php

namespace App\Filament\Resources\SecurityGuardShiftResource\Pages;

use App\Filament\Resources\SecurityGuardShiftResource;
use App\Forms\Components\Latitude;
use App\Forms\Components\Longitude;
use App\Forms\Components\WebCam;
use App\Models\DataSecurityGuardShift;
use App\Models\SecurityGuardShift;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\View\Components\Modal;
use Illuminate\Support\Facades\Auth;

class ListSecurityGuardShifts extends ListRecords
{
    protected static string $resource = SecurityGuardShiftResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            //Action::make('ENtrada')
            //    ->label('Entrada')
            //    ->form([
            //        Fieldset::make('Label')
            //            ->schema([
            //                Toggle::make('relief'),
            //                DateTimePicker::make('date_time')
            //                    ->default(Carbon::now())
            //                    ->disabled(true),
            //                Textarea::make('detail'),
            //            ])
            //            ->columns(3),
//
            //        Fieldset::make('Location')
            //            ->schema([
            //                Latitude::make('latitude'),
            //                Longitude::make('longitude'),
            //            ]),
            //        Fieldset::make('Location')
            //            ->schema([
            //                WebCam::make('img1_url')
            //            ]),
//
            //    ])
            //    ->action(function (array $data) {
            //        $user = Auth::user();
            //        //dd($user ,$data['relief']);
            //        $securityGuardShift = new SecurityGuardShift();
            //        $securityGuardShift->user_id = $user->id;
            //        $securityGuardShift->branche_id = $user->branche_id;
            //        $securityGuardShift->relief = $data['relief'];
            //        $securityGuardShift->save();
            //        //$securityGuardShift->status=true;
            //        $dataSecurityGuardShift = new DataSecurityGuardShift();
            //        $dataSecurityGuardShift->security_guard_shift_id = $securityGuardShift->id;
            //        //$dataSecurityGuardShift->type = 'in';
            //        $dataSecurityGuardShift->security_guard_shift_id = $securityGuardShift->id;
            //        $dataSecurityGuardShift->security_guard_shift_id = $securityGuardShift->id;
//
            //    })
            //  ->slideOver()
        ];
    }
}

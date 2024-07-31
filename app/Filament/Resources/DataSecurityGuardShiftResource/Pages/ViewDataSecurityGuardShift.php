<?php

namespace App\Filament\Resources\DataSecurityGuardShiftResource\Pages;

use App\Filament\Funcions\Logica;
use App\Filament\Resources\DataSecurityGuardShiftResource;
use Filament\Actions;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;

class ViewDataSecurityGuardShift extends ViewRecord
{
    protected static string $resource = DataSecurityGuardShiftResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Fieldset::make('Data Primary')
                    ->relationship(
                        'security_guard_shift',
                    )
                    ->schema([
                        TextEntry::make('user.name'),
                        TextEntry::make('branche.name'),
                    ]),
                Section::make('type')
                
                    ->description('Images used in the page layout.')
                    ->schema([
                        TextEntry::make('date_time'),
                        TextEntry::make('detail')
                            ->columnSpanFull(),
                        //FileUpload::make('img1_url'),
                        TextEntry::make('latitude')
                        //->native()
                        //->default('sa')
                        ,
                        //ViewField::make('latitude')
                        //    ->view('forms.components.latitude'),
                        TextEntry::make('longitude')
                        //->getValue()
                        ,

                        ImageEntry::make('img1_url')
                            ->defaultImageUrl(''),
                        TextEntry::make('type'),
                    ]),
            ]);
    }
}

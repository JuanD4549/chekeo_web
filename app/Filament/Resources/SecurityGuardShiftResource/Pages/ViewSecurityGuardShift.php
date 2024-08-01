<?php

namespace App\Filament\Resources\SecurityGuardShiftResource\Pages;

use App\Filament\Resources\SecurityGuardShiftResource;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Infolists;
use Filament\Resources\Pages\ViewRecord;

class ViewSecurityGuardShift extends ViewRecord
{
    protected static string $resource = SecurityGuardShiftResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Data Primary')
                    ->schema([
                        TextEntry::make('user.name'),
                        TextEntry::make('branche.name'),
                    ]),
                Infolists\Components\Fieldset::make('detail_in')
                    ->relationship('detail_in')
                    ->schema([
                        TextEntry::make('detail.date_time'),
                        TextEntry::make('detail.detail')
                            ->columnSpanFull(),
                        TextEntry::make('detail.latitude'),
                        TextEntry::make('detail.longitude'),

                        Infolists\Components\ImageEntry::make('detail.img1_url')
                            ->defaultImageUrl(''),
                    ]),
                    Infolists\Components\Fieldset::make('detail_out')
                    ->relationship('detail_out')
                    ->schema([
                        TextEntry::make('detail.date_time'),
                        TextEntry::make('detail.detail')
                            ->columnSpanFull(),
                        TextEntry::make('detail.latitude'),
                        TextEntry::make('detail.longitude'),
                        Infolists\Components\ImageEntry::make('detail.img1_url')
                            ->defaultImageUrl(''),
                    ]),
            ]);
    }
}

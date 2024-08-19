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
                Infolists\Components\Section::make('')
                    ->schema([
                        TextEntry::make('branche.name')
                            ->label(__('general.pages.branche')),
                        TextEntry::make('place.name')
                            ->label(__('general.pages.place')),
                        TextEntry::make('user.name')
                            ->label(__('general.pages.employee')),
                        Infolists\Components\Section::make(__('general.detail.detail_in'))
                            ->relationship('detail_in')
                            ->schema([
                                Infolists\Components\Grid::make([
                                    'default' => 3,
                                ])
                                    ->schema([
                                        TextEntry::make('detail.date_time')
                                            ->label(__('general.date.date_time')),
                                        TextEntry::make('detail.latitude')
                                            ->label(__('general.gps.latitude')),
                                        TextEntry::make('detail.longitude')
                                            ->label(__('general.gps.longitude')),
                                    ]),
                                TextEntry::make('detail.detail')
                                    ->label(__('general.detail.detail'))
                                    ->columnSpanFull(),
                                Infolists\Components\Grid::make([
                                    'default' => 2,
                                ])
                                    ->schema([
                                        Infolists\Components\ImageEntry::make('detail.img1_url')
                                            ->label(__('general.form.photo',['number'=>'#1']))
                                            ->defaultImageUrl(''),
                                        Infolists\Components\ImageEntry::make('detail.img2_url')
                                            ->label(__('general.form.photo',['number'=>'#2']))
                                            ->defaultImageUrl(''),
                                    ]),
                            ]),
                        Infolists\Components\Section::make(__('general.detail.detail_out'))
                            ->relationship('detail_out')
                            ->schema([
                                Infolists\Components\Grid::make([
                                    'default' => 3,
                                ])
                                    ->schema([
                                        TextEntry::make('detail.date_time')
                                            ->label(__('general.date.date_time')),
                                        TextEntry::make('detail.latitude')
                                            ->label(__('general.gps.latitude')),
                                        TextEntry::make('detail.longitude')
                                            ->label(__('general.gps.longitude')),
                                    ]),
                                TextEntry::make('detail.detail')
                                    ->label(__('general.detail.detail'))
                                    ->columnSpanFull(),
                                Infolists\Components\Grid::make([
                                    'default' => 2,
                                ])
                                    ->schema([
                                        Infolists\Components\ImageEntry::make('detail.img1_url')
                                            ->label(__('general.form.photo',['number'=>'#1']))
                                            ->defaultImageUrl(''),
                                        Infolists\Components\ImageEntry::make('detail.img2_url')
                                            ->label(__('general.form.photo',['number'=>'#2']))
                                            ->defaultImageUrl(''),
                                    ]),
                            ]),

                    ])->columns(3),
            ]);
    }
}

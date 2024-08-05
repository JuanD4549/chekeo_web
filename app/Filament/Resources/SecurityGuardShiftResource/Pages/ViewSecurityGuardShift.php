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
                Infolists\Components\Section::make(__('general.user_data'))
                    ->schema([
                        TextEntry::make('user.name'),
                        TextEntry::make('branche.name'),
                    ])->columns(2),
                Infolists\Components\Section::make(__('general.detail_in'))
                    ->relationship('detail_in')
                    ->schema([
                        Infolists\Components\Grid::make([
                            'default' => 3,
                        ])
                            ->schema([
                                TextEntry::make('detail.date_time')
                                    ->label(__('general.date_time')),
                                TextEntry::make('detail.latitude')
                                    ->label(__('general.latitude')),
                                TextEntry::make('detail.longitude')
                                    ->label(__('general.longitude')),
                            ]),
                        TextEntry::make('detail.detail')
                            ->label(__('general.detail'))
                            ->columnSpanFull(),
                        Infolists\Components\Grid::make([
                            'default' => 2,
                        ])
                            ->schema([
                                Infolists\Components\ImageEntry::make('detail.img1_url')
                                    ->label(__('general.photo'))
                                    ->defaultImageUrl(''),
                                Infolists\Components\ImageEntry::make('detail.img2_url')
                                    ->label(__('general.photo'))
                                    ->defaultImageUrl(''),
                            ]),
                    ])
                    ->collapsed(),
                Infolists\Components\Section::make(__('general.detail_out'))
                    ->relationship('detail_out')
                    ->schema([
                        Infolists\Components\Grid::make([
                            'default' => 3,
                        ])
                            ->schema([
                                TextEntry::make('detail.date_time')
                                    ->label(__('general.date_time')),
                                TextEntry::make('detail.latitude')
                                    ->label(__('general.latitude')),
                                TextEntry::make('detail.longitude')
                                    ->label(__('general.longitude')),
                            ]),
                        TextEntry::make('detail.detail')
                            ->label(__('general.detail'))
                            ->columnSpanFull(),
                        Infolists\Components\Grid::make([
                            'default' => 2,
                        ])
                            ->schema([
                                Infolists\Components\ImageEntry::make('detail.img1_url')
                                    ->label(__('general.photo'))
                                    ->defaultImageUrl(''),
                                Infolists\Components\ImageEntry::make('detail.img2_url')
                                    ->label(__('general.photo'))
                                    ->defaultImageUrl(''),
                            ]),
                    ])
                    ->collapsed(),
            ]);
    }
}

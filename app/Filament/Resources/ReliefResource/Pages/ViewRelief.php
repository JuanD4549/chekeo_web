<?php

namespace App\Filament\Resources\ReliefResource\Pages;

use App\Filament\Resources\ReliefResource;
use Filament\Actions;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Infolists;
use Filament\Resources\Pages\ViewRecord;

class ViewRelief extends ViewRecord
{
    protected static string $resource = ReliefResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Tabs::make('Information')
                    ->tabs([
                        Infolists\Components\Tabs\Tab::make('First Turn')
                            ->schema([
                                Infolists\Components\Section::make(__('general.user_data'))
                                    ->schema([
                                        TextEntry::make('relief_in.user.name'),
                                        TextEntry::make('branche.name'),
                                    ])->columns(2),
                                Infolists\Components\Section::make(__('general.detail'))
                                    ->relationship('relief_in.detail_in')
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
                                    ]),
                            ]),
                        Infolists\Components\Tabs\Tab::make('Second Turn')
                            ->schema([
                                Infolists\Components\Section::make(__('general.user_data'))
                                    ->schema([
                                        TextEntry::make('relief_out.user.name'),
                                        TextEntry::make('branche.name'),
                                    ])->columns(2),
                                Infolists\Components\Section::make(__('general.detail_in'))
                                    ->relationship('relief_out.detail_out')
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
                                    ]),
                            ]),
                        //->hidden(fn() => !$this->record['relief']),
                    ])->columnSpanFull(),
            ]);
    }
}

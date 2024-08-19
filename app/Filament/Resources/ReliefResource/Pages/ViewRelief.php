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
                Infolists\Components\Section::make('')
                    ->schema([
                        TextEntry::make('branche.name')
                            ->label(__('general.pages.branche')),
                        TextEntry::make('place.name')
                            ->label(__('general.pages.place')),
                    ])->columns(2),
                Infolists\Components\Tabs::make('Information')
                    ->tabs([
                        Infolists\Components\Tabs\Tab::make(__('general.form.in'))
                            ->schema([
                                TextEntry::make('relief_in.user.name')
                                    ->label(__('general.pages.employee')),
                                Infolists\Components\Section::make(__('general.detail'))
                                    ->relationship('relief_in.detail_in')
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
                                                    ->label(__('general.form.photo', ['number' => '#1']))
                                                    ->defaultImageUrl(''),
                                                Infolists\Components\ImageEntry::make('detail.img2_url')
                                                    ->label(__('general.form.photo', ['number' => '#2']))
                                                    ->defaultImageUrl(''),
                                            ]),
                                    ]),
                            ]),
                        Infolists\Components\Tabs\Tab::make(__('general.form.out'))
                            ->schema([
                                TextEntry::make('relief_out.user.name')
                                    ->label(__('general.pages.employee')),
                                Infolists\Components\Section::make('')
                                    ->relationship('relief_out.detail_out')
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
                            ]),
                        //->hidden(fn() => !$this->record['relief']),
                    ])->columnSpanFull(),
            ]);
    }
}

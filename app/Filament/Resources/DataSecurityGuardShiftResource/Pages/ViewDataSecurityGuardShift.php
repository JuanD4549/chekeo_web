<?php

namespace App\Filament\Resources\DataSecurityGuardShiftResource\Pages;

use App\Filament\Resources\DataSecurityGuardShiftResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
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
                TextEntry::make('type'),
                Section::make('Media')
                    ->description('Images used in the page layout.')
                    ->schema([
                        ImageEntry::make('img1_url')
                        ->defaultImageUrl(''),
                        TextEntry::make('type'),
                    ]),
                ImageEntry::make('img1_url'),
            ]);
    }
}

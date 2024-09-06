<?php

namespace App\Filament\Resources\RegistrationVisitResource\Pages;

use App\Filament\Resources\RegistrationVisitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRegistrationVisits extends ListRecords
{
    protected static string $resource = RegistrationVisitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('Pre Visita')
                    ->button()
                    //->color()
                    ->url(fn (): string => route('filament.admin.resources.pre-visits.index'))
        ];
    }
}

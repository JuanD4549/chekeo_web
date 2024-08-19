<?php

namespace App\Filament\Resources\ControlSupervisoryResource\Pages;

use App\Filament\Resources\ControlSupervisoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateControlSupervisory extends CreateRecord
{
    protected static string $resource = ControlSupervisoryResource::class;

    protected static bool $canCreateAnother = false;
}

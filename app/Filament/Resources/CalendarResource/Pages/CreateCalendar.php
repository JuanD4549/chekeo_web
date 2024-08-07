<?php

namespace App\Filament\Resources\CalendarResource\Pages;

use App\Filament\Resources\CalendarResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateCalendar extends CreateRecord
{
    protected static string $resource = CalendarResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data['monday']=json_encode($data['monday']);
        $data['tuesday']=json_encode($data['tuesday']);
        $data['wednesday']=json_encode($data['wednesday']);
        $data['thursday']=json_encode($data['thursday']);
        $data['friday']=json_encode($data['friday']);
        $data['saturday']=json_encode($data['saturday']);
        $data['sunday']=json_encode($data['sunday']);
        //dd($data['monday']);
        return static::getModel()::create($data);
    }
}

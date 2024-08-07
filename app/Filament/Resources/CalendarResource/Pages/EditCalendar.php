<?php

namespace App\Filament\Resources\CalendarResource\Pages;

use App\Filament\Resources\CalendarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCalendar extends EditRecord
{
    protected static string $resource = CalendarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\DeleteAction::make(),
        ];
    }
    protected function mutateFormDataBeforeFill(array $data): array
    {
        //dd(json_decode($data['monday']));
        $data['monday'] = json_decode($data['monday'],true);
        $data['tuesday']=json_decode($data['tuesday'],true);
        $data['wednesday']=json_decode($data['wednesday'],true);
        $data['thursday']=json_decode($data['thursday'],true);
        $data['friday']=json_decode($data['friday'],true);
        $data['saturday']=json_decode($data['saturday'],true);
        $data['sunday']=json_decode($data['sunday'],true);
        return $data;
    }
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['monday']=json_encode($data['monday']);
        $data['tuesday']=json_encode($data['tuesday']);
        $data['wednesday']=json_encode($data['wednesday']);
        $data['thursday']=json_encode($data['thursday']);
        $data['friday']=json_encode($data['friday']);
        $data['saturday']=json_encode($data['saturday']);
        $data['sunday']=json_encode($data['sunday']);
        return $data;
    }
}

<?php

namespace App\Filament\Personal\Resources\SecurityGuardShiftResource\Pages;

use App\Filament\Funcions\Logica;
use App\Filament\Personal\Resources\SecurityGuardShiftResource;
use App\Models\Detail;
use App\Models\DetailIn;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CreateSecurityGuardShift extends CreateRecord
{
    protected static string $resource = SecurityGuardShiftResource::class;

    protected static bool $canCreateAnother = false;

    protected function handleRecordCreation(array $data): Model
    {
        $data['user_id'] = Auth::user()->id;
        $data['branche_id'] = Auth::user()->branche_id;
        return static::getModel()::create($data);
    }
    public function afterCreate(): void
    {
        //dd($this->record['id']);
        //Save detail
        $detail = new Detail();
        $detail_form = $this->form->getState();
        //dd($detail_form['detail']);
        $detail['date_time'] = $this->data['date_time'];
        $detail['detail'] = $detail_form['detail'];
        $detail['latitude'] = $detail_form['latitude'];
        $detail['longitude'] = $detail_form['longitude'];
        $name_foto = (new Logica())->saveFoto($detail_form['img1_url'], 'storage/turns/');
        $detail['img1_url'] = "turns/" . $name_foto;
        $detail->save();
        //Save relation detail with SecurityGuardShifts
        $detail_in = new DetailIn();
        $detail_in['detail_id'] = $detail['id'];
        $detail_in->save();
        $this->record['detail_in_id'] = $detail_in['id'];
        $this->record->save();
        //If save with relief
        //$calendar=(new Logica())->getCalendar();
        //dd($calendar);
        //dd($this->form->getState());
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

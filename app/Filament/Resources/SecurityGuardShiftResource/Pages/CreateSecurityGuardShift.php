<?php

namespace App\Filament\Resources\SecurityGuardShiftResource\Pages;

use App\Filament\Funcions\Logica;
use App\Filament\Resources\SecurityGuardShiftResource;
use App\Forms\Components\Latitude;
use App\Forms\Components\Longitude;
use App\Forms\Components\WebCam;
use App\Models\Detail;
use App\Models\DetailIn;
use Carbon\Carbon;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CreateSecurityGuardShift extends CreateRecord
{
    protected static string $resource = SecurityGuardShiftResource::class;
    protected function handleRecordCreation(array $data): Model
    {
        $data['user_id']=Auth::user()->id;
        $data['branche_id']=Auth::user()->branche_id;
        return static::getModel()::create($data);
    }
    public function afterCreate(): void
    {
        //dd($this->record['id']);
        $detail=new Detail();
        $detail_form=$this->form->getState();
        //dd($detail_form['detail']);
        $detail['date_time']=$this->data['date_time'];
        $detail['detail']=$detail_form['detail'];
        $detail['latitude']=$detail_form['latitude'];
        $detail['longitude']=$detail_form['longitude'];
        $name_foto=(new Logica())->saveFoto($detail_form['img1_url'],'storage/turns/');
        $detail['img1_url']="turns/".$name_foto;
        $detail->save();

        $detail_in=new DetailIn();
        $detail_in['detail_id']=$detail['id'];
        $detail_in->save();
        $this->record['detail_in_id']=$detail_in['id'];
        $this->record->save();

        //dd($this->form->getState());
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Label')
                        ->schema([
                            Toggle::make('relief'),
                            DateTimePicker::make('date_time')
                                ->default(Carbon::now())
                                ->disabled(true),
                            Textarea::make('detail'),
                        ])
                        ->columns(3),

                    Fieldset::make('Location')
                        ->schema([
                            Latitude::make('latitude'),
                            Longitude::make('longitude'),
                        ]),
                    Fieldset::make('Location')
                        ->schema([
                            WebCam::make('img1_url')
                        ]),
            ]);
    }

protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}

}

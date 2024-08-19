<?php

namespace App\Filament\Resources\SecurityGuardShiftResource\Pages;

use App\Filament\Funcions\Logica;
use App\Filament\Resources\SecurityGuardShiftResource;
use App\Forms\Components\Latitude;
use App\Forms\Components\Longitude;
use App\Forms\Components\WebCam;
use App\Models\Detail;
use App\Models\DetailOut;
use Carbon\Carbon;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditSecurityGuardShift extends EditRecord
{
    protected static string $resource = SecurityGuardShiftResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\DeleteAction::make(),
        ];
    }
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['date_time'] = Carbon::now();
        return $data;
    }
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['status'] = false;
        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        //dd($data);
        $detail = new Detail();
        //dd($detail_form['detail']);
        $detail['date_time'] = $data['date_time'];
        $detail['type'] = 'out';
        $detail['detail'] = $data['detail'];
        $detail['latitude'] = $data['latitude'];
        $detail['longitude'] = $data['longitude'];
        $name_foto = (new Logica())->saveFoto($data['img1_url'], 'storage/turns/');
        $detail['img1_url'] = "turns/" . $name_foto;
        $detail->save();

        $detail_out = new DetailOut();
        $detail_out['detail_id'] = $detail['id'];
        $detail_out->save();

        $data['detail_out_id'] = $detail_out['id'];

        $record->update($data);

        return $record;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('')
                    ->schema([
                        Select::make('place_id')
                            ->label(__('general.pages.place'))
                            ->relationship('place', 'name')
                            ->required(),
                        DateTimePicker::make('date_time')
                            ->label(__('general.date.date_time'))
                            ->disabled(),
                        Textarea::make('detail')
                            ->label(__('general.detail.detail')),
                    ]),

                Fieldset::make(__('general.gps.location'))
                    ->schema([
                        Latitude::make('latitude')
                            ->label(__('general.gps.latitude')),
                        Latitude::make('longitude')
                            ->label(__('general.gps.longitude')),
                    ]),
                WebCam::make('img1_url')
                    ->label(__('general.form.photo',['number'=>''])),
            ]);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

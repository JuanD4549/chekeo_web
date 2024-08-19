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
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CreateSecurityGuardShift extends CreateRecord
{
    protected static string $resource = SecurityGuardShiftResource::class;

    protected static bool $canCreateAnother = false;

    //protected static string

    protected function handleRecordCreation(array $data): Model
    {
        $data['user_id'] = Auth::user()->id;
        $data['branche_id'] = Auth::user()->branche_id;
        return static::getModel()::create($data);
    }

    protected function beforeCreate(): void
    {
        //$branche = Auth::user()['branche'];
        ////dd(count($branche['calendars']));
        //if ($branche == null) {
        //    Notification::make()
        //        ->title('None Branche')
        //        ->danger()
        //        ->color('danger')
        //        ->duration(5000)
        //        ->send();
        //    $this->halt();
        //}
        //else if(count($branche['calendars'])==0 || count(Auth::user()['calendars'])==0){
        //    Notification::make()
        //        ->title('None Calendar')
        //        ->danger()
        //        ->color('danger')
        //        ->duration(5000)
        //        ->send();
        //    $this->halt();
        //}
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

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')
                    //->columns(3)
                    ->schema([
                        Fieldset::make()
                            //->columns(1)
                            ->schema([
                                Select::make('place_id')
                                    ->label(__('general.pages.place'))
                                    ->relationship('place', 'name')
                                    ->required(),
                                DateTimePicker::make('date_time')
                                    ->label(__('general.date.date_time'))
                                    ->disabled()
                                    ->default(Carbon::now()),
                                //->disabled(true),
                                Textarea::make('detail')
                                    ->label(__('general.detail.detail'))
                                    ->columnSpanFull(),
                            ]),
                        Fieldset::make(__('general.gps.location'))
                            //->columns(1)
                            ->schema([
                                Latitude::make('latitude')
                                    ->label(__('general.gps.latitude')),
                                Latitude::make('longitude')
                                    ->label(__('general.gps.longitude')),
                            ]),
                        WebCam::make('img1_url')
                            ->label(__('general.form.photo', ['number' => '']))
                            ->required(),

                    ]),
            ]);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

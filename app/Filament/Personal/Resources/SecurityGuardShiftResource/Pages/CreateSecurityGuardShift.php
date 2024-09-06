<?php

namespace App\Filament\Personal\Resources\SecurityGuardShiftResource\Pages;

use App\Filament\Funcions\Logica;
use App\Filament\Personal\Resources\SecurityGuardShiftResource;
use App\Forms\Components\Latitude;
use App\Forms\Components\Longitude;
use App\Forms\Components\WebCam;
use App\Models\Detail;
use App\Models\DetailIn;
use App\Models\Place;
use App\Models\User;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
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
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')
                    ->columns(2)
                    ->schema([
                        Fieldset::make()
                            ->columns(3)
                            ->schema([
                                ToggleButtons::make('status')
                                    ->label(__('general.pages.relief'))
                                    ->default('in')
                                    ->hidden(function (Get $get): bool {
                                        if ($get('place_id') != null) {
                                            $place = Place::find($get('place_id'));
                                            return !$place->type;
                                        }
                                        return true;
                                    })
                                    ->options([
                                        'in' => __('general.form.in'),
                                        'out' => __('general.form.out'),
                                    ])
                                    ->grouped()
                                    ->inline(),
                                Select::make('place_id')
                                    ->label(__('general.pages.place'))
                                    ->disabled()
                                    ->relationship('place', 'name')
                                    ->default(fn () =>Auth::user()->place->id)
                                    ->live()
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
                                Longitude::make('longitude')
                                    ->label(__('general.gps.longitude')),
                            ]),
                        WebCam::make('img1_url')
                            ->label(__('general.form.photo', ['number' => '']))
                            ->required(),

                    ]),
            ]);
    }
}

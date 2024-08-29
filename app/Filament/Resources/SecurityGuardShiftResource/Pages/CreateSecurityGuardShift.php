<?php

namespace App\Filament\Resources\SecurityGuardShiftResource\Pages;

use App\Filament\Funcions\Logica;
use App\Filament\Resources\SecurityGuardShiftResource;
use App\Forms\Components\Latitude;
use App\Forms\Components\Longitude;
use App\Forms\Components\WebCam;
use App\Models\Detail;
use App\Models\DetailIn;
use App\Models\GuardRelief;
use App\Models\Place;
use App\Models\Relief;
use App\Models\ReliefIn;
use App\Models\ReliefOut;
use App\Models\TurnIn;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CreateSecurityGuardShift extends CreateRecord
{
    protected static string $resource = SecurityGuardShiftResource::class;

    protected static bool $canCreateAnother = false;

    //protected static string

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        //$data['user_id'] = Auth::user()->id;
        //$data['branche_id'] = Auth::user()->branche_id;
        //$place = Place::find($data['place_id']);
        //$guardRelief=GuardRelief::where('place_id',$data['place_id'])->get();
        //$guardRelief;
        //dd($guardRelief);
        //$user_in = TurnIn::where();
        //$user_in = false;
        //foreach ($place->guard_reliefs as $key => $guard_relief) {
        //    if ($guard_relief->turn_in->user_id == $data['user_id']) {
        //        $user_in = true;
        //    }
        //    if ($guard_relief->turn_out->user_id == $data['user_id']) {
        //        $user_in = true;
        //    }
        //    //dd($user_id);
        //}
        //
        //dd($user_in);
        return $data;
    }

    //protected function mutateFormDataBeforeFill(array $data): array
    //{
    //    //$data['date_time'] = Carbon::now();
    //    $data['user_id'] = Auth::user()->id;
    //    $data['branche_id'] = Auth::user()->branche_id;
    //    dd($data);
    //    return $data;
    //}

    //protected function handleRecordCreation(array $data): Model
    //{
    //    $data['user_id'] = Auth::user()->id;
    //    $data['branche_id'] = Auth::user()->branche_id;
    //    return static::getModel()::create($data);
    //}

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

        //dd($this->form->getState(),$this->data);
        $place = Place::find($this->data['place_id']);

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

        if (Count($place->guard_reliefs) > 0) {
            //$user_in = null;
            foreach ($place->guard_reliefs as $key => $guard_relief) {
                if ($guard_relief->turn_in->user_id == $this->data['user_id']) {
                    $user_in = true;
                }
                if ($guard_relief->turn_out->user_id == $this->data['user_id']) {
                    $user_in = false;
                }
                //dd($user_id);
            }
            //dd($user_in);
            try {
                if ($user_in == true) {
                    dd('relevo 1');

                    //$reliefIn = new ReliefIn();
                    //$reliefIn['security_guard_shift_id'] =$this->record->id;
                    //$reliefIn->save();
                } else if ($user_in == false) {
                    dd('relevo 2');
                    //$reliefOut = new ReliefOut();
                    //$reliefOut['security_guard_shift_id'] =$this->record->id;
                    //$reliefOut->save();
                }
                $relief = new Relief();
                //$relief['relief_in_id'] = $reliefIn->id;
                //$relief['relief_out_id'] = $reliefOut->id;
                $relief->save();
            } catch (\Throwable $th) {
                dd('el usuario no esta registrado en el puesto');
            }
        }
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
                    ->columns(2)
                    ->schema([
                        Select::make('user_id')
                            ->label(__('general.pages.employee'))
                            ->required()
                            ->afterStateUpdated(function (Set $set,$state) {
                                //dd($state);
                                $user = User::find($state);
                                //dd($user->place_id);
                                $set('place_id',$user->place_id);
                                $set('branche_id',$user->branche_id);
                            })
                            ->live()
                            ->relationship('user', 'name'),
                        Select::make('branche_id')
                            ->label(__('general.pages.branche'))
                            ->disabled()
                            ->required()
                            ->relationship('branche', 'name'),
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

<?php

namespace App\Filament\Resources\ReliefResource\Pages;

use App\Filament\Funcions\Logica;
use App\Filament\Resources\ReliefResource;
use App\Forms\Components\Latitude;
use App\Forms\Components\Longitude;
use App\Forms\Components\WebCam;
use App\Models\Detail;
use App\Models\DetailIn;
use App\Models\DetailOut;
use App\Models\ReliefIn;
use App\Models\ReliefOut;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class EditRelief extends EditRecord
{
    protected static string $resource = ReliefResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['date_time'] = Carbon::now();
        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        //dd($record);
        $detail = new Detail();
        $detail_form = $this->form->getState();
        //dd($detail_form['detail']);
        $detail['date_time'] = $this->data['date_time'];
        $detail['detail'] = $detail_form['detail'];
        $detail['latitude'] = $detail_form['latitude'];
        $detail['longitude'] = $detail_form['longitude'];
        $name_foto = (new Logica())->saveFoto($detail_form['img1_url'], 'storage/reliefs/');
        $detail['img1_url'] = "reliefs/" . $name_foto;
        //save in relief_ins/outs and detain_ins/outs
        //Save relation
        //dd($record['status']);
        if ($record['status']) {
            //Detail
            $detail->save();
            //Detail in
            $detail_in = new DetailIn();
            $detail_in['detail_id'] = $detail['id'];
            $detail_in->save();
            //Relief in
            $relief_in = new ReliefIn();
            $relief_in['user_id'] = Auth::user()['id'];
            $relief_in['detail_in_id'] = $detail_in['id'];
            $relief_in->save();
            //Update relief
            $record->update(['relief_in_id' => $relief_in['id'], 'status' => false,]);
        } else {
            //Detail
            $detail['type'] = 'out';
            $detail->save();
            //Detail out
            $detail_out = new DetailOut();
            $detail_out['detail_id'] = $detail['id'];
            $detail_out->save();
            //Relief in
            $relief_out = new ReliefOut();
            $relief_out['user_id'] = Auth::user()['id'];
            $relief_out['detail_out_id'] = $detail_out['id'];
            $relief_out->save();
            //Update
            $record->update(['relief_out_id' => $relief_out['id']]);
        }
        return $record;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')
                    //->columns(3)
                    ->schema([
                        ToggleButtons::make('status')
                            ->default('out')
                            ->options([
                                'in' => 'In',
                                'out' => 'Out',
                            ])
                            ->grouped()
                            ->inline(),
                        Fieldset::make()
                            //->columns(1)
                            ->schema([
                                //Select::make('place_id')
                                //    ->label(__('general.pages.place'))
                                //    ->relationship('place', 'name')
                                //    ->required(),
                                DateTimePicker::make('date_time')
                                    ->label(__('general.date.date_time'))
                                    ->disabled()
                                    ->default(now()),
                                //->disabled(true),
                                Textarea::make('detail')
                                    ->label(__('general.detail.detail'))
                                    ->rows(5),

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

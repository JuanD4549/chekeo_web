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
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
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
                Grid::make([
                    'default' => 3,
                ])
                    ->schema([
                        WebCam::make('img1_url')
                            ->required(),
                        Textarea::make('detail')
                            ->rows(5),
                        DateTimePicker::make('date_time')
                            ->default(Carbon::now()),
                        //->disabled(true),
                        Latitude::make('latitude'),
                        Longitude::make('longitude'),
                    ]),
            ]);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

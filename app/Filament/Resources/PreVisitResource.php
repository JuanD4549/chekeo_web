<?php

namespace App\Filament\Resources;

use App\Filament\Funcions\GeneratePin;
use App\Filament\Resources\PreVisitResource\Pages;
use App\Filament\Resources\PreVisitResource\RelationManagers;
use App\Forms\Components\WebCam;
use App\Models\PreVisit;
use App\Models\RegistrationVisit;
use DateTime;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PreVisitResource extends Resource
{
    protected static ?string $model = PreVisit::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('visit_id')
                    ->relationship('visit', 'name')
                    ->required()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->label(__('general.form.name'))
                            ->live()
                            ->required(),
                        Forms\Components\TextInput::make('ci')
                            ->label(__('general.form.ci'))
                            ->live()
                            ->required(),
                        Forms\Components\FileUpload::make('img_url')
                            ->directory('person_visit')
                            ->avatar()
                            ->getUploadedFileNameForStorageUsing(
                                fn(Get $get): string => (string) str($get('name') . 'jpg')
                                    ->prepend($get('ci') . '-'),
                            ),
                        Forms\Components\TextInput::make('cellphone')
                            ->label(__('general.form.cellphone'))
                            ->tel()
                            ->required()
                            ->maxLength(10),
                        Forms\Components\TextInput::make('info_visit')
                            ->label(__('general.form.info_visit'))
                            ->required(),
                    ]),
                Forms\Components\DateTimePicker::make('date_time_in')
                    ->required(),
                Forms\Components\Toggle::make('status')
                    ->required()
                    ->default(0),
                Forms\Components\TextInput::make('pin')
                    ->required()
                    ->numeric()
                    ->readOnly()
                    ->default((new GeneratePin())->generate()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('visit.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_time_in')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pin')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('check')
                    ->hidden(fn(PreVisit $record) => $record->status)
                    //->requiresConfirmation()
                    ->form([
                        Forms\Components\TextInput::make('pin_confirmation')
                            ->numeric()
                            ->required(),
                        WebCam::make('foto'),
                    ])
                    ->icon('heroicon-m-check-badge')
                    ->color('info')

                    ->action(function (PreVisit $record, array $data) {
                        if ($data['pin_confirmation'] == $record->pin) {
                            //dd(new DateTime($record->date_time_in));
                            $fecha1 = new DateTime($record->date_time_in);
                            $fecha2 = new DateTime();
                            if ($fecha1->format('Y-m-d') === $fecha2->format('Y-m-d')) {
                                Notification::make()
                                    ->title('Accesso Permitido')
                                    ->success()
                                    ->send();
                                $record['status'] = true;
                                $record->save();

                                $registrarionVisit = new RegistrationVisit();
                                $registrarionVisit['user_id'] = $data;
                                $registrarionVisit['branche_id'] = $data;
                                $registrarionVisit['visit_id'] = $data;
                                $registrarionVisit['date_time_in'] = new DateTime();
                            } else {
                                Notification::make()
                                    ->title('Accesso Denegado')
                                    ->body('No tiene acceso para el día de hoy.')
                                    ->danger()
                                    ->send();
                            }
                        } else {
                            Notification::make()
                                ->title('Accesso Denegado')
                                ->danger()
                                ->send();
                        }
                    }),
                Tables\Actions\EditAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPreVisits::route('/'),
            'create' => Pages\CreatePreVisit::route('/create'),
            'view' => Pages\ViewPreVisit::route('/{record}'),
            'edit' => Pages\EditPreVisit::route('/{record}/edit'),
        ];
    }
}

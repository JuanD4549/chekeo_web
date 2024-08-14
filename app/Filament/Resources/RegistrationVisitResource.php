<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegistrationVisitResource\Pages;
use App\Filament\Resources\RegistrationVisitResource\RelationManagers;
use App\Forms\Components\WebCam;
use App\Models\RegistrationVisit;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RegistrationVisitResource extends Resource
{
    protected static ?string $model = RegistrationVisit::class;

    protected static ?string $navigationIcon = 'icon-access-1';

    public static function getModelLabel(): string
    {
        return __('general.registration_visit');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.registration_visits');
    }

    public static function getNavigationLabel(): string
    {
        return __('general.registration_visits');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('general.menu.security');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('branche_id')
                    ->relationship('branche', 'name')
                    ->disabledOn('edit')
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->live()
                    ->disabledOn('edit')
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        $user = User::find($get('user_id'));
                        $set('phone', $user->cellphone ?? 'Sin celular');
                        $set('mail', $user->email ?? 'Sin correo');
                    })
                    ->required(),
                TextInput::make('phone')
                    ->hidden(fn(Get $get) => $get('user_id') == null ? true : false)
                    ->disabled(true)
                    ->live(),
                TextInput::make('mail')
                    ->hidden(fn(Get $get) => $get('user_id') == null ? true : false)
                    ->disabled(true)
                    ->live(),
                Forms\Components\Select::make('visit_id')
                    ->relationship('visit', 'name')
                    ->searchable(['name', 'ci'])
                    ->disabledOn('edit')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->required(),
                        Forms\Components\TextInput::make('cellphone')
                            ->required(),
                        Forms\Components\TextInput::make('info_visit')
                            ->required(),
                    ])
                    ->required(),
                Forms\Components\Select::make('visit_car_id')
                    ->disabledOn('edit')
                    //->hidden(fn(Get $get) => !$get('state_car'))
                    ->createOptionForm([
                        Forms\Components\TextInput::make('license_plate')
                            ->required()
                    ])
                    ->relationship('visit_car', 'license_plate'),
                Forms\Components\DateTimePicker::make('date_time_in')
                    ->disabled(true)
                    ->default(Carbon::now())
                    ->required(),
                Forms\Components\DateTimePicker::make('date_time_out')
                    ->disabled(true)
                    ->default(Carbon::now())
                    ->hiddenOn('create'),
                WebCam::make('img1_url')
                    ->disabled(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('branche.name')
                    ->numeric()
                    //->url(true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('visit.name')
                    ->numeric()
                    ->searchable(['name','ci'])
                    ->sortable(),
                Tables\Columns\TextColumn::make('visit_car.license_plate')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_time_in')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_time_out')
                    ->dateTime()
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
            //->recordUrl(
            //    //fn (Model $record): string => route('posts.edit', ['record' => $record]),
            //    false
            //)
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('close')
                    ->disabled(fn($record) => $record->date_time_out != null ? true : false)
                //->hidden(fn($record)=>$record->date_time_out!=null?true:false),
            ])
            //->paginated(false)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListRegistrationVisits::route('/'),
            'create' => Pages\CreateRegistrationVisit::route('/create'),
            'edit' => Pages\EditRegistrationVisit::route('/{record}/edit'),
        ];
    }
}

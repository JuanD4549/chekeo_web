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
        return __('general.pages.registration_visit');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.pages.registration_visits');
    }

    public static function getNavigationLabel(): string
    {
        return __('general.pages.registration_visits');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('general.menu_category.security');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('')
                    //->columns(2)
                    ->disabledOn('edit')
                    ->schema([
                        Forms\Components\Select::make('branche_id')
                            ->label(__('general.pages.branche'))
                            ->relationship('branche', 'name')
                            ->required(),
                    ]),
                Forms\Components\Section::make(__('general.form.person_destination'))
                    ->columns(3)
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label(__('general.form.name'))
                            ->relationship('user', 'name')
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set) {
                                $user = User::find($get('user_id'));
                                $set('phone', $user->cellphone ?? 'Sin celular');
                                $set('mail', $user->email ?? 'Sin correo');
                            })
                            ->disabledOn('edit')
                            ->required(),
                        TextInput::make('phone')
                            ->label(__('general.form.phone'))
                            ->hidden(fn(Get $get) => $get('user_id') == null ? true : false)
                            ->disabled(true)
                            ->live(),
                        TextInput::make('mail')
                            ->label(__('general.form.mail'))
                            ->hidden(fn(Get $get) => $get('user_id') == null ? true : false)
                            ->disabled(true)
                            ->live(),
                    ]),
                Forms\Components\Section::make(__('general.detail.detail_visit'))
                    ->columns(2)
                    ->schema([
                        Forms\Components\DateTimePicker::make('date_time_in')
                            ->label(__('general.date.date_time_in'))
                            ->disabled(true)
                            ->default(Carbon::now())
                            ->required(),
                        Forms\Components\DateTimePicker::make('date_time_out')
                            ->label(__('general.date.date_time_outup'))
                            ->disabled(true)
                            ->default(Carbon::now())
                            ->hiddenOn('create'),
                        Forms\Components\Select::make('visit_id')
                            ->label(__('general.data.data_visit'))
                            //->suffixIcon('heroicon-m-globe-alt')
                            ->relationship('visit', 'name')
                            ->searchable(['name', 'ci'])
                            ->disabledOn('edit')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->label(__('general.form.name'))
                                    ->required(),
                                Forms\Components\TextInput::make('ci')
                                    ->label(__('general.form.ci'))
                                    ->required(),
                                //Forms\Components\TextInput::make('email')
                                //    ->required(),
                                //Forms\Components\TextInput::make('cellphone')
                                //    ->required(),
                                Forms\Components\TextInput::make('info_visit')
                                    ->label(__('general.form.info_visit'))
                                    ->required(),
                            ])
                            ->required(),
                        Forms\Components\Select::make('visit_car_id')
                            ->label(__('general.pages.visit_car'))
                            ->disabledOn('edit')
                            ->searchable()
                            //->hidden(fn(Get $get) => !$get('state_car'))
                            ->createOptionForm([
                                Forms\Components\TextInput::make('license_plate')
                                    ->required()
                            ])
                            ->relationship('visit_car', 'license_plate'),
                        WebCam::make('img1_url')
                            ->label(__('general.form.photo'))
                            ->hiddenOn('edit')
                            ->disabled(false),
                        
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('branche.name')
                    ->label(__('general.pages.branche'))
                    //->url(true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('general.pages.employee'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('visit.name')
                    ->label(__('general.pages.visit'))
                    ->searchable(['name', 'ci'])
                    ->sortable(),
                Tables\Columns\TextColumn::make('visit_car.license_plate')
                    ->label(__('general.pages.visit_car'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_time_in')
                    ->label(__('general.date.date_time_in'))
                    ->dateTime('H:i:s / d-m-Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_time_out')
                    ->label(__('general.date.date_time_outup'))
                    ->dateTime('H:i:s / d-m-Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('general.table.created_at'))
                    ->dateTime('H:i:s / d-m-Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('general.table.updated_at'))
                    ->dateTime('H:i:s / d-m-Y')
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->label(__('general.table.closing'))
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
            'view' => Pages\ViewRegistrationVisit::route('/{record}'),
            'edit' => Pages\EditRegistrationVisit::route('/{record}/edit'),
        ];
    }
}

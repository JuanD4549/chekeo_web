<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegisterRoundResource\Pages;
use App\Filament\Resources\RegisterRoundResource\RelationManagers;
use App\Forms\Components\Latitude;
use App\Forms\Components\Longitude;
use App\Forms\Components\WebCam;
use App\Models\RegisterRound;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RegisterRoundResource extends Resource
{
    protected static ?string $model = RegisterRound::class;

    protected static ?string $navigationIcon = 'icon-change-avatar-4';

    public static function getModelLabel(): string
    {
        return __('general.pages.guarden_round');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.pages.guarden_rounds');
    }

    public static function getNavigationLabel(): string
    {
        return __('general.pages.guarden_rounds');
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
                    ->schema([
                        Forms\Components\Select::make('branche_id')
                            ->label(__('general.pages.branche'))
                            ->relationship('branche', 'name')
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('user_id')
                            ->label(__('general.pages.employee'))
                            ->searchable(['name', 'ci'])
                            ->relationship('user', 'name')
                            ->required(),
                        Forms\Components\Select::make('place_id')
                            ->label(__('general.pages.place'))
                            ->relationship('place', 'name')
                            ->preload()
                            ->disabledOn('edit')
                            ->required(),
                    ])
                    ->disabledOn('edit')
                    ->columns(2),
                Forms\Components\Section::make(__('general.pages.rounds'))
                    ->schema([
                        Forms\Components\Repeater::make('rounds')
                            ->label('')
                            ->columnSpanFull()
                            ->relationship('rounds')
                            //->disabled(true)
                            ->schema([

                                Forms\Components\Fieldset::make(__('general.gps.location'))
                                    ->schema([
                                        Latitude::make('latitude')
                                            ->label(__('general.gps.latitude'))
                                            ->disabledOn('edit')
                                            ->required(),
                                        Longitude::make('longitude')
                                            ->label(__('general.gps.longitude'))
                                            ->disabledOn('edit')
                                            ->required(),
                                    ]),
                                Forms\Components\FileUpload::make('img1_url')
                                    ->disabledOn('edit')
                                    ->label(__('general.form.image', ['number' => ''])),
                                Forms\Components\Textarea::make('detail')
                                    ->label(__('general.detail.detail'))
                                    ->disabledOn('edit')
                                    ->label(__('general.detail.detail')),
                            ])
                            ->addActionLabel(__('general.add.add_point'))
                            //->addable(false)
                            ->deletable(false)
                            ->disabledOn('edit')
                            ->reorderable(false)
                            ->grid(3)
                    ]),

                Forms\Components\Section::make('')
                    ->columns(1)
                    ->schema([
                        Forms\Components\DateTimePicker::make('date_time_closed')
                            ->label(__('general.date.date_time_closing')),
                        Forms\Components\Textarea::make('detail_close')
                            ->label(__('general.detail.detail_closing')),
                    ])
                    ->hiddenOn('create'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('branche.name')
                    ->label(__('general.pages.branche'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('place.name')
                    ->label(__('general.pages.place'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('general.pages.employee'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_time_closed')
                    ->label(__('general.date.date_time_closing'))
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
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->label(__('general.table.closing')),
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
            'index' => Pages\ListRegisterRounds::route('/'),
            'create' => Pages\CreateRegisterRound::route('/create'),
            'view' => Pages\ViewRegisterRound::route('/{record}'),
            'edit' => Pages\EditRegisterRound::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlaceResource\Pages;
use App\Filament\Resources\PlaceResource\RelationManagers;
use App\Models\Place;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlaceResource extends Resource
{
    protected static ?string $model = Place::class;

    protected static ?string $navigationIcon = 'icon-place';

    public static function getModelLabel(): string
    {
        return __('general.pages.place');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.pages.places');
    }

    public static function getNavigationLabel(): string
    {
        return __('general.pages.places');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('general.menu_category.my_organization');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('')
                    ->columns(3)
                    ->schema([
                        Forms\Components\ToggleButtons::make('type')
                            ->label(__('general.form.is_relief'))
                            ->boolean()
                            ->default(false)
                            ->live()
                            ->grouped(),
                        Forms\Components\Select::make('branche_id')
                            ->label(__('general.pages.branche'))
                            ->relationship('branche', 'name')
                            ->required(),
                        Forms\Components\TextInput::make('name')
                            ->label(__('general.form.name'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Repeater::make('qualifications')
                            //->relationship()
                            ->label(__('general.pages.reliefs'))
                            ->hidden(fn(Get $get): bool => !$get('type'))
                            ->columnSpanFull()
                            //->columns(1)
                            ->grid(2)
                            ->reorderableWithDragAndDrop(false)
                            ->schema([
                                Forms\Components\Section::make('')
                                    ->schema([
                                        Forms\Components\Select::make('user_id')
                                            ->label(__('general.pages.employee'))
                                            ->required(fn(Get $get): bool => !$get('type')),
                                        Forms\Components\Select::make('user_id')
                                            ->label(__('general.pages.employee'))
                                            ->required(fn(Get $get): bool => !$get('type')),
                                    ])
                                    ->columns(2),
                                Forms\Components\Select::make('user_id')
                                    ->label(__('general.form.employee_sust'))
                                    ->required(fn(Get $get): bool => !$get('type')),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('branche.name')
                    ->label(__('general.pages.branche'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('general.form.name'))
                    ->searchable(),
                Tables\Columns\IconColumn::make('type')
                    ->label(__('general.pages.relief'))
                    ->sortable()
                    ->boolean(),
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
                Tables\Actions\EditAction::make(),
            ])
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
            'index' => Pages\ListPlaces::route('/'),
            'create' => Pages\CreatePlace::route('/create'),
            'edit' => Pages\EditPlace::route('/{record}/edit'),
        ];
    }
}

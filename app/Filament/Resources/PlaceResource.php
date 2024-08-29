<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlaceResource\Pages;
use App\Filament\Resources\PlaceResource\RelationManagers;
use App\Models\Place;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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
                            ->default(false)
                            ->boolean()
                            ->live()
                            ->grouped(),
                        Forms\Components\Select::make('branche_id')
                            ->label(__('general.pages.branche'))
                            ->relationship('branche', 'name')
                            ->required(),
                        //Forms\Components\Select::make('users')
                        //    ->multiple()
                        //    ->relationship('user','name')
                        //    ->required(),
                        Forms\Components\TextInput::make('name')
                            ->label(__('general.form.name'))
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Repeater::make('guard_reliefs')
                            ->relationship()
                            ->label(__('general.pages.reliefs'))
                            ->hidden(fn(Get $get): bool => !$get('type'))
                            ->columnSpanFull()
                            //->columns(2)
                            ->grid(2)
                            ->reorderableWithDragAndDrop(false)
                            ->schema([
                                Forms\Components\Split::make([
                                    Forms\Components\Section::make('')
                                        ->relationship('turn_in')
                                        //->columns(1)
                                        ->schema([
                                            Forms\Components\Select::make('user_id')
                                                ->label(__('general.form.guard'))
                                                ->live()
                                                ->relationship('user', 'name')
                                                ->getOptionLabelFromRecordUsing(fn(Model $record) => "{$record->name} / {$record->ci}")
                                                ->required(fn(Get $get): bool => !$get('type')),
                                        ]),
                                    Forms\Components\Section::make('')
                                        ->relationship('turn_out')
                                        ->live()
                                        ->schema([
                                            Forms\Components\Select::make('user_id')
                                                ->label(__('general.form.guard'))
                                                ->relationship('user', 'name')
                                                ->required(fn(Get $get): bool => !$get('type')),
                                        ]),

                                ]),
                                Forms\Components\Select::make('user_id')
                                    ->label(__('general.form.employee_sust'))
                                    ->relationship('user', 'name')
                                    ->required(fn(Get $get): bool => !$get('type')),

                            ]),
                            //->mutateRelationshipDataBeforeSaveUsing(function (array $data, $record, Get $get): array {
                            //    $user = User::find($data['user_id']);
                            //    $user['place_id'] = $record->place_id;
                            //    //dd($user);
                            //    $user->save();
                            //    //dd($data);
                            //    return $data;
                            //}),
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
            RelationGroup::make('Contacts', [
                RelationManagers\UsersRelationManager::class,
            ]),

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

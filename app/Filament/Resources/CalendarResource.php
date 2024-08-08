<?php

namespace App\Filament\Resources;

use App\Filament\Funcions\Logica;
use App\Filament\Resources\CalendarResource\Pages;
use App\Filament\Resources\CalendarResource\RelationManagers;
use App\Models\Calendar;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class CalendarResource extends Resource
{
    protected static ?string $model = Calendar::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    //protected static ?int $navigationSort = 32;
    public static function getModelLabel(): string
    {
        return __('general.calendar');
    }
    public static function getPluralModelLabel(): string
    {
        return __('general.calendars');
    }
    public static function getNavigationLabel(): string
    {
        return __('general.calendar');
    }
    public static function getNavigationGroup(): ?string
    {
        return __('general.menu.my_organization');
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->orderBy('id', 'desc');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('range')
                ->integer(),
                Section::make()
                    ->schema([
                        Fieldset::make('monday')
                            ->label(__('general.monday'))
                            ->schema([
                                Forms\Components\TimePicker::make('monday.time_in')
                                    ->label(__('general.time_in')),
                                Forms\Components\TimePicker::make('monday.time_out')
                                    ->label(__('general.time_out')),
                            ])
                            ->columnSpan(1)
                            ->columns(1),
                        Fieldset::make('tuesday')
                            ->label(__('general.tuesday'))
                            ->schema([
                                Forms\Components\TimePicker::make('tuesday.time_in')
                                    ->label(__('general.time_in')),
                                Forms\Components\TimePicker::make('tuesday.time_out')
                                    ->label(__('general.time_out')),
                            ])
                            ->columnSpan(1)
                            ->columns(1),
                        Fieldset::make('wednesday')
                            ->label(__('general.wednesday'))
                            ->schema([
                                Forms\Components\TimePicker::make('wednesday.time_in')
                                    ->label(__('general.time_in')),
                                Forms\Components\TimePicker::make('wednesday.time_out')
                                    ->label(__('general.time_out')),
                            ])
                            ->columnSpan(1)
                            ->columns(1),
                        Fieldset::make('thursday')
                            ->label(__('general.thursday'))
                            ->schema([
                                Forms\Components\TimePicker::make('thursday.time_in')
                                    ->label(__('general.time_in')),
                                Forms\Components\TimePicker::make('thursday.time_out')
                                    ->label(__('general.time_out')),
                            ])
                            ->columnSpan(1)
                            ->columns(1),
                        Fieldset::make('friday')
                            ->label(__('general.friday'))
                            ->schema([
                                Forms\Components\TimePicker::make('friday.time_in')
                                    ->label(__('general.time_in')),
                                Forms\Components\TimePicker::make('friday.time_out')
                                    ->label(__('general.time_out')),
                            ])
                            ->columnSpan(1)
                            ->columns(1),
                        Fieldset::make('saturday')
                            ->label(__('general.saturday'))
                            ->schema([
                                Forms\Components\TimePicker::make('saturday.time_in')
                                    ->label(__('general.time_in')),
                                Forms\Components\TimePicker::make('saturday.time_out')
                                    ->label(__('general.time_out')),
                            ])
                            ->columnSpan(1)
                            ->columns(1),
                        Fieldset::make('sunday')
                            ->label(__('general.sunday'))
                            ->schema([
                                Forms\Components\TimePicker::make('sunday.time_in')
                                    ->label(__('general.time_in')),
                                Forms\Components\TimePicker::make('sunday.time_out')
                                    ->label(__('general.time_out')),
                            ]),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('monday')
                    ->label(__('general.monday'))
                    ->formatStateUsing(fn (string $state): string => (new Logica)->formateDayJson($state))
                    ->searchable(),
                Tables\Columns\TextColumn::make('tuesday')
                    ->label(__('general.tuesday'))
                    ->formatStateUsing(fn (string $state): string => (new Logica)->formateDayJson($state)),
                Tables\Columns\TextColumn::make('wednesday')
                    ->label(__('general.wednesday'))
                    ->formatStateUsing(fn (string $state): string => (new Logica)->formateDayJson($state)),
                Tables\Columns\TextColumn::make('thursday')
                    ->label(__('general.thursday'))
                    ->formatStateUsing(fn (string $state): string => (new Logica)->formateDayJson($state)),
                Tables\Columns\TextColumn::make('friday')
                    ->label(__('general.friday'))
                    ->formatStateUsing(fn (string $state): string => (new Logica)->formateDayJson($state)),
                Tables\Columns\TextColumn::make('saturday')
                    ->label(__('general.saturday'))
                    ->formatStateUsing(fn (string $state): string => (new Logica)->formateDayJson($state)),
                Tables\Columns\TextColumn::make('sunday')
                    ->label(__('general.sunday'))
                    ->formatStateUsing(fn (string $state): string => (new Logica)->formateDayJson($state)),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('general.table.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('general.table.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                //Tables\Actions\DetachAction::make(),
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
            RelationManagers\BranchesRelationManager::class,
            RelationManagers\DepartmentsRelationManager::class,
            RelationManagers\UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCalendars::route('/'),
            'create' => Pages\CreateCalendar::route('/create'),
            'edit' => Pages\EditCalendar::route('/{record}/edit'),
        ];
    }
}

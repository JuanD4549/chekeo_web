<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CalendarResource\Pages;
use App\Filament\Resources\CalendarResource\RelationManagers;
use App\Models\Calendar;
use App\Models\User;
use Filament\Forms;
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
                Forms\Components\Select::make('day')
                    ->label(__('general.table.day'))
                    ->required()
                    ->options([
                        'monday' => 'Monday',
                        'tuesday' => 'Tuesday',
                        'wednesday' => 'Wednesday',
                        'thursday' => 'Thursday',
                        'friday' => 'Friday',
                        'saturday' => 'Saturday',
                        'sunday' => 'Sunday'
                    ]),
                Forms\Components\Select::make('branches')
                    ->label(__('general.branches'))
                    ->multiple()
                    ->relationship('branches', 'name')
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('users')
                    ->label(__('general.users'))
                    ->relationship('users', 'name')
                    ->multiple()
                    ->options(fn (): Collection => User::query()
                        ->where('charge', '!=','Root')
                        ->pluck('name', 'id'))
                    ->searchable()
                    ->preload(),
                Forms\Components\TimePicker::make('time_in')
                    ->label(__('general.time_in'))
                    ->required(),
                Forms\Components\TimePicker::make('time_out')
                    ->label(__('general.time_out'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('day')
                    ->label(__('general.table.day'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('time_in')
                    ->label(__('general.table.time_in')),
                Tables\Columns\TextColumn::make('time_out')
                    ->label(__('general.table.time_out')),
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
            'index' => Pages\ListCalendars::route('/'),
            'create' => Pages\CreateCalendar::route('/create'),
            'edit' => Pages\EditCalendar::route('/{record}/edit'),
        ];
    }
}

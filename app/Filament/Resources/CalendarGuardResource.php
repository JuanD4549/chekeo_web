<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CalendarGuardResource\Pages;
use App\Models\CalendarGuard;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CalendarGuardResource extends Resource
{
    protected static ?string $model = CalendarGuard::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    //protected static ?int $navigationSort = 34;

    public static function getModelLabel(): string
    {
        return __('general.calendars_guard');
    }
    public static function getPluralModelLabel(): string
    {
        return __('general.calendars_guards');
    }
    public static function getNavigationLabel(): string
    {
        return __('general.calendars_guard');
    }
    public static function getNavigationGroup(): ?string
    {
        return __('general.menu.my_organization');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('branche_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('day')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('time_in')
                    ->required(),
                Forms\Components\TextInput::make('time_out'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('branche_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day')
                    ->searchable(),
                Tables\Columns\TextColumn::make('time_in'),
                Tables\Columns\TextColumn::make('time_out'),
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
            'index' => Pages\ListCalendarGuards::route('/'),
            'create' => Pages\CreateCalendarGuard::route('/create'),
            'edit' => Pages\EditCalendarGuard::route('/{record}/edit'),
        ];
    }
}

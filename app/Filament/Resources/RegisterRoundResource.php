<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegisterRoundResource\Pages;
use App\Filament\Resources\RegisterRoundResource\RelationManagers;
use App\Models\RegisterRound;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RegisterRoundResource extends Resource
{
    protected static ?string $model = RegisterRound::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('branche_id')
                    ->relationship('branche', 'name')
                    ->disabledOn('edit')
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('place_id')
                    ->relationship('place', 'name')
                    ->preload()
                    ->disabledOn('edit')
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->searchable(['name', 'ci'])
                    ->relationship('user', 'name')
                    ->disabledOn('edit')
                    ->required(),
                Forms\Components\DateTimePicker::make('date_time_closed')
                    ->hiddenOn('create'),
                Forms\Components\Textarea::make('detail_close')
                    ->hiddenOn('create')
                    ->columnSpanFull(),
                    Forms\Components\Repeater::make('rounds')
                    ->relationship('rounds')
                    ->schema([
                        Forms\Components\TextInput::make('latitude')
                            ->required(),
                        
                        // ...
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('branche.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('place.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_time_closed')
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
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListRegisterRounds::route('/'),
            'create' => Pages\CreateRegisterRound::route('/create'),
            'view' => Pages\ViewRegisterRound::route('/{record}'),
            'edit' => Pages\EditRegisterRound::route('/{record}/edit'),
        ];
    }
}

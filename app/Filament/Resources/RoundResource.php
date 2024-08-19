<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoundResource\Pages;
use App\Filament\Resources\RoundResource\RelationManagers;
use App\Forms\Components\Latitude;
use App\Forms\Components\Longitude;
use App\Models\Round;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoundResource extends Resource
{
    protected static ?string $model = Round::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path-rounded-square';

    public static function getModelLabel(): string
    {
        return __('general.pages.round');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.pages.rounds');
    }

    public static function getNavigationLabel(): string
    {
        return __('general.pages.rounds');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('general.menu_category.my_sources');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('register_round_id')
                    ->label(__('general.pages.round'))
                    ->relationship('register_round', 'id')
                    //->searchable(['id'])
                    ->required(),
                Latitude::make('latitude')
                    ->label(__('general.gps.latitude')),
                Longitude::make('longitude')
                    ->label(__('general.gps.longitude')),

                Forms\Components\FileUpload::make('img1_url')
                    ->required()
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('register_round_id')
                    ->label(__('general.pages.round'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('latitude')
                    ->label(__('general.gps.latitude'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('longitude')
                    ->label(__('general.gps.longitude'))
                    ->numeric()
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
            'index' => Pages\ListRounds::route('/'),
            'create' => Pages\CreateRound::route('/create'),
            'view' => Pages\ViewRound::route('/{record}'),
            'edit' => Pages\EditRound::route('/{record}/edit'),
        ];
    }
}

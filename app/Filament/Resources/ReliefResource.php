<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReliefResource\Pages;
use App\Filament\Resources\ReliefResource\RelationManagers;
use App\Models\Relief;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReliefResource extends Resource
{
    protected static ?string $model = Relief::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?int $navigationSort = 3;

    public static function getModelLabel(): string
    {
        return __('general.relief');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.reliefs');
    }

    public static function getNavigationLabel(): string
    {
        return __('general.reliefs');
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
                    ->required(),
                Forms\Components\Select::make('relief_in_id')
                    ->relationship('relief_in', 'id'),
                Forms\Components\Select::make('relief_out_id')
                    ->relationship('relief_out', 'id'),
                Forms\Components\Toggle::make('status')
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('branche.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('relief_in.user.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('relief_out.user.name')
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListReliefs::route('/'),
            'create' => Pages\CreateRelief::route('/create'),
            'edit' => Pages\EditRelief::route('/{record}/edit'),
            'view'=>Pages\ViewRelief::route('/{record}')
        ];
    }
}

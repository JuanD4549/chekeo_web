<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NoveltyResource\Pages;
use App\Filament\Resources\NoveltyResource\RelationManagers;
use App\Models\Novelty;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NoveltyResource extends Resource
{
    protected static ?string $model = Novelty::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function getModelLabel(): string
    {
        return __('general.pages.novelty');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.pages.novelties');
    }

    public static function getNavigationLabel(): string
    {
        return __('general.pages.novelties');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('general.menu_category.my_sources');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('catalog_novelty_id')
                    ->label(__('general.pages.catalog_novelty'))
                    ->relationship('catalog_novelty', 'name')
                    ->preload(),
                Forms\Components\TextInput::make('name')
                    ->label(__('general.pages.novelty'))
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('catalog_novelty.name')
                    ->label(__('general.pages.catalog_novelty'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('general.pages.novelty'))
                    ->searchable(),
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
            'index' => Pages\ListNovelties::route('/'),
            'create' => Pages\CreateNovelty::route('/create'),
            'edit' => Pages\EditNovelty::route('/{record}/edit'),
        ];
    }
}

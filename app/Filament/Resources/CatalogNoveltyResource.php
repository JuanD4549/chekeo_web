<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CatalogNoveltyResource\Pages;
use App\Filament\Resources\CatalogNoveltyResource\RelationManagers;
use App\Models\CatalogNovelty;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CatalogNoveltyResource extends Resource
{
    protected static ?string $model = CatalogNovelty::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function getModelLabel(): string
    {
        return __('general.pages.catalog_novelty');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.pages.catalog_novelties');
    }

    public static function getNavigationLabel(): string
    {
        return __('general.pages.catalog_novelties');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('general.menu_category.my_sources');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('general.form.name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\Repeater::make('novelties')
                    ->label(__('general.pages.novelties'))
                    ->relationship()
                    ->simple(
                        Forms\Components\TextInput::make('name')
                            ->label(__('general.form.name'))
                            ->required(),
                    )
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('general.form.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('novelties.name')
                    //->listWithLineBreaks()
                    ->limitList(4)
                    ->badge()
                    //->expandableLimitedList()
                    //->lineClamp(2)
                    //->wrap()
                    ->label(__('general.pages.novelties'))
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
            'index' => Pages\ListCatalogNovelties::route('/'),
            'create' => Pages\CreateCatalogNovelty::route('/create'),
            'edit' => Pages\EditCatalogNovelty::route('/{record}/edit'),
        ];
    }
}

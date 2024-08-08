<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RepresentativeResource\Pages;
use App\Filament\Resources\RepresentativeResource\RelationManagers;
use App\Models\Representative;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RepresentativeResource extends Resource
{
    protected static ?string $model = Representative::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function getModelLabel(): string
    {
        return __('general.representative');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.representatives');
    }

    public static function getNavigationLabel(): string
    {
        return __('general.representatives');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('general.menu.my_organization');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('ci')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('cellphone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('mail')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ci')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cellphone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mail')
                    ->searchable(),
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
            'index' => Pages\ListRepresentatives::route('/'),
            'create' => Pages\CreateRepresentative::route('/create'),
            'edit' => Pages\EditRepresentative::route('/{record}/edit'),
        ];
    }
}

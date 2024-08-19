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
        return __('general.pages.representative');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.pages.representatives');
    }

    public static function getNavigationLabel(): string
    {
        return __('general.pages.representatives');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('general.menu_category.my_organization');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('general.form.name'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('ci')
                            ->label(__('general.form.ci'))
                            ->required()
                            ->maxLength(10),
                        Forms\Components\TextInput::make('cellphone')
                            ->label(__('general.form.cellphone'))
                            ->tel()
                            ->required()
                            ->maxLength(10),
                        Forms\Components\TextInput::make('mail')
                            ->label(__('general.form.mail'))
                            ->required()
                            ->email(),
                        Forms\Components\Repeater::make('representativeUsers')
                            ->relationship()
                            ->label(__('general.form.children'))
                            ->schema([
                                Forms\Components\Select::make('user_id')
                                ->relationship('user', 'name')
                            ])
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('general.form.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('ci')
                    ->label(__('general.form.ci'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('cellphone')
                    ->label(__('general.form.cellphone'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('mail')
                    ->label(__('general.form.mail'))
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
            'index' => Pages\ListRepresentatives::route('/'),
            'create' => Pages\CreateRepresentative::route('/create'),
            'edit' => Pages\EditRepresentative::route('/{record}/edit'),
        ];
    }
}

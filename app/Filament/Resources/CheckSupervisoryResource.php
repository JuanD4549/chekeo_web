<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CheckSupervisoryResource\Pages;
use App\Filament\Resources\CheckSupervisoryResource\RelationManagers;
use App\Models\CheckSupervisory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CheckSupervisoryResource extends Resource
{
    protected static ?string $model = CheckSupervisory::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';

    public static function getModelLabel(): string
    {
        return __('general.pages.check_supervisory');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.pages.check_supervisories');
    }

    public static function getNavigationLabel(): string
    {
        return __('general.pages.check_supervisories');
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('general.form.name'))
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
                    //Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCheckSupervisories::route('/'),
            'create' => Pages\CreateCheckSupervisory::route('/create'),
            'edit' => Pages\EditCheckSupervisory::route('/{record}/edit'),
        ];
    }
}

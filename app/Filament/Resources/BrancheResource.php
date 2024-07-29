<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrancheResource\Pages;
use App\Filament\Resources\BrancheResource\RelationManagers;
use App\Models\Branche;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class BrancheResource extends Resource
{
    protected static ?string $model = Branche::class;
    //protected static ?string $navigationGroup = 'My Organization';

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    public static function getModelLabel(): string
    {
        return __('general.branche');
    }
    public static function getPluralModelLabel(): string
    {
        return __('general.branches');
    }
    public static function getNavigationLabel(): string
    {
        return __('general.branche');
    }
    public static function getNavigationGroup(): ?string
    {
        return __('general.menu.my_organization');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Data branch')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('address')
                            ->maxLength(255),
                        Forms\Components\Toggle::make('status')
                            ->default(true),
                    ]),
                Forms\Components\Select::make('user_id')
                    ->options(
                        fn (): Collection => User::query()
                            ->where('charge', 'Boss')
                            ->pluck('name', 'id')
                    )
                    ->label('Boss')
                    ->searchable()
                    ->preload()
                    ->live()
                    //->relationship('user', 'name')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('enterprise.name')
                    ->numeric()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Boss')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
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
            RelationManagers\DepartmentsRelationManager::class,
            RelationManagers\UsersRelationManager::class,
            RelationManagers\CalendarsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBranches::route('/'),
            'create' => Pages\CreateBranche::route('/create'),
            'edit' => Pages\EditBranche::route('/{record}/edit'),
        ];
    }
}

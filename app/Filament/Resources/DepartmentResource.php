<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentResource\Pages;
use App\Filament\Resources\DepartmentResource\RelationManagers;
use App\Models\Department;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;
    //protected static ?string $navigationGroup = 'My Organization';
    protected static ?string $navigationIcon = 'heroicon-o-cube-transparent';
    //protected static ?int $navigationSort = 35;
    public static function getModelLabel(): string
    {
        return __('general.pages.department');
    }
    public static function getPluralModelLabel(): string
    {
        return __('general.pages.departments');
    }
    public static function getNavigationLabel(): string
    {
        return __('general.pages.department');
    }
    public static function getNavigationGroup(): ?string
    {
        return __('general.menu_category.my_organization');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('branche_id')
                    ->label(__('general.pages.branche'))
                    ->relationship('branche', 'name')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('user_id')
                    ->label(__('general.pages.employee'))
                    ->label(__('general.form.boss'))
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('calendar_id')
                    ->label(__('general.pages.calendar'))
                    ->relationship('calendar', 'name'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //Tables\Columns\TextColumn::make('branche.name')
                //->label(__('general.pages.branche'))
                //->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('general.pages.department'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('general.form.boss'))
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
            RelationManagers\EmployeesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartment::route('/create'),
            'edit' => Pages\EditDepartment::route('/{record}/edit'),
        ];
    }
}

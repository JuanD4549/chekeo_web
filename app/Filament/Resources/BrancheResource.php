<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Branche;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BrancheResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BrancheResource\RelationManagers;
use App\Models\Employee;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Split;

class BrancheResource extends Resource
{
    protected static ?string $model = Branche::class;
    //protected static ?string $navigationGroup = 'My Organization';
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    //protected static ?int $navigationSort = 31;
    public static function getModelLabel(): string
    {
        return __('general.pages.branche');
    }
    public static function getPluralModelLabel(): string
    {
        return __('general.pages.branches');
    }
    public static function getNavigationLabel(): string
    {
        return __('general.pages.branche');
    }
    public static function getNavigationGroup(): ?string
    {
        return __('general.menu_category.my_organization');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('general.data.data_branche'))
                    //->columns(3)
                    ->schema([
                        Split::make([
                            Section::make([
                                Forms\Components\Toggle::make('status')
                                    ->label(__('general.form.status'))
                                    ->default(true),
                            ])->grow(false),
                            Section::make([
                                Forms\Components\TextInput::make('name')
                                    ->label(__('general.form.name'))
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Select::make('employee_id')
                                    ->label(__('general.form.boss'))
                                    ->relationship('employee', 'name')
                                    ->options(
                                        fn(): Collection => Employee::query()
                                            //->where('id', '!=', $get('user_id'))
                                            ->where('charge', 'Boss')
                                            ->pluck('name', 'id')
                                    )
                                    ->searchable()
                                    ->preload()
                                    ->live()
                                    //->relationship('user', 'name')
                                    ->required(),
                                Forms\Components\Select::make('calendar_id')
                                    ->label(__('general.pages.calendar'))
                                    ->relationship('calendar', 'id')
                                    ->preload(),

                                Forms\Components\TextInput::make('address')
                                    ->label(__('general.form.address'))
                                    ->maxLength(255),
                            ])
                                ->columns(2),
                        ])->from('md'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('enterprise.name')
                    ->label(__('general.pages.enterprise'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('general.form.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('general.form.boss'))
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->label(__('general.form.status'))
                    ->boolean(),
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
            RelationManagers\DepartmentsRelationManager::class,
            RelationManagers\EmployeesRelationManager::class,
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

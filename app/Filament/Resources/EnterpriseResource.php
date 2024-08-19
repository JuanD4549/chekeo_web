<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EnterpriseResource\Pages;
use App\Filament\Resources\EnterpriseResource\RelationManagers;
use App\Models\Enterprise;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EnterpriseResource extends Resource
{
    protected static ?string $model = Enterprise::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    //protected static ?int $navigationSort = 61;

    public static function getModelLabel(): string
    {
        return __('general.pages.enterprise');
    }
    public static function getPluralModelLabel(): string
    {
        return __('general.pages.enterprises');
    }
    public static function getNavigationLabel(): string
    {
        return __('general.pages.enterprise');
    }
    public static function getNavigationGroup(): ?string
    {
        return __('general.menu_category.settings');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('')
                    ->columns(3)
                    ->schema([
                        Forms\Components\FileUpload::make('img_url')
                            ->label(__('general.form.photo', ['number' => '']))
                            ->required()
                            ->image()
                            ->imageEditor(),
                        Forms\Components\TextInput::make('name')
                            ->label(__('general.form.name'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('ruc')
                            ->label(__('general.form.ruc'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('cellphone')
                            ->label(__('general.form.cellphone'))
                            ->required()
                            ->maxLength(10),
                        Forms\Components\TextInput::make('address')
                            ->label(__('general.form.address'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('legal_representative')
                            ->label(__('general.form.legal_representative'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label(__('general.form.mail'))
                            ->email()
                            ->required()
                            ->maxLength(255),
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
                Tables\Columns\TextColumn::make('ruc')
                    ->label(__('general.form.ruc'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('legal_representative')
                    ->label(__('general.form.legal_representative'))
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
            RelationManagers\BranchesRelationManager::class,
            //RelationManagers\DepartmentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEnterprises::route('/'),
            'create' => Pages\CreateEnterprise::route('/create'),
            'edit' => Pages\EditEnterprise::route('/{record}/edit'),
        ];
    }
}

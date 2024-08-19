<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccessResource\Pages;
use App\Filament\Resources\AccessResource\RelationManagers;
use App\Models\Access;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class AccessResource extends Resource
{
    protected static ?string $model = Access::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function getModelLabel(): string
    {
        return __('general.pages.access');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.pages.accesses');
    }

    public static function getNavigationLabel(): string
    {
        return __('general.pages.accesses');
    }

    //public static function getNavigationParentItem(): ?string
    //{
    //    return __('general.menu_category.access');
    //}
    public static function getNavigationGroup(): ?string
    {
        return __('general.menu_category.my_sources');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('branche_id')
                    //->default(Auth::user()->branche_id)
                    ->relationship('branche', 'name')
                    ->disabledOn('edit')
                    ->required(),
                Forms\Components\Select::make('user_id')
                            ->label(__('general.pages.employee'))
                    //->autofocus()
                    ->relationship('user', 'name')
                    ->searchable(['name', 'ci'])
                    ->disabledOn('edit')
                    ->required(),
                Forms\Components\DateTimePicker::make('date_time_in')
                    ->default(Carbon::now())
                    ->disabledOn('edit')
                    ->required(),
                Forms\Components\DateTimePicker::make('date_time_out')
                            ->label(__('general.date.date_time_outup'))
                    ->hiddenOn('create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('branche.name')
                    ->label(__('general.pages.branche'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                ->label(__('general.pages.employee'))
                    ->sortable(),
                 Tables\Columns\TextColumn::make('date_time_in')
                    ->label(__('general.date.date_time_in'))
                    ->sortable(),
                 Tables\Columns\TextColumn::make('date_time_out')
                    ->label(__('general.date.date_time_outup'))
                    ->sortable(),
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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListAccesses::route('/'),
            'create' => Pages\CreateAccess::route('/create'),
            'view' => Pages\ViewAccess::route('/{record}'),
            'edit' => Pages\EditAccess::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Personal\Resources;

use App\Filament\Personal\Resources\SecurityGuardShiftResource\Pages;
use App\Filament\Personal\Resources\SecurityGuardShiftResource\RelationManagers;
use App\Forms\Components\Latitude;
use App\Forms\Components\Longitude;
use App\Forms\Components\WebCam;
use App\Models\SecurityGuardShift;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SecurityGuardShiftResource extends Resource
{
    protected static ?string $model = SecurityGuardShift::class;

    protected static ?string $navigationIcon = 'icon-guard';
    protected static ?int $navigationSort = 3;

    public static function getModelLabel(): string
    {
        return __('general.pages.security_guard_shift');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.pages.security_guard_shifts');
    }

    public static function getNavigationLabel(): string
    {
        return __('general.pages.security_guard_shift');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('general.menu_category.security');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Toggle::make('status')
                    ->required(),
                Forms\Components\Select::make('place_id')
                    ->relationship('place', 'name'),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //Tables\Columns\TextColumn::make('branche.name')
                //    ->label(__('general.pages.branche'))
                //    ->sortable(),
                Tables\Columns\TextColumn::make('id')
                    ->label(__('general.table.branche_place'))
                    ->formatStateUsing(function (string $state, \App\Models\SecurityGuardShift $relief): string {
                        //dd($relief);
                        return $relief->branche->name . ' - ' . $relief->place->name;
                    }),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('general.pages.employee'))
                    ->sortable(),
                //Tables\Columns\IconColumn::make('status')
                //    ->label(__('general.form.status'))
                //    ->boolean(),
                Tables\Columns\TextColumn::make('detail_in.detail.date_time')
                    ->label(__('general.form.in'))
                    ->dateTime('H:i:s / d-m-Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('detail_out.detail.date_time')
                    ->label(__('general.form.out'))
                    ->dateTime('H:i:s / d-m-Y')
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
                Tables\Actions\EditAction::make()
                    ->label(__('general.table.closing')),
            ])
            ->headerActions([
                //
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
            //RelationManagers\DataSecurityGuardShiftsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSecurityGuardShifts::route('/'),
            'create' => Pages\CreateSecurityGuardShift::route('/create'),
            'view' => Pages\ViewSecurityGuardShift::route('/{record}'),
            'edit' => Pages\EditSecurityGuardShift::route('/{record}/edit'),
        ];
    }
}

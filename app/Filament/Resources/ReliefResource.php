<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReliefResource\Pages;
use App\Filament\Resources\ReliefResource\RelationManagers;
use App\Models\Relief;
use App\Models\ReliefIn;
use DateTime;
use DateTimeImmutable;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class ReliefResource extends Resource
{
    protected static ?string $model = Relief::class;

    protected static ?string $navigationIcon = 'icon-guard2';
    protected static ?int $navigationSort = 3;

    public static function getModelLabel(): string
    {
        return __('general.pages.relief');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.pages.reliefs');
    }

    public static function getNavigationLabel(): string
    {
        return __('general.pages.reliefs');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('general.menu_category.security');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('branche_id')
                    ->label(__('general.pages.branche'))
                    ->relationship('branche', 'name')
                    ->required(),
                Forms\Components\Select::make('relief_in_id')
                    ->label(__('general.form.in'))
                    ->relationship('relief_in', 'id'),
                Forms\Components\Select::make('relief_out_id')
                    ->label(__('general.form.out'))
                    ->relationship('relief_out', 'id'),
                Forms\Components\Toggle::make('status')
                    ->label(__('general.form.status'))
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('general.table.branche_place'))
                    ->formatStateUsing(function (string $state, \App\Models\Relief $relief): string {
                        //dd($relief);
                        return $relief->branche->name . ' - ' . $relief->place->name;
                    }),
                //Tables\Columns\TextColumn::make('place.name')
                //    ->label(__('general.pages.place'))
                //    ->sortable(),
                Tables\Columns\TextColumn::make('relief_in')
                    ->formatStateUsing(fn($state): string => $state->user->name)
                    //->default(fn($state): string => $state->user->name)
                    //->state(fn($state): string =>  '')
                    ->description(function ($state): string {
                        $date = new DateTime($state->detail_in->detail->date_time ?? '');
                        $fecha = $date->format('d-m-Y');
                        $hora = $date->format('H:i:s');
                        return $hora . ' / ' . $fecha;
                    })

                    ->label(__('general.form.in')),
                Tables\Columns\TextColumn::make('relief_out')
                    ->label(__('general.form.out'))
                    ->formatStateUsing(fn($state): string => $state->user->name)
                    ->description(function ($state): string {
                        $date = new DateTime($state->detail_out->detail->date_time ?? '');
                        $fecha = $date->format('d-m-Y');
                        $hora = $date->format('H:i:s');
                        return $hora . ' / ' . $fecha;
                    }),
                //Tables\Columns\IconColumn::make('status')
                //    ->label(__('general.form.status'))
                //    ->boolean(),
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
            'index' => Pages\ListReliefs::route('/'),
            'create' => Pages\CreateRelief::route('/create'),
            'edit' => Pages\EditRelief::route('/{record}/edit'),
            'view' => Pages\ViewRelief::route('/{record}')
        ];
    }
}

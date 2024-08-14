<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NoveltyRegistrationResource\Pages;
use App\Filament\Resources\NoveltyRegistrationResource\RelationManagers;
use App\Forms\Components\Latitude;
use App\Forms\Components\Longitude;
use App\Models\CatalogNovelty;
use App\Models\Novelty;
use App\Models\NoveltyRegistration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NoveltyRegistrationResource extends Resource
{
    protected static ?string $model = NoveltyRegistration::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('general.registration_novelty');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.registration_novelties');
    }

    public static function getNavigationLabel(): string
    {
        return __('general.registration_novelties');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('general.menu.security');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('branche_id')
                    ->relationship('branche', 'name')
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('user_notificad_id')
                    ->relationship('user_notificad', 'name')
                    ->required(),
                Forms\Components\Select::make('novelty_id')
                    //->relationship('novelties', 'name')
                    ->options(function () {
                        $catalogo_novelty = CatalogNovelty::where('name', 'Seguridad')->first();
                        return Novelty::where('catalog_novelty_id', $catalogo_novelty->id ?? 0)->pluck('name', 'id');
                    })
                    ->required(),
                Latitude::make('latitude'),
                Longitude::make('longitude'),
                Forms\Components\Textarea::make('detail_created')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('date_time_close')
                    ->hiddenOn('create'),
                Forms\Components\Textarea::make('detail_closed')
                    ->hiddenOn('create')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('img1_url')
                    ->maxLength(255),
                Forms\Components\TextInput::make('img2_url')
                    ->maxLength(255),
                Forms\Components\TextInput::make('img3_url')
                    ->maxLength(255),
                Forms\Components\TextInput::make('img4_url')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('branche.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user_notificad.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('novelty.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_time_close')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListNoveltyRegistrations::route('/'),
            'create' => Pages\CreateNoveltyRegistration::route('/create'),
            'view' => Pages\ViewNoveltyRegistration::route('/{record}'),
            'edit' => Pages\EditNoveltyRegistration::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NoveltyRegistrationResource\Pages;
use App\Filament\Resources\NoveltyRegistrationResource\RelationManagers;
use App\Models\NoveltyRegistration;
use Carbon\Carbon;
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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('branche_id')
                    ->relationship('branche', 'name')
                    ->disabledOn('edit')
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->disabledOn('edit')
                    ->required(),
                Forms\Components\Select::make('user_notificad_id')
                    ->label('Notificar a')
                    ->relationship('user', 'name')
                    ->disabledOn('edit')
                    ->required(),
                Forms\Components\Select::make('catalog_novelty_id')
                    ->searchable()
                    ->preload()
                    ->relationship('catalog_novelty', 'name')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                    ])
                    ->disabledOn('edit')
                    ->required(),
                Forms\Components\Textarea::make('detail_created')
                    ->disabledOn('edit')
                    ->maxLength(500),
                Forms\Components\DateTimePicker::make('date_time_close')
                    ->default(Carbon::now())
                    ->hiddenOn('create'),
                Forms\Components\Textarea::make('detail_closed')
                    ->hiddenOn('create')
                    ->maxLength(500),
                Forms\Components\FileUpload::make('img1_url')
                    ->disabledOn('edit')
                    ->image(),
                Forms\Components\FileUpload::make('img2_url')
                    ->image()
                    ->disabledOn('edit')
                    ->imageEditor(),
                Forms\Components\FileUpload::make('img3_url')
                    ->disabledOn('edit'),
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
                Tables\Columns\TextColumn::make('catalog_novelty.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                //->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('date_time_close')
                    ->dateTime()
                    ->sortable(),
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
                Tables\Actions\EditAction::make()
                    ->hidden(fn($record) => $record->date_time_close != null),
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

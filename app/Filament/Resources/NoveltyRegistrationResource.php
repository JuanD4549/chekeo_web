<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NoveltyRegistrationResource\Pages;
use App\Filament\Resources\NoveltyRegistrationResource\RelationManagers;
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
                    ->label('Notificar a')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Textarea::make('detail_created')
                    ->maxLength(255),
                Forms\Components\TimePicker::make('date_time_close'),
                Forms\Components\Textarea::make('detail_closed')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('img1_url')
                    ->required()
                    ->image(),
                Forms\Components\FileUpload::make('img2_url')
                    ->required()
                    ->image()
                    ->imageEditor(),
                Forms\Components\FileUpload::make('img3_url')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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

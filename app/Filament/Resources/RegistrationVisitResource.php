<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegistrationVisitResource\Pages;
use App\Filament\Resources\RegistrationVisitResource\RelationManagers;
use App\Forms\Components\WebCam;
use App\Models\RegistrationVisit;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RegistrationVisitResource extends Resource
{
    protected static ?string $model = RegistrationVisit::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->live()
                    ->disabledOn('edit')
                    ->afterStateUpdated(function (Get $get, Set $set) {})
                    ->required(),
                TextInput::make('phone')
                    ->live(),
                TextInput::make('mail')
                    ->live(),
                Forms\Components\Select::make('branche_id')
                    ->relationship('branche', 'name')
                    ->disabledOn('edit')
                    ->required(),
                Forms\Components\Select::make('visit_id')
                    ->relationship('visit', 'name')
                    ->disabledOn('edit')
                    ->required(),
                Forms\Components\Toggle::make('state_car')
                    ->disabledOn('edit')
                    ->live(),
                Forms\Components\Select::make('visit_car_id')
                    ->disabledOn('edit')
                    ->hidden(fn(Get $get)=>$get('state_car'))
                    ->relationship('visit_car', 'id'),
                Forms\Components\DateTimePicker::make('date_time_in')
                    ->disabledOn('edit')
                    ->required(),
                Forms\Components\DateTimePicker::make('date_time_out')
                    ->hiddenOn('create'),
                WebCam::make('img1_url'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('branche.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('visit.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('visit_car.license_plate')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_time_in')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_time_out')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('img1_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('img2_url')
                    ->searchable(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRegistrationVisits::route('/'),
            'create' => Pages\CreateRegistrationVisit::route('/create'),
            'edit' => Pages\EditRegistrationVisit::route('/{record}/edit'),
        ];
    }
}

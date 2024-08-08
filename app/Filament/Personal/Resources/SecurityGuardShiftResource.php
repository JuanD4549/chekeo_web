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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make([
                    'default' => 3,
                ])
                    ->schema([
                        WebCam::make('img1_url')
                            ->required(),
                        Textarea::make('detail')
                            ->rows(5),
                        DateTimePicker::make('date_time')
                            ->default(Carbon::now())
                            ->disabled(true),
                        Latitude::make('latitude'),
                        Longitude::make('longitude'),
                    ]),
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
                Tables\Columns\TextColumn::make('place_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('detail_in.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('detail_out.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
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
            'index' => Pages\ListSecurityGuardShifts::route('/'),
            'create' => Pages\CreateSecurityGuardShift::route('/create'),
            'edit' => Pages\EditSecurityGuardShift::route('/{record}/edit'),
        ];
    }
}

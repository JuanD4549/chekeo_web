<?php

namespace App\Filament\Resources\SecurityGuardShiftResource\RelationManagers;

use App\Models\DataSecurityGuardShift;
use App\Models\SecurityGuardShift;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DataSecurityGuardShiftsRelationManager extends RelationManager
{
    protected static string $relationship = 'data_security_guard_shifts';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('type')
                    ->required()
                    ->maxLength(255)
                    ->default('in'),
                Forms\Components\DateTimePicker::make('date_time')
                    //->default(Carbon::now())
                    ->required(),
                Forms\Components\Textarea::make('detail')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('latitude')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('longitude')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('img1_url')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('img2_url')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('date_time')
            ->columns([
                Tables\Columns\TextColumn::make('type'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->createAnother(false)
                    ->hidden(function () {
                        $count = SecurityGuardShift::where('id', $this->ownerRecord->id)
                            ->withCount('data_security_guard_shifts')
                            ->pluck('data_security_guard_shifts_count')
                            ->first();
                        return $count >= 2;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SecurityGuardShiftResource\Pages;
use App\Filament\Resources\SecurityGuardShiftResource\RelationManagers;
use App\Models\SecurityGuardShift;
use Filament\Forms;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SecurityGuardShiftResource extends Resource
{
    protected static ?string $model = SecurityGuardShift::class;
    //protected static ?string $navigationGroup = 'Security';
    //protected static ?int $navigationSort = 2;
    //protected static ?string $navigationLabel = 'Turn';

    //protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\Select::make('user_id')
                //     ->relationship('user', 'name')
                //     ->required(),
                Forms\Components\DateTimePicker::make('date_time_in')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('date_time_out')
                    ->hiddenOn('create'),
                Forms\Components\Select::make('turn')
                    ->required()
                    ->options([
                        'morning' => 'Mornig',
                        'evening' => 'Evening',
                        'night' => 'Night',
                    ]),
                Forms\Components\Select::make('type')
                    ->required()
                    ->options([
                        '12' => '12',
                        '24' => '24',
                    ]),
                Forms\Components\Textarea::make('detail')
                    ->columnSpanFull()
                    ->live(),
                Forms\Components\TextInput::make('latitude_in')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('longitude_in')
                    ->required()
                    ->numeric(),
                ViewField::make('img1_url_in')
                    ->view('forms.components.web-cam')
                    ->label('Foto')
                    ->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_time_in')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_time_out')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('turn')
                    ->searchable(),
                Tables\Columns\TextColumn::make('latitude_in')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('longitude_in')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
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

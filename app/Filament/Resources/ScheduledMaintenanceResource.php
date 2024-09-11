<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduledMaintenanceResource\Pages;
use App\Filament\Resources\ScheduledMaintenanceResource\RelationManagers;
use App\Models\ScheduledMaintenance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ScheduledMaintenanceResource extends Resource
{
    protected static ?string $model = ScheduledMaintenance::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\ToggleButtons::make('active')
                    ->label('Is active?')
                    ->default(true)
                    ->boolean()
                    ->grouped(),
                Forms\Components\Section::make('order_work')
                    ->schema([
                        Forms\Components\ToggleButtons::make('priority')
                            ->required()
                            ->options([
                                'high' => 'Alta',
                                'medium' => 'Media',
                                'low' => 'Baja',
                            ])
                            ->colors([
                                'high' => 'danger',
                                'medium' => 'warning',
                                'low' => 'success',
                            ])
                            ->icons([
                                'high' => 'heroicon-o-pencil',
                                'medium' => 'heroicon-o-clock',
                                'low' => 'heroicon-o-check-circle',
                            ])
                            ->inline()
                            ->inlineLabel(false)
                            ->default('medium'),
                        Forms\Components\Select::make('site_id')
                            ->relationship('site', 'name')
                            ->required(),
                        Forms\Components\Repeater::make('scheduled_maintenance_user')
                            ->relationship()
                            ->schema([
                                Forms\Components\Select::make('user_id')
                                    ->relationship('user', 'name')
                                    ->required(),
                                Forms\Components\Checkbox::make('leader')
                                    ->inline()
                                    //->prohibitedIf('leader', false)
                                    ->default(true)
                                    ->fixIndistinctState(),
                            ])
                            ->minItems(1)
                            ->grid(3)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description')
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Radio::make('type')
                    ->label('Select format')
                    ->inline()
                    ->live()
                    ->columnSpanFull()
                    ->default('daily')
                    ->options([
                        'daily' => 'daily',
                        'weekly' => 'weekly',
                        'monthly' => 'monthly',
                    ]),
                Forms\Components\Section::make('')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('pass_time')
                            ->hidden(fn(Get $get): bool => $get('type') == 'monthly')
                            ->columnSpan(1)
                            ->required()
                            ->numeric()
                            ->default(1),
                        Forms\Components\Repeater::make('in_day_time')
                            ->simple(
                                Forms\Components\TimePicker::make('time')
                                    ->required(),
                            )
                            ->reorderable(false)
                            ->defaultItems(1)
                            ->minItems(1),
                        Forms\Components\Select::make('months')
                            ->hidden(fn(Get $get): bool => $get('type') != 'monthly')
                            ->multiple()
                            ->options([
                                'enery' => 'enery',
                                'febrery' => 'febrery',
                                'tusday' => 'tusday',
                            ]),
                        Forms\Components\Checkbox::make('for_days')->inline()
                            ->hidden(fn(Get $get): bool => $get('type') != 'monthly')
                            ->default(true)
                            ->live(),
                        Forms\Components\Select::make('the')
                            ->hidden(fn(Get $get): bool => $get('for_days'))
                            ->multiple()
                            ->options([
                                'first' => 'first',
                                'second' => 'second',
                                'third' => 'third',
                                'quart' => 'quart',
                                'last' => 'last',
                            ]),
                        Forms\Components\Select::make('days')
                            ->hidden(fn(Get $get): bool => $get('type') != 'weekly' ^ ($get('type') == 'monthly' && !$get('for_days')))
                            ->multiple()
                            ->options([
                                'every day' => 'todos los días',
                                'monday' => 'monday',
                                'tusday' => 'tusday',
                            ]),
                        Forms\Components\Select::make('days_num')
                            ->hidden(fn(Get $get): bool => $get('type') == 'monthly' ^ $get('for_days'))
                            ->multiple()
                            ->options([
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                'last' => 'last',
                            ]),


                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('active')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('in_day_time')
                    ->badge(),
                Tables\Columns\TextColumn::make('days')
                    ->color('success')
                    ->badge(),
                Tables\Columns\TextColumn::make('days_num')
                    ->badge(),
                Tables\Columns\TextColumn::make('the')
                    ->badge(),
                Tables\Columns\TextColumn::make('months')
                    ->badge(),
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
            'index' => Pages\ListScheduledMaintenances::route('/'),
            'create' => Pages\CreateScheduledMaintenance::route('/create'),
            'edit' => Pages\EditScheduledMaintenance::route('/{record}/edit'),
        ];
    }
}
